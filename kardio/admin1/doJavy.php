<!doctype html>
<html>
<body>
<?php
$php_var1 ="Hello world";
echo $php_var1;
$php_var2 ="Jiří";
echo $php_var2;
echo json_encode($php_var1, JSON_UNESCAPED_UNICODE);
echo '<br>'.json_encode($php_var2, JSON_UNESCAPED_UNICODE);

echo '<script>';
echo 'var js_variable1= ' . json_encode($php_var1, JSON_UNESCAPED_UNICODE) . ';';
echo 'var js_variable2= ' . json_encode($php_var2, JSON_UNESCAPED_UNICODE) . ';';
echo '</script>';
?>
<p> naj bi se pokazalo okno alert</p>

<script>
//alert("poskus");
alert("variabla a1:" + js_variable1);
alert("variabla a2:" + js_variable2);
</script>
</body>
</html>