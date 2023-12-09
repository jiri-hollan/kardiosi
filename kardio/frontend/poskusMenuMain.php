<?php
//echo 'Menu anestiz';
require_once('sabloni/vkladane/zahlavi.php');
require_once('../skupne/administrace.php');

class MenuKardiosi  {
   public function __construct() {
   //require_once('../skupne/menu-items.php');  
   $direktorij = "";
$l="links.php";
$p="";    
$n="";
if(isset($_GET['p'])){
$p = $_GET['p'];
	}
	switch($p){
		case "mespdf":
		$n = "mespdf.php";
		$direktorij = "../razpis/mespdf/";
		$l= "";	
		break;
		
		case "zdravniki":
		$s = "";
		$l= "sorta.php";
		$n = "domov.php";
		break;
		
		case "razpisovalec":
		$s = "posta.php";
		$l= '';		
		$n = "domov.php";
		break;
		
		case "kuharica":
		$s = "zahod.php";
		$direktorij = "../besedila/";
		$l= 'navodila.php';
		$n = "domov.php";
		break;
		
		case "povezave":
		$s = "";
		$l= "linki.php";
		$n = "domov.php";
		break;		
	
	    case "biznis":
		$s = "";
		$l= "biznis.php";
		$n = "domov.php";
		break;	
			
		default:
		$s = "main.php";
	}
   
   
    }//od construct
}//od class MenuKardiosi  
$adminKardiosi = new MenuKardiosi(); 
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
require_once('sabloni/vkladane/zapati.php'); 
 ?>  