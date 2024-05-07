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
	$old_info = $result->fetch_assoc();
}


if (empty($_POST["name"])) {
	die("Full Name is required");
}

if (empty($_POST["avh"])) {
	die("Available Hours/Week is required");
}

if (empty($_POST["ccb"])) {
	die("Criminal Background Check is required");
}

if (empty($_POST["lip"])) {
	die("LinkedIn Profile is required");
}

if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
	die("Valid email is required");
}

$mysqli = require "database.php";

$sql = sprintf("UPDATE volunteer SET name= '%s' WHERE name= '%s'", $mysqli->real_escape_string($_POST["name"]), $old_info["name"]);
$result = $mysqli->query($sql);

$sql = sprintf("UPDATE volunteer SET email= '%s' WHERE email= '%s'", $mysqli->real_escape_string($_POST["email"]), $old_info["email"]);
$result = $mysqli->query($sql);

$sql = sprintf("UPDATE volunteer SET avh= '%s' WHERE avh= '%s'", $mysqli->real_escape_string($_POST["avh"]), $old_info["avh"]);
$result = $mysqli->query($sql);

$sql = sprintf("UPDATE volunteer SET ccb= '%s' WHERE ccb= '%s'", $mysqli->real_escape_string($_POST["ccb"]), $old_info["ccb"]);
$result = $mysqli->query($sql);

$sql = sprintf("UPDATE volunteer SET lip= '%s' WHERE lip= '%s'", $mysqli->real_escape_string($_POST["lip"]), $old_info["lip"]);
$result = $mysqli->query($sql);


header("Location: editsuccess.html");
exit;


?>