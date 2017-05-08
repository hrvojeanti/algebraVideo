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
		echo 'tu sam'
		$sql = 'INSERT INTO filmovi(`naslov`, `id_zanr`, `godina`, `trajanje`, `slika`) VALUES(
																:naslov, :id_zanr, :godina, :trajanje, :slika )';
		$ubaci = $conn->prepare($sql);
		$ubaci->bindParam(':naslov', $_POST['naslov']);
		$ubaci->bindParam(':id_zanr', $_POST['zanr']);
		$ubaci->bindParam(':godina', $_POST['godina']);
		$ubaci->bindParam(':trajanje', $_POST['trajanje']);
		$ubaci->bindParam(':slika', $_POST['slika']);
		$ubaci->execute();
	}
}



?>