<?php
	$id = isset($_GET["id"]) ?  $_GET["id"] : null;
	$title = "Orders placed by customer $id";

	include("../Includes/header.php");

	$sql = "SELECT * FROM orders WHERE customerNumber = '" . $id . "'";

	$table = new Table("Orders");
	$table->ShowTableDetails($sql);

	include("../Includes/footer.php");
