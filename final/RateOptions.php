<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
	
	$con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');
	
	if ($con) {
		
		
		$stmt = $con->prepare("SELECT rate From `payment_rates` ORDER BY id ASC");
		
		$stmt->execute();
		
		$result = $stmt->execute();
		
		if ($result) {//check if any data exists
			
			$stmt->bind_result($rate);
			
			//fetch values
			while ($stmt->fetch()) {
				echo"<option>".$rate."</option>";
			}
			
		} else {
			echo "ERROR WHILE COMMUNICATING WITH HOST";
		}
		
		$stmt->close();
		$con->close();
		
	} else {
		echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
	}


?>