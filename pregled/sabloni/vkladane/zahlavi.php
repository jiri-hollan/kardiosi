<?php
require_once __DIR__ . '/../../../skupne/verzija.php';
echo'
<!DOCTYPE html>
<html  lang="sl-SI">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<title>Novi bolnik</title>
<link rel="shortcut icon" href="../favicon.ico?'.verzija('../favicon.ico').'">
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!--<script src="js/vpis.js?'.verzija('js/vpis.js').'"></script>-->
<script src="js/report.js?'.verzija('js/report.js').'"></script>
<script src="js/prenos.js?'.verzija('js/prenos.js').'"></script>
<!--<script src="js/preklopCss.js?'.verzija('js/preklopCss.js').'"></script>-->
<script src="js/odjava.js?'.verzija('js/odjava.js').'"></script>
<script src="js/evaluacija.js?'.verzija('js/evaluacija.js').'"></script>
<script src="js/drugiIzvidi.js?'.verzija('js/drugiIzvidi.js').'"></script>
<script src="js/prijava.js?'.verzija('js/prijava.js').'"></script>
<script src="js/obnovaForme.js?'.verzija('js/obnovaForme.js').'"></script>
<script src="js/vypocty.js?'.verzija('js/vypocty.js').'"></script>
<script src="js/sklepi.js?'.verzija('js/sklepi.js').'"></script>
<script src="js/premedikacijaOtroska.js?'.verzija('js/premedikacijaOtroska.js').'"></script>
<link rel="stylesheet" type="text/css" href="css/novPolnjenje.css?'.verzija('css/novPolnjenje.css').'">
<link rel="stylesheet" type="text/css" href="css/premedikacijaTisk.css?'.verzija('css/premedikacijaTisk.css').'">
<link rel="stylesheet" type="text/css" href="css/premedikacijaPrenos.css?'.verzija('css/premedikacijaPrenos.css').'">
<link rel="stylesheet" type="text/css" href="css/doziranje.css?'.verzija('css/doziranje.css').'">
<link rel="stylesheet" type="text/css" href="css/uporabnik.css?'.verzija('css/uporabnik.css').'">
</head>
<body onload="vpisFunction()">';
?>