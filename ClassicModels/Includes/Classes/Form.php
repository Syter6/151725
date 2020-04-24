<?php


class Form{
	public $table_name;
	public $collumn_names;
	public $db;

	function __construct($table_name){
		global $db;

		$this->table_name = $table_name;
		$this->collumn_names = $this->GetCollummNames();
		$this->db = $db;
	}

	function GetCollummNames(){
		$sth = getTableDescription($this->table_name);
		$cn = array();

		while($row = $sth->fetch()){
			array_push($cn, $row['Field']);
		}

		return $cn;
	}

	function CreateForm($filled=false){
		$pk = $this->collumn_names[0];
		$id = isset($_GET["id"]) ? $_GET["id"] : null;

		echo "<form method='post'>";

		if($filled){
			$sql = "SELECT * FROM $this->table_name WHERE " . $pk . "= '" . $id . "'";
			$sth = $this->db->prepare($sql);
			$sth->execute();

			$row = $sth->fetch();

			echo "<div class='inputField'>";
			echo "<label for='pk'>$pk:</label>";
			echo "<input type='text' id='$pk' name='$pk' value='$row[0]'>";
			echo "</div>";
		}

		for($i = 1; $i < count($this->collumn_names); $i++){
			$cnv = $this->collumn_names[$i];
			echo "<div class='inputField'>";
			echo "<label for='$cnv'>$cnv</label>";
			if($filled){
				echo "<input type='text' name='$cnv' value='$row[$cnv]'/>";
			}else{
				echo "<input type='text' name='$cnv'/>";
			}
			echo "</div>";
		}

		echo "<input type='submit' value='Sla Op'/>";
		echo "</form>";
	}
}