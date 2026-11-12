<?php
// seznam zdravnikov z e-poštnimi naslovi vidijo samo prijavljeni uporabniki
require_once __DIR__ . '/../skupne/zascita.php';
zahtevajPrijavo();
// uporabniki s statusom pod 1 (0 in 0.5) seznama ne vidijo
if (upstatusUporabnika() < 1) {
	exit('<!DOCTYPE html><html lang="sl"><head><meta charset="utf-8"></head>'
		. '<body style="font-family: sans-serif; padding: 20px;"><p><b>Dostop ni omogočen.</b></p></body></html>');
}
?><script>
/* E-pošta: povezava mailto: odpre privzeti program za pošto, a samo, če je ta nastavljen v računalniku.
   Zato ponudimo tudi Gmail, Outlook na spletu in kopiranje naslova - to deluje povsod. */
// skrita = true: naslovi gredo v Skp (skrita kopija), da prejemniki ne vidijo drug drugega (okrožnica)
function moznostiPoste(naslovi, naslov, skrita) {
	var enc = encodeURIComponent(naslovi);
	var polje = skrita ? 'bcc' : 'to';
	var div = document.createElement('div');
	var vrstice = [
		[skrita ? 'mailto:?bcc=' + naslovi : 'mailto:' + naslovi, naslov + ' (program za pošto)'],
		['https://mail.google.com/mail/?view=cm&fs=1&' + polje + '=' + enc, naslov + ' v Gmailu'],
		['https://outlook.office.com/mail/deeplink/compose?' + polje + '=' + enc, naslov + ' v Outlooku (splet)']
	];
	vrstice.forEach(function (v) {
		var p = document.createElement('p'); p.className = 'obarvaj';
		var a = document.createElement('a'); a.href = v[0]; a.textContent = v[1];
		if (v[0].indexOf('mailto:') === 0) { a.target = '_top'; } else { a.target = '_blank'; a.rel = 'noopener'; }
		p.appendChild(a); div.appendChild(p);
	});
	var p = document.createElement('p'); p.className = 'obarvaj';
	var gumb = document.createElement('a'); gumb.href = '#'; gumb.textContent = 'Kopiraj naslov' + (naslovi.indexOf(',') >= 0 ? 'e' : '');
	gumb.onclick = function () { kopiraj(naslovi, gumb); return false; };
	p.appendChild(gumb);
	if (skrita) { var opomba = document.createElement('small'); opomba.textContent = ' (prilepite v polje Skp)'; p.appendChild(opomba); }
	div.appendChild(p);
	return div;
}

function kopiraj(besedilo, gumb) {
	var potrdi = function () { var t = gumb.textContent; gumb.textContent = 'Kopirano ✓'; setTimeout(function () { gumb.textContent = t; }, 2000); };
	if (navigator.clipboard && window.isSecureContext) {
		navigator.clipboard.writeText(besedilo).then(potrdi, function () { kopirajStaro(besedilo); potrdi(); });
	} else {
		kopirajStaro(besedilo); potrdi();
	}
}
function kopirajStaro(besedilo) {
	var ta = document.createElement('textarea'); ta.value = besedilo;
	ta.style.position = 'fixed'; ta.style.opacity = '0';
	document.body.appendChild(ta); ta.select();
	try { document.execCommand('copy'); } catch (e) { window.prompt('Kopirajte naslov:', besedilo); }
	document.body.removeChild(ta);
}

function person(id, ime, priimek, email) {
	var desno = document.getElementById('desno');
	desno.innerHTML = '';
	var slika = document.createElement('img');
	slika.src = '../kardio/podobe/personId' + parseInt(id, 10) + '.jpg'; slika.alt = '---- '; slika.width = 200;
	var h2 = document.createElement('h2'); h2.textContent = ime + ' ' + priimek;
	desno.appendChild(slika); desno.appendChild(document.createElement('br')); desno.appendChild(h2);
	if (email) {
		var naslov = document.createElement('p'); naslov.textContent = email;
		desno.appendChild(naslov);
		desno.appendChild(moznostiPoste(email, 'E pošta'));
	}
}
</script>
<?php
/* V tom failu so funkcije za spreminjanje tabele databaze*/
require_once '../skupne/database.php';
// varnost: dovoljeni sta samo skupini 1 (pridruženi) in 2 (člani); prej je šel parameter neposredno v ime datoteke za require_once
$pogoj = isset($_REQUEST["pogoj"]) && in_array($_REQUEST["pogoj"], array('1', '2'), true) ? $_REQUEST["pogoj"] : NULL;
if ($pogoj !== NULL) {
	require_once 'sabloni/zahlaviPoskusArray' . $pogoj . '.php';
}

$podminka = array("upstatus"=>$pogoj);

vyberFunction($podminka);
function vyberFunction($podminka){
$tabulka="uporabnikiTbl";
$stolpci=array("id", "ime", "priimek", "email");
$vyber = new database();
$vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
if (!is_array($vybrano)) { $vybrano = array(); }

echo"<div style='position:absolute; top:0; left:10px;width:200px'>";
$emajly = array();
$jsonZastavice = JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE;
foreach ($vybrano as $vrstica) {
	// podatki so v bazi shranjeni z htmlspecialchars, zato jih za prikaz najprej dekodiramo
	$ime = html_entity_decode((string)$vrstica["ime"], ENT_QUOTES, 'UTF-8');
	$priimek = html_entity_decode((string)$vrstica["priimek"], ENT_QUOTES, 'UTF-8');
	$email = trim(html_entity_decode((string)$vrstica["email"], ENT_QUOTES, 'UTF-8'));
	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) { $email = ''; }
	$argumenti = json_encode(array((int)$vrstica["id"], $ime, $priimek, $email), $jsonZastavice);
	echo "<p class='obarvaj' onclick='person.apply(null, " . $argumenti . ")'>"
		. htmlspecialchars($ime . ' ' . $priimek, ENT_QUOTES, 'UTF-8') . "</p>";
	if ($email !== '') { $emajly[] = $email; }
}//od foreach
if (count($emajly) > 0) {
	echo "<p><b>okrožnica</b></p><div id='okroznica'></div>";
	echo "<script>document.getElementById('okroznica').appendChild(moznostiPoste("
		. json_encode(implode(',', $emajly), $jsonZastavice) . ", 'Okrožnica', true));</script>";
}
echo"</div>";

}//od vyberFunction 
?>
