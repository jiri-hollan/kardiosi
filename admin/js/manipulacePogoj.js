//let tabulka="uporabnikiTbl";
let tabulka_global;
//alert('definicija tabulke:  '+tabulka_global);
function izborFunction(akce, tabulka) {
//console.log(tabulka);
 tabulka_global=tabulka; 
	//alert(tabulka);
	let  zaUrejat = [];
	let vnosi= "";
  document.getElementById("akceId").value = akce;
switch(akce) {
	case "vyber":
//alert(tabulka);
	switch(tabulka) {
		case "uporabnikiTbl":
//alert(tabulka);
			zaUrejat = ["email", "uname", "geslo", "bolnisnica", "ime", "priimek", "upstatus", "pristop", "gdpr", "stevilkaZdravnika"];			
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
		break;			
		default:
			console.log(tabulka);		
			console.log('za to tabuku ni še napisana koda');
		}
	for (let i = 0; i < zaUrejat.length; i++) {
	vnosi += '<input type=\"text\" id=\"'+zaUrejat[i]+'Id\"  name=\"'+zaUrejat[i]+'\" value=\"\" placeholder=\"'+zaUrejat[i]+'\" required>' ;	
	}
		document.getElementById("tabSent").innerHTML = '<input type="hidden" name="tabulka" value="'+tabulka+'">';
		document.getElementById("urejatSent").innerHTML =  '<input type="hidden" name="zaUrejat" value="'+zaUrejat+'">';		
		document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi">'; //submit
    break; 

    case "vloz":
		switch(tabulka) {
		case "uporabnikiTbl":
//alert(tabulka);
			zaUrejat = ["email", "uname", "geslo", "bolnisnica", "ime", "priimek", "upstatus", "pristop", "gdpr", "stevilkaZdravnika"];			
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
		break;			
		default:
			console.log(tabulka);		
			console.log('za to tabuku ni še napisana koda');
		}
	for (let i = 0; i < zaUrejat.length; i++) {
	vnosi += '<input type=\"text\" id=\"'+zaUrejat[i]+'Id\"  name=\"'+zaUrejat[i]+'\" value=\"\" placeholder=\"'+zaUrejat[i]+'\" required>' ;	
	}
	document.getElementById("demo").innerHTML = vnosi;			
	document.getElementById("tabSent").innerHTML =  '<input type="hidden" name="tabulka" value="'+tabulka+'">';
	document.getElementById("urejatSent").innerHTML =  '<input type="hidden" name="zaUrejat" value="'+zaUrejat+'">';	
	document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi"><input type="reset" name="reset" value="Reset">'; //submit+reset					
    break;

	case "edit":
//alert("v JS case edit");
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
var x = e.target;
//alert(tabulka_global);
	//alert("functionOver");
if (x.nodeName == "TD") {
var y = event.composedPath()[1];
row_value = y.cells[0].innerHTML;
  document.getElementById("demo3").innerHTML = "id v bazi je= " + row_value ;  
 }//od if 
  window.location.href = "manipulacePogojUniverzal.php?akce=" + x.innerHTML + "&id=" + row_value + "&tabulka="+ tabulka_global; 
}//od function(e)