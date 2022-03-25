<!DOCTYPE html> 
<html> 
<head> 
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"> 
</head> 
<body> 
 
<?php 
echo 'na začetku<br>'; 
$to = "jiri.hollan@gmail.com"; 
$subject = "My subject, posta.php"; 
$txt = "Hello world!"; 

//$headers = "From: webmaster@example.com" . "\r\n" . 
//"CB: hocimin68@gmail.com"; 

 $headers[] = "From: webmaster@example.com";
 $headers[] = $to;
 $headers[] = "X-Mailer: PHP". phpversion();
//if (mail($to,$subject,$txt,$headers)) { 
 // if  (mail($to,$subject,$txt,implode("\r\n", $headers))){
	 
  if  (mail($to,$subject,$txt,$headers)){
echo "<br>izgleda, da je poslano"; 
} else {
echo "<br>pošiljanje ni uspelo"; 
}

?> 
 
</body> 
</html>