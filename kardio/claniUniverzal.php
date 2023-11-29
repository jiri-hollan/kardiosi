<html>
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
body {
background-color: wheat;
background-image: url('ozadja/ZadnjaVecera.jpg');
background-size:60%;
background-repeat:no-repeat;
background-position:500px 30px;
}

p {color: black}
p {background-color: wheat}
a {text-decoration: none}
p.obarvaj:link {color:blue}
p.obarvaj:hover {font-size: 120%;background-color:white}
</style>
<script src="js/clani.js?v=<?=time();?>" type="text/javascript">
</script>

</head>
<body>
<span id="levo" style="position:absolute; top:0; left:10px;width:200px"></span>
<span id="desno" style="position:absolute; top:0; left:225px;"></span>
<?php
$izbiraRanga = "";

if(isset($_GET['rang'])){
$izbiraRanga = $_GET['rang'];
//echo'izbira ranga='.$izbiraRanga;
	}
//echo $izbiraRanga;	
	
$izbira="izbiraRanga=".$izbiraRanga;	
echo'<script>'
.$izbira.';'.
'alert("izbira Ranga:"+izbiraRanga);
</script>';
?>

<script type="text/javascript">
	//alert("claniUniverzalNaZačetku");
var c = "";
var p = "";
var r = "";
//var izbiraRanga = "1";
for (i=0;i<zdrClan.length;i++)
{
if (zdrClan[i].rang==izbiraRanga) 
{

c += "<p class='obarvaj' onclick="
c += "'person("
c += "zdrClan[" + i + "].personaId,"
c += "zdrClan[" + i + "].firstname,"
c += "zdrClan[" + i + "].lastname,"
c += "zdrClan[" + i + "].email)'"
c += ">"
c += zdrClan[i].firstname 
c += '  '
c += zdrClan[i].lastname
c +=  "</p>"


p += zdrClan[i].email + ","
}
r = "<p class='obarvaj' >" + "<a href='mailto:" + p + "'" + "target='_top'>" + "okro&#382;nica" + "</a>" + "</p>"
}

document.getElementById('levo').innerHTML = c + "<br>" + r 

</script>
<script>
function person(personaId,firstname,lastname,email)
{
	//alert("claniUniverzalFunctionPerson2");
var m = "";
var n = "";
var o = "";
m += "<img src='podobe/personId" + personaId + ".jpg' alt='---- ' width='200'/>"
n += "<h2>" + firstname + " " + lastname  + "</h2>"
o += "<p class='obarvaj' >" + "<a href='mailto:" + email + "'" + "target='_top'>" + "E po&#353;ta" + "</a>" + "</p>"

document.getElementById('desno').innerHTML = m + "<br>" + n + "<br>" + o
}
</script>

</body>
</html>

