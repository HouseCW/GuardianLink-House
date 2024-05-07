<?php

$is_invalid = false;

if (empty($_POST["username"])) {
	die("Username is required");
}

if(strlen($_POST["password"])<8){
	die("Password must be at least 8 characters");
}

if(!preg_match("/[a-z]/i", $_POST["password"])){
	die("Password must contain at least one letter");
}

if(!preg_match("/[0-9]/", $_POST["password"])){
	die("Password must contain at least one number");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$mysqli = require "database.php";
	
	$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
	
	$sql = sprintf("SELECT password_hash from user WHERE username = '%s'", $_POST["username"]);
	$result = $mysqli->query($sql);
	$old_info = $result->fetch_assoc();
	
	$sql = sprintf("UPDATE user SET password_hash= '%s' WHERE password_hash= '%s'", $password_hash, $old_info["password_hash"]);
	$result = $mysqli->query($sql);
	
	header("Location: resetsuccess.html");
			
	exit;

}	
$is_invalid = true;

