<?php

	// postgresql
try {
	$myPDO = new PDO("pgsql:host=localhost;dbname=jarvis", "postgres", "fikijaya25");
    $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $error) {
	echo 'Connection error: ' .$error->getMessage();

}






	// mysql
    // $server = "localhost";
    // $database = "jarvis";
    // $username = "root";
    // $password = "Sttnf160101@!";

    
    // $conn = mysqli_connect($server, $username, $password, $database);
?>