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

		$sql = 'INSERT INTO filmovi(`naslov`, `id_zanr`, `godina`, `trajanje`, `slika`) VALUES(
																:naslov, :id_zanr, :godina, :trajanje, :slika )';
		$ubaci = $conn->prepare($sql);

		$ubaci->bindParam(':naslov', $_POST['naslov']);
		$ubaci->bindParam(':id_zanr', $_POST['zanr']);
		$ubaci->bindParam(':godina', $_POST['godina']);
		$ubaci->bindParam(':trajanje', $_POST['trajanje']);
		$ubaci->bindParam(':slika', $_FILES['slika']['name']);
		$ubaci->execute();


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

?>

<div class="container">
	<form method="POST" action="" enctype="multipart/form-data">
		<div class="form-group">
			<label for="naslov">Naslov</label>
			<input type="text" class="form-control" value="upisite naslov" name="naslov" /><br/>

			<label for="zanr">Žanr:</label>
			<select class="form-control" name='zanr'>
				<?php  // zanrove stalvjamo u padajuci izbornik
					foreach(Funkcije::fetch_zanr() as $zanr) 
					{
						echo '<option value=1>' . $zanr['naziv'] . '</option>';
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