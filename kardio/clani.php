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
 
 
 <script type="text/javascript">

var c = "";
for (i=0;i<zdrClan.length;i++)
{

if (zdrClan[i].rang==1) 

{
	console.log(i);
//c += "<p onclick=" + "'person(zdrClan[" + i + "].firstname,zdrClan[" + i + "].lastname,zdrClan[" + i + "].oznaka, zdrClan[" + i + "].email)'" + "class='obarvaj' >" + zdrClan[i].firstname + '  ' + zdrClan[i].lastname + "</p>"

c += "<p onclick="
c += "'person("
c += "zdrClan[" + i + "].firstname,"
c += "zdrClan[" + i + "].lastname,"
c += "zdrClan[" + i + "].oznaka,"
c += "zdrClan[" + i + "].email)'"
c += "class='obarvaj' >"
c += zdrClan[i].firstname 
c += '  '
c += zdrClan[i].lastname
c +=  "</p>"

}

}

var p = ""
var r = ""
for (i=0;i<zdrClan.length;i++)
{
if (zdrClan[i].rang==1) 
{
p += zdrClan[i].email + ","
}
r = "<p class='obarvaj' >" + "<a href='mailto:" + p + "'" + "target='_top'>" + "okro&#382;nica" + "</a>" + "</p>"
}

document.getElementById('levo').innerHTML = c + "<br>" + r 

</script>
 
<script>
function person(firstname,lastname,oznaka,email)
{
var m = "";
var n = "";
var o = "";
m += "<img src='podobe/" + oznaka + ".jpg' alt='---- ' width='200'/>"


n += "<h2>" + firstname + " " + lastname  + "</h2>"


o += "<p class='obarvaj' >" + "<a href='mailto:" + email + "'" + "target='_top'>" + "E po&#353;ta" + "</a>" + "</p>"


document.getElementById('desno').innerHTML = m + "<br>" + n + "<br>" + o
}
</script>

</body>
</html>

