<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
	
	
	if (isset($_POST['action'])) {//page reached by legal means
		
		if ($_POST['action'] == 'Log In') {//check purpose
			
			if (isset($_POST['username']) && isset($_POST['password'])) {//check if credentials were given
				
				$con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');
				
				if ($con) {//connection established
					
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
							
							$stmt->free_result();
							session_start();
							$_SESSION['username'] = $_POST['username'];
							
							$stmt = $con->prepare("SELECT `status` FROM users WHERE `username`=? AND `pass`=?");
							$stmt->bind_param("ss", $_POST['username'], $_POST['password']);
							$stmt->execute();
							
							$stmt->bind_result($status);
							$stmt->fetch();
							
							$_SESSION['status']=$status;
							
							$stmt->free_result();
							
							$stmt = $con->prepare("SELECT `role` FROM users WHERE `username`=? AND `pass`=?");
							$stmt->bind_param("ss", $_POST['username'], $_POST['password']);
							$stmt->execute();
							
							$stmt->bind_result($role);
							$stmt->fetch();
							
							$_SESSION['role']=$role;
							
							$stmt->free_result();
							
							$con->autocommit(false);
							$stmt = $con->prepare("UPDATE  `users` SET `last_login`=CURRENT_TIMESTAMP() WHERE `username`=? AND `pass`=?");
							$stmt->bind_param("ss", $_POST['username'], $_POST['password']);
							$stmt->execute();
							$con->commit();
							$con->autocommit(true);
							
							$stmt->close();
							$con->close();
							
							header("Location: index.php");
							
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
			
		}elseif ($_POST['action'] == 'Register') {
			
			if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
				
				
				$con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');
				$stmt = $con->prepare("SELECT `username` FROM users WHERE `username`=?");
				$stmt->bind_param("s", $_POST['username']);
				
				$stmt->execute();
				
				$result = $stmt->get_result();
				
				
				if (mysqli_num_rows($result) == 0) {//check if username already exists
					
					$stmt->free_result();
					$stmt = $con->prepare("SELECT `email` FROM users WHERE `email`=?");
					$stmt->bind_param("s", $table, $_POST['email']);
					
					$stmt->execute();
					
					$result = $stmt->get_result();
					
					if (mysqli_num_rows($result) == 0) {//check if email already exists
						
						$stmt->free_result();
						$con->autocommit(false);
						$stmt = $con->prepare("INSERT INTO users (`username`, `email`, `pass`, `role`) VALUES (?, ?, ?, ?)");
						$stmt->bind_param("ssss", $_POST['username'], $_POST['email'], $_POST['password'], $_POST['role']);
						
						$stmt->execute();
						$con->commit();
						$con->autocommit(true);
						
						$stmt->close();
						$con->close();
						
						session_start();
						$_SESSION['username']=$_POST['username'];
						$_SESSION['role']=$_POST['role'];
						$_SESSION['status']='Pending Confirmation';
						
						header("Location: index.php");
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