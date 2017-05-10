<?php

require 'includes/header.php';
require 'funkcije.php';
require 'functions/dataLogin.php';


if( !isset($_SESSION['user_id']) )
{
?>
	<div class="container">
	<h4>Moras biti logiran da bi unosio podatake, <a href="login.php">logiraj se</a></h4>
	</div>
<?php
	die();
}

if( isset($_POST['naslov'])) {

		Funkcije::input_filmovi();


		$target = "images/".basename($_FILES['slika']['name']);
		if( move_uploaded_file($_FILES['slika']['tmp_name'], $target)) 
		{
			$msg = "Image uploaded successfully";
		}
		else
		{
			$msg = "There was a problem uploading image";
		}


}


if( isset($_POST['unos_zanr']))
{
	Funkcije::dodaj_zanr();
}

?>

<div class="container">
	<h4>Dodaj film:</h4>
	<form method="POST" action="" enctype="multipart/form-data">
		<div class="form-group">
			<label for="naslov">Naslov:</label>
			<input type="text" class="form-control" value="upisite naslov" name="naslov" /><br/>

			<label for="zanr">Žanr:</label>
			<select class="form-control" name='zanr'>
				<?php // zanrove stalvjamo u padajuci izbornik
					$broj = 1;
					foreach(Funkcije::fetch_zanr() as $zanr) 
					{
						echo '<option value=' . $broj . '>' . $zanr['naziv'] . '</option>';
						$broj++;

					}
				?>
			</select><br/>

			<label for="zanr">Godina:</label>
			<select class="form-control" name='godina'>
				<?php  // godinu stalvjamo u padajuci izbornik
					for($i=2017; $i>=1900; $i--) 
					{
						echo '<option value=' . $i .'>' .$i . '</option>';
					}
				?>
			</select><br/>

			<label for="trajanje">Trajanje:</label>
			<input type="number" class="form-control" name="trajanje" min="1" max="999" /><br/><br/>

			<label for="exampleInputFile">Dodaj sliku:</label>
    	<input type="file" class="form-control-file" name="slika"><br/>

			<button type="submit" class="btn btn-primary">Dodaj film</button>		
		</div>
		
	</form>
</div>
			
<br/>	
<br/>


<div class="container">
	<h4>Dodaj jos zanrova:</h4>
	<form id="form_zanr" action="" method="POST">
		<div class="form-group">
			<input type="text" class="form-control" name="unos_zanr" />
			<br/>

			<button type="submit" class="btn btn-primary">Dodaj zanr</button>
		</div>
	</form>
</div>

