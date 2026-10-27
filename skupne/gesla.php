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

/* Omejitev poskusov prijave: po 5 napačnih poskusih za isto uporabniško ime (ali 20 z istega IP)
   v 15 minutah je prijava začasno zaklenjena. Poskusi se beležijo v tabeli prijavaPoskusiTbl. */
const PRIJAVA_MAX_UPORABNIK = 5;
const PRIJAVA_MAX_IP = 20;
const PRIJAVA_OKNO_SEKUND = 900;

function pripraviTabeloPoskusov($pdo) {
	static $pripravljeno = false;
	if ($pripravljeno) {
		return;
	}
	$pripravljeno = true;
	try {
		$pdo->exec("CREATE TABLE IF NOT EXISTS prijavaPoskusiTbl (
			id INT AUTO_INCREMENT PRIMARY KEY,
			uname VARCHAR(255) NOT NULL,
			ip VARCHAR(45) NOT NULL,
			cas DATETIME NOT NULL,
			INDEX (cas)
		)");
	} catch (PDOException $e) {
		error_log('prijavaPoskusiTbl: ' . $e->getMessage());
	}
}

function prijavaZaklenjena($pdo, $uname) {
	pripraviTabeloPoskusov($pdo);
	try {
		$od = date('Y-m-d H:i:s', time() - PRIJAVA_OKNO_SEKUND);
		$ip = $_SERVER['REMOTE_ADDR'] ?? '';
		$dotaz = $pdo->prepare("SELECT SUM(uname = ?) AS poUporabniku, SUM(ip = ?) AS poIp FROM prijavaPoskusiTbl WHERE cas > ?");
		$dotaz->execute(array($uname, $ip, $od));
		$vrstica = $dotaz->fetch(PDO::FETCH_ASSOC);
		return (int)$vrstica['poUporabniku'] >= PRIJAVA_MAX_UPORABNIK || (int)$vrstica['poIp'] >= PRIJAVA_MAX_IP;
	} catch (PDOException $e) {
		error_log('prijavaZaklenjena: ' . $e->getMessage());
		return false; // če tabela ne deluje, prijave ne zaklepamo
	}
}

function zabeleziPoskus($pdo, $uname, $uspesen) {
	try {
		if ($uspesen) {
			$pdo->prepare("DELETE FROM prijavaPoskusiTbl WHERE uname = ?")->execute(array($uname));
		} else {
			$pdo->prepare("INSERT INTO prijavaPoskusiTbl (uname, ip, cas) VALUES (?, ?, ?)")
				->execute(array($uname, $_SERVER['REMOTE_ADDR'] ?? '', date('Y-m-d H:i:s')));
			$pdo->prepare("DELETE FROM prijavaPoskusiTbl WHERE cas < ?")->execute(array(date('Y-m-d H:i:s', time() - 86400)));
		}
	} catch (PDOException $e) {
		error_log('zabeleziPoskus: ' . $e->getMessage());
	}
}

// preveri uporabnika; vrne vrstico iz uporabnikiTbl ali null. Staro geslo po potrebi preshrani.
// Ob preveč napačnih poskusih vrne null in nastavi $GLOBALS['prijavaZaklenjena'] = true.
function prijaviUporabnika($conn, $uname, $geslo) {
	$GLOBALS['prijavaZaklenjena'] = false;
	if (prijavaZaklenjena($conn->conn, $uname)) {
		$GLOBALS['prijavaZaklenjena'] = true;
		return null;
	}
	$uporabniki = $conn->vyber('uporabnikiTbl', array('upstatus', 'pristop', 'gdpr', 'uname', 'geslo'), array('uname' => $uname));
	if (!is_array($uporabniki)) {
		return null;
	}
	foreach ($uporabniki as $uporabnik) {
		if (preveriGeslo($geslo, $uporabnik['geslo'])) {
			if (potrebujeNovZapis($uporabnik['geslo'])) {
				$conn->aktualizuj('uporabnikiTbl', array('geslo' => zgostiGeslo($geslo)), array('uname' => $uporabnik['uname'], 'geslo' => $uporabnik['geslo']));
			}
			zabeleziPoskus($conn->conn, $uname, true);
			return $uporabnik;
		}
	}
	zabeleziPoskus($conn->conn, $uname, false);
	return null;
}
?>
