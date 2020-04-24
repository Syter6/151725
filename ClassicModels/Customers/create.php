<?php
	$title = "Create Customer";
	include("../Includes/header.php");

	$table_name = "Customers";

	$form = new Form("Customers");
	$form->CreateForm();

	$input_data = get_input_data($table_name);

	if(required_filled($input_data, $table_name)){
		insert_data($table_name, $input_data);
	}

	include("../Includes/footer.php");