 <?php 
 /* V tom failu so funkcije za spreminjanje tabele databaze*/
 require_once('sabloni/vkladane/zahlavi.php');
 require_once('sabloni/formBaze.php');
 require_once '../skupne/database.php';

//_____________________________________________________________
if (isset($_REQUEST["akce"])) {
	  $akce = new Test_input($_REQUEST["akce"]);
	  $akce = $akce->get_test();
if (isset($_REQUEST["pogoj"])){
	  $pogoj = new Test_input($_REQUEST['pogoj']); 
      $pogoj = $pogoj->get_test();
	  
  }else {
	 $pogoj = "";   
  } 
 if (isset($tabulka)){
	  $tabulka= $tabulka; 
  }else if (isset($_REQUEST["tabulka"])){
	  $tabulka= new Test_input($_REQUEST["tabulka"]);
	  $tabulka = $tabulka->get_test();
  }else {
	  echo "ni tabulke v post";
  }
  //var_dump($akce);
    echo strtoupper($akce) .': ';
  echo strtoupper($pogoj) .'<br>';
 
  new $akce($pogoj, $tabulka);

	  
}//od if
//_________________________________
 
 	class Test_input {
	public $test;	
  function __construct($test) {
	//parent::__construct($test);
   $test = trim($test);
  $test = stripslashes($test);
  $this->test = htmlspecialchars($test);
  }//od construct
  function get_test() {
    return $this->test;
  }  
}//od class Test_input

//____________________________________________________________________________________________
 
 ?>
<?php 
 class DostopPost{
  public $pogoj;		
  public $tabulka;
  function __construct($pogoj="", $tabulka="") {
	    $pogoj=strtolower($pogoj); 
        $pogoj=ucfirst($pogoj); 
	    $this->pogoj = $pogoj;
        $this->tabulka = $tabulka; 
		 switch($this->tabulka){
	  case "pregledovalciTbl":
	  $this->dataPreg= '["status", "ime", "priimek", "email", "uname", "geslo"]';
	  //var_dump($this->dataPreg);
	  break;
	  case "uporabnikiTbl":
	  $this->dataPreg= '["email", "uname", "geslo", "ime", "priimek", "status", "pristop"]';
	  break;
;
	  default:
	  echo "tabulka ni določena";
  }
		
  } //od construct
}//od class dostopPost
//____________________________________________________________________________________________
	class Uredi extends DostopPost{
  public $id;
  public $ime;
  public $priimek;
  public $status; 
  public function __construct($pogoj, $tabulka) {
	parent::__construct($pogoj, $tabulka);	
	echo "case uredi <br>";
print_r($_POST);
echo "<br>";
    $id= new test_input($_POST["id"]);
	$this->id = $id->get_test();
	$data=array();
 function array_push_assoc($data, $key, $value){
   $data[$key] = $value;
  // var_dump ($data);
   return $data;
}
foreach (json_decode($this->dataPreg) as $key) {
 //echo "$key <br>";
    $value= new Test_input($_REQUEST[$key]); 
	$value= $value->get_test();	
    $data =array_push_assoc($data, $key, $value);
}

	
	
    $this->podminka = array("id"=>$this->id);
	//$this->data = array("pogoj"=>$this->pogoj, "ime"=>$this->ime, "priimek"=>$this->priimek, "status"=>$this->status);
	    $this->data = $data;
    	$aktualizuj = new database();
		$aktualizovano=$aktualizuj->aktualizuj($this->tabulka,$this->data,$this->podminka);
}
}// od class uredi
//_____________________________________________________________________________________

	class Vyber extends DostopPost{ 
//najde vse zapise v tabulki za pogoj. Če ni določen, najde vse
  public $stolpci;
  public $pogoj; 
  public $tabulka;
  public $poradi;
  function __construct($pogoj, $tabulka, $stolpci=["*"], $poradi=NULL) {
	parent::__construct($pogoj, $tabulka);
    $this->stolpci = $stolpci;	
	//echo "v class vyber";
	if ($this->pogoj == "") {
	$this->podminka = NULL;
   } else {
    $this->podminka = array("pogoj"=>$this->pogoj);
   }//od else
   $this->poradi=$poradi;
   $this->tabulka=$tabulka;
$vyber = new database();
$vybrano=$vyber->vyber($this->tabulka, $this->stolpci, $this->podminka, $this->poradi );
echo "<br>";
if(count($vybrano)>0){	
	//var_dump($vybrano);
	
	
foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
//	var_dump($v);
	       // echo $v;
}//od foreach
}//od if(cout)
else{
echo "Za izbrano bolnisnico ni zapisa v bazi";	
}//od else
}//od vyberFunction  
}//od class vyber

