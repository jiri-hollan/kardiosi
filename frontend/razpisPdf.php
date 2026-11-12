<?php
/* Mesečni razpis (PDF) - samo za prijavljene uporabnike.
   Datoteke v kardio/razpis/mespdf/ niso več dostopne neposredno (.htaccess v tej mapi),
   zato jih prikaže ta skripta: razpisPdf.php?m=januar  (ali m=januar.pdf) */
require_once __DIR__ . '/../skupne/zascita.php';

if (!jePrijavljen()) {
	http_response_code(403);
	header('Content-Type: text/html; charset=utf-8');
	exit('<p style="font-family: sans-serif; padding: 20px;"><b>Razpis je dostopen le prijavljenim uporabnikom. Prosimo, prijavite se.</b></p>');
}
// status 0 (neoverjena registracija) razpisa ne vidi
if (upstatusUporabnika() < 0.5) {
	http_response_code(403);
	header('Content-Type: text/html; charset=utf-8');
	exit('<p style="font-family: sans-serif; padding: 20px;"><b>Dostop ni omogočen.</b></p>');
}

// dovoljeno je samo ime datoteke (npr. "januar", "2026"), brez poti
$ime = preg_replace('/\.pdf$/i', '', (string)($_GET['m'] ?? ''));
$pot = __DIR__ . '/../kardio/razpis/mespdf/' . $ime . '.pdf';
if (!preg_match('/^[a-z0-9_-]{1,30}$/i', $ime) || !is_file($pot)) {
	http_response_code(404);
	header('Content-Type: text/html; charset=utf-8');
	exit('<p style="font-family: sans-serif; padding: 20px;">Razpisa za ta mesec ni.</p>');
}

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . $ime . '.pdf"');
header('Content-Length: ' . filesize($pot));
header('Cache-Control: private, no-cache, must-revalidate');
header('X-Content-Type-Options: nosniff');
readfile($pot);
