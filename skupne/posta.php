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

	public static function veljavenEmail($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false && strpbrk($email, "\r\n") === false;
	}

	// pošlje HTML sporočilo adminu; $replyTo se doda samo, če je veljaven e-poštni naslov
	public static function posljiAdminu($zadeva, $htmlVsebina, $replyTo = '') {
		$subject = '=?UTF-8?B?' . base64_encode($zadeva) . '?=';
		$message = '<!DOCTYPE html><html lang="sl"><head><meta charset="UTF-8"><title>'
			. htmlspecialchars($zadeva, ENT_QUOTES, 'UTF-8') . '</title></head><body>'
			. $htmlVsebina . '</body></html>';
		$headers = array();
		$headers[] = 'From: kardiosi <' . self::ODPOSILJATELJ . '>';
		if ($replyTo !== '' && self::veljavenEmail($replyTo)) {
			$headers[] = 'Reply-To: ' . $replyTo;
		}
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-Type: text/html; charset=UTF-8';
		$headers[] = 'Content-Transfer-Encoding: 8bit';
		return mail(self::PREJEMNIK, $subject, $message, implode("\r\n", $headers), '-f' . self::ODPOSILJATELJ);
	}

	// obvestilo o novem uporabniku (ob registraciji)
	public function __construct($ime, $priimek, $email) {
		// podatki prihajajo iz registracijskega obrazca: ime in priimek ubežimo za HTML,
		// e-pošto preverimo, da prek nje ni mogoče podtakniti dodatnih glav sporočila
		$ime = htmlspecialchars((string)$ime, ENT_QUOTES, 'UTF-8', false);
		$priimek = htmlspecialchars((string)$priimek, ENT_QUOTES, 'UTF-8', false);
		$email = trim((string)$email);
		$veljavenEmail = self::veljavenEmail($email);
		$vsebina = '<p>Nov uporabnik: ' . $ime . ' ' . $priimek . ' '
			. ($veljavenEmail ? htmlspecialchars($email, ENT_QUOTES, 'UTF-8') : '(neveljaven e-poštni naslov)')
			. '</p>';
		$retval = self::posljiAdminu('obvestilo kardiosi', $vsebina, $email);

		if ($retval == true) {
			echo "Obvestilo poslano adminu...";
		} else {
			echo "Nekaj je narobe, obvestilo adminu ni bilo poslano!";
		}
	}//od construct
}//od class posta
?>
