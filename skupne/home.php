<?php
// varnost: dovoljena je samo obstoječa mapa z menuFile1.php (prej je šel parameter neprečiščen v gumb - XSS)
$home = '../frontend/menuFile1.php';
if (isset($_GET['doma'])) {
	$doma = $_GET['doma'];
	if (preg_match('/^[A-Za-z0-9_-]+$/', $doma) && is_file(__DIR__ . '/../' . $doma . '/menuFile1.php')) {
		$home = '../' . $doma . '/menuFile1.php';
	}
}
?>