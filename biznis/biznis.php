<?php require_once __DIR__ . '/../skupne/verzija.php';
// ORGANIZATOR: prej <frameset> (glava1.php + skrite.php + vsebina), zdaj ena stran z vgrajenim oknom "vsebina"
$nazaj = "../biznis/genom.php";
?><!DOCTYPE html>
<html lang="sl-SI">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="../favicon.ico?<?php echo verzija('../favicon.ico'); ?>">
<title>Anestezija za operacije srca - organizator</title>
<style>
  html, body { height: 100%; margin: 0; }
  body {
    display: grid;
    grid-template-columns: 150px 1fr;
    grid-template-rows: 40px 1fr;
    grid-template-areas: "glava glava" "meni vsebina";
    font-family: sans-serif;
  }
  #glava { grid-area: glava; padding: 10px; box-sizing: border-box; }
  #meni { grid-area: meni; background-color: GoldenRod; padding: 0 8px; }
  #meni h2 { color: #00ff00; margin: 12px 0; }
  #meni ul { list-style: none; margin: 0; padding: 0; }
  #meni li { margin: 6px 0; font-weight: bold; }
  a { text-decoration: none; }
  a.obarvaj:link, a.obarvaj:visited { color: blue; }
  a.obarvaj:hover { color: black; background-color: yellow; }
  #vsebina { grid-area: vsebina; width: 100%; height: 100%; border: 0; display: block; }

  /* telefon: meni nad vsebino */
  @media (max-width: 700px) {
    body {
      grid-template-columns: 1fr;
      grid-template-rows: auto auto 1fr;
      grid-template-areas: "glava" "meni" "vsebina";
    }
    #meni { display: flex; align-items: center; gap: 16px; padding: 4px 10px; }
    #meni h2 { margin: 4px 0; font-size: 110%; }
    #meni ul { display: flex; gap: 16px; }
    #vsebina { min-height: 70vh; }
  }
</style>
</head>
<body>
  <div id="glava">
    <a class="obarvaj" href="../frontend/menuFile1.php">domov</a>
  </div>

  <nav id="meni">
    <h2>RAZPIS:</h2>
    <ul>
      <li><a class="obarvaj" href="IzbiraAktualna.php?nazaj=<?php echo $nazaj; ?>" target="vsebina">sedanji</a></li>
      <li><a class="obarvaj" href="IzbiraArhiva.php?nazaj=<?php echo $nazaj; ?>" target="vsebina">arhiv</a></li>
      <li><a class="obarvaj" href="../servis/servis.php?nazaj=<?php echo $nazaj; ?>" target="vsebina">Servis</a></li>
    </ul>
  </nav>

  <iframe id="vsebina" name="vsebina" src="genom.php" title="vsebina"></iframe>
</body>
</html>
