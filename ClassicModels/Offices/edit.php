<?php
	$title = "Edit Office";
	include("../Includes/header.php");

	$form = new Form("Offices");
	$form->CreateForm(true);

	if(required_filled($input_data, "Offices")){
		edit_data("Offices", $input_data);
	}

	include("../Includes/footer.php");