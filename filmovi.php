<?php

require 'includes/header.php';
require 'funkcije.php';
require 'functions/dataLogin.php';

$letter = 'A';
?>

<br/>
<div class='container' id='slova'>

<?php  // slova po abecednom redu, za trazenje filmova
echo '<span> | <a href="filmovi.php">SVI | </a></span>';
for($i=1; $i<=26; $i++)
{
	echo "<span><a href='?s=" . $letter .  "'>" . $letter . "</a> | </span> ";
	$letter++;
}





if ( isset($_GET['s']))
{
	$slovo = $_GET['s'] . '%';
				
	$sql = "SELECT slika, naslov, godina, trajanje, id_zanr FROM filmovi WHERE naslov LIKE :slovo ";
	$fil = $conn->prepare($sql);
	$fil->bindParam(':slovo', $slovo);
	$fil->execute();

	echo '<div class="container">';
		foreach($fil->fetchAll(PDO::FETCH_ASSOC) as $film)
		{
			echo '<img src="images/' . $film['slika'] . '" class="img-rounded" alt="'. $film['slika'] . '" width="120" height="180" ><br/> ';
			echo '<h4>' . $film['naslov'] . ' (' . $film['godina'] . ')</h4>';
			echo '<h4>Trajanje: ' . $film['trajanje'] . ' min</h4>';
		}
	echo '</div>';
	die();

}


// uzimanje filmova
function fetch_filmovi() 
{
	global $conn;
	$sql = 'SELECT slika, naslov, godina, trajanje  FROM filmovi';
	$res = $conn->prepare($sql);
	$res->execute();


?>
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

<?php  // ubacivanje podataka u tablicu
	foreach($res->fetchAll(PDO::FETCH_ASSOC) as $film) 
	{	
		echo '<tr>';
		foreach($film as $podaci) 
		{
			if( strpos($podaci, '.jpg'))
			{
				echo '<td><img src="images/' . $podaci . '" class="img-rounded" alt="'. $podaci . '" width="120" height="180" > ';
				continue;
			}
			echo '<td>' . $podaci . '</td>';

		}
		if (isset($_SESSION['user_id'])) 
		{
			echo '<td><form method="POST" action=""><button class="btn btn-danger">Brisi</button></form></td>';
		}
		else
		{
			echo '<td><h4>Moras biti logiran da bi mogao brisati,<br/> <a href="login.php">Logiraj se</a></h4></td>';
		}
		echo '</tr>';
	}

}

fetch_filmovi();
	

?>