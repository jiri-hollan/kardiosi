<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) { session_start(); }
/*header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");*/
require_once('sabloni/zahlaviSkupne.php');
require_once('../admin/administrace.php');
require_once(__DIR__ . '/../skupne/zascita.php');
include_once "../skupne/pregledovalciKomb.php";
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
$direktorij = "";
$l="links.php";
$p="";    
$n="";
$prijava="sabloni/vkladane/prihlas.php";
if(isset($_GET['p'])){
$p = $_GET['p'];
	}
	switch($p){
		case "mespdf":
		// razpis je dostopen le prijavljenim uporabnikom
		if (!jePrijavljen()) {
			$s = "samoPrijavljeni.php";
			$n = "domov.php";
			break;
		}
		$n = "mespdf.php";
		// PDF-ji niso več dostopni neposredno; odpre jih razpisPdf.php, ki preveri prijavo
		$direktorij = "razpisPdf.php?m=";
		$l= "";	
		$prijava="";
		break;
		
		case "zdravniki":
		$s = "zdruziteSe.php";
		$l= "sorta.php";
		$n = "domov.php";
		$prijava="";
		break;
		
	/*	case "razpisovalec":
		$s = "posta.php";
		$l= '';		
		$n = "domov.php";
		$prijava="";
		break;*/
		
		case "kuharica":
		$s = "zahod.php";
		$direktorij = "../kardio/besedila/";
		$l= '../navodila/navodilaKovid.php';
		$n = "domov.php";
		$prijava="";
		break;
		
		case "povezave":
		$s = "";
		$l= "../linki.php";
		$n = "domov.php";
		$prijava="";
		break;		
		
		case "pregled":
		// stran z gumboma "Pregled bolnika" in "Statistika" (prej je takoj preusmerilo na pregled bolnika)
		$s = "pregledIzbira.php";
        //echo '<script>sbFunction("spomin");</script>';
		//echo '<script>window.location="../pregled/zdravnik.php";</script>';
		$n = "domov.php";
		$prijava="";
		break;	
		
	    case "biznis":
		echo '<script>window.location="../biznis/biznis.php";</script>';
		break;
		
        case "admin":

		  header("Location: ../admin/admin.php");
		break;			
					
		default:
		$s = "main.php";
	}
?>

	<script src="js/pdfPrikaz.js?<?php echo verzija('js/pdfPrikaz.js'); ?>"></script>
	<script type="text/javascript">
     var direktorij= "<?php echo $GLOBALS ['direktorij'] ?>";
		
		function showPDF(a){		
		// na telefonu PDF narišemo s PDF.js (sicer ga telefon le prenese) - js/pdfPrikaz.js
		if (jeTelefon()) {
			document.getElementById('tojePdf').scrollIntoView();
			prikaziPdfNaTelefonu(direktorij + a + '.pdf', document.getElementById('tojePdf'));
			return;
		}
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
<!--</head>-->
<body>
    <div id="topnav"> <?php if (isset($prijava) and $prijava != "") {include($prijava); }?></div> 
	<div id="nav">    <?php if (isset($l) and $l != "") {include($l); }?></div>     
	<div id="vsebina"><?php if (isset($s) and $s != "") {include($s); }?></div>
	<div id="sos">    <?php if (isset($n) and $n != "") {include($n); }?></div>
	<div id="tojePdf"></div>
<script>
if("<?= $uname ?>"==""){
	document.getElementById("uname").innerHTML = "niste prijavljeni ";	
}else{

	document.getElementById("uname").innerHTML = "prijavljen je: " + " " + "<?= $uname ?>";
	}
	//document.getElementById("dom").innerHTML = "doma";	
	
if("<?= $p ?>"==""){
		document.getElementById("dom").innerHTML = "doma";
    }	
		else{
		document.getElementById("dom").innerHTML = "domov";		
	}
</script>
</body>
</html>