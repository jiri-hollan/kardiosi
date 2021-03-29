var x=""
var y=""
function letorazpis()


{
x=(document.getElementById("letnikx").value);


if (x!="")

{

 window.location="razpis/msofice/" + x +".xls";


}
else
{
alert("Vpisi iskano letnico ");

//window.location="skrita1.htm";
}
}

