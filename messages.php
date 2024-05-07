<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<meta charset = "UTF-8">
	<link rel="stylesheet" href="guardianstylesheet.css">
</head>
<body>

	<h1>Your Messages</h1>
	
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
	
	<button style="font-size:25px; background-color:gold; color:blue; border-radius:25px;"><a href="delete_messages.php">Delete Messages</a></button>
	
	<table>
		<tr>
			<th>Sent By</th>
			<th>Recipient</th>
			<th>Message</th>
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
			$sql = sprintf("SELECT sender, receiver, message from messages WHERE receiver = '%s'", $user["username"]);

			$result = $mysqli->query($sql);
		}	
		if ($result-> num_rows > 0){
			while ($row = $result-> fetch_assoc()){
				echo "<tr><td>" . $row["sender"] . "</td><td>"
				. $row["receiver"] . "</td><td>"
				. $row["message"] . "</td></tr>";
			}
			echo "</table>";
		}
		else {
			echo "You have no messages";
		}
		exit;	
		?>
	</table>
		
</body>
</html>