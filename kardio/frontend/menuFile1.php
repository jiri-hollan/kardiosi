<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

require_once('sabloni/vkladane/zahlavi.php');
require_once('administrace.php');

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
		$n = "mespdf.php";
		$direktorij = "../razpis/mespdf/";
		$l= "";	
		$prijava="";
		break;
		
		case "zdravniki":
		$s = "";
		$l= "sorta.php";
		$n = "domov.php";
		$prijava="";
		break;
		
		case "razpisovalec":
		$s = "posta.php";
		$l= '';		
		$n = "domov.php";
		$prijava="";
		break;
		
		case "kuharica":
		$s = "zahod.php";
		$direktorij = "../besedila/";
		$l= 'navodila.php';
		$n = "domov.php";
		$prijava="";
		break;
		
		case "povezave":
		$s = "";
		$l= "../linki.php";
		$n = "domov.php";
		$prijava="";
		break;		
	
	    case "biznis":
		$s = "";
		$l= "../biznis/biznis.php";
		$n = "";
		break;
		
        case "admin":
		$s = "";
		$l= "../admin/admin.php";
		$n = "";
		  header("Location: ../admin/admin.php");
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
<body>
    <div id="topnav"> <?php if (isset($prijava) and $prijava != "") {include($prijava); }?></div> 
	<div id="nav">    <?php if (isset($l) and $l != "") {include($l); }?></div>     
	<div id="vsebina"><?php if (isset($s) and $s != "") {include($s); }?></div>
	<div id="sos">    <?php if (isset($n) and $n != "") {include($n); }?></div>
	<div id="tojePdf"></div>

</body>
</html>