//________________________________________________________________________________________	
	class Vloz extends DostopPost {

  function __construct($pogoj, $tabulka) {
	parent::__construct($pogoj, $tabulka);
	echo $tabulka;
	$this->tabulka = $tabulka;
	$data=array();
 function array_push_assoc($data, $key, $value){
   $data[$key] = $value;
   return $data;
}
foreach (json_decode($this->dataPreg) as $key) {
 //echo "$key <br>";
    $value= new Test_input($_REQUEST[$key]); 
	$value= $value->get_test();	
    $data =array_push_assoc($data, $key, $value);
}
     $this->data = $data;
     $vloz = new database();
     $vlozeno=$vloz->vloz($this->tabulka,$this->data);
    //echo $vlozeno[1];
     echo "<br>";
     print_r($vlozeno);
     echo "<br>";
     echo count($vlozeno);
     echo "<br>";	 
  }	    
}// od class Vloz

//-------------------------iterator-----------------------------------------------------
	class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
		//echo $_REQUEST["tabulka"];
	echo "<table id='osebe' style='border: solid 1px black;'>";
	switch ($_REQUEST["tabulka"]){
		  case "pregledovalciTbl":
    echo "<tr><th>Id</th><th>status</><th>ime</th><th>priimek</th><th>email</th><th>uname</th><th>geslo</th></tr>";
    break;
	
	case "uporabnikiTbl":
    echo "<tr><th>Id</th><th>email</><th>uname</th><th>geslo</th><th>ime</th><th>priimek</th><th>status</th><th>pristop</th></tr>";
    break;
	default:
	echo "";
	}
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() { 
		 return "<td  >"  . parent::current() . "</td>";
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "<td class='urediCls' onclick=" . '"izborFunction('. "'edit'".')"'.'"' . ">edit</td>
		<td class='odstraniCls' onclick=" . '"izborFunction('. "'odstrani'".')"'.'"' . ">odstrani</td>
		
		</tr>" . "\n";
    }
	
} // od class TableRows

//____________________________________________________________________________________________________

    class Edit {
	public $id;	
	public $tabulka;
	 function __construct($tabulka, $id) {
    $id = new test_input($_GET["id"]);
	$this->id = $id->get_test();
//echo "id uporabnika= " .  $id;
	$tabulka = new test_input($_GET["tabulka"]);
	 $this->tabulka = $tabulka->get_test();	 
	 $podminka = array("id"=>$this->id);	
	 $stolpci=["*"];
	 $vyber = new database();
	 $vybrano=$vyber->vyber($this->tabulka, $stolpci, $podminka );
//echo "število vybranych zapisov= " . count($vybrano);
     $dolzina=count($vybrano);
     echo "<form  method='post'>";
     for ($i = 0; $i < $dolzina; $i++) {
       foreach ($vybrano[$i] as $key => $value) {
// echo "$key: $value\n";
 if($key=="id"){
	   echo " $key: <input name=$key value=$value readonly\n></input>";	
}	else{ 
	   echo " $key: <input id=$key name=$key value='".$value."'></input><br>";
	   }
      }//od foreach	 
	 echo "<input type='hidden' name='akce' value='uredi'></input><button class='submit' type='submit'>potrdi</button><button type='reset'>reset</button> ";
     echo "</form>";
       }//od for	
	 }//od construct	
	}//od class edit
//________________________________________________________________________________________________

    class odstrani {
	public $id;	
	public $tabulka;
	 function __construct($tabulka, $id) {		 
	 $tabulka = new test_input($_GET["tabulka"]);
	 $this->tabulka = $tabulka->get_test();
     $id = new test_input($_GET["id"]);
	 $this->id = $id->get_test();
	// echo "id uporabnika= " .  $id;
	 echo "<br>";
	 $stolpci=["*"];	 
	 $podminka = array("id"=>$this->id);
	 $odstrani = new database();
    $najdeno=$odstrani->vyber($this->tabulka, $stolpci, $podminka );
	print_r($najdeno);
	$odstranjeno=$odstrani->odstrani($this->tabulka, $podminka );
	echo 'Odstranjen je bil '.$odstranjeno.' uporabnik';
	 }//od construct
	 }//od class odstrani
if (isset($_REQUEST["tabulka"])){

switch($_REQUEST["tabulka"]){

case "pregledovalciTbl":
echo '<script src="js/manipulacePregledovalci.js?<?php echo time(); ?>"></script>'; 
break;
case "uporabnikiTbl":
echo '<script src="js/manipulacePogoj.js?<?php echo time(); ?>"></script>'; 
break;


}
}
?>
<!--zapati-->
</body>
</html>	