<?php
	include('includes/header.php');

	//Check if user is logged in
	if (isset($_SESSION['username'])) {
		header("Location: main.php");
	}
?>

<div class="modal" id="login-modal">
	<h1>LOGIN</h1>
	<?php
		if (isset($_POST['login'])) {
			$username = mysqli_real_escape_string($conn,$_POST['user']);
			$password = sha1(mysqli_real_escape_string($conn,$_POST['pass']));

			if ($_POST['user'] == NULL || $_POST['pass'] == NULL) {
				echo "<p class='fail'>Please fill in all fields!</p>";
			}else{
				$sql = "SELECT password FROM users WHERE username = '$username'";
				$pass = getdata($sql, "verify_pass");

				if ($pass == $password) {
					$_SESSION['username'] = $username;
					header('Location: main.php');
				}else{
					echo "<p class='fail'>Incorrect Password!</p>";
				}
			}
		}
	?>
	<form action="login.php" method="post">
		<p><label>Username</label><br>
		<input type="text" name="user"></p>

		<p><label>Password</label><br>
		<input type="password" name="pass"></p>

		<p>Don't have an account? <a href="register.php">Register</a></p>

		<p><input type="submit" name="login" value="LOGIN"></p>
	</form>	
</div>