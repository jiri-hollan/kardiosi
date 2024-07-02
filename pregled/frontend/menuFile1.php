<?php
require_once('administrace.php');
require_once('sabloni/vkladane/zahlavi.php');

$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
require_once('sabloni/vkladane/zapati.php'); 
?>
<script>
	sbFunction("spomin");
	document.getElementById("uname").innerHTML = "prijavljen je: " + " " + "<?= $uname ?>";
	document.getElementById("dom").innerHTML = "doma";		
</script>

