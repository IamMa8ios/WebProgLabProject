<?php
	
	function logGuest(){
		$mysqli=connect();
		
		$sql="INSERT INTO `guest_log`(`id`) VALUES(NULL);";
		
		if($mysqli){
			$stmt=getStatement($mysqli, $sql);
			
			if ($stmt){
				$mysqli->autocommit(false);
				executeUpdate($stmt);
				$mysqli->commit();
				$mysqli->autocommit(true);
			}
		}
		
	}
	
	function uploadListing(){
		
		if (isset($_POST)) {//check if data was given
			
			$submitted = $_POST['submit_button'];
			
			if (isset($submitted)) {//check if it came through a valid channel
				
				if ($submitted == 'freelancer_listing') {//check type of listing
					
					$exp_level = $_POST['exp_level'];
					$rate=$_POST['rate'];
					$jobTitle = $_POST['job_title'];
					$amount = doubleval($_POST['amount']);
					$techs = $_POST['techs'];
					$location = $_POST['location'];
					$description = $_POST['description'];
					
					if (isset($jobTitle) && isset($amount) && isset($techs) && isset($location) && isset($description) &&
						isset($rate) && isset($exp_level) && $rate!='Choose option' && $exp_level!='Choose option'){
						
						$con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');
						
						if ($con){
							
							$con->autocommit(false);
							
							$id_results=array();
							
							session_start();
							//find user id
							$stmt = $con->prepare("SELECT `id` FROM `users` WHERE `username`=?");
							$stmt->bind_param("s", $_SESSION['username']);
							//echo "username ".$_SESSION['username']."<br>";
							$stmt->execute();
							$stmt->bind_result($text);
							$stmt->fetch();
							array_push($id_results, $text);
							$stmt->free_result();
							
							//get id for job level
							$stmt = $con->prepare("SELECT `id` FROM `exp_levels` WHERE `exp_level`=?");
							$stmt->bind_param("s", $_POST['exp_level']);
							$stmt->execute();
							$stmt->bind_result($text);
							$stmt->fetch();
							array_push($id_results, $text);
							$stmt->free_result();
							
							//get id for payment rate
							$stmt = $con->prepare("SELECT `id` FROM `payment_rates` WHERE `rate`=?");
							$stmt->bind_param("s", $_POST['rate']);
							$stmt->execute();
							$stmt->bind_result($text);
							$stmt->fetch();
							array_push($id_results, $text);
							$stmt->free_result();
							
							$stmt = $con->prepare("INSERT INTO
    					listings (userID, job_title, job_level, payment_amount, payment_rate, techs, location, description)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
							$stmt->bind_param("isidisss", $id_results[0], $jobTitle, $id_results[1], $amount, $id_results[2], $techs, $location, $description);
							
							$stmt->execute();
							
							$con->commit();
							$con->autocommit(true);
							
							$stmt->close();
							$con->close();
							
							header("Location: pages-user-listings-history.php");
							exit();
							
						}
						
					}
					
				}
				
			}
			
		}
	}
?>