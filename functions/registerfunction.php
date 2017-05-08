<?php

include 'dataLogin.php';



$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['pass'];

$name = stripslashes($name);
$email = stripslashes($email);
$pass = stripslashes($pass);
$name = mysqL_real_escape_string($name);
$email = mysqL_real_escape_string($email);
$pass = mysqL_real_escape_string($pass);

$sve = $conn->query('SELECT name, email FROM users');
$copy = 'true';

// PROVJERA da se ne ponavlja user ili email
foreach($sve as $nes) 
{	
	if($nes['name'] == $name || $nes['email'] == $email)
	{
		echo 'email or username already in use';
		$copy = '';
	}

	
	
}
if($copy)
{
	$conn->query("  INSERT INTO users (`name`, `email`, `password`)
				VALUES('$name', '$email', '$pass') ");
	echo $name . ' you are registred';
	echo '<br/>';
	echo "Return " . "<a href='../index.php>Home</a>";
}


?>
