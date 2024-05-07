<!DOCTYPE html>
<html>
	<head>
		<title>ShowNPO</title>
		<link rel="stylesheet" href="guardianstylesheet.css">
	</head>
	<body>
		<h1>Non-Profits Seeking Volunteers</h1>
		
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
		
		<p>If you would like to contact an NPO, please reach out by email OR<br> Message directly through our <a href="contactform.html">Contact Form</a></p>
		
		<table>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Organization Name</th>
				<th>Area(s) of Concern</th>
			</tr>
			<?php
			$mysqli = require "database.php";
			$sql = "SELECT username, email, orgname, aoc from nonprofit";
			$result = $mysqli->query($sql);
			
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