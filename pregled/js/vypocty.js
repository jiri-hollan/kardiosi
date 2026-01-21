//------------------------otroška premedikacija vklop------------------------

function otroskaVklopFunction(){
    let teza = document. getElementById('teza').value;
//alert(teza);
		if (teza!=0&&teza<45){
			          document.getElementById('premedikacija').innerHTML='<b class="otroska" onclick="otroskaFunction(teza)">premedikacija otroka</b>';
		  }else{document.getElementById('premedikacija').innerHTML='Premedikacija';
		  }
		  return;
}

//------------------------------BMI-----------------------------------------
let visina;
let teza;
let BMI;

function bmiFunction()
{
    teza = document. getElementById('teza').value;
    visina = document. getElementById('visina').value;

    teza = validacija(teza);
    visina = validacija(visina);

    document.getElementById('teza').value = teza;
	if (visina>3){
		visina="";
		alert("Visina mora biti navedena v metrih!");
	}else{
          document.getElementById('visina').value = visina;
         }
     //window.alert ("1teža" + teza);
     //window.alert ("1višina" + visina);
    if (visina!=0 && teza!=0) {
        //window.alert ("2teža" + teza);
        //window.alert ("2višina" + visina);
        BMI = Math.round(teza/(visina*visina));
        //window.alert ("BMI= " + BMI);
        document.getElementById('bmi').value=BMI;
		otroskaVklopFunction();
    } else {
        // window.alert ("BMI2= " + BMI);
        document.getElementById('bmi').value="";
    }
}



function validacija(input) {
    if (input < 0) {
        return 0;
    }

    if (input == "NaN") {
        return 0;
    }

    return input.replace(",", ".");
}

//----------------------------konec BMI--------------------------------------------

  //................ Izračun starosti.............
  

  let dateParts;
  let starost;

 function starostFunction()
 {
let dan = document.getElementById("dan").value ;
let mesec = document.getElementById("mesec").value ;
let leto =  document.getElementById("leto").value ;
if(dan*mesec*leto >0){

 datRojstva = dan + "." + mesec + "." + leto;
   dateParts = datRojstva.split(".");  

/*  datRojstva = document.getElementById("dan").value ;
  datRojstva = datRojstva + "." + document.getElementById("mesec").value ;
  datRojstva = datRojstva + "." +  document.getElementById("leto").value ;*/


  // dateParts = datRojstva.split(".");  
//alert (dateParts);

//............ month is 0-based, that's why we need dataParts[1] - 1  roj = dateObject.......
 document.getElementById("datRojstva").value = leto + "-" + mesec + "-" + dan; 
  let roj =  new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]); 
//alert (datRojstva);
  let d1 = Date.parse(roj);
  let d2 = Date.parse(Date());
  let d3 = d2 - d1;
  let n = 1000*60*60*24*365.25;
// window.alert ("n= " + n);
   starost = ~~(d3 / n);
 //window.alert (starost);
  document.getElementById("starost").value = starost; 
}
}
//---------------------------konec izračuna starosti---------------