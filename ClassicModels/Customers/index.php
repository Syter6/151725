<?php
	$showButton = true;
    $title = "Customers";
    include("../Includes/header.php");

	$table = new Table("Customers");
	$table->ShowDataTable();

	include("../Includes/footer.php");