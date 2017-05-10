<?php

require 'functions/dataLogin.php';
require 'includes/header.php';




if ( isset($_SESSION['user_id']) )
{
	header("Location: index.php");
} 

if( !empty($_POST['name']) && !empty($_POST['pass']) )
{
	$user = $conn->prepare('SELECT id, name, password FROM users WHERE name = :name');
	$user->bindParam(':name', $_POST['name']);
	$user->execute();
	$results = $user->fetch(PDO::FETCH_ASSOC);
	$message = '';
	var_dump($results);
	if( count($results) > 0 && password_verify($_POST['pass'], $results['password']) )
	{
		$_SESSION['user_id'] = $results['id'];
		$_SESSION['user'] = $results['name'];
		header("Location: index.php");

	} 
	else
	{
		$message = '<div class="container"><h4>Niste se upjesno logirali!</h4></div>';
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

			<label for="pass">Sifra:</label>
			<input type="password" class="form-control" id="pass" name="pass"/>
			<br/>

		<button type="submit" class="btn btn-primary">Submit</button><br/><br/>
		<p>Nemas racun, registriraj se <a href="register.php">ovdje</a></p>
	</form>
</div>

