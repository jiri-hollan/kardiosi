<?php require_once('vkladane/zahlavi.php');?>
<button onclick="schovej('id01')"style="width:auto;">Sign Up</button>
<button onclick="schovej('id02')" style="width:auto;">Login</button>
<div id="id01" class="modal">
<!-- ---------------------------------Registracija--------------->  
  <form class="modal-content animate" autocomplete="off" action="<?php echo $_SERVER['PHP_SELF'] . '?r=singin'?>" method="post">
    <div class="container">
      <h1>Registracija</h1>
      <label for="ime"><b>Ime in priimek</b></label><br>
	  <span>
      <input type="text" class="imePriimek" placeholder=" Ime" name="ime" required>	  
      <input type="text" class="imePriimek" placeholder="Priimek" name="priimek" required><br>	  
	  </span>
	  <label for="email"><b>email</b></label>
      <input type="text" placeholder=" Email je potreben" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ni veljaven email naslov" required>
      <label for="uname"><b>uname</b></label>
      <input type="text" placeholder=" Uporabniško ime" name="uname" autocomplete="off" required>
      <label for="geslo"><b>Geslo</b></label>
      <input type="password" placeholder="geslo" name="geslo" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Mora vsebovati vsaj številke in male črke skupaj najmanj 8 znakov" required>
      <label for="psw-repeat"><b>Ponovi geslo</b></label>
      <input type="password" placeholder="Ponovi geslo" name="psw-repeat" autocomplete="off" required>
      <button type="submit" class="signupbtn">Sign Up</button>    
    </div>
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
  </form>
</div>
<!-- ___________________________   Prijava       ___________________________________________-->
<div id="id02" class="modal"> 
  <form class="modal-content animate" action="<?php echo $_SERVER['PHP_SELF'] . '?r=login'?>" method="post" autocomplete="off">
    <div class="container">
      <label for="uname"><b>Uporabniško ime</b></label>
      <input type="text" placeholder="Enter Username" name="uname" autocomplete="off" required>
      <label for="geslo"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="geslo" autocomplete="off" required>       
      <button type="submit" class="signupbtn" >Login</button>
    </div>
      <div class="clearfix">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
    </div>   
  </form>
</div>
<?php require_once('vkladane/zapati.php'); ?>