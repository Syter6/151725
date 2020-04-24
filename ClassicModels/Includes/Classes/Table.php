<?php


class Table{
	public $table_name;
	public $column_names;
	public $db;

	function __construct($table_name) {
		global $db;

		$this->table_name = $table_name;
		$this->column_names = $this->GetColumnNames();
		$this->db = $db;
	}

	function GetColumnNames(){
		$sth = getTableDescription($this->table_name);
		$cn = array();

		while($row = $sth->fetch()){
			array_push($cn, $row['Field']);
		}

		return $cn;
	}

	function ShowDataTableHeader($include_action=true){
		echo "<tr>";

		for($i = 0; $i < count($this->column_names); $i++){
			echo "<th>" . $this->column_names[$i] . "</th>";
		}

		if($include_action){
			echo "<th>Actions</th>";
		}
		echo "</tr>";
	}

	function ShowDataTable(){
		$sql = "SELECT * FROM " . $this->table_name;
		$sth = $this->db->prepare($sql);
		$sth->execute();

		$even = true;

		echo "<div class='dataTableHolder'>";
		echo "<table class='dataTable'>";

		$this->ShowDataTableHeader();

		//table headings//
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

	function ShowTableDetails($sql, $include_action=false){
		$sth = $this->db->prepare($sql);
		$sth->execute();

		if($sth->fetch()){
			echo "<div class='dataTableHolder'>";
			echo "<table class='dataTable'>";

			$this->ShowDataTableHeader($include_action);

			while($row = $sth->fetch()){
				echo "<tr>";
				for($i = 0; $i < count($this->column_names); $i++){
					echo "<td> " . $row[$this->column_names[$i]] . "</td>";
				}
				echo "</tr>";
			}

			echo "</table>";
			echo "</div>";
		}else{
			echo "<h3 id='emptyMessage'>This table is empty</h3>";
		}
	}

}
