<?php
// Podatki za povezavo z bazo so v skupne/konfiguracija.php, ki NI v Gitu (glej .gitignore).
// Vzorec je v skupne/konfiguracija.primer.php
if (!is_file(__DIR__ . '/konfiguracija.php')) {
	exit('Manjka datoteka skupne/konfiguracija.php (kopiraj konfiguracija.primer.php in vpiši podatke za bazo).');
}
$konfiguracijaBaze = require __DIR__ . '/konfiguracija.php';
$izbranaBaza = ($_SERVER['SERVER_NAME'] == "localhost") ? $konfiguracijaBaze['lokalno'] : $konfiguracijaBaze['streznik'];
$this->servername = $izbranaBaza['servername'];
$this->username   = $izbranaBaza['username'];
$this->password   = $izbranaBaza['password'];
$this->dbname     = $izbranaBaza['dbname'];
?>
