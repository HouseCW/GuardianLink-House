<?php

if (empty($_POST["sender"])) {
	die("Username is required");
}

if (empty($_POST["receiver"])) {
	die("Username of Recipient is required");
}

if (empty($_POST["message"])) {
	die("Message is required");
}

$mysqli = require "database.php";

$sql = "INSERT INTO messages (sender, receiver, message) VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

if (! $stmt->prepare($sql)){
	die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss", $_POST["sender"], $_POST["receiver"], $_POST["message"]);
$stmt->execute();

header("Location: sent.html");
exit;

?>