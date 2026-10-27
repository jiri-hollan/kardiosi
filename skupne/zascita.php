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

// CSRF žeton: vsak zaščiten obrazec dobi skrito polje "csrf"; POST brez pravega žetona se zavrne
function csrfZeton() {
	if (empty($_SESSION['csrf'])) {
		$_SESSION['csrf'] = bin2hex(random_bytes(32));
	}
	return $_SESSION['csrf'];
}

function preveriCsrf() {
	$jeBrisanje = isset($_GET['akce']) && strtolower($_GET['akce']) === 'odstrani';
	if ($_SERVER['REQUEST_METHOD'] === 'POST' || $jeBrisanje) {
		$poslan = $_POST['csrf'] ?? $_GET['csrf'] ?? '';
		if (!is_string($poslan) || !hash_equals(csrfZeton(), $poslan)) {
			http_response_code(403);
			exit('<h2>Zahteva ni veljavna (stran je potekla ali je datoteka prevelika). Osvežite stran in poskusite znova.</h2>');
		}
	}
	// v vse obrazce na strani samodejno doda skrito polje z žetonom
	static $vstavljeno = false;
	if (!$vstavljeno) {
		$vstavljeno = true;
		$zeton = csrfZeton();
		ob_start(function ($html) use ($zeton) {
			return preg_replace('/<form\b[^>]*>/i', '$0<input type="hidden" name="csrf" value="' . $zeton . '">', $html);
		});
	}
}

// ali ima prijavljeni uporabnik vsaj podani pristop (za shranjevanje in pregledovanje zapisov bolnikov)
function imaPristop($najnizjiPristop) {
	$casovniLimit = 1800;
	if (empty($_SESSION['uporabnikPrihlasen'])) {
		return false;
	}
	if (isset($_SESSION['casova_znamka']) && time() - $_SESSION['casova_znamka'] > $casovniLimit) {
		return false;
	}
	if (!isset($_SESSION['pristop']) || (int)$_SESSION['pristop'] < $najnizjiPristop) {
		return false;
	}
	$_SESSION['casova_znamka'] = time();
	return true;
}

function zahtevajPrijavo($najnizjiUpstatus = null) {
	$casovniLimit = 1800; // sekund neaktivnosti (30 minut)
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
	preveriCsrf();
}
?>