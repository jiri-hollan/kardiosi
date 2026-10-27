<?php
require_once __DIR__ . '/../../../skupne/verzija.php';
echo'
<!DOCTYPE html>
<html lang="sl-SI">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kardiosi</title>
<link rel="shortcut icon" href="../favicon.ico?'.verzija('../favicon.ico').'">
<link rel="stylesheet" href="sabloni/css/zahlavi.css?'.verzija('sabloni/css/zahlavi.css').'">
<link rel="stylesheet" href="../css/menuFile.css?'.verzija('../css/menuFile.css').'">
<script src="../frontend/js/uporabnikiVse.js?'.verzija('../frontend/js/uporabnikiVse.js').'"></script> 
<script src="../pregled/js/prijava.js?'.verzija('../pregled/js/prijava.js').'"></script>
<script src="../skupne/js/seznamBolnisnic.js?'.verzija('../skupne/js/seznamBolnisnic.js').'"></script> 
<link rel="stylesheet" href="sabloni/css/uporabnikiNov.css?'.verzija('sabloni/css/uporabnikiNov.css').'">
</head>
<body>
<div class="topnav">
  <a id="dom" class="active" href="../frontend/menuFile1.php">Domov</a>
  <a id="prij" href="../frontend/prihlaseni.php?r=logout&stav=odhlasit">Prijava</a>
  <a href="../frontend/prihlaseni.php?r=profil">Moj profil</a>
  <span id="uname">odjavljen</span>
</div>';
?> 
