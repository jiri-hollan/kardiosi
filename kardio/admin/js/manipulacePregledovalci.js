function izborFunction(akce) {
  document.getElementById("akceId").value = akce;
switch(akce) {
  case "vyber":
	document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit">'; //submit
    break; 

  case "vloz":
  
    status= '<input type="int" id="statusId" name="status" value="" placeholder="status" required>';
    ime= '<input type="text" id="imeId" name="ime" value="" placeholder="ime" required>';
    priimek= '<input type="text" id="priimekId" name="priimek" value="" placeholder="priimek" required>';
	email= '<input type="text" id="emailId" name="email" value="" placeholder="email" required>';
    uname= '<input type="text" id="unameId" name="uname" value="" placeholder="Uporabniško ime" required>';	
	
    geslo= '<input type="text" id="gesloId" name="geslo" value="" placeholder="Geslo" required>';


    document.getElementById("demo").innerHTML = status + ime + priimek + email + uname + geslo; 
	document.getElementById("posli").innerHTML = '<input type="submit" name="submit" value="Submit"><input type="reset" name="reset" value="Reset">'; //submit+reset
    break;

  case "uredi":
  //alert("v JS case edit");
  if(document.getElementById("osebe")!=null){
 document.getElementById("osebe").addEventListener("click", functionOver);
}

    break;

  case "odstrani":

  
  if ( confirm("v funkciji JS odstrani\odstranim en zapis?") == true) {
    if(document.getElementById("osebe")!=null){
    document.getElementById("osebe").addEventListener("click", functionOver);
      }
} else {
  text = "You canceled!";
}
  
  
 /* if(document.getElementById("osebe")!=null){
 document.getElementById("osebe").addEventListener("click", functionOver);
 
}*/

    // code block

    break;	
  default:
    // code block
 }//od switch
} // od izborFunction
//----------------------------------------------------------------------------------------
function functionOver (e) {
var x = e.target;
if (x.nodeName == "TD") {
var y = event.composedPath()[1];
row_value = y.cells[0].innerHTML;
 /* document.getElementById("demo1").innerHTML = "Triggered by a " + x.nodeName + " element";
  document.getElementById("demo2").innerHTML = "Triggered by a " + x.innerHTML + " element";  */
  document.getElementById("demo3").innerHTML = "id v bazi je= " + row_value ;  
 }//od if
 
 window.location.href = "manipulacePregledovalci.php?akce=" + x.innerHTML + "&id=" + row_value;
  
}//od function(e)