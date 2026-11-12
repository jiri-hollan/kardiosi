<?php
require_once __DIR__ . '/../skupne/verzija.php';
require_once __DIR__ . '/../skupne/zascita.php'; // zaščita: upstatus 3 ali več (biznis/servis)
zahtevajPrijavo(3);
// Na tej strani se lahko dodelijo samo upstatusi 0, 1 in 2 (tudi adminu) in urejajo samo uporabniki s temi upstatusi.
// Višje statuse (3, 4) ureja admin v ADMIN > upravljanje z uporabniki.
const DOVOLJENI_UPSTATUSI = array('0', '0.5', '1', '2');
// upstatus iz baze (npr. "1.0", "0.5") ali iz obrazca ("0,5") v enotno obliko: "0", "0.5", "1", ...
function normUpstatus($v) {
	$v = str_replace(',', '.', trim((string)$v));
	if (!is_numeric($v)) {
		return '';
	}
	return rtrim(rtrim(number_format((float)$v, 1, '.', ''), '0'), '.');
}
const DOVOLJENI_PRISTOPI = array('0', '1', '2', '3');
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
	$vrednosti = array("0","0.5","1","2");
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
    $id=test_input($_POST["id"] ?? '');
	$upstatus = normUpstatus(test_input($_POST["upstatus"] ?? ''));
	$pristop = test_input($_POST["pristop"] ?? '');	
	$podminka = array("id"=>$id);
	if (!in_array($upstatus, DOVOLJENI_UPSTATUSI, true) || !in_array($pristop, DOVOLJENI_PRISTOPI, true)) {
		echo "Dodeliti je mogoče samo upstatus 0, 0,5, 1 ali 2 in pristop 0 do 3. Nič ni spremenjeno.";
		break;
	}
	if (!uporabnikUredljiv($podminka)) {
		echo "Tega uporabnika tukaj ni mogoče urejati (upstatus 3 ali 4 ureja admin). Nič ni spremenjeno.";
		break;
	}
	// ime in priimek sta v obrazcu samo za branje, zato ju ne shranjujemo
    $data= array("upstatus"=>$upstatus, "pristop"=>$pristop);	
	$aktualizuj = new database($tabulka,$data,$podminka);
	$aktualizovano=$aktualizuj->aktualizuj($tabulka,$data,$podminka);
	echo "Shranjeno.";
   break;
default:
    echo "ni izvelo case";	
}//od switch 
}//od if

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["akce"])) {
  $akce = test_input($_GET["akce"]);
switch ($akce) {
case "uredi":
     $id = test_input($_GET["id"] ?? '');
	 echo "id uporabnika= " .  $id;
	 echo "<br>";
	 $podminka = array("id"=>$id);
	 if (!uporabnikUredljiv($podminka)) {
		 echo "Tega uporabnika tukaj ni mogoče urejati (upstatus 3 ali 4 ureja admin).";
		 break;
	 }
     editFunction($podminka);
   break;
case "odstrani":
	// brisanje uporabnikov na tej strani ni dovoljeno (v vmesniku je bilo že izklopljeno)
	echo "ni dovoljeno";
    break;	
 default:
    echo "ni izvelo get case"; 
  }//od switch	  
}//od if

// ali ima uporabnik upstatus 0, 1 ali 2 (samo take je mogoče urejati na tej strani)
function uporabnikUredljiv($podminka){
   $vyber = new database();
   $vybrano = $vyber->vyber("uporabnikiTbl", array("upstatus"), $podminka);
   return is_array($vybrano) && count($vybrano) == 1 && in_array(normUpstatus($vybrano[0]["upstatus"]), DOVOLJENI_UPSTATUSI, true);
}

function vyberFunction($podminka,$vrednosti){
   $tabulka="uporabnikiTbl";
   $stolpci=["id,email,ime,priimek, upstatus,pristop"];
   //var_dump($vrednosti);
   $vyber = new database();
   $vybrano=$vyber->vyberIn($tabulka, $stolpci, $podminka, $vrednosti);
   // tudi pri iskanju po priimku prikažemo samo uporabnike z upstatusom 0, 1 ali 2
   $vybrano = array_values(array_filter(is_array($vybrano) ? $vybrano : array(), function ($v) {
	   return in_array(normUpstatus($v["upstatus"]), DOVOLJENI_UPSTATUSI, true);
   }));
//echo $vybrano[1];
//echo var_dump($vybrano);
   //echo "<br>";
   echo 'Število zapisov: '.count($vybrano);
//$dolzina=count($vybrano);
//echo $vybrano[1];
echo "<br>";
if(count($vybrano)>0){
  echo'<P><b>upstatus:</b> 0=izključen 0,5=dostop do razpisa 1=pridruženi 2=član</P>';
  echo'<P><b>pristop:</b> 3=dostop do baze</P>';
  echo "<table id='osebe' style='border: solid 1px black;'>";
  echo "<tr><th>Id</th><th>e-mail</><th>ime</th><th>priimek</th><th>upstatus</th><th>pristop</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() :mixed { 
		 return "<td  >"  . parent::current() . "</td>";
    }
    function beginChildren() :void {
        echo "<tr>";
    }
    function endChildren() :void {
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
     if($key=="upstatus"){	
	  echo " $key: <select name='upstatus'>";
	  foreach (array('0'=>'0 izključen', '0.5'=>'0,5 dostop do razpisa', '1'=>'1 pridruženi', '2'=>'2 član') as $vrednost => $opis) {
		  echo "<option value='$vrednost'" . (normUpstatus($value) === (string)$vrednost ? " selected" : "") . ">$opis</option>";
	  }
	  echo "</select>\n";
}
     if($key=="pristop"){	
	  echo " $key: <input name=$key value=$value   pattern='[0-3]{1}' \n></input>";
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
<script src="js/manipulaceUporabniki.js?<?php echo verzija('js/manipulaceUporabniki.js'); ?>">
</script>
<?php
require_once '../skupne/sabloni/zapati.php';
?>