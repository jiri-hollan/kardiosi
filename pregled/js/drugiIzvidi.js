//........drugi izvidi...................................................................................
function drugiIzvidiFunction() {
let text = "";
let i;
let lab = document.getElementById("stolpec3").getElementsByTagName("label");
let vred =document.getElementById("stolpec3").getElementsByTagName("textarea"); 
for (i = 0; i < lab.length; i++)   
if (vred[i].value.length > 0) {
   text += lab[i].innerHTML + vred[i].value + "," + "&nbsp" + " ";
   //alert (text);
   }
 document.getElementById("drugiIzvidi").value = text;  
}