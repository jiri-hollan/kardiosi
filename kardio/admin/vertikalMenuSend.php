<?php
echo 'napredna manipulacija z bazo';
require_once('../admin/sabloni/vkladane/zahlavi.php');
require_once('../admin/administrace.php');

class Vertikal extends Administrace {
   public function __construct() {
	       parent::__construct();
		   
 /* if (isset($_SESSION["status"]) && $_SESSION["status"] == 3)  {*/
$nazaj="../admin1/vertikalMenu.php";
//-----------------nova koda-------------------
?>
<form>
<input type="hidden" class="" name="nazaj" value="$mazaj">
<input type="submit" name="" value="">
</form>
<?php
//-------------------------------------------------------
echo '


<h1>Menu databaze</h1>
<ul id="linky1">

<li><a href="kreateBaseNavodila.php?nazaj='.$nazaj.'">naredi bazo: navodila</a></li>
<li><a href="kreateTableVse.php?nazaj='.$nazaj.'">naredi tabele</a></li>
</ul>
';
  /*   } else {
	echo	' <h2>za ta del niste pooblaščeni</h2>';
	}*/
   }//od construct 
}//od class vertikal  
 $adminVnertikal = new Vertikal(); 
require_once('../admin/sabloni/vkladane/zapati.php'); 
?>