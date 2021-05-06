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
		disconnect($mysqli);
	}
	
	function uploadListing($data, $action){
		
		$con=connect();
		
		if ($con){
			
			$con->autocommit(false);
			
			$sql="SELECT `id` FROM `payment_rates` WHERE `rate`=?";
			$stmt=getStatement($con, $sql);
			
			if($stmt){
				
				$stmt->bind_param("s", $data['rate']);
				$result=fetchResults($stmt);
				
				if (sizeof($result)==1){
				
					$rateID=$result[0]['id'];
					$sql="SELECT `id` FROM `exp_levels` WHERE `exp_level`=?";
					$stmt=getStatement($con, $sql);
					
					if($stmt){
						
						$stmt->bind_param("s", $data['exp_level']);
						$result=fetchResults($stmt);
						
						if (sizeof($result)==1){
							
							$expID=$result[0]['id'];
							
							if($action=='Create'){
								$sql="INSERT INTO `listings`(`userID`, `job_title`, `job_level`, `payment_amount`,
                       					`payment_rate`, `techs`, `location`, `description`)
										VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
								$stmt=getStatement($con, $sql);
								$stmt->bind_param("isidisss", $_SESSION['id'], $data['job_title'], $data['exp_level'],
								$data['amount'], $data['rate'], $data['techs'], $data['location'], $data['description']);
							}elseif ($action=='Update'){
								$sql="UPDATE `listings` SET `job_title`=?, `job_level`=?, `payment_amount`=?, `payment_rate`=?,
                      					`techs`=?, `location`=?, `description`=?, `last_edit`=CURRENT_TIMESTAMP()
										WHERE `userID`=? AND `id`=?;";
								$stmt=getStatement($con, $sql);
								$stmt->bind_param("sidisssii", $data['job_title'], $expID, $data['amount'], $rateID,
									$data['techs'], $data['location'], $data['description'], $_SESSION['id'], $data['id']);
							}
							
							executeUpdate($stmt);
							
						}else{
							header("Location: 500.php");
							exit();
						}
						
					}else{
						header("Location: 500.php");
						exit();
					}
				}else{
					header("Location: 500.php");
					exit();
				}
				
			}else{
				header("Location: 500.php");
				exit();
			}
			
			$con->autocommit(true);
			
			disconnect($con);
			
			header("Location: pages-user-listings-history.php");
			exit();
			
		}
		
	}
?>