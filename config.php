<?php
	$conn = new mysqli("localhost","root","","kart_system");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>