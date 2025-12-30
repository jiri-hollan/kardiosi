<?php
Class Posta{
	public function __construct($ime, $priimek, $email) {
$to = "<jiri.hollan@gmail.com>";
//$to .= ", <dr.maja.sostaric@gmail.com>";
$subject = "obvestilo kardiosi";
$from = 'noreply@sender.com';
$message = "<br>Nov uporabnik: ".$ime." ". $priimek." ".$email;
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
            echo "Nekaj je narobe, obvestilo adminu ni bilo poslano!";
         }
	}//od construct
}//od class posta
?>