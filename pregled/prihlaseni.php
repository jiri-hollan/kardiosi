<?php
@session_start();
require_once('../skupne/database.php');
require_once('../skupne/gesla.php');
require_once('../koren.php');
//require_once('zdravnik.php');
  	  echo '<script>console.log("prihlaseni 6");</script>';
//echo '<script>alert("linija7");</script>';
/*global $r;
$r = $_GET['r'];
var_dump ($r);*/
	  
//require_once('sabloni/prihlasovaci-formular.php');
Class Prihlaseni {
	public $conn;
	public $zaklad;
	public $upstatus;
	public $pristop;
	public $upGdpr;
	public $koren;	
	public function __construct($koren) {
	//echo"('KOREN: '.$koren)";	
	  $this->conn = new Database();
	  $this->zaklad = new stdClass();
	  if ($_SERVER['SERVER_NAME']=="localhost"){
		 $this->zaklad->url = 'http://' . $_SERVER['SERVER_NAME'].'/'.$koren.'/frontend/'; 
	  }else {
		 $this->zaklad->url = 'http://' . $_SERVER['SERVER_NAME'].'/frontend/';  
	  }
	  

	}	
	
}//od class prihlaseni

//___________________________________- potomstvo_______________________________________________


Class Prijava extends Prihlaseni {
	
	
	public function __construct($koren) {
		    parent::__construct($koren);
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		  $chiba = $this->overUdaje();
		  //echo var_dump($chiba);
	  }else if (isset($_GET['stav']) && $_GET['stav'] == 'neaktivni'){
		  $oznameni = 'Ste odjavljeni zaradi neaktivnosti. ' . 'Ponovno se prijavite.';		  
	  }
	  require_once('sabloni/prihlasovaci-formular.php');
	//od function inicializuj		
	}
	
	public function prihlaseniUspesne($upstatus, $pristop, $upGdpr, $uname){
	   $_SESSION['uporabnikPrihlasen'] = true;
	   $_SESSION["casova_znamka"] = time();
	   $_SESSION["upstatus"] = $upstatus;
	   $_SESSION["pristop"] = $pristop;
	   $_SESSION["uporabnikGdpr"] = $upGdpr;
	   $_SESSION["uname"] = $uname;
	  //echo $upstatus;
	header('Location: bolnik.php');
	   exit();
	}	
	public function prihlaseniSelhalo() {
		//echo 'Napačno uporabniško ime ali geslo. ';
		echo '
		<script>
		alert("Napačno uporabniško ime ali geslo.");
		window.history.back();
		</script> ';
		
	   return ;
	}	
	public function overUdaje() {
		if (!empty($_POST['uname']) && !empty($_POST['geslo'])){
			// varna prijava (password_verify); stara md5 gesla se ob prijavi samodejno preshranijo
			$uporabnik = prijaviUporabnika($this->conn, $_POST['uname'], $_POST['geslo']);

		if ($uporabnik !== null)	{
			$upstatus=$uporabnik['upstatus'];			
			//echo $upstatus;
			$pristop=$uporabnik['pristop'];			
			//echo $pristop;
			$upGdpr=$uporabnik['gdpr'];			
			$uname=$uporabnik['uname'];
		// echo $upstatus;
			$this->prihlaseniUspesne($upstatus, $pristop, $upGdpr, $uname);
		} else {
			//echo 'iz funkcije overUdaje';
			return $this->prihlaseniSelhalo();
		}   
	  }
	}
	
	
// od class Prijava	
}
//_____________________________________konec Prijava_______________________________________________




//sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss







//$prihlaseni = new Prihlaseni;
if (isset($_GET['r'])) {
	 // echo 'poskus GET' . $_GET['r'];
	  $r = $_GET['r'];
switch ($r) {
  case "login":
 	  echo '<script>console.log("prihlaseni 112");</script>';   
      $prihlaseni = new Prijava($koren);

	 
    //echo "poskušate se logirati!"; 
   break;
 
  default:
  	  echo '<script>console.log("prihlaseni 118");</script>';
}
}else{echo '<script>console.log("prihlaseni 120");</script>';}