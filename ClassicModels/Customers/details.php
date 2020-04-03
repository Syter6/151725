<?php
	$id = isset($_GET["id"]) ?  $_GET["id"] : null;

	$title = "Orders placed by customer $id";
	include("../Includes/header.php");

	$sql = "SELECT * FROM orders WHERE customerNumber = '$id'";
	showDetailsTable($id, $sql, "Orders");

	include("../Includes/footer.php");