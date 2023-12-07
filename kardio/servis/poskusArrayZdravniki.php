
<?php
/* V tom failu so funkcije za spreminjanje tabele databaze*/
require_once '../skupne/database.php';
echo"
<script>
function person(id,ime,priimek,email)
{
	alarm('function person');
}
</script>
";
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
	echo '<script>';
	echo 'var vybranoDžejsn= ' . json_encode($vybrano, JSON_UNESCAPED_UNICODE) . ';';
	//echo 'alert("vybranoDžejsn:" + vybranoDžejsn);';	
	//echo 'alert("vybranoDžejsn[0]:" + vybranoDžejsn[0]["ime"]);';
	echo'</script>';
//echo'<br>----------------------------------------------------------------------------------------------------------<br>';	

//echo$vybrano[0]["ime"]."<br>";

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

	$paragrafKlik = "<p class='obarvaj' onclick=";	
	$paragrafKlik =$paragrafKlik."'person(";
	$paragrafKlik =$paragrafKlik.$vybrano[$key]["id"].", ";	
	$paragrafKlik =$paragrafKlik.$vybrano[$key]["ime"].", ";
	$paragrafKlik =$paragrafKlik.$vybrano[$key]["priimek"].", ";
	$paragrafKlik =$paragrafKlik.$vybrano[$key]["email"].")";	
	$paragrafKlik =$paragrafKlik."'>";
	$paragrafKlik =$paragrafKlik.$vybrano[$key]["ime"]." ";
	$paragrafKlik =$paragrafKlik.$vybrano[$key]["priimek"];
	$paragrafKlik =$paragrafKlik. "</p>";
	
	echo($paragrafKlik);
	

}//od for
//var_dump($paragrafKlik);
//echo $paragrafKlik;

}//od vyberFunction 
?>
