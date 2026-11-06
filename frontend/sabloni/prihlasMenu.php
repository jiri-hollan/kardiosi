<?php
// gumbi za prijavo/registracijo samo za neprijavljene uporabnike
// (in na strani za odjavo, kjer se seja konča šele po izpisu te glave)
$jeOdjava = isset($_GET['r']) && $_GET['r'] === 'logout';
if (empty($_SESSION['uporabnikPrihlasen']) || $jeOdjava) {
echo
'<button class="knof" onclick="schovej(\'id01\')" style="width:auto;">Registracija</button>
<button class="knof" onclick="schovej(\'id02\')" style="width:auto;">Prijava</button>
<button class="knof" onclick="schovej(\'id03\')" style="width:auto;">Pozabljeno geslo</button>';
}
?>
