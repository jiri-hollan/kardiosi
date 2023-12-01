<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE HTML>
<html  lang="sl-SI"> 
<head>
 <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
 <meta http-equiv="Pragma" content="no-cache">
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </meta> 
  <link rel="stylesheet" href="css/index.css?<?php echo time(); ?>">
  <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>" >
<title>prikaz mesečnega razporeda v obliki PDF</title>
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
		$m = "crna.php";
		$n = "mespdf.php";
		$direktorij = "razpis/mespdf/";
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
			b += a;  
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

</html>