<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
	
	$con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');
	
	if ($con) {
		
		
		$stmt = $con->prepare("SELECT `exp_level` From `exp_levels`");
		
		$stmt->execute();
		
		$result = $stmt->execute();
		
		if ($result) {//check if any data exists
			
			$stmt->bind_result($expLevel);
			
			/* fetch values */
			while ($stmt->fetch()) {
				echo"<option>".$expLevel."</option>";
			}
		
		} else {
			echo "ERROR WHILE COMMUNICATING WITH HOST";
		}
		
		$stmt->close();
		
	} else {
		echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
	}
	
	$con->close();

?>