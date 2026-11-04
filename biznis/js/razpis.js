// Iskanje razpisa po letnici.
// Pred odprtjem preverimo, ali datoteka obstaja; če ne, namesto sistemskega
// "Not Found" izpišemo "za to letnico ni zapisa".

function izpisiSporocilo(besedilo) {
  var p = document.getElementById("sporocilo");
  if (!p) {
    p = document.createElement("p");
    p.id = "sporocilo";
    p.style.color = "yellow";
    p.style.fontSize = "60%";
    var obrazec = document.getElementById("letnikx").form;
    obrazec.appendChild(p);
  }
  p.textContent = besedilo;
}

// Preizkusi poti po vrsti in odpre prvo, ki obstaja.
function odpriPrvoObstojeco(poti) {
  if (poti.length == 0) {
    izpisiSporocilo("za to letnico ni zapisa");
    return;
  }
  fetch(poti[0], { method: "HEAD", cache: "no-store" })
    .then(function (odgovor) {
      if (odgovor.ok) {
        izpisiSporocilo("");
        window.location = poti[0];
      } else {
        odpriPrvoObstojeco(poti.slice(1));
      }
    })
    .catch(function () {
      odpriPrvoObstojeco(poti.slice(1));
    });
}

function preberiLetnico() {
  var x = document.getElementById("letnikx").value.trim();
  if (x == "") {
    alert("Vpisi iskano letnico");
    return null;
  }
  if (!/^\d{4}$/.test(x)) {
    izpisiSporocilo("za to letnico ni zapisa");
    return null;
  }
  return x;
}

function aktualRazpis() {
  var x = preberiLetnico();
  if (x === null) return;
  odpriPrvoObstojeco([
    "../kardio/razpis/msofice/" + x + ".xlsx",
    "../kardio/razpis/msofice/" + x + ".xls"
  ]);
} //od function aktualRazpis

function arhivRazpis() {
  var x = preberiLetnico();
  if (x === null) return;
  odpriPrvoObstojeco([
    "../kardio/razpis/msBackup/arhiv/" + x + ".xlsx",
    "../kardio/razpis/msBackup/arhiv/" + x + ".ods"
  ]);
} //od function arhivRazpis
