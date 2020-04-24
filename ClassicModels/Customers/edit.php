<?php
	$title = "Edit Customer";
	include("../Includes/header.php");

	$table_name = "Customers";

	$form = new Form("Customers");
	$form->CreateForm(true);

	$input_data = get_input_data($table_name);

	if(required_filled($input_data, $table_name)){
		edit_data($table_name, $input_data);
	}

	include("../Includes/footer.php");