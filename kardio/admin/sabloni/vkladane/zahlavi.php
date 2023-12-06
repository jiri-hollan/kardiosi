<!DOCTYPE html>
<html lang="cs-SI">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin</title>
<link rel="shortcut icon" href="../favicon.ico?<?php echo time(); ?>">
<link rel="stylesheet" href="../admin/css/zahlavi.css?<?php echo time(); ?>">
<link rel="stylesheet" href="../admin/css/menuFile.css?<?php echo time(); ?>">
<link rel="stylesheet" href="../admin/css/pregledovalci.css?<?php echo time(); ?>">
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


