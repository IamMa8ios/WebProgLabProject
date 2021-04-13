<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
	
	
	if (isset($_POST['action'])) {//page reached by legal means
		
		if ($_POST['action'] == 'Log In') {//check purpose
			
			if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {//check if credentials were given
				
				$con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');
				
				if ($con) {//connection established
					
					if ($_POST['role'] != 'Freelancer' && $_POST['role'] != 'Business' && $_POST['role'] != 'Admin') {
						echo "YOU MUST CHOOSE A ROLE BEFORE YOU CAN CONTINUE";
						return;
					}
					
					//check if username is registered
					$stmt = $con->prepare("SELECT `username` FROM `users` WHERE `username`=?");
					$stmt->bind_param("s", $_POST['username']);
					$stmt->execute();
					$result = $stmt->get_result();
					
					if (mysqli_num_rows($result) == 1) {//username found
						
						$stmt->free_result();
						$stmt = $con->prepare("SELECT `username` FROM users WHERE `username`=? AND `pass`=?");
						$stmt->bind_param("ss", $_POST['username'], $_POST['password']);
						$stmt->execute();
						$result = $stmt->get_result();
						
						if (mysqli_num_rows($result) == 1) {//check if username and password match
							
							$stmt = $con->prepare("SELECT `status` FROM users WHERE `username`=? AND `pass`=?");
							$stmt->bind_param("ss", $_POST['username'], $_POST['password']);
							$stmt->execute();
							
							session_start();
							$_SESSION["username"] = $_POST['username'];
							$_SESSION['role'] = $_POST['role'];
							
							$stmt->bind_result($status);
							$stmt->fetch();
							
							if ($status == 'Active') {
								$_SESSION['active'] = 'yes';
								$stmt->close();
								$con->close();
								
								header("Location: index-".strtolower($_POST['role']).".php");
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
							return;
						}
					} else {
						// remove all session variables
						session_unset();
						
						// destroy the session
						session_destroy();
						echo "USERNAME NOT FOUND";
						return;
					}
					
				} else {
					echo "ERROR WHILE CONTACTING HOST";
					return;
				}
				
			}else{
				echo "PLEASE FILL EVERYTHING BEFORE CONTINUEING";
				return;
			}
			
		}elseif ($_SESSION['action'] == 'Register') {
			
			if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['role'])) {
				
				if ($_POST['role'] == 'Freelancer') {
					$table='freelancers';
				}elseif ($_POST['role'] == 'Business') {
					$table='businesses';
				}elseif ($_POST['role'] == 'Admin') {
					$table='admins';
				}else{
					return;
				}
				
				$con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');
				$stmt = $con->prepare("SELECT `username` FROM users WHERE `username`=?");
				$stmt->bind_param("s", $_POST['email']);
				
				$stmt->execute();
				
				$result = $stmt->get_result();
				
				if (mysqli_num_rows($result) == 0) {//check if username already exists
					
					$stmt = $con->prepare("SELECT `email` FROM users WHERE `email`=?");
					$stmt->bind_param("s", $table, $_POST['email']);
					
					$stmt->execute();
					
					$result = $stmt->get_result();
					
					if (mysqli_num_rows($result) == 0) {//check if email already exists
						
						$stmt = $con->prepare("INSERT INTO users (`username`, `email`, `pass`, `role`) VALUES (?, ?, ?, ?)");
						$stmt->bind_param("ssss", $_POST['username'], $_POST['email'], $_POST['password'], $_POST['role']);
						
						$stmt->execute();
						
						session_start();
						$_SESSION['username'] = $_POST['username'];
						$_SESSION['role'] = $_POST['role'];
						$_SESSION['active']='no';
						
						$stmt->close();
						$con->close();
						
						header("Location: index-freelancer.php");
					} else {
						$stmt->close();
						$con->close();
						header("Location: session-close.php");
					}
					
				} else {
					$stmt->close();
					$con->close();
					header("Location: session-close.php");
				}
				
				$stmt->close();
				$con->close();
				
			}
			
		}else {
			header("Location: login.php");
		}
		
	} else {
		echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
	}


?>