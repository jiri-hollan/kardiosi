<?php
//------seznam bolnišnic
require_once '../skupne/database.php';
Class spisekBolnisnic{
	public $conn;
	public $nameTable;
	public function __construct() {
  $this->conn = new Database();	
  $this->nameTable = 'bolnisniceTbl'; 
  $stolpci = array('mesto');
  $poradi = "mesto";
  $podminka = "";
  $vrednosti = [];
  $prebrano = $this->conn->vyber($this->nameTable, $stolpci);
//var_dump ($prebrano);
  $mestoBolnisnice=array();
  for ($i = 0; $i < count($prebrano); $i++) {
//echo $prebrano[$i]["mesto"].'<br>';	
array_push($mestoBolnisnice,$prebrano[$i]["mesto"]);
//var_dump($mestoBolnisnice);
    }//od for 
	//echo '<br>var dump mesto Bolnišnice:<br>';
//_______________________________________________________________________________


$mestoBolnisniceJson = json_encode($mestoBolnisnice, JSON_UNESCAPED_UNICODE);

//var_dump($mestoBolnisniceJson);
echo '<script>';
echo 'var mestoBolnisniceJson= ' . json_encode( $mestoBolnisniceJson, JSON_UNESCAPED_UNICODE) . ';';
//echo 'alert(mestoBolnisniceJson);';
echo '</script>';
	}//od construct			
	}//od class spisekBolnisnic
	new spisekBolnisnic();
?>