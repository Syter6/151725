<?php
	$title = "Create Order";
	include("../Includes/header.php");

	$table_name = "Orders";

	createOrderEditForm(false);

	if(dateInFuture($_POST["requiredDate"])){
		if(customerNumberExists($_POST["customerNumber"])) {
			$newOrderNumber = newOrderNumber();
			createNewOrder($newOrderNumber, $_POST);
		}
		else{
			echo "<p style='text-align: center'><b>Customer number doesn't exist</b></p>";
		}
	}else{
		echo "<p style='text-align: center'><b>Date has to be in future</b></p>";
	}

	include("../Includes/footer.php");