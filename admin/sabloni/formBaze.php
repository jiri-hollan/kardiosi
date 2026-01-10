<?php
if (isset($_REQUEST["tabulka"])){
  $tab=$_REQUEST["tabulka"];
//echo "Tabulka je: ".$tab;
 echo strtoupper(rtrim($tab,"Tbl"));
  }
//echo($spisek->mestoB);
//$spisek->mestoB
//$mestoB je iz seznamBolnisnic.php
//$mestoB=$spisek->mestoB;
//var_dump ($mestoB);  
?>

<br>
<button id="vyberId" onclick="izborFunction('vyber','<?php echo $tab;?>', mestoB)">izberi</button>
<button id="vlozId" onclick="izborFunction('vloz','<?php echo $tab;?>')">vlož</button>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" id="akceId" name="akce" value="">
<p id="demo"></p>
<p id="tabSent"></p>
<p id="urejatSent"></p>
<p id="posli"></p>
</form>

<p id="demo3"></p>
