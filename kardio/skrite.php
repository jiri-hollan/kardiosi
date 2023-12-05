<!DOCTYPE HTML>
<html lang="sl-SI">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <style type="text/css">
body {background-color: GoldenRod }
  a {font-size: 100%}
  a {text-decoration: none}
  a.obarvaj:link {color: blue}
  a.obarvaj:visited {color: #0000ff}
  a.obarvaj:hover {color: black; background-color: yellow}
  h2 {background-color: GoldenRod ; color: #00ff00}
  td {background-color: GoldenRod }
  </style>

<?php


$nazaj="../genom.php";
echo'
<table >
<tr><td> <h2>RAZPIS:</h2> </td></tr>
<tr><td><b><a class="obarvaj" href="frontend/IzbiraAktualna.php?nazaj='.$nazaj.'" target="vsebina"> 
sedanji</a></b></td></tr>

<tr><td><b><a class="obarvaj" href="frontend/IzbiraArhiva.php?nazaj='.$nazaj.'" target="vsebina"> 
arhiv</a></b></td></tr>

<tr><td><b><a class="obarvaj" href="servis/servis.php?nazaj='.$nazaj.'" target="vsebina"> 
Servis</a></b></td></tr>

<tr><td><b><a class="obarvaj" href="admin/databazeMenu.php?nazaj='.$nazaj.'" target="vsebina"> 
databaze</a></b></td></tr>
</table>
';
?>