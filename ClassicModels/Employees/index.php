<?php
	$showButton = true;
	$title = "Employees";
	include("../Includes/header.php");

	$table = new Table("Employees");
	$table->ShowDataTable();

	include("../Includes/footer.php");