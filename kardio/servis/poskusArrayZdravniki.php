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
/*echo'
<script>
function person(id,ime,priimek,email)
{
	//alert("poskusArrayZdravnik FunctionPerson2");
var slika = "";
var celoIme = "";
var mail = "";
slika += "<img src='podobe/personId" + personaId + ".jpg' alt='---- ' width='200'/>"
celoIme += "<h2>" + firstname + " " + lastname  + "</h2>"
mail += "<p class='obarvaj' >" + "<a href='mailto:" + email + "'" + "target='_top'>" + "E po&#353;ta" + "</a>" + "</p>"

document.getElementById('desno').innerHTML = slika + "<br>" + celoIme + "<br>" + mail
}
</script>
';*/
$podminka = NULL;
vyberFunction($podminka);
function vyberFunction($podminka){
$tabulka="uporabnikiTbl";
$stolpci=["*"];
$vyber = new database();
$vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
//echo var_dump($vybrano);
	//echo'<br><br>';
	
//var_dump($vybrano[0]);
	
//	echo'<br><br>';
//echo json_encode($vybrano, JSON_UNESCAPED_UNICODE);
	//echo '<script>';
	//echo 'var vybranoDžejsn= ' . json_encode($vybrano, JSON_UNESCAPED_UNICODE) . ';';
	//echo 'alert("vybranoDžejsn:" + vybranoDžejsn);';	
	//echo 'alert("vybranoDžejsn[0]:" + vybranoDžejsn[0]["ime"]);';
	//echo'</script>';
//echo'<br>----------------------------------------------------------------------------------------------------------<br>';	

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
$okroznica = "<p class='obarvaj' >" . "<a href='mailto:" . $emajly . "'" . "target='_top'>" . "okro&#382;nica" . "</a>" . "</p>";
    echo $okroznica;
echo"</div>";
//var_dump($paragrafKlik);
//echo $paragrafKlik;

}//od vyberFunction 
?>
