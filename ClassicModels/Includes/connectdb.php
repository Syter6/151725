<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ClassicModels";

try{
	$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo "<p>Conncection Error:</p>" . $e->getMessage();
}
