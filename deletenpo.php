<!DOCTYPE html>
<html>
	<head>
		<title>DeleteNPO</title>
		<link rel="stylesheet" href="guardianstylesheet.css">
	</head>
	<body>
		<h1>Delete NPO User</h1>
		
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
		<p>Below are the current Non-Profit Organization User Accounts<br>
		Please enter the Username of the Account to be deleted.</p>
		
		<form action="npodelete.php" method="post" novalidate>		
		
			<div>
				<label for="username">Username</label>
				<input type="text" id="username" name="username">
			</div>
				
			<button style="font-size: 15px">Confirm</button>
		</form>
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