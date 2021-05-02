<?php
	
	include_once "../../query-executor.php";

	$mysqli=connect();

	if ($mysqli) {
		
		$stmt = getStatement($mysqli,"SELECT `rate` From `payment_rates` ORDER BY id ASC");
		$result = fetchResults($stmt);
		
		if (sizeof($result)>0) {//check if any data exists

			for ($i=0;$i<sizeof($result);$i++){
				echo"<option>". $result[$i]['rate'] ."</option>";
			}
			
		} else {
			echo "ERROR WHILE COMMUNICATING WITH HOST";
		}

        disconnect($mysqli);
	} else {
		echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
	}


?>