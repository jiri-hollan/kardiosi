<?php
/* Razred za statistiko: uporablja skupni razred Database (skupne/database.php)
   in mu doda poizvedbi counta (štetje po skupinah) in skupina (štetje po razredih CASE). */
require_once __DIR__ . '/../skupne/database.php';

class DatabaseS extends Database {

	// pogoji oblike ["datPregleda>=" => "2026-01-01"]; ključi so določeni v kodi, vrednosti gredo kot parametri
	private function sestaviPogoj($podminka, &$parametry) {
		$podminkaSQL = '';
		if (is_array($podminka)) {
			$i = 0;
			foreach ($podminka as $sloupec => $hodnota) {
				$podminkaSQL .= ($i == 0) ? " WHERE $sloupec ?" : " AND $sloupec ?";
				$parametry[] = $hodnota;
				$i++;
			}
		}
		return $podminkaSQL;
	}

	// SELECT stolpec, COUNT(*) ... GROUP BY stolpec
	public function counta($tabulka, $sloupce, $grupa, $podminka = NULL) {
		$sloupceSQL = implode(', ', $sloupce);
		$grupaSQL = implode(', ', $grupa);
		$parametry = array();
		$podminkaSQL = $this->sestaviPogoj($podminka, $parametry);
		$dotaz = $this->conn->prepare("SELECT $sloupceSQL, COUNT(*) AS steviloZapisov FROM $tabulka $podminkaSQL GROUP BY $grupaSQL ORDER BY $grupaSQL");
		try {
			$dotaz->execute($parametry);
			$zaznamy = $dotaz->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo $e->getMessage();
			$zaznamy = array();
		}
		$dotaz->closeCursor();
		return $zaznamy;
	}

	// SELECT CASE ... AS skupina, COUNT(*) ... GROUP BY skupina
	public function skupina($tabulka, $sloupce, $grupa = NULL, $podminka = NULL, $razvrstitev = NULL) {
		$parametry = array();
		$podminkaSQL = $this->sestaviPogoj($podminka, $parametry);
		$dotaz = $this->conn->prepare("SELECT $razvrstitev AS skupina, count(*) AS stevilo
			FROM $tabulka $podminkaSQL
			GROUP BY skupina ORDER BY ABS(skupina)");
		try {
			$dotaz->execute($parametry);
			$zaznamy = $dotaz->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo $e->getMessage();
			$zaznamy = array();
		}
		$dotaz->closeCursor();
		return $zaznamy;
	}
}
?>
