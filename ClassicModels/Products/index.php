<?php
	$id = isset($_GET["id"]) ? $_GET["id"] : null;
    $title = $id;

    include("../Includes/header.php");

    $sql = "SELECT * FROM Products WHERE productLine = '" . $id . "'";

    $table = new Table("Products");
    $table->ShowTableDetails($sql);

    include("../Includes/footer.php");
