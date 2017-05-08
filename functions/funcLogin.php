<?php

include 'dataLogin.php';



$name = $_POST['name'];
$pass = $_POST['pass'];

$name = stripslashes($name);
$pass = stripslashes($pass);
$name = mysqL_real_escape_string($name);
$pass = mysqL_real_escape_string($pass);

$sve = $conn->query('SELECT name, password FROM users');

// PROVJERA da se ne ponavlja user ili email
foreach($sve as $nes) 
{	
	if($nes['name'] == $name && $nes['password'] == $pass)
	{
		echo 'You are logged in!';
		$copy = '';
		echo "<br/> <a href='../index.php'>Home</a>";
		exit();
	}


	
	
}

echo 'There no such account';



?>
