<?php
	$host = "localhost";
	$user = "root";
	$pass = "admin";
	$dbname = "bkd";
	
	$mysqli = new mysqli($host, $user, $pass, $dbname);
	
	if($mysql->connect_errno) {
		die('Koneksi gagal karena ' . $mysqli->connect_error);
	}