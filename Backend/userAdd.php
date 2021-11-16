<?php
	ini_set('display_errors', '0');
	error_reporting(E_ALL | E_STRICT);

	include "../Backend/secret.php";

	function console($data) {
		if (!empty($data)) {
			echo '<script>'.'console.log("%c'.$data.'","color: rgba(215,220,45,100); font-size: 1.5rem; font-weight: light;")'.";</script>";
		}
	}				
	if(isset($_POST['submit'])){
		$conn = mysqli_connect($server, $username, $password, $dbname, $port);
		if (!$conn) {
			console("Connection failed due to:" . mysqli_connect_error());
		}
		else {
			console("Connection success!");

			$newAdmin 	= $_POST['username'];
			$newPass	= $_POST['pass'];
			$hashedPass	= password_hash($newPass, PASSWORD_BCRYPT);
			$userAgent  =   $_SERVER['HTTP_USER_AGENT'];

			$newAdminQuery = "INSERT INTO Admin (`id`, `username`, `password`, `last_login`, `user_agent`, `reg_date`)
			VALUES (NULL, '$newAdmin', '$hashedPass', current_timestamp(), '$userAgent', current_timestamp()";

			if ($conn->query($newAdminQuery)) {
				console("Query works, wooooooo");
			}
			else {
				console("Something went wrong");
			}
		}
	}
?>