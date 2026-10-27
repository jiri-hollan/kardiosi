<?php
require_once __DIR__ . '/../skupne/zascita.php'; // zaščita: samo admin (upstatus 4)
zahtevajPrijavo(4);
require_once '../skupne/sabloni/zahlavi.php';
echo 'PHP_SELF: ' . $_SERVER['PHP_SELF'];
echo "<br>";
echo 'SERVER_NAME: ' . $_SERVER['SERVER_NAME'];
echo "<br>";
echo 'HTTP_HOST: ' . $_SERVER['HTTP_HOST'];
echo "<br>";
echo 'HTTP_REFERER: ' . $_SERVER['HTTP_REFERER'];
echo "<br>";
echo 'HTTP_USER_AGENT: ' . $_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo 'SCRIPT_NAME: ' . $_SERVER['SCRIPT_NAME'];
require_once '../skupne/sabloni/zapati.php';
?>

</body>
</html>