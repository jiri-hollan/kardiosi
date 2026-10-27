<?php
/* Varno shranjevanje gesel.
   Nova gesla se shranijo s password_hash (bcrypt).
   Stara md5 gesla še delujejo; ob prvi uspešni prijavi se samodejno preshranijo v varni obliki. */

function zgostiGeslo($geslo) {
	return password_hash($geslo, PASSWORD_DEFAULT);
}

function jeStaroMd5Geslo($shranjeno) {
	return is_string($shranjeno) && preg_match('/^[a-f0-9]{32}$/i', $shranjeno) === 1;
}

// ali je vrednost že zgoščeno geslo (in ne geslo v navadnem besedilu)
function jeZgoscenoGeslo($vrednost) {
	return jeStaroMd5Geslo($vrednost) || password_get_info($vrednost)['algo'] !== null;
}

function preveriGeslo($vpisano, $shranjeno) {
	if (!is_string($shranjeno) || $shranjeno === '') {
		return false;
	}
	if (jeStaroMd5Geslo($shranjeno)) {
		$shranjeno = strtolower($shranjeno);
		if (hash_equals($shranjeno, md5($vpisano))) {
			return true;
		}
		// registracija je prej geslo pred md5 še "očistila" (trim, stripslashes, htmlspecialchars)
		$ocisceno = htmlspecialchars(stripslashes(trim($vpisano)));
		return hash_equals($shranjeno, md5($ocisceno));
	}
	return password_verify($vpisano, $shranjeno);
}

function potrebujeNovZapis($shranjeno) {
	return jeStaroMd5Geslo($shranjeno) || password_needs_rehash($shranjeno, PASSWORD_DEFAULT);
}

// preveri uporabnika; vrne vrstico iz uporabnikiTbl ali null. Staro geslo po potrebi preshrani.
function prijaviUporabnika($conn, $uname, $geslo) {
	$uporabniki = $conn->vyber('uporabnikiTbl', array('upstatus', 'pristop', 'gdpr', 'uname', 'geslo'), array('uname' => $uname));
	if (!is_array($uporabniki)) {
		return null;
	}
	foreach ($uporabniki as $uporabnik) {
		if (preveriGeslo($geslo, $uporabnik['geslo'])) {
			if (potrebujeNovZapis($uporabnik['geslo'])) {
				$conn->aktualizuj('uporabnikiTbl', array('geslo' => zgostiGeslo($geslo)), array('uname' => $uporabnik['uname'], 'geslo' => $uporabnik['geslo']));
			}
			return $uporabnik;
		}
	}
	return null;
}
?>
