<?php

require 'includes/header.php';
require 'funkcije.php';



?>
<div class="container">
	<form>
		<div class="form-group">
			<label for="naslov">Naslov</label>
			<input type="text" class="form-control" value="upisite naslov" name="naslov" /><br/>

			<label for="zanr">Žanr:</label>
			<select class="form-control" name='zanr'>
				<?php  // zanrove stalvjamo u padajuci izbornik
					foreach(Funkcije::fetch_zanr() as $zanr) 
					{
						echo '<option>' . $zanr['naziv'] . '</option>';
					}
				?>
			</select><br/>

			<label for="godina">Godina:</label>
			<input type="number" class="form-control" name="godina" min="1900" max="2017"/><br/>

			<label for="trajanje">Trajanje</label>
			<input type="number" class="form-control" name="trajanje" min="1" max="999" /><br/><br/>

			<label for="exampleInputFile">File input</label>
    	<input type="file" class="form-control-file" name="slika"><br/>

			<button type="submit" class="btn btn-primary">Submit</button>		
		</div>
		
	</form>
</div>