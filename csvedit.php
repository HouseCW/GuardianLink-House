<!DOCTYPE html>
<html>
<head>
	<title>CSV Edit</title>
	<meta charset = "UTF-8">
	<link rel="stylesheet" href="guardianstylesheet.css">
</head>
<body>

	<h1>Cybersecurity Volunteer Edit Profile</h1>
	
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
	
	<form action="editcsv.php" method="post" novalidate>		
		
		<div>
			<label for="name">Full Name</label>
			<input type="text" id="name" name="name">
		</div> 
		
		<div>
			<label for="email">Email</label>
			<input type="email" id="email" name="email">
		</div>
		
		<div>
			<label for="avh">Available # of hours/week</label>
			<input type="text" id="avh" name="avh">
		</div>
		
		<div>
			<label for="ccb">Criminal Background Check</label>
			<input type="text" id="ccb" name="ccb">
		</div>
		
		<div>
			<label for="lip">LinkedIn Profile</label>
			<input type="text" id="lip" name="lip">
		</div>
				
		<button style="font-size: 15px">Confirm Changes</button>
	</form>
	
	<p>Contact Admin to <a href="contactform.html">Delete My Account</a></p>
	
	<table>
		<tr>
			<th>Username</th>
			<th>Name</th>
			<th>Email</th>
			<th>Available Hours/Week</th>
			<th>Criminal Background Check</th>
			<th>LinkedIn Profile</th>
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
			$sql = sprintf("SELECT username, name, email, avh, ccb, lip from volunteer WHERE username = '%s'", $user["username"]);

			$result = $mysqli->query($sql);
		}	
		if ($result-> num_rows > 0){
			while ($row = $result-> fetch_assoc()){
				echo "<tr><td>" . $row["username"] . "</td><td>"
				. $row["name"] . "</td><td>"
				. $row["email"] . "</td><td>"
				. $row["avh"] . "</td><td>"
				. $row["ccb"] . "</td><td>"
				. $row["lip"] . "</td></tr>";
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