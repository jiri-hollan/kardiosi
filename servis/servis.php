<?php
require_once '../skupne/sabloni/zahlavi.php';
$nazaj="../servis/servis.php";
echo'
 <section class="top-bar-section">
          <!-- Right Nav Section -->
    <ul class="right">
	  <li class=""><a href="../navodila/formUploadBesedilo.php?direktorij=../navodila/besedila/"><h1>naloži besedilo</h1></a></li> 
	  <li class=""><a href="upload/formUpload.php"><h1>naloži mesečni razpis PDF</h1></a></li>
	  <li class=""><a href="manipulaceUporabniki.php?nazaj='.$nazaj.'">kompetence</a></li>
	  <li class=""><a href="manipulacePregledovalci.php?nazaj='.$nazaj.'">pregledovalci</a></li>
	  <li class=""><a href="manipulaceSklepi.php?nazaj='.$nazaj.'">prednastavljeni sklepi</a></li>
	  <li class=""><a href="manipulaceLimiti.php?nazaj='.$nazaj.'">Mejne vrednosti</a></li>	  
    </ul>
 </section>
';
?>