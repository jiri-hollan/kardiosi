<?php
/* Enotno preverjanje prijave in pravic za zaščitene strani.
   Uporaba na vrhu strani (pred kakršnimkoli izpisom):
       require_once __DIR__ . '/../skupne/zascita.php';
       zahtevajPrijavo(4);   // 4 = admin, 3 = biznis/servis, null = katerikoli prijavljen uporabnik
*/
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

// URL korena aplikacije: na XAMPP-u "/kardiosi", na strežniku "" (aplikacija je v korenu)
function korenAplikacijeUrl() {
	$koren = str_replace('\\', '/', (string)realpath(__DIR__ . '/..'));
	$docRoot = str_replace('\\', '/', (string)realpath($_SERVER['DOCUMENT_ROOT'] ?? ''));
	$docRoot = rtrim($docRoot, '/');
	if ($docRoot !== '' && strncasecmp($koren, $docRoot, strlen($docRoot)) === 0) {
		return rtrim(substr($koren, strlen($docRoot)), '/');
	}
	return '';
}

function preusmeriNaPrijavo($stav) {
	$url = korenAplikacijeUrl() . '/frontend/prihlaseni.php?r=login&stav=' . urlencode($stav);
	if (!headers_sent()) {
		header('Location: ' . $url);
	}
	echo '<script>window.location.href = ' . json_encode($url) . ';</script>';
	exit();
}

function zahtevajPrijavo($najnizjiUpstatus = null) {
	$casovniLimit = 600; // sekund neaktivnosti
	if (empty($_SESSION['uporabnikPrihlasen'])) {
		preusmeriNaPrijavo('odhlasit');
	}
	if (isset($_SESSION['casova_znamka']) && time() - $_SESSION['casova_znamka'] > $casovniLimit) {
		session_unset();
		session_destroy();
		preusmeriNaPrijavo('neaktivni');
	}
	$_SESSION['casova_znamka'] = time();
	if ($najnizjiUpstatus !== null && (!isset($_SESSION['upstatus']) || (int)$_SESSION['upstatus'] < $najnizjiUpstatus)) {
		http_response_code(403);
		exit('<h2>Za ta del niste pooblaščeni.</h2>');
	}
}
?>