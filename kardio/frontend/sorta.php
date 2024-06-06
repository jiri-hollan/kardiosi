<?php
require_once('sabloni/zahlaviSkupne.php');
?>
</head>
<body id="sorta">
<script>
var skupina = "ČLANI";
var b ="";
b += "<p>";
b += "<a class='zdrav' ";
b += "href='javascript: showZDR(";
b += '"../servis/poskusArrayZdravniki.php?pogoj=2")';
b += "' > ";
b += skupina;
b += "</a>";
b +=  "</p>";
document.write(b);

var skupina = "PRIDRUŽENI";
var b ="";
b += "<p>";
b += "<a class='zdrav' ";
b += "href='javascript: showZDR(";
b += '"../servis/poskusArrayZdravniki.php?pogoj=1")';
b += "' > ";
b += skupina;
b += "</a>";
b +=  "</p>";
document.write(b);
</script>

</body>
</html>
