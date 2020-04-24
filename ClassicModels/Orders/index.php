<?php
	$showButton = true;
	$title = "Orders";
	include("../Includes/header.php");

	$table = new Table("Orders");
	$table->ShowDataTable();

	include("../Includes/footer.php");