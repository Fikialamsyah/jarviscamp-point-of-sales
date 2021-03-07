<?php

	// postgresql
	// $myPDO = new PDO("pgsql:host=localhost;dbname=db_pos", "postgres", "12345");

	// mysql
    $server = "localhost";
    $database = "jarvis";
    $username = "root";
    $password = "Sttnf160101@!";

    
    $conn = mysqli_connect($server, $username, $password, $database);
?>