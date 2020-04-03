<?php
	$id = isset($_GET["id"]) ? $_GET["id"] : null;

	$title = "Costumers helped by employee $id";
	include("../Includes/header.php");

	$sql = "SELECT * FROM Customers WHERE salesRepEmployeeNumber = $id";
	showDetailsTable($id, $sql, "Customers");

	include("../Includes/footer.php");