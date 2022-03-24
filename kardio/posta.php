<?php
$to = "jiri.hollan@gmail.com";
$subject = "My subject";
$from = 'Sender <noreply@sender.com>';
$message = "Hello world!";
//$headers[] = "From: " .($from);
//$headers[] = "Reply-To: ".($from);
$headers = 'From: '.$from ;
//$retval = mail($to,$subject,$message,implode("\r\n", $headers));
$retval = mail($to,$subject,$message, $headers);

mail($to,$subject,$txt,$headers);
?>

</body>
</html>