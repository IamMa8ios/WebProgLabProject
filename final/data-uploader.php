<?php
	
	function logGuest(){
		$mysqli=connect();
		
		$sql="INSERT INTO `guest_logger`(`id`) VALUES(NULL);";
		
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
	
	function uploadProfile($data)
	{
		if (isset($data) && isset($_FILES)) {
			
			$mysqli = connect();
			
			if ($mysqli) {
				
				$sql = "SELECT COUNT(`userID`) AS `exists` FROM `profiles` WHERE `userID`=?";
				
				$stmt = getStatement($mysqli, $sql);
				
				if ($stmt) {
					
					$stmt->bind_param("i", $data['userID']);
					$results = fetchResults($stmt);
					
					$photo=$_FILES["photo"]["name"];
					
					if($photo){
						
						if (isset($results[0]['exists']) && $results[0]['exists'] == 1) {
							$sql = "UPDATE `profiles`
								SET `photo`=?, `first_name`=?, `last_name`=?, `phone`=?, `rank`=?, `email`=?, `website`=?, `last_edit`=CURRENT_TIMESTAMP()
								WHERE `userID`=?";
							$stmt = getStatement($mysqli, $sql);
							
							if ($stmt) {
								
								$stmt->bind_param("sssssssi", $photo, $data['firstName'], $data['lastName'], $data['phone'], $data['rank'], $data['email'], $data['website'], $data['userID']);
								
								if (executeUpdate($stmt)) {
									saveProfilePhoto($data);
								}
								
							}
							
						} elseif ((isset($results[0]['exists']) && $results[0]['exists'] == 0)) {
							
							$sql = "INSERT INTO `profiles`(`photo`, `userID`, `first_name`, `last_name`, `phone`, `rank`, `email`, `website`)
								VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
							$stmt = getStatement($mysqli, $sql);
							
							if ($stmt) {
								
								$stmt->bind_param("sissssss", $photo, $data['userID'], $data['firstName'], $data['lastName'], $data['phone'], $data['rank'], $data['email'], $data['website']);
								
								if (executeUpdate($stmt)) {
									saveProfilePhoto($data);
								}else{
									displayError("Error while uploading profile.");
								}
								
							}
							
						} else {
							displayError("Error while loading profile.");
							exit();
						}
						
					}else{
						
						if (isset($results[0]['exists']) && $results[0]['exists'] == 1) {
							$sql = "UPDATE `profiles`
								SET `first_name`=?, `last_name`=?, `phone`=?, `rank`=?, `email`=?, `website`=?, `last_edit`=CURRENT_TIMESTAMP()
								WHERE `userID`=?";
							$stmt = getStatement($mysqli, $sql);
							
							if ($stmt) {
								
								$stmt->bind_param("ssssssi", $data['firstName'], $data['lastName'], $data['phone'], $data['rank'], $data['email'], $data['website'], $data['userID']);
								
								if (executeUpdate($stmt)) {
									saveProfilePhoto($data);
								}
								
							}
							
						} elseif ((isset($results[0]['exists']) && $results[0]['exists'] == 0)) {
							
							$sql = "INSERT INTO `profiles`(`userID`, `first_name`, `last_name`, `phone`, `rank`, `email`, `website`)
								VALUES(?, ?, ?, ?, ?, ?, ?)";
							$stmt = getStatement($mysqli, $sql);
							
							if ($stmt) {
								
								$stmt->bind_param("issssss", $data['userID'], $data['firstName'], $data['lastName'], $data['phone'], $data['rank'], $data['email'], $data['website']);
								
								if (executeUpdate($stmt)) {
									saveProfilePhoto($data);
								}else{
									displayError("Error while uploading profile.");
								}
								
							}
							
						} else {
							header("Location: 404.php");
							exit();
						}
						
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
	
?>