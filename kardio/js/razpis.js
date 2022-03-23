//var x=""
//var y=""
function aktualRazpis(){
  var x=""
  x=(document.getElementById("letnikx").value);
if (x!=""){
 window.location="razpis/msofice/" + x +".xlsx";//zdaj je window.location="skrita1.htm"
  } else {
 alert("Vpisi iskano letnico ");
  }
}//od function aktualRazpis


//var x=""
//var y=""
function arhivRazpis() {
  var x=""
  x=(document.getElementById("letnikx").value);
if (x=="") {
   alert("Vpisi iskano letnico");
  } else {
	  oo="razpis/msBackup/arhiv/" + x +".ods";
	  ms="razpis/msBackup/arhiv/" + x +".xlsx";
try{
window.location=ms;
}
catch{
alert("to je catch");
}


  
	  
	  //zdaj je window.location="skrita1.htm"

}
} //od function arhivRazpis