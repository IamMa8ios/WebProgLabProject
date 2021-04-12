<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
	
	
	$con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');
	
	if ($con) {
		$Action = $_POST['action'];
		
		if (isset($Action)) {
			
			if ($Action == 'Log In') {
				
				// get the post records
				$Username = $_POST['username'];
				$Password = $_POST['password'];
				
				if (isset($Username) && isset($Password)) {//check if input was given
					
					$stmt = $con->prepare("SELECT `username` FROM `freelancers` WHERE `username`=?");
					$stmt->bind_param("s", $Username);
					
					$stmt->execute();
					
					$result = $stmt->get_result();
					
					if (mysqli_num_rows($result) == 1) {//check if username exists
						
						$stmt = $con->prepare("SELECT `username` FROM `freelancers` WHERE `username`=? AND `pass`=?");
						$stmt->bind_param("ss", $Username, $Password);
						
						$stmt->execute();
						
						$result = $stmt->get_result();
						
						if (mysqli_num_rows($result) == 1) {//check if username and password match
							
							$stmt = $con->prepare("SELECT `current_status` FROM `freelancers` WHERE `username`=? AND `pass`=?");
							$stmt->bind_param("ss", $Username, $Password);
							
							$stmt->execute();
							
							session_start();
							$_SESSION["username"] = $Username;
							
							$stmt->bind_result($status);
							$stmt->fetch();
							
							if ($status == 'Confirmed') {
								$_SESSION['active'] = 'yes';
								$stmt->close();
								$con->close();
								header("Location: index-freelancer.php");
							} else {
								$_SESSION['active'] = 'no';
								$stmt->close();
								$con->close();
								header("Location: index-pending.php");
							}
							
						} else {
							// remove all session variables
							session_unset();
							
							// destroy the session
							session_destroy();
							echo "WRONG PASSWORD";
						}
					} else {
						// remove all session variables
						session_unset();
						
						// destroy the session
						session_destroy();
						echo "USERNAME NOT FOUND";
					}
					
					
				}
			} elseif ($Action == 'Register') {
				
				$Username = $_POST['username'];
				$Email = $_POST['email'];
				$Password = $_POST['password'];
				
				if (isset($Username) && isset($Password) && isset($Email)) {
					
					$stmt = $con->prepare("SELECT `username` FROM `freelancers` WHERE `username`=?");
					$stmt->bind_param("s", $Username);
					
					$stmt->execute();
					
					$result = $stmt->get_result();
					
					if (mysqli_num_rows($result) == 0) {//check if username already exists
						
						$stmt = $con->prepare("SELECT `email` FROM `freelancers` WHERE `email`=?");
						$stmt->bind_param("s", $Email);
						
						$stmt->execute();
						
						$result = $stmt->get_result();
						
						if (mysqli_num_rows($result) == 0) {//check if email already exists
							
							$stmt = $con->prepare("INSERT INTO `freelancers` (`username`, `email`, `pass`) VALUES (?, ?, ?)");
							$stmt->bind_param("sss", $Username, $Email, $Password);
							
							$stmt->execute();
							
							$stmt->close();
							$con->close();
							
							session_start();
							$_SESSION["username"] = $Username;
							
							header("Location: index-freelancer.php");
						} else {
							// remove all session variables
							session_unset();
							
							// destroy the session
							session_destroy();
							echo "EMAIL ALREADY IN USE";
						}
						
					} else {
						// remove all session variables
						session_unset();
						
						// destroy the session
						session_destroy();
						echo "USERNAME TAKEN";
					}
					
				}
				
			}
			
		}
		
	} else {
		echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
	}


?>