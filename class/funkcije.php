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


}



?>