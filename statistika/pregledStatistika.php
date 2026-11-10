<?php
/* Statistika pregledov iz tabele bolnikTbl (prirejeno po anestiz/statistika/pregledStatistika.php).
   GET  semafor=...                 -> vsi zapisi
   POST semafor, zacDatum, koncDatum -> zapisi v izbranem obdobju (obrazec iz js/bolnikPogoji.js) */
require_once __DIR__ . '/zascitaStatistika.php';
require_once __DIR__ . '/databaseS.php';
$nazaj = "statistikaMenu.php";
require_once('sabloni/zahlavi.php');
echo '<script src="js/bolnikPogoji.js?'.verzija('js/bolnikPogoji.js').'"></script>';
echo "<div class='flex-container'>";
require_once('sabloni/forma.php');

$tabulka = "bolnikTbl";
$semafor = $_REQUEST['semafor'] ?? '';
$podminka = NULL;
if (isset($_POST['semafor'])) {
	$podminka = [];
	if (!empty($_POST['zacDatum']))  { $podminka["datPregleda>="] = $_POST['zacDatum']; }
	if (!empty($_POST['koncDatum'])) { $podminka["datPregleda<="] = $_POST['koncDatum']; }
}

/* razvrstitve v skupine (CASE) za posamezno polje; {s} se nadomesti z imenom stolpca */
$razvrstitve = [
	"asa" => ["asa", "CASE WHEN {s} < 1 THEN 'ni&nbsp;podatkov' WHEN {s} BETWEEN 1 AND 5 THEN {s} ELSE 'verjetno&nbsp;neveljaven&nbsp;vnos' END"],
	"mallampati" => ["mallampati", "CASE WHEN {s} < 1 THEN 'ni&nbsp;podatkov' WHEN {s} BETWEEN 1 AND 4 THEN {s} ELSE 'verjetno&nbsp;neveljaven&nbsp;vnos' END"],
	"opiati" => ["opiati", "CASE WHEN {s} = '' THEN 'ni&nbsp;podatkov' ELSE {s} END"],
	"druge_Ovisnosti" => ["dovisnosti", "CASE WHEN {s} = '' THEN 'ni&nbsp;podatkov' ELSE {s} END"],
	"starost" => ["starost", "CASE WHEN {s} < 10 THEN {s} WHEN {s} BETWEEN 10 AND 100 THEN TRUNCATE({s}, -1) WHEN {s} BETWEEN 100 AND 110 THEN TRUNCATE({s}, -2) ELSE '200&nbsp;neveljaven&nbsp;vnos' END"],
	"ks" => ["ks", "CASE WHEN {s} < 1 THEN 'ni&nbsp;podatkov' WHEN {s} BETWEEN 1 AND 19 THEN TRUNCATE({s}, 0) WHEN {s} BETWEEN 20 AND 50 THEN TRUNCATE({s}, -1) ELSE 'verjetno&nbsp;neveljaven&nbsp;vnos' END"],
	"hb" => ["hb", "CASE WHEN {s} < 1 THEN 'ni&nbsp;podatkov' WHEN {s} BETWEEN 50 AND 200 THEN TRUNCATE({s}, -1) ELSE 'verjetno&nbsp;neveljaven&nbsp;vnos' END"],
	"trombociti" => ["trombociti", "CASE WHEN {s} < 1 THEN ' ni&nbsp;podatkov' WHEN {s} BETWEEN 1 AND 150 THEN '<150' WHEN {s} BETWEEN 100 AND 999 THEN TRUNCATE({s}, -2) WHEN {s} BETWEEN 1000 AND 20000 THEN TRUNCATE({s}, -3) ELSE 'verjetno&nbsp;neveljaven&nbsp;vnos' END"],
	"pbnp" => ["pbnp", "CASE WHEN {s} < 1 THEN ' ni&nbsp;podatkov' WHEN {s} BETWEEN 1 AND 99 THEN '<100' WHEN {s} BETWEEN 100 AND 999 THEN TRUNCATE({s}, -2) WHEN {s} BETWEEN 1000 AND 20000 THEN TRUNCATE({s}, -3) ELSE 'verjetno&nbsp;neveljaven&nbsp;vnos' END"],
	"spo2" => ["spo2", "CASE WHEN {s} < 1 THEN ' ni&nbsp;podatkov' WHEN {s} BETWEEN 50 AND 100 THEN TRUNCATE({s}, 1) ELSE 'verjetno&nbsp;neveljaven&nbsp;vnos' END"],
];
/* štetje po vrednostih polja brez razvrščanja */
$poKriterijih = ["pregledovalec" => "imeZdravnika", "sklep" => "sklep", "alergija" => "alergija"];

$baza = new DatabaseS();
if (isset($poKriterijih[$semafor])) {
	$stolpec = $poKriterijih[$semafor];
	$vybrano = $baza->counta($tabulka, [$stolpec], [$stolpec], $podminka);
	$nadpis = ($semafor == "pregledovalec") ? ["ime zdravnika", "število pregledov"] : [strtoupper($semafor), ""];
	izpisiTabelo($vybrano, $nadpis, $podminka, $semafor);
} elseif (isset($razvrstitve[$semafor])) {
	list($stolpec, $case) = $razvrstitve[$semafor];
	$vybrano = $baza->skupina($tabulka, [$stolpec], [$stolpec], $podminka, str_replace('{s}', $stolpec, $case));
	izpisiTabelo($vybrano, [strtoupper($semafor), ""], $podminka, $semafor);
} else {
	echo htmlspecialchars($semafor) . " - neznana izbira statistike";
}

function izpisiTabelo($vybrano, $nadpis, $podminka, $semafor) {
	$obdobje = '';
	if (isset($podminka["datPregleda>="]) || isset($podminka["datPregleda<="])) {
		$obdobje = "&nbsp;od:&nbsp;" . htmlspecialchars($podminka["datPregleda>="] ?? '') . "&nbsp;&nbsp;do:&nbsp;" . htmlspecialchars($podminka["datPregleda<="] ?? '') . "<br>";
	}
	if (count($vybrano) > 0) {
		$skupaj = 0;
		echo "<div class='udaje'>" . $obdobje;
		echo "<table id='pocet'>";
		echo "<tr class='glavaTable'><th>" . $nadpis[0] . "</th><th>" . $nadpis[1] . "</th></tr>";
		foreach ($vybrano as $vrstica) {
			$vrednosti = array_values($vrstica);
			$skupaj += (int)$vrednosti[1];
			// vrednosti iz CASE vsebujejo &nbsp; zato le ime iz baze (stolpec 0 pri counta) varujemo pred HTML
			$prva = ($vrednosti[0] === null) ? '' : (string)$vrednosti[0];
			if (strpos($prva, '&nbsp;') === false) { $prva = htmlspecialchars($prva); }
			echo "<tr><td>" . $prva . "</td><td>" . (int)$vrednosti[1] . "</td></tr>";
		}
		echo "<tr class='glavaTable'><th>skupaj</th><th>" . $skupaj . "</th></tr>";
		echo "</table></div>";
	} else {
		echo $obdobje . 'V izbranem terminu ni zapisov';
	}
	$danes = json_encode(date("Y-m-d"));
	echo "<script>intervalFunction($danes, " . json_encode($semafor) . ")</script>";
}

echo "</div>";
require_once 'sabloni/prijavljenJe.php';
require_once 'sabloni/zapati.php';
?>
