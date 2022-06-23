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
        $dbname = "kart_system";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }



        // $conn->close();

        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'kart_system');
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }


?>

</body>
</html>