<?php
/* Obvestilo adminu o novem uporabniku.
   Da Gmail pošte ne uvrsti med spam:
   - odpošiljatelj je naslov z naše domene (kardiosi.com), za katero strežnik sme pošiljati (SPF/DKIM v cPanel > Email Deliverability)
   - enak naslov je tudi "ovojni" pošiljatelj (parameter -f pri mail())
   - besedilo je v UTF-8 */
Class Posta{
	const ODPOSILJATELJ = 'noreply@kardiosi.com';
	const PREJEMNIK = 'jiri.hollan@gmail.com';
	//const PREJEMNIK = 'jiri.hollan@gmail.com, dr.maja.sostaric@gmail.com';

	public function __construct($ime, $priimek, $email) {
		// podatki prihajajo iz registracijskega obrazca: ime in priimek ubežimo za HTML,
		// e-pošto preverimo, da prek nje ni mogoče podtakniti dodatnih glav sporočila
		$ime = htmlspecialchars((string)$ime, ENT_QUOTES, 'UTF-8', false);
		$priimek = htmlspecialchars((string)$priimek, ENT_QUOTES, 'UTF-8', false);
		$email = trim((string)$email);
		$veljavenEmail = filter_var($email, FILTER_VALIDATE_EMAIL) !== false && strpbrk($email, "\r\n") === false;

		$subject = '=?UTF-8?B?' . base64_encode('obvestilo kardiosi') . '?=';
		$message = '<!DOCTYPE html><html lang="sl"><head><meta charset="UTF-8"><title>obvestilo kardiosi</title></head><body>'
			. '<p>Nov uporabnik: ' . $ime . ' ' . $priimek . ' '
			. ($veljavenEmail ? htmlspecialchars($email, ENT_QUOTES, 'UTF-8') : '(neveljaven e-poštni naslov)')
			. '</p></body></html>';

		$headers = array();
		$headers[] = 'From: kardiosi <' . self::ODPOSILJATELJ . '>';
		if ($veljavenEmail) {
			$headers[] = 'Reply-To: ' . $email;
		}
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-Type: text/html; charset=UTF-8';
		$headers[] = 'Content-Transfer-Encoding: 8bit';

		$retval = mail(self::PREJEMNIK, $subject, $message, implode("\r\n", $headers), '-f' . self::ODPOSILJATELJ);

		if ($retval == true) {
			echo "Obvestilo poslano adminu...";
		} else {
			echo "Nekaj je narobe, obvestilo adminu ni bilo poslano!";
		}
	}//od construct
}//od class posta
?>
