<?php
require_once __DIR__ . '/zascitaStatistika.php';
$nazaj = ""; // namesto gumba Nazaj je samo gumb Domov (na začetno stran)
require_once('sabloni/zahlavi.php');
require_once('menuStatistika-items.php');
echo '<nav class="statistikaNav"><ul>';
switch ((int)$_SESSION["upstatus"]) {
	case 2:
		echo $a0.$a1.$a2;
		break;
	case 3:
		echo $a0.$a1.$a2.$a3;
		break;
	case 4:
		echo $a0.$a1.$a2.$a3.$a4;
		break;
	default:
}
echo '</ul></nav>';
require_once 'sabloni/prijavljenJe.php';
require_once('sabloni/zapati.php');
?>
