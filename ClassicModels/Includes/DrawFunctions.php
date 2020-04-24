<?php
	include("connectdb.php");

	function createOrderEditForm($filling=true){
		global $db;

		if($filling) {
			$num = isset($_GET["id"]) ? $_GET["id"] : null;
			$sql = "SELECT o.orderNumber, o.orderDate, o.requiredDate, o.shippedDate, o.status, o.comments, c.customerName 
		FROM orders AS o JOIN customers AS c USING(customerNumber) 
		WHERE o.orderNumber = $num";

			$sth = $db->prepare($sql);
			$sth->execute();

			$data = $sth->fetch();
		}else{
			$data = array(
				"orderNumber"=>"",
				"orderDate"=>"",
				"requiredDate"=>"",
				"shippedDate"=>"",
				"status"=>"",
				"comments"=>""
			);
		}
		?>
			<form method="post">
                <?php
                    if($filling){
                        ?>
                        <input type="hidden" id="customerNumber" name="customerNumber">
                        <label for='orderDate'>Order Date: </label>
                        <input type="text" id="orderDate" readonly name="orderDate" value="<?php echo $data['orderDate'] ?>"/>
                        <?php
                    }
                    else{
                        ?>
                        <label for="customerNumber">Customer Number</label>
                        <input type="text" id="customerNumber" name="customerNumber"><br/>
                        <label for="orderDate">Order Date:</label>
                        <input type="text" id="orderDate" name="orderDate" placeholder="YYYY-MM-DD"/>
                        <?php
                    }
                ?>
				<input type="hidden" name="orderNumber" value="<?php echo $data['orderNumber'] ?>"/><br/>
				<label for="requiredDate">Required Date: </label>
				<input type="text" id="requiredDate" name="requiredDate" value="<?php echo $data['requiredDate'] ?>"/><br/>
				<label for="shippedDate">Shipped date: </label>
				<input type="text" id="shippedDate" name="shippedDate" value="<?php echo $data['shippedDate'] ?>"/><br/>
				<label for="status">Status: </label>
				<select style='display: inline' name="status" id="status">
					<option value="Shipped">Shipped</option>
					<option value="Resolved">Resolved</option>
					<option value="Cancelled">Cancelled</option>
					<option value="On Hold">On Hold</option>
					<option value="Disputed">Disputed</option>
					<option value="InProcess">In Process</option>
				</select><br/>
				<label for="comments">Comments: </label>
				<input type="text" id="comments" name="comments" value="<?php echo $data['comments'] ?>"/><br/>
				<input type="submit" value="sla op"/>
			</form>
		<?php
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

