<?php
require_once __DIR__ . '/../skupne/zascita.php'; // zaščita: samo upstatus 3 ali več (biznis/servis)
zahtevajPrijavo(3);
// po oddaji obrazca (POST) ni podatka nazaj: vrnemo se na Servis
$privzetiNazaj = "../servis/servis.php";
require_once '../skupne/sabloni/zahlavi.php';

/* KOLEDAR: iz prototipa (servis/prototipi/prototipKoledarja.xlsx) naredi koledar za izbrano leto
   v mapi kardio/razpis/msofice/<leto>.xlsx.
   Prototip je v celoti voden z leto v celici Predloge!A1 (datumi, dnevi, prazniki, velika noč),
   zato se v kopiji spremeni samo ta celica, Excel/LibreOffice pa ob odprtju vse preračuna.
   Če koledar za to leto že obstaja, se NE prepiše - najprej ga je treba ročno izbrisati. */

$prototip = __DIR__ . '/prototipi/prototipKoledarja.xlsx';
$mapaKoledarjev = __DIR__ . '/../kardio/razpis/msofice';
$urlMape = '../kardio/razpis/msofice';

$sporocilo = '';
$napaka = '';
$vneseno = date('Y') + 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$vneseno = trim((string)($_POST['leto'] ?? ''));
	if (!preg_match('/^\d{4}$/', $vneseno) || (int)$vneseno < 2000 || (int)$vneseno > 2100) {
		$napaka = 'Vnesite letnico s štirimi številkami (med 2000 in 2100).';
	} else {
		$leto = (int)$vneseno;
		$obstojece = array();
		foreach (array('xlsx', 'xls', 'ods') as $kon) {
			if (file_exists($mapaKoledarjev . '/' . $leto . '.' . $kon)) {
				$obstojece[] = $leto . '.' . $kon;
			}
		}
		if (count($obstojece) > 0) {
			$napaka = 'Koledar za leto ' . $leto . ' v mapi msofice že obstaja (' . implode(', ', $obstojece) . ').<br>'
				. 'Če želite narediti novega, je treba obstoječega najprej ročno izbrisati.';
		} else {
			$rezultat = narediKoledar($prototip, $mapaKoledarjev, $leto);
			if ($rezultat === true) {
				$sporocilo = 'Koledar za leto ' . $leto . ' je narejen: '
					. '<a href="' . $urlMape . '/' . $leto . '.xlsx">' . $leto . '.xlsx</a>';
			} else {
				$napaka = $rezultat;
			}
		}
	}
}

