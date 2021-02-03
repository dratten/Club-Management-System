<?php
	require('db.php');
	$conn = connection('cms');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Club Management System</title>
	<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div id="container">
		<nav>
			<div class="links">
				<ul>
					<li><a href="index.php">CMS</a></li>
					<li><a href="#">ABOUT</a></li>
					<li><a href="#">CONTACT</a></li>
					<li><a href="#">SUPPORT</a></li>
				</ul>
			</div>

			<div class="log-reg-btns">
				<?php if (isset($_SESSION['username'])) { ?>
					<form action="db.php" method="post">
						<?php echo "<a href='#' style = 'padding: 0px; margin: 0px; text-decoration: underline;'>".$_SESSION['username']."</a> is logged in. ";?>
						<input type="submit" name="logout" value="LOGOUT">
					</form>
				<?php 
					}else{ ?>
						<ul>
							<li><a href="login.php">LOGIN</a></li>
							<li><a href="register.php" class="call-to-action">REGISTER</a></li>
						</ul>
				<?php }	?>	
			</div>
		</nav>
