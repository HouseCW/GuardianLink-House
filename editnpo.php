<?php
session_start();

if (isset($_SESSION["user_id"])){

	$mysqli = require "database.php";
	
	$sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
	
	$result = $mysqli->query($sql);
	
	$user = $result->fetch_assoc();
}
if (isset($user)){
	$sql = sprintf("SELECT email, orgname, aoc from nonprofit WHERE username = '%s'", $user["username"]);

	$result = $mysqli->query($sql);
	$old_info = $result->fetch_assoc();
}


if (empty($_POST["orgname"])) {
	die("Organization Name is required");
}

if (empty($_POST["aoc"])) {
	die("Area(s) of Concern is required");
}

if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
	die("Valid email is required");
}

$mysqli = require "database.php";

$sql = sprintf("UPDATE nonprofit SET email= '%s' WHERE email= '%s'", $mysqli->real_escape_string($_POST["email"]), $old_info["email"]);
$result = $mysqli->query($sql);

$sql = sprintf("UPDATE nonprofit SET orgname= '%s' WHERE orgname= '%s'", $mysqli->real_escape_string($_POST["orgname"]), $old_info["orgname"]);
$result = $mysqli->query($sql);

$sql = sprintf("UPDATE nonprofit SET aoc= '%s' WHERE aoc= '%s'", $mysqli->real_escape_string($_POST["aoc"]), $old_info["aoc"]);
$result = $mysqli->query($sql);


header("Location: editsuccess.html");
exit;


?>