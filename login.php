<?php

session_start();

if ( isset($_SESSION['user_id']) )
{
	header("Location: index.php");
} 


require 'functions/dataLogin.php';
require 'includes/header.php';

?>
<div class="container">

	<form action="" method="POST">

			<label for="name">Ime:</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter your name here"/>
			<br/>

			<label for="pass">Sifra:</label>
			<input type="password" class="form-control" id="pass" name="pass"/>
			<br/>

		<button type="submit" class="btn btn-primary">Submit</button><br/><br/>
		<p>Dont have a account, register <a href="register.php">here</a></p>
	</form>
</div>