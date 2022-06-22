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
		$sql = "CREATE DATABASE DB";
		if (mysqli_query($conn, $sql)) {
		echo "Database created successfully";
		} else {
		//echo "Error creating database: " . mysqli_error($conn);
		}
		// mysqli_close($conn);


		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "DB";
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
			//echo "Table UsersTab created successfully";
			} else {
			//echo "Error creating table: " . $conn->error;
		}

		$sql="CREATE TABLE items(
			id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			name VARCHAR(100),
			price VARCHAR(100),
			image VARCHAR(100)
			)";



		if ($conn->query($sql) === TRUE) {
			//echo "Table UsersTab created successfully";
		} else {
			//echo "Error creating table: " . $conn->error;
		}

		$sql="CREATE TABLE orders(
			id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			products VARCHAR(200),
			clientID INT
			totalCost VARCHAR(200)
			)";



		if ($conn->query($sql) === TRUE) {
			//echo "Table UsersTab created successfully";
		} else {
			//echo "Error creating table: " . $conn->error;
		}
		

		


		define('DB_SERVER', 'localhost');
		define('DB_USERNAME', 'root');
		define('DB_PASSWORD', '');
		define('DB_NAME', 'DB');
		$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if($link === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		} 

		$sql="INSERT INTO items (id, name, price, image) VALUES
  			(1, 'watch1', '100', '1.jpeg'),
			(2, 'watch2', '120', '2.jpg'),
			(3, 'watch3', '150', '3.jpeg'),
			(4, 'phone', '200', '4.jfif'),
			(5, 'cable1', '20', '5.jpg'),
			(6, 'cable2', '30', '6.jpg'),
			(7, 'camera', '670', '7.jpg'),
			(8, 'laptop', '879', '8.jpg'),
			(9, 'mouse', '35', '9.jpg')";

		if ($conn->query($sql) === TRUE) {
			//echo "New record created successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
?>

</body>
</html>