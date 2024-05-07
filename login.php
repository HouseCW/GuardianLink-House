<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$mysqli = require "database.php";
	
	$sql = sprintf("SELECT * FROM user WHERE username = '%s'", $mysqli->real_escape_string($_POST["username"]));
	
	$result = $mysqli->query($sql);
	
	$user = $result->fetch_assoc();
	
	if ($user){
		if (password_verify($_POST["password"], $user["password_hash"])){
			
			session_start();
			
			session_regenerate_id();
			
			$_SESSION["user_id"] = $user["id"];
			
			header("Location: guardianlink.php");
			
			exit;
		}	
	}
	
	$is_invalid = true;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="guardianstylesheet.css">
	</head>
	<body>
		<h1>Login</h1>
		
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
		
		<?php if ($is_invalid): ?>
			<em style="color:white;">Invalid login</em>
		<?php endif; ?>
		
		<div class="wrapper">
			<form method="post">
				<div>
					<label for="username">Username</label>
					<input type="text" name="username" id="username">
				</div>
				<div>
					<label for="password">Password</label>
					<input type="password" name="password" id="password">
				</div>
			
				<div>
					<a href="contactform.html">Forgot password?</a>
				</div>
			
				<button>Log in</button>
			</form>
		</div>
	</body>
</html>