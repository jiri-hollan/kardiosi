<!--<ul id="links">
<li><a href="menuFile1.php?p=mespdf">RAZPIS</a></li>
<li><a href="menuFile1.php?p=zdravniki">ZDRAVNIKI</a></li>
<li><a href="mailto:kardio.an@gmail.com" >razpisovalec</a></li>
<li><a href="menuFile1.php?p=kuharica">KUHARICA</a></li>
<li><a href="menuFile1.php?p=povezave">POVEZAVE</a></li>
<li><a href="menuFile1.php?p=biznis">BIZNIS</a></li>
-->




<?php
/*
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

*/
class MenuAnestiz  {
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
 
echo '
<nav id= "glavnaNav">
<ul id="links">';
  if (isset($_SESSION["status"]))  {
	  //require_once('../skupne/menu-items.php'); 
	   switch ($_SESSION["status"]) {		   
	case 1:
	  echo $a1.$a0;
    break;   
     case 2:
	   echo $a1.$a0.$a2;
	 break;	 
	 case 3:
	   echo $a1.$a0.$a2;
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
	 	  echo $a0; 
   }
      echo '</ul></nav>';
   }//od construct
}//od class MenuAnestiz  
$adminAnestiz = new MenuAnestiz(); 
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
?>