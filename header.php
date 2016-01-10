<!DOCTYPE HTML>
<html>
	<head>
		<title>STUDENT CLUB REGISTRATION SYSTEM</title>		
		<link rel="stylesheet" type="text/css" href="des.css">
	</head>
	<body>
	<?php
		require("../pass.php");
		error_reporting(E_ERROR | E_PARSE);
		$server = '127.0.0.1';
		$username = 'root';
		$password = base64_decode($pass);
		$db = 'db007';
		
		$conn = mysqli_connect($server, $username, $password, $db);
		if (mysqli_connect_errno($conn))
			die ("Failed to connect : " . mysqli_connect_error());
		