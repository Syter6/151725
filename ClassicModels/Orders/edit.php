<?php
$title = "Edit Order";
include("../Includes/header.php");

$table_name = "Orders";

createOrderEditForm();


$data = array(
	"orderNumber"=>$_POST["orderNumber"],
	"orderDate"=> $_POST["orderDate"],
	"requiredDate"=>$_POST["requiredDate"],
	"shippedDate" => $_POST["shippedDate"],
	"status" => $_POST["status"],
	"comments" => $_POST["comments"]
);

if($data["orderDate"] != null){
	UpdateOrders($data);
}

include("../Includes/footer.php");