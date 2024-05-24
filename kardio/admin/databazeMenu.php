<?php
if (isset($_SESSION["status"])&&$_SESSION["status"]==4)  {
require_once('sabloni/vkladane/zahlavi.php');
echo 'napredna manipulacija z bazo';

echo '
<h1>Menu databaze</h1>
<ul id="linky1">
<li><a href="kreateBaseBiznis.php ">naredi bazo: biznis</a></li>
<li><a href="kreateTableVse.php ">naredi tabele</a></li>
</ul>
';

echo'

<h1>Menu servis</h1>
<ul id="linky1">

<li><a href="../admin1/vertikalMenu.php ">Vertikal Menu</a></li>
<li><a href="manipulacePogojUniverzal.php?tabulka=uporabnikiTbl">upravljanje z uporabniki</a></li>
</ul>

';

require_once('sabloni/zapati.php'); 
   }//od if 
?>