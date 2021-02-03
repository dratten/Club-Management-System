<?php
	session_start();

	function connection($dbname){
		$conn = new mysqli('localhost', 'root', '', $dbname);
		if ($conn->connect_error) {
			die("<p class='fail'>Connection failed: " . $conn->connection_error."!</p>");
		}
		return $conn;
	}

	function setdata($sql, $purpose){
		$conn = connection('cms');

		if ($purpose == 'register') {
			if($conn->query($sql) == TRUE) {
				echo "<p class='success'>Registration was successful. Click <a href='login.php'>here</a> to login!</p>";
			} else{
				echo "<p class='fail'>Error: ".$sql."<br>".$conn->error."!</p>";
			}
		}
	}

	function getdata($sql, $purpose){
		$conn = connection('cms');
		$result = $conn->query($sql);

		if ($purpose == 'verify_pass') {
			if ($result->num_rows > 0) {
				while ($retrieved = $result->fetch_assoc()){
					return $retrieved['password'];	
				}
			}else{
				echo "<p class='fail'>Username does not exist!</p>";
			}
		}else if($purpose == 'check_availability'){
			if ($result->num_rows > 0) {
				while ($retrieved = $result->fetch_assoc()){
					return 0;
				}
			}else{
				return 1;
			}
		}
	}

	//Logout
	if (isset($_POST['logout'])) {
		session_destroy();
		header("Location: index.php");
	}

?>