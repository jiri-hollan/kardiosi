<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="js/razpis.js?<?php echo time(); ?>" type="text/javascript"></script>
 <style type="text/css">


  body {background-color: blue}
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
  <form class="pos_abs">
    <strong>LETNIK:</strong> <input type="year" id="letnikx" value="" size="1" maxlength="4" /> <input type="button" id="button1" onclick="aktualRazpis()" value="potrdi!" />
  </form>
</body>
</html>
