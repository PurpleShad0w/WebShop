<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">

</head>
<body>

<?php

		$servername = "localhost";
		$username = "root";
		$password = "";
		$conn = mysqli_connect($servername, $username, $password);

		if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
		}
		$sql = "CREATE DATABASE registeredUsersDB";
		if (mysqli_query($conn, $sql)) {
		echo "Database created successfully";
		} else {
		echo "Error creating database: " . mysqli_error($conn);
		}
		mysqli_close($conn);


		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "registeredUsersDB";
		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
		$sql = "CREATE TABLE usersTab (
			id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			username VARCHAR(50) NOT NULL UNIQUE,
			password VARCHAR(255) NOT NULL,
			created_at DATETIME DEFAULT CURRENT_TIMESTAMP
		)";
		if ($conn->query($sql) === TRUE) {
		echo "Table UsersTab created successfully";
		} else {
		echo "Error creating table: " . $conn->error;
		}
		$conn->close();


		define('DB_SERVER', 'localhost');
		define('DB_USERNAME', 'root');
		define('DB_PASSWORD', '');
		define('DB_NAME', 'registeredUsersDB');
		$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if($link === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		} 


?>




</body>
</html>