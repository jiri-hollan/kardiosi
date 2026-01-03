//let tabulka="uporabnikiTbl";
let tabulka_global;
//alert('definicija tabulke:  '+tabulka_global);
function izborFunction(akce, tabulka) {
//console.log(tabulka);
 tabulka_global=tabulka; 
	//alert(tabulka);
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
			const zaUrejat = ["email", "uname", "geslo", "bolnisnica", "ime", "priimek", "upstatus", "pristop", "gdpr", "stevilkaZdravnika"];
			email= '<input type="text" id="emailId" name="email" value="" placeholder="email" required>';
			uname= '<input type="text" id="unameId" name="uname" value="" placeholder="uname" >';
			geslo= '<input type="int" id="gesloId" name="geslo" value="" placeholder="geslo" >';
			bolnisnica= '<input type="int" id="bolnisnicaId" name="bolnisnica" value="" placeholder="bolnisnica" >';			
			ime= '<input type="int" id="imeId" name="ime" value="" placeholder="ime" required>';	
			priimek= '<input type="int" id="priimekId" name="priimek" value="" placeholder="priimek" required>';
			upstatus= '<input type="int" id="statusId" name="upstatus" value="" placeholder="upstatus" required>';
			pristop= '<input type="int" id="pristopId" name="pristop" value="" placeholder="pristop" >';
			gdpr= '<input type="int" id="gdprId" name="gdpr" value="" placeholder="gdpr" >';
			stevilkaZdravnika= '<input type="int" id="stevilkaZdravnikaId" name="stevilkaZdravnika" value="" placeholder="stevilkaZdravnika" >';			
			document.getElementById("demo").innerHTML = email + uname + geslo + bolnisnica +ime + priimek + upstatus + pristop+gdpr+stevilkaZdravnika;
			document.getElementById("tabSent").innerHTML =  '<input type="hidden" name="tabulka" value="'+tabulka+'">';
			document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi"><input type="reset" name="reset" value="Reset">'; //submit+reset
		break;
		case "statusiTbl":
//alert(tabulka);	
			status= '<input type="text" id="statusId" name="status" value="" placeholder="status" required>';
			pomen= '<input type="text" id="pomenId" name="pomen" value="" placeholder="pomen" >';    
			document.getElementById("demo").innerHTML =  status + pomen;	
			document.getElementById("tabSent").innerHTML =  '<input type="hidden" name="tabulka" value="'+tabulka+'">';
			document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi"><input type="reset" name="reset" value="Reset">'; //submit+reset		
		break;
		case "bolnisniceTbl":
//alert(tabulka);	
			mesto= '<input type="text" id="mestoId" name="mesto" value="" placeholder="mesto" required>';
			nazivB= '<input type="text" id="nazivBId" name="nazivB" value="" placeholder="nazivB" >';    
			bolnisnicaStatus= '<input type="text" id="statusBId" name="bolnisnicaStatus" value="" placeholder="bolnisnicaStatus" >'; 	 
			document.getElementById("demo").innerHTML = mesto+nazivB+bolnisnicaStatus;		
			document.getElementById("tabSent").innerHTML =  '<input type="hidden" name="tabulka" value="'+tabulka+'">';
			document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi"><input type="reset" name="reset" value="Reset">'; //submit+reset		
		break;
		case "limitiTbl":
//"bolnisnica", "skupina", "ime", "min", "max"
//console.log(tabulka);
			bolnisnica= '<input type="text" id="bolnisnicaId" name="bolnisnica" value="" placeholder="bolnisnica" required>';			
			skupina= '<input type="text" id="skupinaId" name="skupina" value="" placeholder="skupina" required>';
			ime= '<input type="text" id="imeId" name="ime" value="" placeholder="ime" required>';
			min= '<input type="text" id="minId" name="min" value="" placeholder="min" required>';
			max= '<input type="text" id="maxId" name="max" value="" placeholder="max" required>';
			document.getElementById("demo").innerHTML = bolnisnica+skupina+ime+min+max;		
			document.getElementById("tabSent").innerHTML =  '<input type="hidden" name="tabulka" value="'+tabulka+'">';
			document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi"><input type="reset" name="reset" value="Reset">'; //submit+reset					
//console.log('za to tabuku ni še napisana koda');
		break;			
		default:
			console.log(tabulka);		
			console.log('za to tabuku ni še napisana koda');
	}
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