var tabulka="uporabnikiTbl";
function izborFunction(akce, tabulka) {
	var tabulka=tabulka;
	//alert(tabulka);
  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
  document.getElementById("tabSent").innerHTML = '<input type="hidden" name="tabulka" value="'+tabulka+'">';
  document.getElementById("posli").innerHTML = '<input class="submit" type="submit" name="submit" value="potrdi">'; //submit
    break; 

  case "vloz":

    email= '<input type="text" id="emailId" name="email" value="" placeholder="email" required>';
    uname= '<input type="text" id="unameId" name="uname" value="" placeholder="uname" required>';
    geslo= '<input type="int" id="gesloId" name="geslo" value="" placeholder="geslo" required>';
ime= '<input type="int" id="imeId" name="ime" value="" placeholder="ime" required>';	
priimek= '<input type="int" id="priimekId" name="priimek" value="" placeholder="priimek" required>';
status= '<input type="int" id="statusId" name="status" value="" placeholder="status" required>';
pristop= '<input type="int" id="pristopId" name="pristop" value="" placeholder="pristop" required>';

	
    document.getElementById("demo").innerHTML = email + uname + geslo + ime + priimek + status + pristop;
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
if (x.nodeName == "TD") {
var y = event.composedPath()[1];
row_value = y.cells[0].innerHTML;
  document.getElementById("demo3").innerHTML = "id v bazi je= " + row_value ;  
 }//od if 
  window.location.href = "manipulaceObjektUniverzal.php?akce=" + x.innerHTML + "&id=" + row_value + "&tabulka="+ tabulka; 
}//od function(e)