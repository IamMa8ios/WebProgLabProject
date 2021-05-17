<?php
	
	require_once "scripts.php";
	
	if(isset($_GET['userID']) && isset($_GET['action']) && isset($_GET['status'])){
		
		$mysqli=connect();
		
		if($mysqli){
			
			$sql="";
			
			if($_GET['status'] == "Active"){
				
				if($_GET['action']=="accept"){
					header("Location: user-details.php");
				}elseif ($_GET['action']=="decline"){
					$sql = "UPDATE `users` SET `status` = 'Suspended' WHERE `users`.`id` = ?";
				}
				
			}elseif ($_GET['status'] == "Suspended" || $_GET['status'] == "Pending Confirmation"){
				
				if($_GET['action']=="accept"){
					$sql = "UPDATE `users` SET `status` = 'Active' WHERE `users`.`id` = ?";
				}elseif ($_GET['action']=="decline") {
					$sql = "DELETE FROM `users` WHERE `users`.`id` = ?";
				}
				
			}
			
			$stmt=getStatement($mysqli, $sql);
			$stmt->bind_param("i", $_GET['userID']);
			
			$mysqli->autocommit(false);
			executeUpdate($stmt);
			$mysqli->commit();
			$mysqli->autocommit(true);
		}
		
	}
	header("Location: pages-admin-manage-nice.php");
	exit();

?>