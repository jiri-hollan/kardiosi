var x=""
var y=""
function letorazpis()


{
x=(document.getElementById("letnikx").value);
if (x!="")

{
window.location="razpis/openofice/" + x +".ods";

}
else
{
alert("Vpisi iskano letnico");

//window.location="skrita1.htm";
}
}

