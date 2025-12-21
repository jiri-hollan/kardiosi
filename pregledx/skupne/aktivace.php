
<?php
require_once'../../kardiox2/skupne/database.php';
// aktivace
$database=new Database;
$database->testirajBolnik();
if($database->bolnikObstaja==2){
$tabulka="omejitveTbl";
$sloupce=["razlog", "nivo"];
$podminka=["razlog"=>"gdpr"];
$database= new Database;
$gdpr=$database->vyber($tabulka,$sloupce,$podminka);
//echo '<br>'.count($gdpr).'<br>';
if(count($gdpr)==1){
$omejitevGdpr=$gdpr[0];	
$gdpr=	$omejitevGdpr['nivo'];
echo'<script>';
echo 'localStorage.setItem("gdpr",'.$gdpr.');';
echo'</script>';
}
}else{
$gdpr=0;
echo'<script>';
echo 'localStorage.setItem("gdpr",'.$gdpr.');';
echo'</script>';
}
?>