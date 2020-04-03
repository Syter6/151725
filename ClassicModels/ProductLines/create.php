<?php
	$title = "Create ProductLine";
	include("../Includes/header.php");

	createForm("ProductLines", false, true);

	$input_data = get_input_data("ProductLines");

	if(required_filled($input_data, "ProductLines")){
		insert_data("ProductLines", $input_data);
	}

	include("../Includes/footer.php");