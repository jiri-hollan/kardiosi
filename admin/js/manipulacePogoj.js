let tabulka_global;
//alert('definicija tabulke:  '+tabulka_global);
function izborFunction(akce, tabulka,bolList) {
//console.log(tabulka);
	tabulka_global=tabulka; 
//alert(tabulka);
	let zaUrejat = [];
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
		if(zaPogoj=="bolnisnica"){
	    document.getElementById("demo").innerHTML = '<input id="bolnisnicaId" list="bolnisnice" name="bolnisnica" value="" placeholder="Bolnišnica" onkeyup="pogojFunction(name, value)" autocomplete="off"><datalist id="bolnisnice"><option value="izbrana bolnisnica"> </datalist>';

		for (i = 0; i < bolList.length; i++) {
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
	let y = event.composedPath()[1];
	row_value = y.cells[0].innerHTML;
	document.getElementById("demo3").innerHTML = "id v bazi je= " + row_value ;  
	}//od if 
  window.location.href = "manipulacePogojUniverzal.php?akce=" + x.innerHTML + "&id=" + row_value + "&tabulka="+ tabulka_global; 
}//od function(e)

//------------------------------------------------------------------------------------------
function pogojFunction(name, value){
	let pogojJs ={};
	pogojJs[name] = value;
	console.log(pogojJs);
	const pogoj = JSON.stringify(pogojJs);
	console.log(pogoj);
	
document.getElementById("pogojSkriti").innerHTML = '<input type="hidden" name="pogoj" value='+pogoj+'>';
}//od pogojFunction