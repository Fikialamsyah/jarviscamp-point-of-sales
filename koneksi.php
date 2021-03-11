<?php

	// postgresql
try {
	$myPDO = new PDO("pgsql:host=localhost;dbname=jarvis", "postgres", "12345");
	// echo "Koneksi berhasil bos";
}
catch(PDOException $e) {
	echo $e->getMessage();
}	


	// mysql
    // $server = "localhost";
    // $database = "jarvis";
    // $username = "root";
    // $password = "Sttnf160101@!";

    
    // $conn = mysqli_connect($server, $username, $password, $database);
?>