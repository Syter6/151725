<?php
	$title = "Edit Office";
	include("../Includes/header.php");

	createForm("Offices", true);

	$input_data = get_input_data("Offices");

	if(required_filled($input_data, "Offices")){
		edit_data("Offices", $input_data);
	}

	include("../Includes/footer.php");