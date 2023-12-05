<?php
require_once '../skupne/sabloni/zahlavi.php';
$nazaj="../admin1/vertikalMenu.php";
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
 <section class="top-bar-section">
          <!-- Right Nav Section -->
          <ul class="right">
              <li class=""><a href="upload/formUpload.html"><h1>naloži mesečni razpis PDF</h1></a></li>
              <li class=""><a href="../admin1/manipulaceUporabniki.php?nazaj='.$nazaj.'">kompetence</a></li>           
          </ul>
        </section>
</body>
</html>