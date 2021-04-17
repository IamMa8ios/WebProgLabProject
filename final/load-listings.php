<?php
	
	//listingID freelancerID job_title job_level payment_amount payment_rate techs location description date_submitted status last_update
	
	if (isset($_SESSION) && isset($_SESSION['role']) && isset($_SESSION['active'])) {
		
		if ($_SESSION['role'] == 'Freelancer' && $_SESSION['active'] == 'yes') {
			
			$con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');
			
			$stmt = $con->prepare("SELECT `id` FROM `users` WHERE `username`=?");
			$stmt->bind_param("s", $_SESSION['username']);
			$stmt->execute();
			$stmt->bind_result($id_result);
			$stmt->fetch();
			
			$userID = intval($id_result);
			
			$stmt->free_result();
			
			$stmt = $con->prepare("SELECT `job_title`, `job_level`, `techs`, `payment_amount`, `payment_rate`,
       						`location`, `date_submitted`, `status` FROM `freelancer_listings` WHERE `freelancerID`=?");
			$stmt->bind_param("i", $userID);
			$stmt->execute();
			
			if ($stmt->bind_result($title, $level, $techs, $amount, $rate, $location, $date, $status)) {
				while ($stmt->fetch()) {
					echo "<tr class='odd pointer'>";
						echo "<td class='a-center '><input type='checkbox' class='flat' name='table_records'></td>";
						echo "<td>" . $title . "</td>";
						echo "<td>" . $level . "</td>";
						echo "<td>" . $techs . "</td>";
						echo "<td>$" . $amount . "/" . $rate . "</td>";
						echo "<td>" . $location . "</td>";
						echo "<td>" . $date . "</td>";
						echo "<td>" . $status . "</td>";
						echo "<td class=' last'><i href='#'>View</i>";
					echo "</tr>";
					
				}
				
			}
			
			$stmt->close();
			$con->close();
			
		}
		
	}

?>