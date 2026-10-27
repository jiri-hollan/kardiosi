<?php
/* PODATKI ZA POVEZAVO Z BAZO
   VZOREC: kopiraj v konfiguracija.php in vpiši prave podatke. konfiguracija.php ni v Gitu.
   Po spremembi gesla baze na strežniku tukaj popravi 'password' v delu 'streznik'. */
return array(
	'streznik' => array(
		'servername' => 'localhost',
		'username'   => 'UPORABNIK_BAZE',
		'password'   => 'GESLO_BAZE',
		'dbname'     => 'IME_BAZE',
	),
	'lokalno' => array(   // XAMPP
		'servername' => 'localhost',
		'username'   => 'root',
		'password'   => '',
		'dbname'     => 'biznis',
	),
);
