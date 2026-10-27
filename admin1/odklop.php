<?php
require_once __DIR__ . '/../skupne/zascita.php'; // zaščita: samo admin (upstatus 4)
zahtevajPrijavo(4);
require_once '../skupne/sabloni/zahlavi.php';
$conn = null;
require_once '../skupne/sabloni/zapati.php';
?>