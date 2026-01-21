function listaSklepovFunction(sklepList) {
let text = "";
let i;	
//alert ("lista Sklepov function");
console.log("sklepi.js");

for (i = 0; i < sklepList.length; i++) {
  text += "<option value='" +  sklepList[i] + "'>"  +"<br>";
}
//console.log(text);
document.getElementById("sklepi").innerHTML = text;
}