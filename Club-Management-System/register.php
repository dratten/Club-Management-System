<?php
	include('includes/header.php');

	//Check if user is logged in
	if (isset($_SESSION['username'])) {
		header("Location: main.php");
	}
?>

	<div class="modal" id="reg-Modal">
		<h1>REGISTER</h1>
		<?php
			if (isset($_POST['register'])) {

				$fname = mysqli_real_escape_string($conn,$_POST['fname']);
				$lname = mysqli_real_escape_string($conn,$_POST['lname']);
				$user = mysqli_real_escape_string($conn,$_POST['user']);
				$email = mysqli_real_escape_string($conn,$_POST['email']);
				$pass = mysqli_real_escape_string($conn,$_POST['pass']);

				$sql = "SELECT * FROM users WHERE username = '$user' OR email='$email'";
				$availability = getdata($sql, "check_availability");

				if ($fname == NULL || $lname == NULL || $user == NULL || $email == NULL || $pass == NULL) {
					echo "<p class='fail'>Please fill in all the fields</p>";
				}else if($availability == 0){
					echo "<p class='fail'>Username already taken!</p>";	
				}else{
					$enc_pass = sha1($pass);
					$sql = "INSERT INTO users(first_name, last_name, username, email, password) VALUES('$fname', '$lname', '$user', '$email', '$enc_pass')";
					setdata($sql, "register");
				}
			}
		?>
		<form action="register.php" method="post">
			<p><label>First Name</label><br>
			<input type="text" name="fname"></p>

			<p><label>Last Name</label><br>
			<input type="text" name="lname"></p>

			<p><label>Username</label><br>
			<input type="text" name="user"></p>

			<p><label>Email</label><br>
			<input type="email" name="email"></p>

			<p><label>Password</label><br>
			<input type="password" name="pass"></p>

			<p>Already have an account? <a href="login.php">Login</a></p>
			
			<p><input type="submit" name="register" value="REGISTER"></p>
			
		</form>
	</div>