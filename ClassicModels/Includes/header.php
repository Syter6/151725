<?php
	if(!isset($title)){
		$title = "";
	}

	$singular = substr($title, 0, -1);

	if(!isset($showButton)){
	    $showButton = false;
    }

	include("Functions.php");
	include("DrawFunctions.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Classicmodels - <?php echo $title ?></title>
		<link rel="stylesheet" href="../CSS/style.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="../Scripts/Functions.js"></script>
    </head>
	<body>
		<header id="mainHeader">
			<h2>Classic Models <?php echo "- $title" ?></h2>
			<?php
				if($showButton){
					echo "<button class='newButton'><a id='newLink' style='color: #ffffff' href='create.php'>Create new $singular</a></button>";
				}
			?>
			<ul>
				<a href="../Customers/"><li>Customers</li></a>
				<a href="../Employees/"><li>Employees</li></a>
				<a href="../Offices/"><li>Offices</li></a>
				<a href="../ProductLines"><li>ProductLines</li></a>
			</ul>
		</header>
        <main>
