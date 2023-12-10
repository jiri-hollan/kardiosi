<?php
require_once('../skupne/sabloni/zahlavi.php');
echo 'napredna manipulacija z bazo';

/*
require_once('administrace.php');

class Vertikal extends Administrace {
   public function __construct() {
	       parent::__construct();
		   
 /* if (isset($_SESSION["status"]) && $_SESSION["status"] == 3)  {
$nazaj="databazeMenu.php";
//-----------------nova koda-------------------
*/
?>
<!--<form>
<input type="hidden" class="" name="nazaj" value="$nazaj">
<input type="submit" name="" value="">
</form>-->
<?php
//-------------------------------------------------------
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

<li><a href="manipulaceObjektUniverzal.php?tabulka=uporabnikiTbl">upravljanje z uporabniki</a></li>
<li><a href="../admin1/vertikalMenu.php?nazaj='.$nazaj.'">Vertikal Menu</a></li>
<li><a href="manipulacePogojUniverzal.php?tabulka=uporabnikiTbl">Poskus pogoj</a></li>
</ul>
</div>
';
  /*   } else {
	echo	' <h2>za ta del niste pooblaščeni</h2>';

   }//od construct 
}//od class vertikal  
 $adminVnertikal = new Vertikal(); 
 	}*/
require_once('sabloni/zapati.php'); 
?>