<?php
/* V tom failu so funkcije za spreminjanje tabele databaze*/
require_once '../skupne/sabloni/zahlavi.php';
require_once '../admin1/sabloni/kompetence.php';
require_once '../skupne/database.php';
//$nazaj="../admin1/vertikalMenu.php";
//echo "manipulace nazaj= ".$nazaj;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $akce = test_input($_POST["akce"]);
  $priimek = test_input($_POST["priimek"]);

 // echo strtoupper($akce) .': ';
 // echo strtoupper($priimek) .'<br>';
  
switch ($akce) {
 case "vyber":
   // echo "to je vyber.<br>";
   if ($priimek == "") {
	$podminka = "upstatus";
	$vrednosti = array("0","1","2");
} else {
    $podminka = "priimek";
		$vrednosti = array("$priimek");
}
    vyberFunction($podminka, $vrednosti);
  break; 	 
case "vloz":
     echo "ni dovoljeno";
   break; 
case "uredi":
    $tabulka="uporabnikiTbl";
    $id=test_input($_POST["id"]);
    //$email=test_input($_POST["email"]);
    //$uname=test_input($_POST["uname"]);	
    $ime = test_input($_POST["ime"]);
	$priimek = test_input($_POST["priimek"]);
	$upstatus = test_input($_POST["upstatus"]);
	$pristop = test_input($_POST["pristop"]);	
	$podminka = array("id"=>$id);
    $data= array("ime"=>$ime, "priimek"=>$priimek, "upstatus"=>$upstatus, "pristop"=>$pristop);	
	$aktualizuj = new database($tabulka,$data,$podminka);
	$aktualizovano=$aktualizuj->aktualizuj($tabulka,$data,$podminka);
   break;
default:
    echo "ni izvelo case";	
}//od switch 
}//od if

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["akce"])) {
  $akce = test_input($_GET["akce"]);
switch ($akce) {
case "uredi":
     $id = test_input($_GET["id"]);
	 echo "id uporabnika= " .  $id;
	 echo "<br>";
	// var_dump($id);
	// echo "<br>"; 
	 $podminka = array("id"=>$id);
     editFunction($podminka);
   break;
case "odstrani":
      $id = test_input($_GET["id"]);
	 echo "id uporabnika= " .  $id;
	echo "<br>";
    $podminka = array("id"=>$id);
	odstraniFunction($podminka);
    // odstraniFunction();
    break;	
 default:
    echo "ni izvelo get case"; 
  }//od switch	  
}//od if

function vyberFunction($podminka,$vrednosti){
   $tabulka="uporabnikiTbl";
   $stolpci=["id,email,ime,priimek, upstatus,pristop"];
   //var_dump($vrednosti);
   $vyber = new database();
   $vybrano=$vyber->vyberIn($tabulka, $stolpci, $podminka, $vrednosti);
//echo $vybrano[1];
//echo var_dump($vybrano);
   //echo "<br>";
   echo 'Število zapisov: '.count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
echo "<br>";
if(count($vybrano)>0){
  echo'<P><b>upstatus:</b> 0=izključen 1=pridruženi 2=član</P>';
  echo'<P><b>pristop:</b>1=na seznamu 2=vlaganje v bazo 3=pogled v bazo</P>';
  echo "<table id='osebe' style='border: solid 1px black;'>";
  echo "<tr><th>Id</th><th>e-mail</><th>ime</th><th>priimek</th><th>upstatus</th><th>pristop</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() { 
		 return "<td  >"  . parent::current() . "</td>";
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
		$a = 'onclick="' . "izborFunction('uredi')" . '"';
		$b = 'onclick="' . "izborFunction('odstrani')" . '"';
        echo "<td class='urediCls'  onclick=" . '"izborFunction('. "'uredi'".')"'.'"' . ">uredi</td>
		<!--<td class='odstraniCls' onclick=" . '"izborFunction('. "'odstrani'".')"'.'"' . ">ODSTRANI</td>-->		
		</tr>" . "\n";
}//od endChildren
}// od class TableRows

foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;

}//od foreach
}//od if(cout)
else{
   echo "Za izbrano bolnisnico ni zapisa v bazi";	
}//od else
}//od vyberFunction  

function vlozFunction($data){
   $tabulka="uporabnikiTbl";
   $vloz = new database($tabulka,$data);
   $vlozeno=$vloz->vloz($tabulka,$data );
//echo $vlozeno[1];
   echo "<br>";
   echo var_dump($vlozeno);
   echo "<br>";
   echo count($vlozeno);
   echo "<br>";
}//od vlozFunction

function editFunction($podminka){
//	echo 'editFunction pošalje podatke v urediFunction';
   $tabulka="uporabnikiTbl";
   $stolpci=["*"];
   $vyber = new database($tabulka, $stolpci, $podminka );
   $vyber->vyber($tabulka, $stolpci, $podminka);
   $vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
   echo "<br>";
   echo "število izbranih zapisov= " . count($vybrano);
   $dolzina=count($vybrano);
//echo $vybrano[1];
   echo "<br>";
   echo "<form  method='post'>";
   for ($i = 0; $i < $dolzina; $i++) {
     foreach ($vybrano[$i] as $key => $value) {
      if($key=="id"||$key=="ime"||$key=="priimek"){
	   echo " $key: <input name=$key value=$value readonly style='background-color:ivory;'\n></input>";	
}	 
     if($key=="upstatus"||$key=="pristop"){	
	  echo " $key: <input name=$key value=$value   pattern='[0,1,2,3]{1}' \n></input>";
}	
}//od foreach
   echo "<input type='hidden' name='akce' value='uredi'></input><br><br><button type='submit'>submit</button><button type='reset'>reset</button> ";
   echo "</form>";
}//od for		
}//od editFunction

function odstraniFunction($podminka){
//odstrani zapis
	$tabulka="uporabnikiTbl";
	$odstrani = new database();
	$odstranjeno=$odstrani->odstrani($tabulka, $podminka );
	echo 'Odstranjen je bil '.$odstranjeno.' uporabnik';
}//od odstraniFunction
?>
<script src="js/manipulaceUporabniki.js?<?php echo time(); ?>">
</script>
<?php
require_once '../skupne/sabloni/zapati.php';
?>