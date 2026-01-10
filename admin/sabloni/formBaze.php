<?php
if (isset($_REQUEST["tabulka"])){
  $tab=$_REQUEST["tabulka"];
//echo "Tabulka je: ".$tab;
 echo strtoupper(rtrim($tab,"Tbl"));
  }
//echo($spisek->bolList);
//$spisek->bolList
//$bolList je iz seznamBolnisnic.php
//$bolList=$spisek->bolList;
//var_dump ($bolList);  
?>

<br>
<button id="vyberId" onclick="izborFunction('vyber','<?php echo $tab;?>', bolList)">izberi</button>
<button id="vlozId" onclick="izborFunction('vloz','<?php echo $tab;?>')">vlož</button>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" id="akceId" name="akce" value="">
<p id="demo"></p>
<p id="tabSent"></p>
<p id="urejatSent"></p>
<p id="posli"></p>
</form>

<p id="demo3"></p>
