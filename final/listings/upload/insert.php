<?php
	
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
					
					include_once "../../account/config.php";
					
					if ($mysqli){
						
						$mysqli->autocommit(false);
						
						$id_results=array();
						
						session_start();
						//find user id
						$stmt = $mysqli->prepare("SELECT `id` FROM `users` WHERE `username`=?");
						$stmt->bind_param("s", $_SESSION['username']);
						//echo "username ".$_SESSION['username']."<br>";
						$stmt->execute();
						$stmt->bind_result($text);
						$stmt->fetch();
						array_push($id_results, $text);
						$stmt->free_result();
						
						//get id for job level
						$stmt = $mysqli->prepare("SELECT `id` FROM `exp_levels` WHERE `exp_level`=?");
						$stmt->bind_param("s", $_POST['exp_level']);
						$stmt->execute();
						$stmt->bind_result($text);
						$stmt->fetch();
						array_push($id_results, $text);
						$stmt->free_result();
						
						//get id for payment rate
						$stmt = $mysqli->prepare("SELECT `id` FROM `payment_rates` WHERE `rate`=?");
						$stmt->bind_param("s", $_POST['rate']);
						$stmt->execute();
						$stmt->bind_result($text);
						$stmt->fetch();
						array_push($id_results, $text);
						$stmt->free_result();
						
						$stmt = $mysqli->prepare("INSERT INTO
    					listings (userID, job_title, job_level, payment_amount, payment_rate, techs, location, description)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
						$stmt->bind_param("isidisss", $id_results[0], $jobTitle, $id_results[1], $amount, $id_results[2], $techs, $location, $description);
						
						$stmt->execute();
						
						$mysqli->commit();
						$mysqli->autocommit(true);
						
						$stmt->close();
						$mysqli->close();
						
						header("Location: history.php");
						
					}
					
				}
				
			}
			
		}
		
	}
?>


