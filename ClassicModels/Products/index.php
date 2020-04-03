<?php
	$id = isset($_GET["id"]) ? $_GET["id"] : null;
    $title = $id;

    include("../Includes/header.php");

	$sql = "SELECT * FROM products WHERE productLine = '$id'";
	showDetailsTable($id, $sql, "Products");

    include("../Includes/footer.php");