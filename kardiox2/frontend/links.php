<?php
class MenuBiznis  {
   public function __construct() { 
 $a0= '
<li><a href="menuFile1.php?p=kuharica">KUHARICA</a></li>
<li><a href="menuFile1.php?p=povezave">POVEZAVE</a></li>
<li><a href="mailto:kardio.an@gmail.com" >razpisovalec</a></li>
';
$a1= '
<li><a href="menuFile1.php?p=mespdf">RAZPIS</a></li>
<li><a href="menuFile1.php?p=zdravniki">ZDRAVNIKI</a></li>
';
$a2= '
<li><a href="menuFile1.php?p=biznis">BIZNIS</a></li>
'; 
$a3= '
<li><a href="menuFile1.php?p=admin">ADMIN</a></li>
'; 
$a4= '
<li><a href="menuFile1.php?p=pregled">PREGLED</a></li>
';  
echo '
<nav id= "glavnaNav">
<ul id="links">';
  if (isset($_SESSION["upstatus"]))  {
	  //require_once('../skupne/menu-items.php'); 
	   switch ($_SESSION["upstatus"]) {
	case 0; 
	  echo $a1.$a4.$a0;
	  echo "<p style='color: black;'>vaša registracija še ni overjena</>";
	break;  
	case 1:
	  echo $a1.$a4.$a0;
    break;   
     case 2:
	   echo $a1.$a4.$a0;
	 break;	 
	 case 3:
	   echo $a1.$a4.$a0.$a2;
    break;
	 case 4:
	   echo $a1.$a4.$a0.$a2.$a3;
    break;   	
    default:
	   } //od switch
	 echo
	'<script>
    document.getElementById("prij").innerHTML = "Odjava";
	document.getElementById("uname").innerHTML = "prijavljen";	
     </script>';
   }//od if 
   else{
	 	  echo $a1.$a0; 
   }
      echo '</ul></nav>';
   }//od construct
}//od class MenuBiznis  
$adminAnestiz = new MenuBiznis(); 
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
?>