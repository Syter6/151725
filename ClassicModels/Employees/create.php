<?php
	$title = "Create Employee";
	include("../Includes/header.php");

	$table_name = "Employee";

	createForm($table_name, false);

	$input_data = get_input_data($table_name);

	if(required_filled($input_data, $table_name)) {
		insert_data($table_name, $input_data);
	}

	include("../Includes/footer.php");