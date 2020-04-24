<?php
	$id = isset($_GET["id"]) ? $_GET["id"] : null;

	$title = "Employees that work at office $id";
	include("../Includes/header.php");

	$sql = "SELECT * FROM Employees WHERE officeCode = '$id'";

	$table = new Table("Employees");
	$table->ShowTableDetails($sql);

	include("../Includes/footer.php");