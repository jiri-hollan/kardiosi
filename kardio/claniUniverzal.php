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
'//alert("izbira Ranga:"+izbiraRanga);
</script>';
?>

<script type="text/javascript">
	//alert("claniUniverzalNaZačetku");
	alert(zdrClan[0].firstname);
var pragrafKlik = "";
var emajly = "";
var okroznica = "";
//var izbiraRanga = "1";
for (i=0;i<zdrClan.length;i++)
{
if (zdrClan[i].rang==izbiraRanga) 
{

pragrafKlik += "<p class='obarvaj' onclick="
pragrafKlik += "'person("
pragrafKlik += "zdrClan[" + i + "].personaId,"
pragrafKlik += "zdrClan[" + i + "].firstname,"
pragrafKlik += "zdrClan[" + i + "].lastname,"
pragrafKlik += "zdrClan[" + i + "].email)'"
pragrafKlik += ">"
pragrafKlik += zdrClan[i].firstname 
pragrafKlik += '  '
pragrafKlik += zdrClan[i].lastname
pragrafKlik +=  "</p>"


emajly += zdrClan[i].email + ","
}
okroznica = "<p class='obarvaj' >" + "<a href='mailto:" + emajly + "'" + "target='_top'>" + "okro&#382;nica" + "</a>" + "</p>"
}

document.getElementById('levo').innerHTML = pragrafKlik + "<br>" + okroznica 

</script>
<script>
function person(personaId,firstname,lastname,email)
{
	//alert("claniUniverzalFunctionPerson2");
var slika = "";
var celoIme = "";
var mail = "";
slika += "<img src='podobe/personId" + personaId + ".jpg' alt='---- ' width='200'/>"
celoIme += "<h2>" + firstname + " " + lastname  + "</h2>"
mail += "<p class='obarvaj' >" + "<a href='mailto:" + email + "'" + "target='_top'>" + "E po&#353;ta" + "</a>" + "</p>"

document.getElementById('desno').innerHTML = slika + "<br>" + celoIme + "<br>" + mail
}
</script>

</body>
</html>

