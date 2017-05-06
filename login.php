<?php

include 'includes/header.php';

?>
<div class="container">
	<form action="functions/funcLogin.php" method="POST">
		<div class="form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Enter your name here"/>
		</div>
		<div class="form-group">
			<label for="pass">Password:</label>
			<input type="password" class="form-control" id="pass" name="pass"/>
		</div>

		<button type="submit" class="btn btn-primary">Submit</button><br/><br/>
		<p>Dont have a account, register <a href="register.php">here</a></p>
	</form>
</div>