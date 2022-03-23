<?php
$to = "jiri.hollan@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: webmaster@example.com" . "\r\n" .
"CC: jiri.hollan@gmail.com";

mail($to,$subject,$txt,$headers);
?>