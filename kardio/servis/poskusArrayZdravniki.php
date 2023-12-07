
<?php
/* V tom failu so funkcije za spreminjanje tabele databaze*/
require_once '../skupne/database.php';

	$podminka = NULL;
    vyberFunction($podminka);


function vyberFunction($podminka){
$tabulka="uporabnikiTbl";
$stolpci=["*"];
$vyber = new database();
$vybrano=$vyber->vyber($tabulka, $stolpci, $podminka );
//echo $vybrano[1];
echo var_dump($vybrano);
	echo'<br><br>';
	
var_dump($vybrano[0]);
	
	echo'<br><br>';
echo json_encode($vybrano, JSON_UNESCAPED_UNICODE);
	echo '<script>';
	echo 'var vybranoDžejsn= ' . json_encode($vybrano, JSON_UNESCAPED_UNICODE) . ';';
	//echo 'alert("vybranoDžejsn:" + vybranoDžejsn);';	
	echo 'alert("vybranoDžejsn[0]:" + vybranoDžejsn[0]["ime"]);';
	echo'</script>';
echo'<br>----------------------------------------------------------------------------------------------------------<br>';	
var_dump($vybrano[0][firstname]);

?>
