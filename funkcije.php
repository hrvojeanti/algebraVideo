<?php

require 'functions/dataLogin.php';


class Funkcije 
{

	public function fetch_zanr() {
		global $conn;

		$res = $conn->prepare('SELECT naziv FROM zanr');
		$zanrovi = $res->execute();

		return $res->fetchAll();

	}

	public function input_filmovi()
	{
		global $conn;

		$sql_check = 'SELECT naslov FROM filmovi';
		$check = $conn->prepare($sql_check);
		$check->execute();

		$kopija = '';
		foreach($check->fetchAll() as $nas)
		{
			if($nas['naslov'] == $_POST['naslov']) {
				$kopija = 'true';
			}

		}

		if( !$kopija) {
			$sql = 'INSERT INTO filmovi(`naslov`, `id_zanr`, `godina`, `trajanje`, `slika`) VALUES(
																	:naslov, :id_zanr, :godina, :trajanje, :slika )';
			$ubaci = $conn->prepare($sql);
			$ubaci->bindParam(':naslov', $_POST['naslov']);
			$ubaci->bindParam(':id_zanr', $_POST['zanr']);
			$ubaci->bindParam(':godina', $_POST['godina']);
			$ubaci->bindParam(':trajanje', $_POST['trajanje']);
			$ubaci->bindParam(':slika', $_FILES['slika']['name']);
			$ubaci->execute();
		}
	}

	public function dodaj_zanr() {
		global $conn;

		$kopija = '';
		foreach(Funkcije::fetch_zanr() as $zanr) 
		{
			if($zanr['naziv'] == $_POST['unos_zanr'])
			{
				$kopija = 'true';
				break;
			}
		}

		if( !$kopija ) 
		{
			$sql = 'INSERT INTO zanr(naziv) VALUE(:naziv)';
			$res = $conn->prepare($sql);
			$res->bindParam(':naziv', $_POST['unos_zanr']);
			$res->execute();
		}
	}

	public function table_filmovi() 
	{
		global $conn;
		$sql = 'SELECT slika, naslov, godina, trajanje  FROM filmovi';
		$res = $conn->prepare($sql);
		$res->execute();
		if ($res->fetchAll()) {
			echo '
			<br/>
			<br/>
			<br/>

			<table class="table table-responsiv">
			  <thead>
			    <tr>
			      <th>Slika</th>
			      <th>Naslov Filma</th>
			      <th>Godina</th>
			      <th>Trajanje</th>
			      <th>Akcija</th>
			    </tr>
			  </thead>
			  <tbody>
			';
		}
		$res->execute();

		// ubacivanje podataka u tablicu
		foreach($res->fetchAll(PDO::FETCH_ASSOC) as $film) 
		{	
			echo '<tr>';
			foreach($film as $podaci) 
			{
				if( strpos($podaci, '.jpg'))  // ubacujemo sliku ak je jbg
				{
					echo '<td><img src="images/' . $podaci . '" class="img-rounded" alt="'. $podaci . '" width="120" height="180" > ';
					continue;
				}
				echo '<td>' . $podaci . '</td>';

			}
			if (isset($_SESSION['user_id'])) 
			{
				echo '<td><form method="POST" action="">
									<input type="hidden" name="brisi"/>
									<input type="hidden" name="ime_filma" value="' . $film["naslov"] . '"/>
									<button class="btn btn-danger">Brisi</button>
									</form></td>';
			}
			else
			{
				echo '<td><h4>Moras biti logiran da bi mogao brisati,<br/> <a href="login.php">Logiraj se</a></h4></td>';
			}
			echo '</tr>';
		}

	}


}



?>