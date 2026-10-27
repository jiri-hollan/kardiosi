<?php
/* Številka različice za CSS/JS/ikone v URL-ju (npr. style.css?1735470000).
   Spremeni se samo, ko se datoteka spremeni, zato jo brskalnik lahko hrani v predpomnilniku.
   (prej: ?time() - brskalnik je ob vsakem odprtju strani znova prenesel vse datoteke) */
if (!function_exists('verzija')) {
	function verzija($url) {
		$pot = dirname($_SERVER['SCRIPT_FILENAME']) . '/' . $url;
		return is_file($pot) ? filemtime($pot) : time();
	}
}
?>