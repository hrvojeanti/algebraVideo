<?php


if ( isset($_SESSION['user_id']) )
{
	header("Location: index.php");
} 


require 'functions/dataLogin.php';
require 'includes/header.php';

$message = '';

if( !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['pass']) )
{	

	$name = $_POST['name'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];

	$kopija = '';

	// Provjera dali se upisi ponavljaju
	$sql_sel = 'SELECT name, email FROM users';
	$us_baza = $conn->prepare($sql_sel);
	$nes = $us_baza->execute();
	foreach($us_baza->fetchAll() as $user )
	{
		if( $name == $user['name'] )
		{
			echo '<div class="container"><h4>' . 'Ime se vec koristi' . '</h4></div>';
			$kopija = 'true';
			break;
		} 
		elseif ( $email == $user['email'] ) {
			echo '<div class="container"><h4>' . 'Prezime se vec koristi' . '</h4></div>';
			break;
		}
	}

	// Unos podataka u bazu
	if(!$kopija) {
		$sql_ins = "INSERT INTO users (`name`, `password`, `email`) VALUES (:name, :password, :email) ";

		$unos = $conn->prepare($sql_ins);
		$unos->bindParam(':name', $name);
		$unos->bindParam(':password', password_hash($pass, PASSWORD_BCRYPT));
		$unos->bindParam(':email', $email);
		if( $unos->execute() )
		{
			$message = '<div class="container"><h4>' . $name . ' uspjesno ste registrirani, provratak na ' . '<a href="login.php">prijavu</a>' . '</h4></div>';
		}
		else 
		{
			$message = 'Registracija nije uspjela';
		}
	}
}


?>
	<?php if(!empty($message)): ?>
		<?= $message ?>
	<?php endif; ?>


<div class="container">

	<form action="" method="POST">

			<label for="name">Ime:</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter your name here"/>
			<br/>

			<label for="pass">Email:</label>
			<input type="email" class="form-control" id="email" name="email"/>
			<br/>

			<label for="pass">Sifra:</label>
			<input type="password" class="form-control" id="pass" name="pass"/>
			<br/>

		<button type="submit" class="btn btn-primary">Registriraj se</button><br/><br/>
		<p><a href="register.php">Prijavi se</a></p>
	</form>
</div>