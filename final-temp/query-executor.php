<?php
	function executeUpdate($sql, $types, $params){
		
		$queryExecuted=false;
		
		if ($stmt = $mysqli->prepare($sql)) {
			// Bind variables to the prepared statement as parameters
			
			if(count($params)>1){
				$param1=array_shift($params);
				$stmt->bind_param($types, $param1, $params);
			}else{
				$stmt->bind_param($types, $params);
			}
			
			$mysqli->autocommit(false);
			
			// Attempt to execute the prepared statement
			if ($stmt->execute()) {
				
				$queryExecuted=true;
				$mysqli->commit();
				
			} else {
				echo "Oops! Something went wrong. Please try again later.";
			}
			
			
			$mysqli->autocommit(true);
			// Close statement
			$stmt->close();
			
		}
		
		return $queryExecuted;
		
	}
	
	function fetchResults($sql, $types, $params){
		
		$results=array();
		
		if ($stmt = $mysqli->prepare($sql)) {
			// Bind variables to the prepared statement as parameters
			
			if(count($params)>1){
				$param1=array_shift($params);
				$stmt->bind_param($types, $param1, $params);
			}else{
				$stmt->bind_param($types, $params);
			}
			
			$mysqli->autocommit(false);
			
			// Attempt to execute the prepared statement
			if ($stmt->execute()) {
				// store result
				$stmt->store_result();
				
				
				
			} else {
				echo "Oops! Something went wrong. Please try again later.";
			}
			
			$mysqli->commit();
			$mysqli->autocommit(true);
			
			// Close statement
			$stmt->close();
		}
		
		
	}
	
?>