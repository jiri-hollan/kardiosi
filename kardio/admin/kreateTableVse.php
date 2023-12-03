
<?php
require_once '../skupne/sabloni/zahlavi.php';

echo '
<h2>Naredi tabelo</h2>
<form method="post" action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'">  



  <label for="pregledovalci"><span class="imenaFilov">pregledovalci</span></label>
  <input type="radio" id="pregledovalci" name="name" value="pregledovalci">
  
 
     <label for="uporabniki"><span class="imenaFilov">uporabniki</span></label>
  <input type="radio" id="uporabniki" name="name" value="uporabniki">
  
   <input type="hidden" name="nazaj" value='. $nazaj.'>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
  <br>
</form>';
?>
<?php
// define variables and set to empty values
$name  = "";
$ime  = "";
if ($_SERVER["REQUEST_METHOD"] == "POST"&& isset($_POST["name"])) {
  $name = test_input($_POST["name"]);    
  $name = naredi($name);

}

function naredi($ime) {
require_once '../skupne/narediTablo.php';	
$databaseGloboka=new DatabaseGloboka;	
switch ($ime) {	


case "pregledovalci":
$definice= "id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `status` int(3) NOT NULL,
	`ime` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
	`priimek` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
	`email` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
	`uname` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci ,
	`geslo` varchar(255) CHARACTER SET utf8 COLLATE utf8_slovenian_ci ,	
	UNIQUE (email, uname)";
$databaseGloboka->naredi('pregledovalciTbl', $definice);
break;
case "uporabniki":
$definice= "id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	`email` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
	`uname` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
	`geslo` varchar(255) CHARACTER SET utf8 COLLATE utf8_slovenian_ci NOT NULL,
	`ime` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
	`priimek` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
    `status` int(3) NOT NULL,
    `pristop` int(3) NOT NULL,	
	UNIQUE (email, uname)";
$databaseGloboka->naredi('uporabnikiTbl', $definice);
break;
/*
case "":
$definice= "";
$databaseGloboka->naredi('', $definice);
break;
*/
default:
    echo "ni izvelo get case"; 
  }//od switch	$ime
 echo "<h2>Your Input: ".$ime."</h2>";
echo "<br>"; 
}// od function naredi($ime)

require_once '../skupne/sabloni/zapati.php';
?>
