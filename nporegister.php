<?php

if (empty($_POST["username"])) {
	die("Username is required");
}

if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
	die("Valid email is required");
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

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require "database.php";

$sql = "INSERT INTO nonprofit (username, email, orgname, aoc) VALUES (?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if (! $stmt->prepare($sql)){
	die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss", $_POST["username"], $_POST["email"], $_POST["orgname"], $_POST["aoc"]);
$stmt->execute();

$sql = "INSERT INTO user (username, password_hash) VALUES (?,?)";

$stmt = $mysqli->stmt_init();

if (! $stmt->prepare($sql)){
	die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ss", $_POST["username"], $password_hash);
if ($stmt->execute()){
	header("Location: registersuccess.html");
	exit;
}

?>