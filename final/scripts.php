<?php
	
	function connect(){
		
		/* Attempt to connect to MySQL database */
		$mysqli = new mysqli('localhost', 'root', '', 'bytes4hire');
		
		// Check connection
		if($mysqli === false){
			die("ERROR: Could not connect. " . $mysqli->connect_error);
		}
		
		return $mysqli;
	}
	
	function disconnect($mysqli){
		$mysqli->close();
	}
	
	function getStatement($mysqli, $sql){
		
		if($mysqli) {
			if ($stmt = $mysqli->prepare($sql)) {
				return $stmt;
			}
		}
		
		return null;
	}
	
	function executeUpdate($stmt){
		
		$executed=false;
		
		if($stmt){
			
			if($stmt->execute()){
				$executed=true;
			}
			
			$stmt->close();
		}
		
		
		return $executed;
		
	}
	
	function fetchResults($stmt){
		
		$data=array();
		
		if($stmt){
			
			if($stmt->execute()){
				
				$results = $stmt->get_result();
				
				while ($row = $results->fetch_assoc()) {
					array_push($data, $row);
				}
				
			}
			
			$stmt->close();
		}
		
		return $data;
		
	}
	
	function sessionCheck(){
		
		if (session_status() != PHP_SESSION_ACTIVE) {
			session_start();
		}
		
		if (!isset($_SESSION)) {
			$_SESSION['loggedin'] = false;
			$_SESSION['role'] = 'Guest';
			header("Location: index-guest.php");
			exit();
		} else {
			
			if (!isset($_SESSION['loggedin'])) {
				$_SESSION['loggedin'] = false;
				$_SESSION['role'] = 'Guest';
			}
			
			if($_SESSION['role']=='Guest'){
				header("Location: index-guest.php");
				exit();
			}
			
			if (!isset($_SESSION['username'])) {
				header("Location: authentication-login.php");
				exit();
			}
			
			if (!isset($_SESSION['status'])) {
				header("Location: authentication-login.php");
				exit();
			}
			
			if ($_SESSION['status']!='Active') {
				header("Location: index-inactive.php");
				exit();
			}
			
			if (!isset($_SESSION['role'])) {
				header("Location: authentication-login.php");
				exit();
			}
			
			if (!isset($_SESSION['id'])) {
				header("Location: authentication-login.php");
				exit();
			}
			
		}
	}
	
	function sessionClose(){
		session_start();
		
		// remove all session variables
		session_unset();
		
		unset($_SESSION);
		//$_SESSION=[];
		
		// destroy the session
		session_destroy();
		header("Location: authentication-login.php");
		exit();
	}
	
	function debugTable($table){
		
		echo "<br>";
		echo "<pre>";
		print_r($table);
		echo "</pre>";
		echo "<br>";
		
	}
	
?>





















