<?php

session_start();

if (isset($_SESSION["user_id"])){

	$mysqli = require "database.php";
	
	$sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
	
	$result = $mysqli->query($sql);
	
	$user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>GuardianLinkHome</title>
		<link rel="stylesheet" href="guardianstylesheet.css">
	</head>
	<body>
		<h1>Guardian Link</h1>
		
		<nav class="navbar">
			<ul>
				<li><a href="guardianlink.php">Home</a></li>
				<li><a href="about.html">About Us</a></li>
				<li><a href="CSVolunteers.html">Cybersecurity Volunteers</a></li>
				<li><a href="NPO.html">NPOs</a></li>
				<li><a href="Admin.html">Admin</a></li>
				<li><a href="messages.php">Messages</a></li>
			</ul>
		</nav>
		
		<p>Already have an account?<a href="login.php">Log in</a></p>
		
		<?php if (isset($user)): ?>
			<p style="color:white">Hello <?= htmlspecialchars($user["username"]) ?></p>
		<?php endif; ?>
			
		<p><a href="logout.php">Log out</a></p>
		
		<div class="wrapper" style="text-align:center">
			<img src="capstonepics/C4Vlogo.png" height="442px" width="420px">
			<div class="text-box">
				<p>A C4V Student Project - Christopher House</p>
			</div>
		</div>	
	</body>
</html>