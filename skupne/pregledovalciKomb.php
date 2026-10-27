<?php
/* Pogled (VIEW) pregledovalciKomb združuje uporabnike in pregledovalce.
   Pogled je trajen objekt v bazi in se sam posodablja, zato ga ustvarimo samo, če še ne obstaja
   (prej se je ustvarjal ob vsakem odprtju glavnega menija).
   Če spremeniš definicijo spodaj, pogled enkrat ročno izbriši: DROP VIEW pregledovalciKomb; */
$kodaSql = "CREATE OR REPLACE VIEW pregledovalciKomb AS
SELECT bolnisnica, ime, priimek FROM uporabnikiTbl WHERE pristop >=1
UNION
SELECT bolnisnica, ime, priimek FROM pregledovalciTbl WHERE pregledovalciStatus >=1;";

mojSql($kodaSql);
function mojSql($kodaSql) {
require_once '../skupne/narediTablo.php';	
try {
	$databaseView=new DatabaseView;
	if (!$databaseView->pogledObstaja('pregledovalciKomb')) {
		$databaseView->narediSql($kodaSql);
	}
} catch (PDOException $e) {
	// napaka baze ne sme podreti glavnega menija; zapiše se v error_log
	error_log('pregledovalciKomb: ' . $e->getMessage());
}
}

class DatabaseView {
	public $servername = '';
	public $username = '';
	public $password = '';
	public $dbname = '';
	public $conn = '';
	public Function __construct(){
	require_once 'streznik.php';
      //$this->servername = "sh17.neoserv.si"; 
		$this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname . ';charset=UTF8', $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	}//uzavírací zavorky __construct	
//-----------------konec construct--------------


public function pogledObstaja($ime) {
	$dotaz = $this->conn->prepare("SELECT COUNT(*) FROM information_schema.VIEWS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ?");
	$dotaz->execute(array($ime));
	return (int)$dotaz->fetchColumn() > 0;
}

public function narediSql($kodaSql) {
try {    
    $sql = $kodaSql;
	//echo "<br>";
	//echo $sql . "<br>" ;
// use exec() because no results are returned
    $this->conn->exec($sql);
   // echo "Stavek SQL izvrsen";
    }
catch(PDOException $e)
    { 
	echo "napaka";
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
}//uzavírací zavorky function narediSql
//-------------------konec function narediSql-------

}//uzavírací zavorky class DatabaseView
?>