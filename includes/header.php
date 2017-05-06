<?php
$ser = $_SERVER['REQUEST_URI'];
$cur_site = '';


// ovo sluzi za provjeru tako da znamo na kojem smo sajtu
if(strpos($ser, 'login.php'))
{
	$cur_site = 'login';
}
elseif(strpos($ser, 'index.php'))
{
	$cur_site = 'home';
}
elseif(strpos($ser, 'unos.php'))
{
	$cur_site = 'unos';
}

?>


<!doctype html>
<html>
<head>
	<title>
	<?php // TITLE na temelju $cur_site
		switch($cur_site)
		{
			case('home'):
				echo 'home videoteka';
				break;
			case('login'):
				echo 'login videoteka';
				break;
			default:
				echo 'videoteka';
		}

	?>
	</title>
	<meta charset="utf-8">
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-3.2.1.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
	
	<div class="container-fluid">
		<!-- Ako želimo logo -->
		
		<div class="navbar-header" id="logo">
			<a href="#" class="navbar-brand">Videoteka</a>
		</div>

		<!-- menu items -->

		<div>
			<ul class="nav navbar-nav">
				<li 
				<?php	// cinimo home aktivnim
					if($cur_site == 'home') echo 'class=active';
				?>
					><a href="index.php">Home</a></li>
				<li><a href="#">Filmovi</a></li>
				<li
				<?php	// cinimo home aktivnim
					if($cur_site == 'unos') echo 'class=active';
				?>
				><a href="unos.php">Unos</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">

				<li><a href="login.php">Login</a></li>


			</ul>
		</div>

	</div>



</nav>




