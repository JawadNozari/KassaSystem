<?php

// this file will contain the credentials for the database
$server = "SERVER";
$username = "username";
$password = "password";
$dbname = "dbname";
$port = 3306;

// Create connection
$conn = mysqli_connect($server, $username, $password, $dbname, $port);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
