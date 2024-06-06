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
require_once('sabloni/zahlaviSkupne.php');
?>


</head>
<body id="sorta">

<script>
var skupina = "ČLANI";
var b ="";
b += "<p>";
b += "<a class='zdrav' ";
b += "href='javascript: showZDR(";
b += '"../servis/poskusArrayZdravniki.php?pogoj=2")';
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
b += '"../servis/poskusArrayZdravniki.php?pogoj=1")';
b += "' > ";
b += skupina;
b += "</a>";
b +=  "</p>";
document.write(b);
</script>

</body>
</html>
