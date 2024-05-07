<?php
session_start();

if (isset($_SESSION["user_id"])){

	$mysqli = require "database.php";
	
	$sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
	
	$result = $mysqli->query($sql);
	
	$user = $result->fetch_assoc();
}
if (isset($user)){
	$sql = sprintf("DELETE from messages WHERE receiver = '%s'", $user["username"]);

	$result = $mysqli->query($sql);
}
header("Location: message_deleted.html");			
exit;	
?>