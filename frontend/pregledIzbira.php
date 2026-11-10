<?php
// Stran, ki se odpre po kliku na PREGLED (menuFile1.php?p=pregled):
// gumb "Pregled bolnika" (prejšnja vsebina PREGLED) in gumb "Statistika".
// Statistika: enaki pogoji kot v anestiz - prijavljen, status 2-4 in gdpr == 1.
require_once __DIR__ . '/../skupne/aktivace.php';
$upstatus = isset($_SESSION["upstatus"]) ? (int)$_SESSION["upstatus"] : -1;
$pokaziStatistiko = jePrijavljen() && $upstatus >= 2 && $upstatus <= 4 && isset($gdpr) && (int)$gdpr == 1;
?>
<style>
#pregledIzbira { list-style-type: none; margin: 20px 0; padding: 0; }
#pregledIzbira li { display: inline-block; margin: 0 20px 20px 0; background: #4444FF; border-radius: 15px; }
#pregledIzbira a { display: block; padding: 25px 40px; color: #FFFF80; font-size: 130%; text-decoration: none; cursor: pointer; }
#pregledIzbira li:hover { background: #2222AA; }
</style>
<ul id="pregledIzbira">
	<li><a onclick='sbFunction("spomin"); return false;' href="../pregled/zdravnik.php">PREGLED BOLNIKA</a></li>
<?php if ($pokaziStatistiko) { ?>
	<li><a href="../statistika/statistikaMenu.php">STATISTIKA</a></li>
<?php } ?>
</ul>
