<?php
require_once __DIR__ . '/../../skupne/verzija.php';
if (!function_exists('test_input')) {
	function test_input($test) {
		return htmlspecialchars(stripslashes(trim($test)));
	}
}
if (!isset($nazaj)) {
	$nazaj = "../frontend/menuFile1.php?p=pregled";
}
echo'
<!DOCTYPE html>
<html lang="sl-SI">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/zahlavi.css?'.verzija('css/zahlavi.css').'">
<link rel="stylesheet" href="css/statistika.css?'.verzija('css/statistika.css').'">
<title>Kardiosi - statistika</title>
<link rel="shortcut icon" href="../favicon.ico?'.verzija('../favicon.ico').'">
</head>
<body>
<div class="topnav">'.
  // $nazaj = "" -> brez gumba Nazaj, samo Domov (seznam statistik)
  ($nazaj !== '' ? '
  <a class="active" href="'.htmlspecialchars($nazaj).'">Nazaj</a>
  <a href="../frontend/menuFile1.php">Domov</a>' : '
  <a class="active" href="../frontend/menuFile1.php">Domov</a>').'
  <span id="poPotrebi"></span>
  <span id="uname"></span>
</div>';
?>
