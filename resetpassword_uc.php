<?php

session_start();

$mysqli = require "database.php";

if (isset($_SESSION["user_id"])){
	
	$sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
	$result = $mysqli->query($sql);
	$user = $result->fetch_assoc();

	
	if (isset($user)){	
	
		$sql = sprintf("SELECT username, name from admin WHERE username = '%s'", $user["username"]);
		$result = $mysqli->query($sql);
		$user_info = $result->fetch_assoc();
	}	
	if($user["username"] == $user_info["username"]){
		header("Location: resetpassword.html");
		exit;
	}
	else{
		print("You must be logged in as an Administrator to view this page");
	}
}
else{
	print("You must be logged in as an Administrator to view this page");
}	

?>