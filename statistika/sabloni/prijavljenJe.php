<?php
$uname = !empty($_SESSION["uname"]) ? $_SESSION["uname"] : "";
echo'
<script>
var uname = '.json_encode($uname, JSON_UNESCAPED_UNICODE).';
document.getElementById("uname").innerHTML = (uname == "") ? "niste prijavljeni " : "prijavljen je: " + uname;
</script>
';
?>
