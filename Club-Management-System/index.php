<?php
	include('includes/header.php');

	//Check if user is logged in
	if (isset($_SESSION['username'])) {
		header("Location: main.php");
	}
?>
		<section class="content">
			<article>
				<h1>THIS IS THE STRATHMORE CLUB MANAGEMENT SYSTEM</h1></header>
				<a href="register.php" class="call-to-action">GET STARTED</a>
			</article>
		</section>
	</div>
</body>
</html>