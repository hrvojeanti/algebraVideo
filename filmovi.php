<?php

require 'includes/header.php';
require 'funkcije.php';
require 'functions/dataLogin.php';


$letter = 'A';
?>

<br/>
<div id="sve_filmovi">
<div class='container' id='slova'>

<?php  // pisanje slova po abecednom redu, za trazenje filmova
echo '<span> | <a href="filmovi.php">SVI</a> | </span>';
for($i=1; $i<=26; $i++)
{
	echo "<span><a href='?s=" . $letter .  "'>" . $letter . "</a> | </span> ";
	$letter++;
}



// trazenje filmova po slovima
if ( isset($_GET['s']))
{
	echo '<br/><br/></div>';


	$slovo = $_GET['s'] . '%';
				
	$sql = "SELECT slika, naslov, godina, trajanje, id_zanr FROM filmovi WHERE naslov LIKE :slovo ";
	$fil = $conn->prepare($sql);
	$fil->bindParam(':slovo', $slovo);
	$fil->execute();

	foreach($fil->fetchAll(PDO::FETCH_ASSOC) as $film)
		{
			echo '<img src="images/' . $film['slika'] . '" class="img-rounded slika" alt="'. $film['slika'] . '" width="120" height="180" ><br/> ';
			echo '<h4>' . $film['naslov'] . ' (' . $film['godina'] . ')</h4>';
			echo '<h4>Trajanje: ' . $film['trajanje'] . ' min</h4>';
		}
	echo '</div><br/><br/>';

	die();

}


// brisemo film koji zelimo
if ( isset($_POST['brisi'])) 
{
	$sql = 'DELETE FROM `filmovi` WHERE `filmovi`.`naslov` = :naslov';
	$brisanje = $conn->prepare($sql);
	$brisanje->bindParam(':naslov', $_POST['ime_filma']);
	$brisanje->execute();
}


// Stvaramo tablicu i upisujemo filmove u tablicu
Funkcije::table_filmovi();
	

?>
</tbody>
</table>
</div>
<br/>
<br/>
<br/>



