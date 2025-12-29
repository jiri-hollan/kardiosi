//var x=""
//var y=""
function aktualRazpis(){
  var x=""
  x=(document.getElementById("letnikx").value);
if (x!=""){
 window.location="../kardio/razpis/msofice/" + x +".xlsx";//zdaj je window.location="biznis.php"
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
	  oo="../kardio/razpis/msBackup/arhiv/" + x +".ods";
	  ms="../kardio/razpis/msBackup/arhiv/" + x +".xlsx";
	  window.location=ms;
  
	  
	  //zdaj je window.location="biznis.php"

}
} //od function arhivRazpis