<?php

try {
	$myPDO = new PDO("pgsql:host=localhost;dbname=db_pos", "postgres", "12345");
	echo "Connected to Postgres";

} catch(PDOException $e) {
	echo $e->getMessage();
}


?>