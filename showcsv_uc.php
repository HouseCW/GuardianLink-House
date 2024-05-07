<?php

session_start();

$mysqli = require "database.php";

if (isset($_SESSION["user_id"])){
	
	$sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
	$result = $mysqli->query($sql);
	$user = $result->fetch_assoc();

	
	if (isset($user)){	
	
		$sql = sprintf("SELECT username, email, orgname, aoc from nonprofit WHERE username = '%s'", $user["username"]);
		$result = $mysqli->query($sql);
		$user_info = $result->fetch_assoc();
	}	
	if($user["username"] == $user_info["username"]){
		header("Location: showcsv.php");
		exit;
	}
	else{
		print("You must be logged in as an NPO User to view this page");
	}
}
else{
	print("You must be logged in as an NPO User to view this page");
}	

?>