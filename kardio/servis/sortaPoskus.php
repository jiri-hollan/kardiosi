<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
body {background-color: wheat}
a {
color: black
}
a {
text-decoration: none
}
a.zdrav:hover {font-size: 130%;background-color:maroon; color:white}
a.okro:hover {font-size: 130%;background-color:blue; color:yellow}


</style>-->
<?php
require_once('../frontend/sabloni/zahlavi.php');
//require_once('poskusArrayZdravniki.php');
?>
<?php

echo'
<p><a class="zdrav" href="javascript: showZDR(\"servis/poskusArrayZdravniki.php?pogoj=1\")">ČLANI</a></p>
<p><a class="zdrav" href="javascript: showZDR(\"servis/poskusArrayZdravniki.php?pogoj=2\")">Pridruženi</a></p>
<b id= "okr"> to je mail </b>
';
?>

</head>
<body id="sorta">

<script>/*
var skupina = "ČLANI";
var b ="";
b += "<p>";
b += "<a class='zdrav' ";
b += "href='javascript: showZDR(";
b += '"servis/poskusArrayZdravniki.php?pogoj=1")';
b += "' > ";
b += skupina;
b += "</a>";
b +=  "</p>";
document.write(b);

var skupina = "PRIDRUŽENI";
var b ="";
b += "<p>";
b += "<a class='zdrav' ";
b += "href='javascript: showZDR(";
b += '"servis/poskusArrayZdravniki.php?pogoj=2")';
b += "' > ";
b += skupina;
b += "</a>";
b +=  "</p>";
document.write(b);

*/

</script>



<SCRIPT>
var c = "";
var p = ""
var r = ""
for (i=0;i<zdrClan.length;i++)
{
if (zdrClan[i].rang==1 || zdrClan[i].rang==2) 
{
p += zdrClan[i].email + ","
}
r = "<a  class='okro' href='mailto:" + p + "'" + "target='_top'>" + "okro&#382;nica" + "</a>" 
}

document.getElementById('okr').innerHTML = "<br>" + r;
</script>
</body>
</html>
