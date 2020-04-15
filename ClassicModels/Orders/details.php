<?php
	$id = isset($_GET["id"]) ? $_GET["id"] : null;

	$title = "Orders retrieved from Customer $id";
	include("../Includes/header.php");

	$sql = "SELECT * FROM Customers WHERE customerNumber = '$id'";
	showDetailsTable($id, $sql, "Customers");

	include("../Includes/footer.php");