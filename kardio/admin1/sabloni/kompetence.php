<h2>kompetence uporabnikov</h2>
<button onclick="izborFunction('vyber')">izberi</button>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <input type="hidden" id="akceId" name="akce" value="">
 <input type="hidden" id="nazaj" name="nazaj" value="<?php echo $nazaj;?>">
 <p id="demo"></p>
 <p id="posli"></p><!--submit prek JS -->
</form>
 <br>
<p id="demo3"></p>