<?php

// varnost: dovoljene so samo funkcije s tega seznama (prej je bilo mogoče poklicati katerokoli PHP funkcijo)
$dovoljeneFunkcije = ["premedikacija"];

if (!empty($_REQUEST['function']) && in_array($_REQUEST['function'], $dovoljeneFunkcije, true)) {
	$function = $_REQUEST['function'];
	$function();
} else {
	echo json_encode(["error" => "Funkcija ne obstaja"]);
	die();
}

function premedikacija() 
{
	echo json_encode([
		"test1" => "bla bla",
		"test2" => 123123
	]);
}	
