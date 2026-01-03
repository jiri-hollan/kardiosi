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
  document.getElementById("tabSent").innerHTML = '<input type="hidden" name="tabulka" value="'+tabulka+'">';
  document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi">'; //submit
    break; 

    case "vloz":
	switch(tabulka) {
		case "uporabnikiTbl":
//alert(tabulka);
			zaUrejat = ["email", "uname", "geslo", "bolnisnica", "ime", "priimek", "upstatus", "pristop", "gdpr", "stevilkaZdravnika"];
			vnosi= "";
			for (let i = 0; i < zaUrejat.length; i++) {
			vnosi += zaUrejat[i]+'=<input type=\"text\" id=\"'+zaUrejat[i]+'Id\"  name=\"'+zaUrejat[i]+'\" value=\"\" placeholder=\"'+zaUrejat[i]+'\" required>' ;	
			}

			document.getElementById("demo").innerHTML = vnosi;
			document.getElementById("tabSent").innerHTML =  '<input type="hidden" name="tabulka" value="'+tabulka+'">';
			document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi"><input type="reset" name="reset" value="Reset">'; //submit+reset
		break;
		case "statusiTbl":
//alert(tabulka);	
			zaUrejat = ["status", "pomen",];
			vnosi= "";
			for (let i = 0; i < zaUrejat.length; i++) {
			vnosi += zaUrejat[i]+'=<input type=\"text\" id=\"'+zaUrejat[i]+'Id\"  name=\"'+zaUrejat[i]+'\" value=\"\" placeholder=\"'+zaUrejat[i]+'\" required>' ;	
			}
			document.getElementById("demo").innerHTML = vnosi;			
			document.getElementById("tabSent").innerHTML =  '<input type="hidden" name="tabulka" value="'+tabulka+'">';
			document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi"><input type="reset" name="reset" value="Reset">'; //submit+reset		
		break;
		case "bolnisniceTbl":
//alert(tabulka);	
			zaUrejat = ["mesto", "nazivB", "bolnisnicaStatus"];
			vnosi= "";
			for (let i = 0; i < zaUrejat.length; i++) {
			vnosi += zaUrejat[i]+'=<input type=\"text\" id=\"'+zaUrejat[i]+'Id\"  name=\"'+zaUrejat[i]+'\" value=\"\" placeholder=\"'+zaUrejat[i]+'\" required>' ;	
			}

			document.getElementById("demo").innerHTML = vnosi;	
			document.getElementById("tabSent").innerHTML =  '<input type="hidden" name="tabulka" value="'+tabulka+'">';
			document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi"><input type="reset" name="reset" value="Reset">'; //submit+reset		
		break;
		case "limitiTbl":
//"bolnisnica", "skupina", "ime", "min", "max"
//console.log(tabulka);		
			zaUrejat = ["bolnisnica", "skupina", "ime", "min", "max"];
			vnosi= "";
			for (let i = 0; i < zaUrejat.length; i++) {
			vnosi += zaUrejat[i]+'<input type=\"text\" id=\"'+zaUrejat[i]+'Id\"  name=\"'+zaUrejat[i]+'\" value=\"\" placeholder=\"'+zaUrejat[i]+'\" required>' ;	
			}

//console.log('za to tabuku ni še napisana koda');
		break;			
		default:
			console.log(tabulka);		
			console.log('za to tabuku ni še napisana koda');
	}
	
			document.getElementById("demo").innerHTML = vnosi;			
			document.getElementById("tabSent").innerHTML =  '<input type="hidden" name="tabulka" value="'+tabulka+'">';
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