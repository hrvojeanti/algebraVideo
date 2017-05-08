<?php
	
require 'database.php';


if ( isset($_SESSION['user_id']) ){
	header("Location: index.php");
}

$message = '';

if(!empty($_POST['email']) && !empty($_POST['password'])):
	// Enter a new user in database

	$sql = "INSERT INTO users (email, password) VALUES(:email, :password)";
	
	// This is all for securtiy reson
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT)); 

	// with execute we run the statement
	if($stmt->execute() ):
		$message = 'Successfuly created new user'; 
	else:
		$message = 'Sorry there must be an issue creating your account';
	endif;

endif;

?>
<!doctype html>
<html>
<head>
	<title>Register Below</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">

</head>
<body>

	<div class="header">
		<a href="index.php">My App</a>
	</div>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Register</h1>
	<span> or <a href="login.php">login here</a></span>
	<form actin="register.php" method="POST">
		<input type="text" placeholder="Enter your email" name="email">
		<input type="password" placeholder="and password" name="password">
		<input type="password" placeholder="confirm password" name="password">

		<input type="submit">

	</form>
</body>

</html>