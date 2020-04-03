<?php
	include("connectdb.php");

	function showDataTableHeading($table_name, $include_action = true){
		$cn = getCollumnNames($table_name);

		echo "<tr>";

		for($i = 0; $i < count($cn); $i++){
			echo "<th>" . $cn[$i] . "</th>";
		}

		if($include_action){
			echo "<th>Actions</th>";
		}
		echo "</tr>";
	}

	function showDataTable($table_name){
		global $db;

		$sql = "SELECT * FROM $table_name";
		$sth = $db->prepare($sql);
		$sth->execute();

		$even = true;

		echo "<div class='dataTableHolder'>";
		echo "<table class='dataTable'>";

		showDataTableHeading($table_name);

		#table headings#
		while($row = $sth->fetch()){

			$columnNum = 0;

			echo "<tr>";
			foreach($row as $column){
				$columnNum++;

				if($even){
					if($columnNum == 1){
						echo "<td><a href='details.php?id=$column'>$column</a></td>";
						$even = false;
					}if($columnNum > 1){
						echo "<td>$column</td>";
						$even = false;
					}
				}
				else{
					$even = true;
				}
			}

			echo "<td><a href='edit.php?id=$row[0]'>Edit</a></td>";
			echo "</tr>";
		}


		echo "</table>";
		echo "</div>";
	}

	function createForm($table_name, $filled, $string_pk = False){
		global $db;

		$column_names = getCollumnNames($table_name);

		$pk = $column_names[0];

		$id = isset($_GET["id"]) ? $_GET["id"] : null;

		if($filled){
			$sql = "SELECT * FROM $table_name WHERE $pk = '$id'";
			$sth = $db->prepare($sql);
			$sth->execute();

			$row = $sth->fetch();
		}

		echo "<form method='post'>";

		if($filled){
			echo "<div class='inputField'>";
			echo "<label for='pk'>$pk:</label>";
			$message = "You are not able to edit the primary key(id) of this table";
			if(!$string_pk){
				echo "<input type='text' id='$pk' name='$pk' disabled onclick='alert($message)' value='$row[0]'>";
			}else{
				echo "<input type='text' id='$pk' name='$pk' onclick='alert($message)' value='$row[0]'>";
			}
			echo "</div>";
		}

		for($i = 1; $i < count($column_names); $i++){
			echo "<div class='inputField'>";
			echo "<label for='$column_names[$i]'>$column_names[$i]</label>";

			if(!$filled){
				echo "<input type='text' name='$column_names[$i]'/>";
			}else{
				echo "<input type='text' name='$column_names[$i]' value='$row[$i]'/>";
			}
			echo "</div>";
		}

		echo "<input type='submit' value='Sla Op'/>";
		echo "</form>";
	}

	function showSelect($table_name){
		global $db;

		$sql = "SELECT * FROM $table_name";
		$sth = $db->prepare($sql);
		$sth->execute();

		echo "<form action='../Products/' method='get'/>";
		echo "<select name='id'>";
		while($row = $sth->fetch()){
			echo "<option value='$row[productLine]'>$row[productLine]</option>";
		}
		echo "<input type='submit' value='bekijk product soort'/>";
		echo "</select>";

	}

	function showDetailsTable($id, $sql, $table_name){
		global $db;

		$cn = getCollumnNames($table_name);

		$sth = $db->prepare($sql);
		$sth->execute();

		if($sth->fetch()) {

			echo "<div class='dataTableHolder'>";
			echo "<table class='dataTable'>";

			showDataTableHeading($table_name, false);

			while($row = $sth->fetch()){
				echo "<tr>";

				for($i = 0; $i < count($cn); $i++){
					echo "<td> " . $row[$cn[$i]] . "</td>";
				}

				echo "</tr>";
			}

			echo "</table>";
			echo "</div>";
		}else{
			echo "<h3 id='emptyMessage'>This table is empty</h3>";
		}
	}