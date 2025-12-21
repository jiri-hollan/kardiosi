<body>
<h1><form action="upload.php" method="post" enctype="multipart/form-data">
<label for="meseci">Izberi mesec:</label>
  <select id="meseci" name="meseci" required>
    <option value=""></option>
    <option value="januar.pdf">Januar</option>
    <option value="februar.pdf">Februar</option>
    <option value="marec.pdf">Marec</option>
	<option value="april.pdf">April</option>
    <option value="maj.pdf">Maj</option>
    <option value="junij.pdf">Junij</option>
    <option value="julij.pdf">Julij</option>
    <option value="avgust.pdf">Avgust</option>
    <option value="september.pdf">September</option>	
	<option value="oktober.pdf">Oktober</option>
    <option value="november.pdf">November</option>
    <option value="december.pdf">December</option>	
  </select>
  <br>Izberi pdf za naložiti:
  <input type="file" name="fileToUpload" id="fileToUpload" required><br>
  <input type="radio" id="zamenjaj" name="obstojeca" value=1>
  <label for="zamenjaj">Zamenjaj</label><br>
  <input type="radio" id="pusti" name="obstojeca" value=0>
  <label for="pusti">Pusti obstoječo</label><br>
  <input type="submit" value="Naloži mesečni razpis" name="submit">
</form></h1>
</body>
