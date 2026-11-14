<?php require_once __DIR__ . '/../../skupne/verzija.php'; ?><!DOCTYPE html>
<html lang="sl-SI">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../skupne/css/zahlavi.css?<?php echo verzija('../skupne/css/zahlavi.css'); ?>">
<link rel="stylesheet" href="../admin/css/izbira.css?<?php echo verzija('../admin/css/izbira.css'); ?>">
<title>kardiosi</title>
<link rel="shortcut icon" href="../favicon.ico?<?php echo verzija('../favicon.ico'); ?>">
</head>
<body>
<div class="topnav">
<?php
// stran lahko pred vključitvijo te glave določi $privzetiNazaj (kam vodi Nazaj, če ni podano)
$privzetoNazaj = isset($privzetiNazaj) ? $privzetiNazaj : "../index.php";
if (isset($_GET['nazaj'])){
      $nazaj = test_input($_GET['nazaj']);	
}elseif (isset($_POST['nazaj'])){		  
      $nazaj = test_input($_POST['nazaj']);	
}else {
     $nazaj = $privzetoNazaj;
}
// varnost: dovoljene so samo poti znotraj aplikacije (ne zunanje ali javascript: povezave)
if ($nazaj === '' || strpos($nazaj, ':') !== false || strpos($nazaj, '//') !== false || strpos($nazaj, '\\') !== false) {
     $nazaj = $privzetoNazaj;
}
// glavni meni se vedno odpre čez celo okno, ne znotraj okna "vsebina" (ORGANIZATOR)
$cilj = (strpos($nazaj, 'index.php') !== false || strpos($nazaj, 'menuFile1.php') !== false) ? ' target="_top"' : '';
echo '
 <a class="active" href="' . $nazaj . '"' . $cilj . '>Nazaj</a>
 ';
function test_input($test) {
  $test = trim($test);
  $test = stripslashes($test);
  $test = htmlspecialchars($test);
  return $test;
} 
 ?>
</div>





