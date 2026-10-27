<?php
require_once __DIR__ . '/../skupne/zascita.php'; // zaščita: samo admin (upstatus 4)
zahtevajPrijavo(4);
require_once '../skupne/sabloni/zahlavi.php';
require_once '../skupne/narediTablo.php';	
$databaseGloboka=new DatabaseGloboka;
$databaseGloboka->pokaziTable();
require_once '../skupne/sabloni/zapati.php';
?>