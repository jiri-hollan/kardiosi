
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
echo'<br>----------------------------------------------------------------------------------------------------------';	
//echo $vybrano[1];
/*
echo "<br>";
if(count($vybrano)>0){
echo "<table id='osebe' style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>bolnisnica</><th>skupina</><th>ime</th><th>min</th><th>max</th></tr>";

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
        echo "<td onclick=" . '"izborFunction('. "'uredi'".')"'.'"' . ">uredi</td>
		<td onclick=" . '"izborFunction('. "'odstrani'".')"'.'"' . ">odstrani</td>		
		</tr>" . "\n";
    }//od funkcije endChildern
}//od class TableRows
foreach(new TableRows(new RecursiveArrayIterator($vybrano)) as $k=>$v) {
        echo $v;
}//od foreach
}//od if(cout)
else{
echo "Za izbrano bolnisnico ni zapisa v bazi";	
}//od else
	*/
}//od vyberFunction  


?>
