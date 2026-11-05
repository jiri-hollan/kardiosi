
<!-- ---------------------------------Registracija------------------------------------------------------- --> 
<div id="id01" class="modal">
  <form class="modal-content animate" autocomplete="off" action="<?php echo $_SERVER['PHP_SELF'] . '?r=singin'?>" method="post" autocomplete="off">
    <div class="container">
      <h1>Registracija</h1>
      <label for="bolnisnicaId"><b>Bolnisnica</b></label><br>

<select id="bolnisnicaId"  class="imePriimek" placeholder=" Bolnisnica" name="bolnisnica" required><br>
  <option value=""></option>
  <option value="Izola">Izola</option>
  <option value="Jesenice">Jesenice</option>
  <option value="UKCL">UKC Ljubljana</option>
</select>

 <script>
 seznamBolnisnicFunction(bolList );
  </script>


 	  <br>
      <input type="text" class="imePriimek" placeholder=" Ime" name="ime" required>	  
      <input type="text" class="imePriimek" placeholder="Priimek" name="priimek" required>  
      <input type="text" class="imePriimek" placeholder="št. zdravnika" name="stevilkaZdravnika" >
      <!--<label for="emailId"><b>email</b></label>-->
      <input id="emailId" type="text"  class="imePriimek"  placeholder=" Email je potreben" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ni veljaven email naslov"  autocomplete="off" required><br>

      <label for="unameId"><b>uname</b></label>
      <input id="unameId" type="text" placeholder=" Uporabniško ime" name="uname" autocomplete="off" required><br>

      <label for="gesloId"><b>Geslo</b></label>
      <input id="gesloId" type="password" placeholder="geslo" name="geslo" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Mora vsebovati vsaj številke in male črke skupaj najmanj 8 znakov" required><br>

      <label for="pswRepeatId"><b>Ponovi geslo</b></label>
      <input id="pswRepeatId" type="password" placeholder="Ponovi geslo" name="psw-repeat" autocomplete="off" required><br>
      <button type="submit" class="signupbtn">Sign Up</button>    
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
    </div>
 

  </form>
</div>



<!-- ___________________________   Prijava       ___________________________________________-->
<div id="id02" class="modal">
  
  <form class="modal-content animate" action="<?php echo $_SERVER['PHP_SELF'] . '?r=login'?>" method="post" autocomplete="off">
    

    <div class="container">
      <label for="uname1Id"><b>Uporabniško ime</b></label>
      <input id="uname1Id" type="text" placeholder="Enter Username" name="uname" autocomplete="off" required>

      <label for="geslo1Id"><b>Password</b></label>
      <input id="geslo1Id" type="password" placeholder="Enter Password" name="geslo" autocomplete="off" required>
        
      <button type="submit" class="signupbtn" >Login</button>
 <!--     <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>-->
	      <div class="clearfix">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
   <!--   <span class="psw">Forgot <a href="#">password?</a></span>-->
    </div>     
    </div>



  </form>
</div>

<!-- ___________________________   Pozabljeno geslo   ___________________________________________-->
<div id="id03" class="modal">
  <form class="modal-content animate" action="<?php echo $_SERVER['PHP_SELF'] . '?r=pozabljeno'?>" method="post" autocomplete="off">
    <div class="container">
      <h1>Pozabljeno geslo</h1>
      <p>Vpišite e-poštni naslov, s katerim ste se registrirali.<br>Administrator vam bo poslal novo geslo.</p>
      <label for="email3Id"><b>Email</b></label>
      <input id="email3Id" type="email" class="imePriimek" placeholder=" Email" name="email" maxlength="255" required><br>
      <button type="submit" class="signupbtn">Pošlji zahtevo</button>
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
    </div>
  </form>
</div>

<?php require_once('vkladane/zapati.php'); ?>