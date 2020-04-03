<?php
	$title = "Create Office";
	include("../Includes/header.php");

	$table_name = "Offices";

	createForm($table_name, false, true);

	$input_data = get_input_data($table_name);

	if(required_filled($input_data,$table_name)){
		insert_data($table_name, $input_data, true);
	}

	include("../Includes/footer.php");