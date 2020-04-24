<?php
	$showButton = true;
	$title = "Offices";
	include("../Includes/header.php");

	$table = new Table("Offices");
	$table->ShowDataTable();

	include("../Includes/footer.php");