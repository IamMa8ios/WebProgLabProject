<?php
	
	function connect()
	{
		
		/* Attempt to connect to MySQL database */
		$mysqli = new mysqli('localhost', 'root', '', 'icarus');
		
		// Check connection
		if ($mysqli === false) {
			die("ERROR: Could not connect. " . $mysqli->connect_error);
		}
		
		return $mysqli;
	}
	
	function disconnect($mysqli)
	{
		$mysqli->close();
	}
	
	function getStatement($mysqli, $sql)
	{
		
		if ($mysqli) {
			if ($stmt = $mysqli->prepare($sql)) {
				return $stmt;
			}
		}
		
		return null;
	}
	
	function executeUpdate($stmt)
	{
		
		$executed = false;
		
		if ($stmt) {
			
			if ($stmt->execute()) {
				$executed = true;
			}
			
			$stmt->close();
		}
		
		
		return $executed;
		
	}
	
	function fetchResults($stmt)
	{
		
		$data = array();
		
		if ($stmt) {
			
			if ($stmt->execute()) {
				
				$results = $stmt->get_result();
				
				while ($row = $results->fetch_assoc()) {
					array_push($data, $row);
				}
				
			}
			
			$stmt->close();
		}
		
		return $data;
		
	}
	
	function sessionCheck()
	{
		
		if (session_status() != PHP_SESSION_ACTIVE) {
			session_start();
		}
		
		if (!isset($_SESSION)) {
			$_SESSION['loggedin'] = false;
			$_SESSION['role'] = 0;
		} else {
			
			if (!isset($_SESSION['loggedin'])) {
				$_SESSION['loggedin'] = false;
				$_SESSION['role'] = 0;
			}
			
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
				header("Location: index-guest.php");
				exit();
			}
			
			if (!isset($_SESSION['username'])) {
				header("Location: login.php");
				exit();
			}
			
			if (!isset($_SESSION['status'])) {
				header("Location: login.php");
				exit();
			}
			
			if (!isset($_SESSION['role'])) {
				header("Location: login.php");
				exit();
			}
			
			if (!isset($_SESSION['id'])) {
				header("Location: login.php");
				exit();
			}
			
		}
	}
	
	function iHaveLogged()
	{
		
		if (session_status() != PHP_SESSION_ACTIVE) {
			session_start();
		}
		
		if (!isset($_SESSION)) {
			return false;
		}
		
		if (!isset($_SESSION['username'])) {
			return false;
		}
		
		if (!isset($_SESSION['role'])) {
			return false;
		}
		
		if (!isset($_SESSION['id'])) {
			return false;
		}
		
		if (!isset($_SESSION['status'])) {
			return false;
		}
		
		return true;
		
	}
	
	function iAmProfessor()
	{
		
		if (iHaveLogged()) {
			if ($_SESSION['role'] != 2) {
				return -1;
			}
			
			if ($_SESSION['status'] != 'Active') {
				return 0;
			}
			
			return 1;
		}
		
		return -1;
		
	}
	
	function iAmStudent()
	{
		
		if (iHaveLogged()) {
			if ($_SESSION['role'] != 3) {
				return -1;
			}
			
			if ($_SESSION['status'] != 'Active') {
				return 0;
			}
			
			return 1;
			
		}
		
		return -1;
	}
	
	function sessionClose()
	{
		session_start();
		
		// remove all session variables
		session_unset();
		
		unset($_SESSION);
		//$_SESSION=[];
		
		// destroy the session
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	function debugTable($table)
	{
		
		echo "<br>";
		echo "<pre>";
		print_r($table);
		echo "</pre>";
		echo "<br>";
		
	}
	
	function displayError($errorMsg)
	{
		if ($errorMsg != "") {
			echo $errorMsg; ?>
            <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    <button type="button" onclick="window.history.back();" class="login100-form-btn">Back</button>
                </div>
            </div>
		<?php }
	}

?>





















