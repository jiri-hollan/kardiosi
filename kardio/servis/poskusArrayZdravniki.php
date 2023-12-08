<script>
function person(id,ime,priimek,email)
{
	//alert("poskusArrayZdravnik FunctionPerson2");
var slika = "";
var celoIme = "";
var mail = "";
slika += "<img src='../podobe/personId" + id + ".jpg' alt='---- ' width='200'/>"
celoIme += "<h2>" + ime + " " + priimek  + "</h2>"
mail += "<p class='obarvaj' >" + "<a href='mailto:" + email + "'" + "target='_top'>" + "E po&#353;ta" + "</a>" + "</p>"

document.getElementById('desno').innerHTML = slika + "<br>" + celoIme + "<br>" + mail
}
</script>
<?php
/* V tom failu so funkcije za spreminjanje tabele databaze*/
require_once '../skupne/database.php';
require_once 'sabloni/zahlaviPoskusArray.php';

if (isset($_REQUEST["pogoj"])){
	  //$pogoj = new Test_input($_REQUEST['pogoj']); 
     // $pogoj = $pogoj->get_test();
	$pogoj = $_REQUEST['pogoj']; 
  }else {
	 $pogoj = NULL;   
  } 


$podminka = array("status"=>$pogoj);
//$podminka = $pogoj;
//$podminka = array("status"=>2);
//$podminka = NULL;
vyberFunction($podminka);
function vyberFunction($podminka){
$tabulka="uporabnikiTbl";
$stolpci=["*"];
$vyber = new database();
$vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );


//echo$vybrano[0]["ime"]."<br>";
echo"<div style='position:absolute; top:0; left:10px;width:200px'>";
$paragrafKlik = "";
$emajly = "";
$okroznica = "";

foreach ($vybrano as $key=>$value) 	
{
	//var_dump($key);
	//echo $key."<br>";
foreach ($vybrano[$key] as $key1=>$value1) 	
{

}	
$id = $vybrano[$key]["id"];
$ime = $vybrano[$key]["ime"];
$priimek = $vybrano[$key]["priimek"];
$email = $vybrano[$key]["email"];
	$function_name = "person($id, '$ime', '$priimek', '$email')";
	$paragrafKlik = "<p class='obarvaj' onclick=\"";	
	$paragrafKlik =$paragrafKlik.$function_name;	
	$paragrafKlik =$paragrafKlik."\">";
	$paragrafKlik =$paragrafKlik.$vybrano[$key]["ime"]." ";
	$paragrafKlik =$paragrafKlik.$vybrano[$key]["priimek"];
	$paragrafKlik =$paragrafKlik. "</p>";
	
	echo($paragrafKlik);
	
	$emajly = $emajly.$email.",";
	//echo $emajly;
	
}//od foreach
$okroznica = "<p class='obarvaj' >" . "<a href='mailto:" . $emajly . "'" . "target='_top'>" . "okrožnica" . "</a>" . "</p>";
    echo $okroznica;
echo"</div>";
//var_dump($paragrafKlik);
//echo $paragrafKlik;

}//od vyberFunction 
?>
