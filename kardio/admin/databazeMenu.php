<?php
require_once('../skupne/sabloni/zahlavi.php');
echo 'napredna manipulacija z bazo';

echo '
<h1>Menu databaze</h1>
<ul id="linky1">
<li><a href="kreateBaseBiznis.php?nazaj='.$nazaj.'">naredi bazo: biznis</a></li>
<li><a href="kreateTableVse.php?nazaj='.$nazaj.'">naredi tabele</a></li>
</ul>
';

echo'
<div id="manipulace">
<h1>Menu servis</h1>
<ul id="linky1">

<li><a href="../admin1/vertikalMenu.php?nazaj='.$nazaj.'">Vertikal Menu</a></li>
<li><a href="manipulacePogojUniverzal.php?tabulka=uporabnikiTbl">upravljanje z uporabniki</a></li>
</ul>
</div>
';

require_once('sabloni/zapati.php'); 
?>