<!DOCTYPE html> 
<html> 
<head> 
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"> 
</head> 
<body> 
 
<?php 
echo 'na začetku'; 
$to = "jiri.hollan@gmail.com"; 
$subject = "My subject"; 
$txt = "Hello world!"; 
$headers = "From: webmaster@example.com" . "\r\n" . 
"CC: jiri.hollan@gmail.com"; 
 
mail($to,$subject,$txt,$headers); 
echo "kao da je poslano"; 
?> 
 
</body> 
</html>