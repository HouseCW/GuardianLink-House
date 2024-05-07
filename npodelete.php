<?php

$is_invalid = false;

if (empty($_POST["username"])) {
	die("Username is required");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$mysqli = require "database.php";
	
	$sql = sprintf("DELETE FROM nonprofit WHERE username = '%s'", $mysqli->real_escape_string($_POST["username"]));
	$result = $mysqli->query($sql);
	
	$sql = sprintf("DELETE FROM user WHERE username = '%s'", $mysqli->real_escape_string($_POST["username"]));
	$result = $mysqli->query($sql);
	
	header("Location: deletesuccess.html");
			
	exit;

}	
$is_invalid = true;


?>