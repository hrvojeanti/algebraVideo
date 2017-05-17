<?php
$ser = $_SERVER['REQUEST_URI'];
$cur_site = '';

session_start();

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
elseif(strpos($ser, 'filmovi.php'))
{
	$cur_site = 'filmovi';
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
				echo 'Home videoteka';
				break;
			case('login'):
				echo 'Login videoteka';
				break;
			case('filmovi'):
				echo 'Filmovi videoteka';
				break;
			case('unos'):
				echo 'Unos videoteka';
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
		


		<!-- menu items -->

		<div>
			<ul class="nav navbar-nav">
				<li 
				<?php	// cinimo home aktivnim
					if($cur_site == 'home') echo 'class=active';
				?>
					><a href="index.php">Home</a></li>
				<li
				<?php	// cinimo filmovi aktivnim
					if($cur_site == 'filmovi') echo 'class=active';
				?>
				><a href="filmovi.php">Filmovi</a></li>
				<li
				<?php	// cinimo home aktivnim
					if($cur_site == 'unos') echo 'class=active';
				?>
				><a href="unos.php">Unos</a></li>
			</ul>
			<?php
			if( !isset($_SESSION['user_id'])) {
			echo ' <ul class="nav navbar-nav navbar-right"> <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Registriraj se</a></li> <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Prijavi se</a></li>	</ul>';
			} else {
				echo ' <ul class="nav navbar-nav navbar-right"> 
				<li><a href="logout.php">
				<span ></span> Log out</a></li> 
				<li><a href="index.php">
				<span ></span>' . $_SESSION['user'] . '</a></li>	
				</ul>';
			}
   		?>
		</div>

	</div>



</nav>




