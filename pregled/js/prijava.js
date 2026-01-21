
function zdravnikFunction() {  
// Check browser support
if (typeof(Storage) !== "undefined") {
// Store
  let imeZdravnika = document.getElementById("zdravnik").value || "" ;
    //let str = document.getElementById("demo").innerHTML; 
 imeZdravnika = imeZdravnika.replace(/ /g, "&nbsp;");
   
   
   localStorage.setItem("imeZdravnika", imeZdravnika);
// Retrieve
   document.getElementById("pregledovalec").innerHTML = "izvajalec:  "+"<b>" + localStorage.getItem("imeZdravnika")+"</b>";
     } else {
     document.getElementById("pregledovalec").innerHTML = "oprostite, vaš brskalnik ne podpira Web Storage" + "<br>" + "uporabite Google Chrom";
    }
  }
//_______________________________________________
function sbFunction(bol="") {
//alert(seznamBolnisnicJson);
       if(bol=="spomin") {
	location.href='../pregled/zdravnik.php?aktivnaBolnisnica='+localStorage.getItem("mestoBolnisnice");return false;
      } else if (!bol=="") {
// alert(seznamBolnisnicJson);
//naredi array bolnišnic
		 bolnisnica=seznamBol; 
		 bol = document.getElementById("bolnisnica").value || "" ;
         localStorage.setItem("aktivnaBolnisnica",bolnisnica[bol]);
         localStorage.setItem("mestoBolnisnice",bol);
//alert(bolnisnica[bol]);		 
//alert(bazeBolnisniceJson);		 
//alert ("Formular za S.B. Izola");
	location.href='zdravnik.php?aktivnaBolnisnica='+localStorage.getItem("mestoBolnisnice");return false; 
      } else {
//alert ("nobena bolnišnica ni aktivirana");	
      }
   }
//____________________________________________
function naprejFunction() { 
 if (localStorage.getItem("imeZdravnika").length < 3) {
    alert("zdravnik ni prijavljen");
    return false;
  } 
	 window.open("bolnik.php", "_self"); 
}
//______________________________________________________
function listaZdravnikovFunction(zdravList) {
//alert ("lista zdravnikov function");
document.getElementById("pregledovalec").innerHTML = "izvajalec:  " +"<b>"+ localStorage.getItem("imeZdravnika")+"</b>";
//alert(localStorage.getItem("imeZdravnika"));
//  koda, ki naredi array zdravList iz tabele pregledovalci	
//alert(zdravList);
 document.getElementById("aktBolnisnica").innerHTML = "<h1>"+localStorage.getItem("mestoBolnisnice")+"</h1> "; 
//alert (localStorage.getItem("aktivnaBolnisnica"));
 if (localStorage.getItem("aktivnaBolnisnica") === ""||localStorage.getItem("aktivnaBolnisnica") ==="undefined") {
    zdravList  =[];
document.getElementById("aktBolnisnica").innerHTML = "<h1 style='color:Tomato;'>Bolnišnica ni določena</h1>"; 	
//alert ("bolnišnica ni določena");
} 
let text = "";
let naslov="&nbsp;dr.med";
let i;
for (i = 0; i < zdravList.length; i++) {
	let povezano = zdravList[i].replace(/ /g, "&nbsp;");
    text += "<option value='" +  povezano + naslov + "'>"  +"<br>";
}
document.getElementById("zdravniki").innerHTML = text;
}
//__________________________________________________________________________________________
function listaBolnisnicFunction(bolList) {
let text = "";
let i;
//alert ("lista bolnisnic function");
document.getElementById("pregledovalec").innerHTML = "izvajalec:  " + localStorage.getItem("imeZdravnika");
// koda, ki naredi array bolList iz tabele bolnisniceTab	
//alert(bolList);

for (i = 0; i < bolList.length; i++) {
  text += "<option value='" +  bolList[i]  + "'>"  +"<br>";
}
document.getElementById("bolnisnice").innerHTML = text;
}
/************************funkcja schovej************************/
function schovej(a){
//alert (a);
	document.getElementById(a).style.display='block';
// Get the modal
	let modal = document.getElementById(a);
// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}//od window.onclick
}//od function schovej