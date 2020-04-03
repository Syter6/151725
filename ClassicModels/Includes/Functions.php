<?php
	include("connectdb.php");

	function getTableDescription($table_name){
		global $db;

		$sql = "DESCRIBE $table_name";

		$sth = $db->prepare($sql);
		$sth->execute();

		return $sth;
	}

	function getRequired($table_name){
		$sth = getTableDescription($table_name);

		$data = $sth->fetchall();
		$reqs = array();

		for($i = 0; $i < count($data); $i++){
			if($data[$i]["Null"] == "NO"){
				array_push($reqs, $data[$i]["Field"]);
			}
		}

		return $reqs;
	}

	function getCollumnNames($table_name){

		$sth = getTableDescription($table_name);

		$cn = array();

		while($row = $sth->fetch()){
			array_push($cn, $row["Field"]);
		}

		return $cn;
	}

	function required_filled($inputs, $table_name)
	{
		$valid = true;

		$required = getRequired($table_name);

		for ($i = 0; $i < count($inputs); $i++) {
			for($j = 0; $i < count($required); $i++){
				if($inputs[$i] == $required[$j]){
					if($inputs[$i] == null){
						$valid = false;
					}
				}
			}
		}

		return $valid;
	}

	function get_input_data($table_name){
		$cn = getCollumnNames($table_name);

		$ret = array();

		for($i = 0; $i < count($cn); $i++){
			$ret[$i] = isset($_POST[$cn[$i]]) ? $_POST[$cn[$i]] : null;
		}

		return $ret;
	}

	function get_highest_key($table_name, $pk){
		global $db;

		$sql = "SELECT MAX($pk) FROM $table_name";

		$sth = $db->prepare($sql);
		$sth->execute();

		$hpk = $sth->fetch()[0] + 1;
		return $hpk;
	}

	function get_pk($table_name){
		$cn = getCollumnNames($table_name);

		return $cn[0];

	}

	function edit_data($table_name, $data, $pkEditAble = false){
		$cn = getCollumnNames($table_name);
		global $db;

		$id = isset($_GET["id"]) ? $_GET["id"] : null;

		$first = true;

		$pk = get_pk($table_name);

		$sql = "UPDATE $table_name SET $pk = $id, ";

		for($i = 1; $i < count($cn); $i++){
			if($first){
				$sql .= "$cn[$i] = '$pk'";
				$first = false;
			}
			else{
				$sql .= ", $cn[$i] = '$data[$i]'";
			}
		}

		$sql .= " WHERE $cn[0] = $id";

		try{
			$sth = $db->prepare($sql);
			$sth->execute();
			Header("Location: index.php");
			echo "Couldn't edit data. please try again or get help";
		}
		catch(Exception $e){
//			echo "<p><b>Error:</b>: " . $e->getMessage() . "</p>";
		}

	}

	function insert_data($table_name, $data, $string_pk = false){
		global $db;

		$cn = getCollumnNames($table_name);
		$pk = get_highest_key($table_name, $cn[0]);

		$sql = "INSERT INTO $table_name (";

		$first = true;

		for($i = 0; $i < count($cn); $i++){
			if(!$first) {
				$sql .= ", " . $cn[$i];
			}else{
				$sql .= $cn[$i];
				$first = false;
			}
		}

		$first = true;
		$sql .= ") VALUES (";

		for($i = 0; $i < count($cn); $i++){
			if(!$first){
				$sql .= ", '" . $data[$i] . "'";
			}else{
				if($string_pk){
					$sql .= "' " . $data[$i] . "'";
				}else{
					$sql .= $pk;
				}
				$first = false;
			}
		}

		$sql .= ")";

		try{
			$sth = $db->prepare($sql);
			$sth->execute();
			Header('Location: index.php');
		}
		Catch(Exception $e){
//			echo "<p><b>Error:</b>: " . $e->getMessage() . "</p>";
		}


	}