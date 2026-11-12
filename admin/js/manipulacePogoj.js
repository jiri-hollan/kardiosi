let tabulka_global;
//alert('definicija tabulke:  '+tabulka_global);
let zaUrejat = [];
let pogojJs = {}; // izbrani pogoji (npr. bolnisnica, priimek); prazni se ne pošljejo
function izborFunction(akce, tabulka,bolList) {
//console.log(tabulka);
	tabulka_global=tabulka; 
//alert(tabulka);
	let vnosi= "";
	let seznam = "";
	let zaPogoj = "";
	let i;
		switch(tabulka) {
		case "uporabnikiTbl":
//alert(tabulka);
			zaUrejat = ["email", "uname", "geslo", "bolnisnica", "ime", "priimek", "upstatus", "pristop", "gdpr", "stevilkaZdravnika"];
			zaPogoj = "bolnisnica";
		break;
		case "statusiTbl":
//alert(tabulka);	
			zaUrejat = ["status", "pomen",];	
		break;
		case "bolnisniceTbl":
//alert(tabulka);
			zaUrejat = ["mesto", "nazivB", "bolnisnicaStatus"];
		break;
		case "limitiTbl":
//console.log(tabulka);		
			zaUrejat = ["bolnisnica", "skupina", "ime", "min", "max"];
			zaPogoj = "bolnisnica";			
		break;
		case "pregledovalciTbl":
//console.log(tabulka);		
			zaUrejat = ["bolnisnica", "ime", "priimek", "pregledovalciStatus"];
			zaPogoj = "bolnisnica";
		break;	
		case "omejitveTbl":
//console.log(tabulka);		
			zaUrejat = ["razlog", "nivo"];
		break;
		case "sklepiTbl":
//console.log(tabulka);		
			zaUrejat = ["bolnisnica", "sklep", "sklepiStatus"];
			zaPogoj = "bolnisnica";			
		break;
		case "opravilaTbl":
//console.log(tabulka);		
			zaUrejat = ["bolnisnica", "opravilo", "sifraOpravila"];
		break;	
		case "premedikacija1Tbl":
//console.log(tabulka);		
			zaUrejat = ["ucinkovina", "teza", "doza", "koncentracija", "navodila"];
		break;	
/*			case "tabulka":
//console.log(tabulka);		
			zaUrejat = ["stolpec", "stolpec"];
		break;			
		case "tabulka":
//console.log(tabulka);		
			zaUrejat = ["stolpec", "stolpec"];
		break;	*/				
		default:
			zaUrejat = [];		
			console.log(tabulka);		
			console.log('za to tabuku ni še napisana koda');
		}
	document.getElementById("akceId").value = akce;
	
	switch(akce) {
	case "vyber":
		pogojJs = {};
		document.getElementById("pogojSkriti").innerHTML = '';
		if(zaPogoj=="bolnisnica"){
	    document.getElementById("demo").innerHTML = '<input id="bolnisnicaId" list="bolnisnice" name="bolnisnica" value="" placeholder="Bolnišnica" onkeyup="pogojFunction(name, value)" onchange="pogojFunction(name, value)" autocomplete="off"><datalist id="bolnisnice"><option value="izbrana bolnisnica"> </datalist>';
		// pri uporabnikih je mogoče izbirati tudi po priimku, imenu in upstatusu (posamezno ali v kombinaciji)
		if (tabulka == "uporabnikiTbl") {
			document.getElementById("demo").innerHTML += ' <input id="priimekPogojId" name="priimek" value="" placeholder="Priimek" onkeyup="pogojFunction(name, value)" onchange="pogojFunction(name, value)" autocomplete="off">'
				+ ' <input id="imePogojId" name="ime" value="" placeholder="Ime" onkeyup="pogojFunction(name, value)" onchange="pogojFunction(name, value)" autocomplete="off">'
				+ ' <select id="upstatusPogojId" name="upstatus" onchange="pogojFunction(name, value)">'
				+ '<option value="">upstatus: vsi</option><option value="0">0 izključen</option><option value="0.5">0,5 dostop do razpisa</option><option value="1">1 pridruženi</option>'
				+ '<option value="2">2 član</option><option value="3">3 vodstvo</option><option value="4">4 admin</option></select>';
		}

		for (i = 0; i < bolList.length; i++) {
			//alert(bolList[i]);
			bolList[i] =   bolList[i].replace(/ /g, "&nbsp;");
			seznam += "<option value='" +  bolList[i] + "'>"  +"<br>";
		}	
			document.getElementById("bolnisnice").innerHTML = seznam;
		}else{
			console.log('zaPogoj ni določen');
		}
		for (i = 0; i < zaUrejat.length; i++) {
	vnosi += '<input type=\"text\" id=\"'+zaUrejat[i]+'Id\"  name=\"'+zaUrejat[i]+'\" value=\"\" placeholder=\"'+zaUrejat[i]+'\" required>' ;	
			}
		document.getElementById("tabSent").innerHTML = '<input type="hidden" name="tabulka" value="'+tabulka+'">';
		document.getElementById("urejatSent").innerHTML =  '<input type="hidden" name="zaUrejat" value="'+zaUrejat+'">';		
		document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi">'; //submit
    break; 

    case "vloz":
		for (i = 0; i < zaUrejat.length; i++) {
			vnosi += '<input type=\"text\" id=\"'+zaUrejat[i]+'Id\"  name=\"'+zaUrejat[i]+'\" value=\"\" placeholder=\"'+zaUrejat[i]+'\" required>' ;		
			}
		document.getElementById("demo").innerHTML = vnosi;			
		document.getElementById("tabSent").innerHTML =  '<input type="hidden" name="tabulka" value="'+tabulka+'">';
		document.getElementById("urejatSent").innerHTML =  '<input type="hidden" name="zaUrejat" value="'+zaUrejat+'">';	
		document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi"><input type="reset" name="reset" value="Reset">'; //submit+reset					
    break;

	case "edit":
		if(document.getElementById("osebe")!=null){
			document.getElementById("osebe").addEventListener("click", functionOver);
			}
    break;

	case "odstrani": 
		if ( confirm("Odstranim en zapis?") == true) {
			if(document.getElementById("osebe")!=null){
				document.getElementById("osebe").addEventListener("click", functionOver);
			}
		} else {
			text = "You canceled!";
		}
    break;	
	default:
 }//od switch
} // od izborFunction
//----------------------------------------------------------------------------------------
function functionOver (e) {
let x = e.target;
if (x.nodeName == "TD") {
	let y = e.composedPath()[1];
	row_value = y.cells[0].innerHTML;
	document.getElementById("demo3").innerHTML = "id v bazi je= " + row_value ;  
	}//od if 
//alert(zaUrejat);
  window.location.href = "manipulacePogojUniverzal.php?akce=" + x.innerHTML + "&id=" + row_value + "&tabulka="+ tabulka_global + "&zaUrejat=" + zaUrejat + "&csrf=" + encodeURIComponent((document.querySelector('input[name="csrf"]') || {}).value || ""); 
}//od function(e)

//------------------------------------------------------------------------------------------
function pogojFunction(name, value){
	// presledki iz seznama bolnišnic so zapisani kot &nbsp; - vrnemo jih v navadne presledke
	value = String(value).replace(/\u00a0/g, " ").trim();
	if (value === "") {
		delete pogojJs[name];
	} else {
		pogojJs[name] = value;
	}
	const skriti = document.getElementById("pogojSkriti");
	skriti.innerHTML = "";
	if (Object.keys(pogojJs).length > 0) {
		// vrednost nastavimo prek DOM, da presledki in narekovaji ne pokvarijo pogoja
		const polje = document.createElement("input");
		polje.type = "hidden";
		polje.name = "pogoj";
		polje.value = JSON.stringify(pogojJs);
		skriti.appendChild(polje);
	}
}//od pogojFunction