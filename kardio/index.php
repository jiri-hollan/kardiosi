

<!DOCTYPE HTML>

<html  lang="sl-SI"> 
<head>
 <meta name="generator" content="HTML Tidy for Windows (vers 13 April 2006), see www.w3.org"> 
 <meta http-equiv="Content-Type" content="text/html;charset=utf-8_general_ci" > 
 <meta name="GENERATOR" content="OpenOffice.org 2.0 (Win32)"> 
 <meta name="CHANGEDBY" content="Jiri Hollan"> 
 <meta name="CHANGED" content="20080311;13163818"> 
 <meta http-equiv="cache-control" content="No-Cache"></meta> 
<title>prikaz mese&#269nega razporeda v obliki PDF</title>
<?php
$direktorij = "";
$l="links.php";
$p="";    
$n="";

if(isset($_GET['p'])){
$p = $_GET['p'];
	}
	switch($p){
		case "mespdf":
		$m = "crna.htm";
		$n = "mespdf.php";
		$direktorij = "razpis/mespdf/";
		$l= "";
		
		break;
		
		case "zdravniki":
		$s = "";
		$l= "sorta.htm";
		$n = "domov.php";
		break;
		
		case "razpisovalec":
		$s = "posta.php";
		$l= '';		
		$n = "domov.php";
		break;
		
		case "kuharica":
		$s = "zahod.php";
		$direktorij = "besedila/";
		$l= 'navodila.php';
		$n = "domov.php";
		break;
		
		case "povezave":
		$s = "";
		$l= "linki.htm";
		$n = "domov.php";
		break;		
	
	    case "biznis":
		$s = "";
		$l= "biznis.htm";
		$n = "domov.php";
		break;	
	
		
		default:
		$s = "main.php";
	}

?>





	<link rel="stylesheet" type="text/css"  href="style.css" >
	<script type="text/javascript">
     var direktorij= "<?php echo $GLOBALS ['direktorij'] ?>";
	
	
	
		function showPDF(a){
		
		
		var b = '<iframe width="900px" height="900px" name="plugin" src=" '; 
		
		    b += direktorij;
			
			b += a;  
			b += '.pdf" type="application/pdf">';
			b += '</iframe> '
		    
			document.getElementById('tojePdf').innerHTML= b;  
			
		}
		

	

	
		function showZDR(a){
		

		var b = '<iframe width="1400px" height="900px" name="plugin" src=" '; 
		
			//b = '<';
			b += a;  
			//b += '>';
			b += '"';
			b += ' type="html">';
			
			
			b += '</iframe> ';
			

			document.getElementById('vsebina').innerHTML= b;  
			
		}
		
	</script>
	
	

</head>

	<div id="nav">    <?php if (isset($l) and $l != "") {include($l); }?></div>     
	<div id="vsebina"><?php if (isset($s) and $s != "") {include($s); }?></div>
	<div id="sos">    <?php if (isset($n) and $n != "") {include($n); }?></div>
	<div id="cela">   <?php if (isset($m) and $m != "") {include($m); }?></div>
	<!--<	<br><br><br><br>
	p id="demo">Sem se prenese</p>-->

</html>