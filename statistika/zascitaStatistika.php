<?php
/* Skupna zaščita vseh strani statistike (kardiosi):
   - prijavljen uporabnik s statusom 2 ali več (sicer preusmeritev na prijavo / sporočilo)
   - gdpr == 1 (enako kot v anestiz), sicer nazaj na začetno stran */
require_once __DIR__ . '/../skupne/zascita.php';
zahtevajPrijavo(2);
// aktivace.php izpiše <script> - izpis zavržemo, potrebujemo le $gdpr
ob_start();
require_once __DIR__ . '/../skupne/aktivace.php';
ob_end_clean();
if (!isset($gdpr) || (int)$gdpr != 1) {
	header('Location: ../frontend/menuFile1.php');
	echo '<script>window.location.href = "../frontend/menuFile1.php";</script>';
	exit();
}
?>
