<!DOCTYPE html>
<html>
<head>
	<title>NPO Edit</title>
	<meta charset = "UTF-8">
	<link rel="stylesheet" href="guardianstylesheet.css">
</head>
<body>

	<h1>NPO Edit Profile</h1>
	
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
	
	<form action="editnpo.php" method="post" novalidate>		
		
		<div>
			<label for="email">Email</label>
			<input type="email" id="email" name="email">
		</div>
		
		<div>
			<label for="orgname">Organization Name</label>
			<input type="text" id="orgname" name="orgname">
		</div>
		
		<div>
			<label for="aoc">Area(s) of Concern</label>
			<input type="text" id="aoc" name="aoc">
		</div>
				
		<button style="font-size: 15px">Confirm Changes</button>
	</form>
	
	<p>Contact Admin to <a href="contactform.html">Delete My Account</a></p>
	
	<table>
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th>Organization Name</th>
			<th>Area(s) of Concern</th>
		</tr>
		<?php
		session_start();

		if (isset($_SESSION["user_id"])){

			$mysqli = require "database.php";
	
			$sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
	
			$result = $mysqli->query($sql);
	
			$user = $result->fetch_assoc();
		}
		if (isset($user)){
			$sql = sprintf("SELECT username, email, orgname, aoc from nonprofit WHERE username = '%s'", $user["username"]);

			$result = $mysqli->query($sql);
		}	
		if ($result-> num_rows > 0){
			while ($row = $result-> fetch_assoc()){
				echo "<tr><td>" . $row["username"] . "</td><td>"
				. $row["email"] . "</td><td>"
				. $row["orgname"] . "</td><td>"
				. $row["aoc"] . "</td></tr>";
			}
			echo "</table>";
		}
		else {
			echo "0 results";
		}
		exit;	
		?>
	</table>
		
</body>
</html>