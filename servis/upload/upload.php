<?php
declare(strict_types=1);
require_once __DIR__ . '/../../skupne/zascita.php'; // zaščita: samo upstatus 3 ali več (biznis/servis)
zahtevajPrijavo(3);
 
/**
 * servis/upload/upload.php
 * Nalaganje mesečnega razpisa dežurstev (PDF).
 *
 * Dostop: samo prijavljeni uporabniki z upstatus 3 ali več (skupne/zascita.php).
 */
 
const MAX_SIZE = 500000; // največja dovoljena velikost v bajtih (500 KB)
const TARGET_DIR = __DIR__ . '/../../razpis/mespdf';
const ALLOWED_FILES = [
    'januar.pdf', 'februar.pdf', 'marec.pdf', 'april.pdf', 'maj.pdf', 'junij.pdf',
    'julij.pdf', 'avgust.pdf', 'september.pdf', 'oktober.pdf', 'november.pdf', 'december.pdf',
];
 
/** Izpiše varno (escape-ano) vrednost za HTML. */
function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
 
/** Izpiše rezultat kot stran in konča skripto. */
function izpis(int $koda, string $naslov, string $sporocilo): void
{
    http_response_code($koda);
    header('Content-Type: text/html; charset=utf-8');
    header('Cache-Control: no-store');
    echo '<!DOCTYPE html>' . "\n";
    echo '<html lang="sl-SI">' . "\n";
    echo '<head><meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>' . e($naslov) . '</title></head>' . "\n";
    echo '<body>' . "\n";
    echo '<h1>' . e($naslov) . '</h1>' . "\n";
    echo '<p>' . e($sporocilo) . '</p>' . "\n";
    echo '<p><a href="formUpload.html">Nazaj na obrazec</a></p>' . "\n";
    echo '</body></html>';
    exit;
}
 
/** Prevede kodo napake nalaganja v berljivo sporočilo. */
function napakaNalaganja(int $koda): string
{
    switch ($koda) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            return 'Datoteka je prevelika.';
        case UPLOAD_ERR_PARTIAL:
            return 'Datoteka je bila naložena samo delno. Poskusite znova.';
        case UPLOAD_ERR_NO_FILE:
            return 'Datoteke niste izbrali.';
        default:
            return 'Pri nalaganju je prišlo do napake (koda ' . $koda . ').';
    }
}
 
// 1. Dovoljena je samo metoda POST.
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Allow: POST');
    izpis(405, 'Napaka', 'Ta stran sprejme samo oddan obrazec.');
}
 
// 2. Mesec mora biti na seznamu dovoljenih imen (preprečuje pisanje kamorkoli).
$mesec = $_POST['meseci'] ?? '';
if (!is_string($mesec) || !in_array($mesec, ALLOWED_FILES, true)) {
    izpis(400, 'Napaka', 'Izbrani mesec ni veljaven.');
}
 
// 3. Zamenjava obstoječe datoteke samo, če je izrecno izbrana.
$zamenjaj = (($_POST['obstojeca'] ?? '') === '1');
 
// 4. Preveri nalaganje.
$datoteka = $_FILES['fileToUpload'] ?? null;
if (!is_array($datoteka) || !isset($datoteka['error'], $datoteka['tmp_name'], $datoteka['size'])) {
    izpis(400, 'Napaka', 'Datoteka ni bila poslana.');
}
if ($datoteka['error'] !== UPLOAD_ERR_OK) {
    izpis(400, 'Napaka', napakaNalaganja((int) $datoteka['error']));
}
if (!is_uploaded_file($datoteka['tmp_name'])) {
    izpis(400, 'Napaka', 'Neveljavno nalaganje.');
}
if ($datoteka['size'] > MAX_SIZE) {
    izpis(413, 'Datoteka je prevelika', 'Največja dovoljena velikost je ' . (int) (MAX_SIZE / 1000) . ' KB.');
}
 
// 5. Preveri vsebino: mora biti PDF (začetek "%PDF-" in, če je na voljo, MIME tip).
$glava = '';
$fh = fopen($datoteka['tmp_name'], 'rb');
if ($fh !== false) {
    $glava = (string) fread($fh, 5);
    fclose($fh);
}
$jePdf = ($glava === '%PDF-');
if ($jePdf && function_exists('finfo_open')) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    if ($finfo !== false) {
        $jePdf = (finfo_file($finfo, $datoteka['tmp_name']) === 'application/pdf');
        finfo_close($finfo);
    }
}
if (!$jePdf) {
    izpis(400, 'Neveljavna datoteka', 'Dovoljene so samo datoteke PDF.');
}
 
// 6. Ciljna mapa mora obstajati in biti zapisljiva.
$mapa = realpath(TARGET_DIR);
if ($mapa === false || !is_dir($mapa) || !is_writable($mapa)) {
    error_log('upload.php: ciljna mapa ni na voljo: ' . TARGET_DIR);
    izpis(500, 'Napaka na strežniku', 'Ciljna mapa ni na voljo.');
}
$cilj = $mapa . DIRECTORY_SEPARATOR . $mesec;
 
if (file_exists($cilj) && !$zamenjaj) {
    izpis(409, 'Datoteka že obstaja', $mesec . ' že obstaja in ni bila zamenjana. Izberite »Zamenjaj«, če jo želite prepisati.');
}
 
// 7. Zapiši najprej v začasno datoteko, nato jo preimenuj (da ni napol zapisane datoteke).
$zacasna = tempnam($mapa, 'upl_');
if ($zacasna === false) {
    error_log('upload.php: tempnam ni uspel v ' . $mapa);
    izpis(500, 'Napaka na strežniku', 'Datoteke ni bilo mogoče shraniti.');
}
if (!move_uploaded_file($datoteka['tmp_name'], $zacasna)) {
    @unlink($zacasna);
    izpis(500, 'Napaka na strežniku', 'Datoteke ni bilo mogoče shraniti.');
}
if (!rename($zacasna, $cilj)) {
    @unlink($zacasna);
    error_log('upload.php: rename ni uspel za ' . $cilj);
    izpis(500, 'Napaka na strežniku', 'Datoteke ni bilo mogoče shraniti.');
}
@chmod($cilj, 0644);
 
$izvirnoIme = isset($datoteka['name']) ? basename((string) $datoteka['name']) : '';
izpis(200, 'Datoteka je naložena', 'Datoteka ' . $izvirnoIme . ' je bila naložena kot ' . $mesec . '.');
 