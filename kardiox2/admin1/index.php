<?php
if (!isset($_SESSION)) session_start();
require_once('../admin/administrace.php');
$admin = new Administrace();
?>