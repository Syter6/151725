<?php
	$title = "Edit ProductLine";
	include("../Includes/header.php");

	createForm("ProductLines", true, true);

	$input_data = get_input_data("ProductLines");

	if(required_filled($input_data, "ProductLines")){
		edit_data("ProductLines", $input_data);
	}

	include("../Includes/footer.php");