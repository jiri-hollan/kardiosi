<?php require_once __DIR__ . '/../../../skupne/verzija.php'; ?><!DOCTYPE html>
<html lang="sl-SI">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>kardiosi</title>
<link rel="shortcut icon" href="../favicon.ico?<?php echo verzija('../favicon.ico'); ?>">
<link rel="stylesheet" href="../admin/css/zahlavi.css?<?php echo verzija('../admin/css/zahlavi.css'); ?>">
<link rel="stylesheet" href="../admin/css/menuFile.css?<?php echo verzija('../admin/css/menuFile.css'); ?>">
<link rel="stylesheet" href="../admin/css/izbira.css?<?php echo verzija('../admin/css/izbira.css'); ?>">
<script src="js/manipulacePogoj.js?<?php echo verzija('js/manipulacePogoj.js'); ?>"></script> 
</head>
<body>
<div class="topnav">
  <a class="active" href="../index.php" target="_top">Domov</a>
  <!--<a href="../frontend/prihlaseni.php?r=logout&stav=odhlasit">Odjava in prijava</a>-->
</div>
<?php 
 //require_once('../admin/sabloni/oznamovaci-oblast.php');  
 function test_input($test) {
  $test = trim($test);
  $test = stripslashes($test);
  $test = htmlspecialchars($test);
  return $test;
} 
?>