// vrne true ali besedilo napake
function narediKoledar($prototip, $mapa, $leto) {
	if (!class_exists('ZipArchive')) {
		return 'PHP nima vključene razširitve zip (ZipArchive), zato koledarja ni mogoče narediti.';
	}
	if (!is_file($prototip)) {
		return 'Prototip koledarja ne obstaja: servis/prototipi/prototipKoledarja.xlsx';
	}
	if (!is_dir($mapa) || !is_writable($mapa)) {
		return 'V mapo kardio/razpis/msofice ni mogoče pisati.';
	}
	$cilj = $mapa . '/' . $leto . '.xlsx';
	$zacasna = $mapa . '/.koledar_' . $leto . '_' . bin2hex(random_bytes(4)) . '.xlsx';
	if (!copy($prototip, $zacasna)) {
		return 'Prototipa ni bilo mogoče kopirati.';
	}

	$zip = new ZipArchive();
	if ($zip->open($zacasna) !== true) {
		@unlink($zacasna);
		return 'Prototipa ni bilo mogoče odpreti (ni veljavna datoteka xlsx).';
	}

	// 1) poiščemo list "Predloge"
	$workbook = $zip->getFromName('xl/workbook.xml');
	$rels = $zip->getFromName('xl/_rels/workbook.xml.rels');
	$potPredloge = null;
	if ($workbook !== false && $rels !== false
		&& preg_match('/<sheet\b[^>]*\bname="Predloge"[^>]*\br:id="([^"]+)"/', $workbook, $m)
		&& preg_match('/<Relationship\b[^>]*\bId="' . preg_quote($m[1], '/') . '"[^>]*\bTarget="([^"]+)"/', $rels, $t)) {
		$potPredloge = 'xl/' . ltrim(preg_replace('#^/?xl/#', '', $t[1]), '/');
	}
	if ($potPredloge === null || ($predloge = $zip->getFromName($potPredloge)) === false) {
		$zip->close();
		@unlink($zacasna);
		return 'V prototipu ni lista "Predloge".';
	}

	// 2) v Predloge!A1 vpišemo leto (ohranimo obliko celice)
	$novaA1 = function ($ujemanje) use ($leto) {
		$slog = '';
		if (preg_match('/\bs="(\d+)"/', $ujemanje[1], $s)) {
			$slog = ' s="' . $s[1] . '"';
		}
		return '<c r="A1"' . $slog . ' t="inlineStr"><is><t>' . $leto . '</t></is></c>';
	};
	$predloge = preg_replace_callback('#<c r="A1"([^>]*?)(?:/>|>.*?</c>)#s', $novaA1, $predloge, 1, $stevilo);
	if ($stevilo !== 1) {
		$zip->close();
		@unlink($zacasna);
		return 'V listu "Predloge" ni celice A1 z letnico.';
	}
	$zip->addFromString($potPredloge, $predloge);

	// 3) iz vseh listov odstranimo shranjene (stare) rezultate formul, da se ne prikažejo datumi prototipa
	for ($i = 0; $i < $zip->numFiles; $i++) {
		$ime = $zip->getNameIndex($i);
		if (!preg_match('#^xl/worksheets/[^/]+\.xml$#', $ime)) {
			continue;
		}
		$xml = ($ime === $potPredloge) ? $predloge : $zip->getFromName($ime);
		$xml = preg_replace('#(<f\b[^>]*/>|<f\b[^>]*>.*?</f>)<v>.*?</v>#s', '$1', $xml);
		$zip->addFromString($ime, $xml);
	}

	// 4) Excel/LibreOffice naj ob odprtju vse preračunata
	if (strpos($workbook, 'fullCalcOnLoad') === false) {
		if (preg_match('#<calcPr\b#', $workbook)) {
			$workbook = preg_replace('#<calcPr\b#', '<calcPr fullCalcOnLoad="1"', $workbook, 1);
		} else {
			$workbook = str_replace('</workbook>', '<calcPr fullCalcOnLoad="1"/></workbook>', $workbook);
		}
		$zip->addFromString('xl/workbook.xml', $workbook);
	}
	if ($zip->locateName('xl/calcChain.xml') !== false) {
		$zip->deleteName('xl/calcChain.xml');
	}

	if (!$zip->close()) {
		@unlink($zacasna);
		return 'Koledarja ni bilo mogoče shraniti.';
	}
	// še enkrat preverimo, da ga medtem ni kdo naredil, potem ga preimenujemo v končno ime
	if (file_exists($cilj)) {
		@unlink($zacasna);
		return 'Koledar za leto ' . $leto . ' je medtem že nastal. Najprej ga je treba ročno izbrisati.';
	}
	if (!rename($zacasna, $cilj)) {
		@unlink($zacasna);
		return 'Koledarja ni bilo mogoče shraniti v mapo msofice.';
	}
	return true;
}
?>
<h2>Koledar</h2>
<p>Iz prototipa <i>servis/prototipi/prototipKoledarja.xlsx</i> naredi koledar za izbrano leto v mapi <i>kardio/razpis/msofice</i>.</p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <strong>LETNICA:</strong>
  <input type="number" name="leto" min="2000" max="2100" step="1" required value="<?php echo htmlspecialchars((string)$vneseno); ?>">
  <input type="submit" value="potrdi">
</form>
<?php
if ($napaka !== '') {
	echo '<p style="color: red; font-weight: bold;">' . $napaka . '</p>';
}
if ($sporocilo !== '') {
	echo '<p style="color: green; font-weight: bold;">' . $sporocilo . '</p>';
}
require_once '../skupne/sabloni/zapati.php';
?>
