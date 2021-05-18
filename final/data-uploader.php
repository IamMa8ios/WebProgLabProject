<?php
	
	function logGuest()
	{
		$mysqli = connect();
		
		$sql = "INSERT INTO `guest_log`(`id`) VALUES(NULL);";
		
		if ($mysqli) {
			$stmt = getStatement($mysqli, $sql);
			
			if ($stmt) {
				$mysqli->autocommit(false);
				executeUpdate($stmt);
				$mysqli->commit();
				$mysqli->autocommit(true);
			}
		}
		disconnect($mysqli);
	}
	
	function uploadListing($data, $action)
	{
		
		
		sessionCheck();
		
		$con = connect();
		
		if ($con) {
			
			$con->autocommit(false);
			
			$sql = "SELECT `id` FROM `payment_rates` WHERE `rate`=?";
			$stmt = getStatement($con, $sql);
			
			if ($stmt) {
				
				$stmt->bind_param("s", $data['rate']);
				$result = fetchResults($stmt);
				
				if (sizeof($result) == 1) {
					
					$rateID = $result[0]['id'];
					$sql = "SELECT `id` FROM `exp_levels` WHERE `exp_level`=?";
					$stmt = getStatement($con, $sql);
					
					if ($stmt) {
						
						$stmt->bind_param("s", $data['exp_level']);
						$result = fetchResults($stmt);
						
						if (sizeof($result) == 1) {
							
							$expID = $result[0]['id'];
							$amount = doubleval($data['amount']);
							
							if ($action == 'Create') {
								$sql = "INSERT INTO `listings`(`userID`, `job_title`, `job_level`, `payment_amount`,
                       					`payment_rate`, `techs`, `location`, `description`)
										VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
								$stmt = getStatement($con, $sql);
								$stmt->bind_param("isidisss", $_SESSION['id'], $data['job_title'], $expID,
									$amount, $rateID, $data['techs'], $data['location'], $data['description']);
							} elseif ($action == 'Update') {
								$sql = "UPDATE `listings` SET `job_title`=?, `job_level`=?, `payment_amount`=?, `payment_rate`=?,
                      					`techs`=?, `location`=?, `description`=?, `last_edit`=CURRENT_TIMESTAMP()
										WHERE `userID`=? AND `id`=?;";
								$stmt = getStatement($con, $sql);
								$stmt->bind_param("sidisssii", $data['job_title'], $expID, $data['amount'], $rateID,
									$data['techs'], $data['location'], $data['description'], $_SESSION['id'], $data['id']);
							}
							
							executeUpdate($stmt);
							
						} else {
							header("Location: 500.php");
							exit();
						}
						
					} else {
						header("Location: 500.php");
						exit();
					}
				} else {
					header("Location: 500.php");
					exit();
				}
				
			} else {
				header("Location: 500.php");
				exit();
			}
			
			$con->autocommit(true);
			
			disconnect($con);
			
			header("Location: pages-user-listings-history.php");
			exit();
			
		}
		
	}
	
	function editListingStatus($action, $listingID)
	{
		
		
		if (isset($action) && isset($listingID)) {
			
			$status = "";
			
			if ($action == 'enable') {
				$status = 'Open';
			} elseif ($action == 'disable') {
				$status = 'Closed';
			} else {
				return;
			}
			
			$mysqli = connect();
			
			if ($mysqli) {
				
				$sql = "UPDATE `listings` SET `status`=?, `last_edit`=CURRENT_TIMESTAMP() WHERE `id`=?";
				
				$stmt = getStatement($mysqli, $sql);
				
				if ($stmt) {
					$stmt->bind_param("si", $status, $listingID);
					$mysqli->autocommit(false);
					executeUpdate($stmt);
					$mysqli->commit();
					$mysqli->autocommit(true);
				}
			}
			disconnect($mysqli);
			
		}
		
		
	}
	
	function uploadProfile($data)
	{
		if (isset($data) && isset($_FILES)) {
			
			$mysqli = connect();
			
			//name] => [birthday] => [phone] => [country] => [email] => [job] => [website
			
			if ($mysqli) {
				
				$sql = "SELECT COUNT(`userID`) AS `exists` FROM `profiles` WHERE `userID`=?";
				
				$stmt = getStatement($mysqli, $sql);
				
				if ($stmt) {
					
					$stmt->bind_param("i", $data['userID']);
					$results = fetchResults($stmt);
					
					if (isset($results[0]['exists']) && $results[0]['exists'] == 1) {
						$sql = "UPDATE `profiles`
								SET `photo`=?, `name`=?, `birthday`=?, `phone`=?, `country`=?, `email`=?, `job`=?, `website`=?, `last_update`=CURRENT_TIMESTAMP()
								WHERE `userID`=?";
						$stmt = getStatement($mysqli, $sql);
						
						if ($stmt) {
							
							$birthday = date('Y/m/d', strtotime($data['birthday']));
							
							$phone = preg_replace('/[^0-9.]+/', '', $data['phone']);
							
							$stmt->bind_param("sssissssi", $_FILES["photo"]["name"], $data['name'], $birthday, $phone, $data['country'], $data['email'], $data['job'], $data['website'], $data['userID']);
							
							if (executeUpdate($stmt)) {
								saveProfilePhoto($data);
							}
							
						}
						
					} elseif ((isset($results[0]['exists']) && $results[0]['exists'] == 0)) {
						
						$sql = "INSERT INTO `profiles`(`photo`, `userID`, `name`, `birthday`, `phone`, `country`, `email`, `job`, `website`)
								VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
						$stmt = getStatement($mysqli, $sql);
						
						if ($stmt) {
							
							$stmt->bind_param("sississss", $_FILES["photo"]["name"], $data['userID'], $data['name'], $data['birthday'], $data['phone'], $data['country'], $data['email'], $data['job'], $data['website']);
							
							if (executeUpdate($stmt)) {
								saveProfilePhoto($data);
							}
							
						}
						
					} else {
						header("Location: 404.php");
						exit();
					}
					
					
				}
				
				disconnect($mysqli);
				header("Location: pages-user-profile-view.php");
				exit();
			}
			
			
		}
	}
	
	function saveProfilePhoto($data)
	{
		
		$target_dir = "profile-photos/";
		$target_file = $target_dir . basename($_FILES["photo"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		
		// Check if image file is a actual image or fake image
		if (isset($data["submit"])) {
			$check = getimagesize($_FILES["photo"]["tmp_name"]);
			if ($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		
		// Check file size
		if ($_FILES["photo"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		
		// Allow certain file formats
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif") {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
				echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
		
		return $uploadOk;
	}
	
	function uploadSkills($data)
	{
		
		if (isset($data)) {
			
			$mysqli = connect();
			
			if ($mysqli) {
				
				$sql = "SELECT COUNT(`id`) AS `numOfSkillsets` FROM `skills` WHERE `userID`=?";
				
				$stmt = getStatement($mysqli, $sql);
				
				if ($stmt) {
					
					$stmt->bind_param("i", $data['userID']);
					
					$results = fetchResults($stmt);
					
					if ($results) {
						
						$sql = "";
						$action = "";
						
						if ($results[0]['numOfSkillsets'] == 0) {
							$sql = "INSERT INTO `skills`(`userID`, `skill1`, `value1`, `skill2`, `value2`, `skill3`, `value3`, `skill4`, `value4`) VALUES(?,?,?,?,?,?,?,?,?)";
							$action = "insert";
						} elseif ($results[0]['numOfSkillsets'] == 1) {
							$sql = "UPDATE `skills` SET skill1=?, value1=?, skill2=?, value2=?, skill3=?, value3=?, skill4=?, value4=? WHERE `userID`=?";
							$action = "update";
						} else {
							echo "error";
						}
						
						$stmt = getStatement($mysqli, $sql);
						
						if ($stmt) {
							
							if ($action == "insert") {
								$stmt->bind_param("isisisisi", $data['udsrID'], $data['skillName1'], $data['skill1'], $data['skillName2'], $data['skill2'], $data['skillName3'], $data['skill3'], $data['skillName4'], $data['skill4']);
							} elseif ($action == "update") {
								$stmt->bind_param("sisisisii", $data['skillName1'], $data['skill1'], $data['skillName2'], $data['skill2'], $data['skillName3'], $data['skill3'], $data['skillName4'], $data['skill4'], $data['userID']);
							}
							
							if (executeUpdate($stmt)) {
								disconnect($mysqli);
								header("Location: pages-user-profile-view.php");
								exit();
							} else {
								disconnect($mysqli);
								header("Location: 500.php");
								exit();
							}
							
						} else {
							disconnect($mysqli);
							header("Location: 500.php");
							exit();
						}
						
					}
					
					
				}else{
					disconnect($mysqli);
					header("Location: 500.php");
					exit();
				}
				
			}
			
		}
		
	}
	
	function applyToListing($listingID, $applicantID)
	{
		
		if (isset($listingID) && isset($applicantID)) {
			
			$mysqli = connect();
			
			if ($mysqli) {
				
				$sql = "SELECT `u`.`id` AS `posterID` FROM `users` AS `u`, `listings` AS `l`
						WHERE `u`.`id`=`l`.`userID` AND `l`.`id`=?";
				
				$stmt = getStatement($mysqli, $sql);
				
				if ($stmt) {
					
					$stmt->bind_param("i", $listingID);
					
					$results = fetchResults($stmt);
					
					$posterID = $results[0]['posterID'];
					
					$sql = "INSERT INTO `applications`(`applicantID`, `posterID`, `listingID`) VALUES (?,?,?)";
					
					$stmt = getStatement($mysqli, $sql);
					
					if ($stmt) {
						$stmt->bind_param("iii", $applicantID, $posterID, $listingID);
						$mysqli->autocommit(false);
						executeUpdate($stmt);
						$mysqli->autocommit(true);
					}
					
				}
				
				disconnect($mysqli);
			}
			
		}
		
	}
	
	function insertPoll($data){
		if ($con = connect()){
			$con->autocommit(false);
			
			$sql = "INSERT INTO polls (title) VALUES (?) ";
			$stmt = getStatement($con, $sql);
			$stmt->bind_param('s', $data);
			
			executeUpdate($stmt);
			
			$con->autocommit(true);
			disconnect($con);
		}
		
	}
	
	function insertPollChoices($dataTitle, $dataOptions){
		if ($con = connect()){
			$con->autocommit(false);
			// find id
			$sql = "SELECT id FROM polls WHERE title= ?";
			$stmt = getStatement($con, $sql);
			$stmt->bind_param('s', $dataTitle);
			$resultID = fetchResults($stmt);
			
			if (sizeof($resultID) == 1) {
				for ($i = 0; $i < sizeof($dataOptions); $i++) {
					$sql = "INSERT INTO poll_options (pollID, value) VALUES (?,?) ";
					$stmt = getStatement($con, $sql);
					$stmt->bind_param('is', $resultID[0]['id'], $dataOptions[$i]);
					
					executeUpdate($stmt);
				}
			}
			$con->autocommit(true);
			disconnect($con);
			
		}
	}

?>