<?php
	//listingID freelancerID job_title job_level payment_amount payment_rate techs location description date_submitted status last_update
	
	if (isset($_SESSION) && isset($_SESSION['role']) && isset($_SESSION['status'])) {
		
		if ($_SESSION['role'] == 'Freelancer' && $_SESSION['status'] == 'Active') {
			
			$con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');
			
			$stmt = $con->prepare("SELECT `id` FROM `users` WHERE `username`=?");
			$stmt->bind_param("s", $_SESSION['username']);
			$stmt->execute();
			$stmt->bind_result($id_result);
			$stmt->fetch();
			
			$userID = intval($id_result);
			$stmt->free_result();
			
			$stmt = $con->prepare("SELECT `id` FROM `listings` WHERE `userID`=?");
			$stmt->bind_param("i", $userID);
			$stmt->execute();
			
			$stmt->bind_result($id_result);
			
			$id_results = array();
			
			while ($stmt->fetch()) {
				array_push($id_results, $id_result);
			}
			
			$stmt->free_result();
			
			$stmt = $con->prepare("SELECT `l`.`id`, `job_title`, `techs`, `payment_amount`, `location`, `date_submitted`,
       									`status`, `exp_level`, `rate`
										FROM `listings` AS l, `exp_levels` AS el, `payment_rates` AS pr
										WHERE `userID`=? AND `el`.`id`=`job_level` AND `pr`.`id`=`payment_rate`");
			$stmt->bind_param("i", $userID);
			$stmt->execute();
			
			if ($stmt->bind_result($id, $title, $techs, $amount, $location, $date, $status, $level, $rate)) {
			    $tablePointers=["even pointer", "odd pointer"];
				$i=0;
				while ($stmt->fetch()) { ?>
                        <form method="post" action="listings-edit.php">
                            <tr class='<?php echo $tablePointers[$i%2] ?>'>
                                <td class='a-center '><input type='checkbox' class='flat' name='table_records'></td>
                                <td> <?php echo $id ?> </td>
                                <td> <?php echo $title ?> </td>
                                <td> <?php echo $level ?> </td>
                                <td> <?php echo $techs ?> </td>
                                <td>$<?php echo $amount . "/" . $rate ?> </td>
                                <td> <?php echo $location ?> </td>
                                <td> <?php echo $date ?> </td>
                                <td> <?php echo $status ?> </td>
                                <td><input type="submit" value="View"></td>
                            </tr>
                        </form>
					<?php
				}
				
			}
			
			$stmt->close();
			$con->close();
			
		}
		
	}

?>