<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once('../skupne/database.php');
require_once(__DIR__ . '/../skupne/zascita.php');
require_once('sabloni/vkladane/zahlavi.php');
class Administrace {
	public $conn;
	public $zaklad;
	
	public function __construct() {
	  $this->conn = new Database();
      $this->zaklad = new stdClass();
	  // prej: /pregled/frontend/ - ta mapa ne obstaja več (napaka 404 ob poteku seje)
	  $this->zaklad->url = korenAplikacijeUrl() . '/frontend/';
		  
	  //echo $this->zaklad->url;
	  $casoviLimit = 1800;
	  if (isset($_SESSION["uporabnikPrihlasen"])) {
		  $uplinuliCas = time() - $_SESSION["casova_znamka"];
		  if ($uplinuliCas > $casoviLimit) {
			  session_unset();
			  session_destroy();
			  header('Location: ' . $this->zaklad->url . 'prihlaseni.php?stav=neaktivni');
			  exit();
		  }
	  }
	  $_SESSION["casova_znamka"] = time();
	  $prihlasen = $_SESSION['uporabnikPrihlasen'] ?? null;
	  if (empty($prihlasen)) {
		  session_unset();
		  session_destroy();
	echo'<script>
	sessionStorage.removeItem("testJSON");	
	sessionStorage.removeItem("bolnikId"); 
	</script>';	  
		  
		  header('Location: ' . $this->zaklad->url . 'prihlaseni.php?stav=odhlasit');
		   
	// header('Location: localhost/kardiosi/pregled/frontend/prihlaseni.php?stav=odhlasit');
		   
		   exit();
	  } else {
		  $this->conn = new Database();
	  }
//od construct	  
	}
//0d class administrace	
}