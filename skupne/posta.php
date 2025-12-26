<?php
$to = "<dr.maja.sostaric@gmail.com>";
//$to .= ", <hocimin68@gmail.com>";
$subject = "obvestilo kardiosi";
$from = '<noreply@sender.com>';
$message = "Nov uporabnik";
$headers[] = "From: " .($from);
$headers[] = $to;
//$headers[] = "CC: somebodyelse@example.com";
$headers[] = "Reply-To: ".($from);
$headers[] = "Return-Path: ".($from);
$headers[] = "MIME-Version: 1.0"; 
$headers[] = "Content-Type: text/html";
$headers[] = "charset=ISO-8859-1";
$headers[] = "X-Priority: 3";
$headers[] = "X-Mailer: PHP". phpversion();
//$retval = mail($to,$subject,$message,implode("\r\n", $headers));
$retval = mail($to,$subject,$message,$headers);
         
         if( $retval == true ) {
            echo "Obvestilo poslano adminu...";
         }else {
            echo "Message could not be sent...";
         }

?>
<?php
Class Posta{
	public function __construct($ime, $priimek, $email) {
$to = "<jiri.hollan@gmail.com>";
//$to .= ", <dr.maja.sostaric@gmail.com>";
$subject = "obvestilo kardiosi";
$from = 'noreply@sender.com';
$message = "<br>Nov uporabnik: ".$ime." ". $priimek;
$headers[] = "From: " .($from);
$headers[] = "Reply-To: ".($email);
$headers[] = "Return-Path: ".($from);
$headers[] = "MIME-Version: 1.0"; 
$headers[] = "Content-Type: text/html; charset=ISO-8859-1";
$headers[] = "X-Priority: 3";
$headers[] = "X-Mailer: PHP". phpversion();
$retval = mail($to,$subject,$message,implode("\r\n", $headers));

         if( $retval == true ) {
            echo "Obvestilo poslano adminu...";
         }else {
            echo "Message could not be sent...";
         }
	}//od construct
}//od class posta
?>