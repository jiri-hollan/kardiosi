<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8_general_ci"/>
  <script src="js/biznis.js?v=<?=time();?>" type="text/javascript">
  </script>
 
 <style type="text/css">


  body {background-color: black}
  form {color: Gainsboro}
  form {font-size:300%}
  input {color: Gainsboro}
  input {font-size:100%}
  input {background-color: black}

  form.pos_abs
  {
  position:absolute;
  left:200px;
  top:300px
  }



  </style>

  <title></title>
</head>

<body>
  <form class="pos_abs" action="geslobiznis()">
    <strong>GESLO:</strong> <input type="password" id="password1" value="" size="6" maxlength="8" /> <input type="button" id="button1" onclick="geslobiznis()" value="potrdi!" />
  </form>
</body>
</html>
