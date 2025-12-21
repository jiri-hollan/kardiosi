<?php
if (!isset($_SESSION)) session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
require_once('sabloni/vkladane/zahlavi.php');
require_once('administrace.php');

class MenuBiznis  {
   public function __construct() { 
 $a0= '
';

$a1= '
';

$a2= '
'; 

$a3= '
';  
echo '
<nav id= "glavnaNav">
<ul id="links">';
  if (isset($_SESSION["upstatus"]))  {
	   switch ($_SESSION["upstatus"]) {		   
	case 1:
	  
    break;   
     case 2:  
	 break;	
	 
	 case 3:
    break;
	
	 case 4:
	 require_once('../admin/databazeMenu.php');
    break; 
  	
    default:
	   } //od switch
	/* echo
	'<script>
    document.getElementById("prij").innerHTML = "Odjava";
	document.getElementById("uname").innerHTML = "prijavljen";	
     </script>';*/
   }//od if 
   else{
	 	  echo $a0; 
   }
      echo '</ul></nav>';
   }//od construct
}//od class MenuBiznis  
$adminAnestiz = new MenuBiznis(); 
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
?>