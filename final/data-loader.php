<?php
	
	require_once "scripts.php";
	sessionCheck();
	
	function loadListings($owner)
	{
		
		if (isset($_SESSION['id'])) {
			
			$mysqli = connect();
			
			if ($mysqli) {
				
				$sql = "SELECT `l`.`id` AS `id`, `job_title`, `techs`, `payment_amount`, `location`,
                                            `date_submitted`, `status`, `exp_level`, `rate`
                                            FROM `listings` AS `l`, `exp_levels` AS el, `payment_rates` AS pr ";
				$condition = "";
				$order = "
                                            ORDER BY `date_submitted` DESC";
				if (isset($_SESSION['role']) && $_SESSION['role'] == $owner) {
					$condition = "
                                            WHERE `userID`=? AND `el`.`id`=`job_level` AND `pr`.`id`=`payment_rate`";
				} elseif (isset($_SESSION['role']) && $_SESSION['role'] != $owner) {
					$condition = "
                                            WHERE `userID`<>? AND `el`.`id`=`job_level` AND `pr`.`id`=`payment_rate`";
				}
				
				$stmt = getStatement($mysqli, $sql . $condition . $order);
				if ($stmt) {
					$stmt->bind_param("i", $_SESSION['id']);
					
					$results = fetchResults($stmt);
					
					if (sizeof($results) > 0) {
						
						foreach ($results as $row) { ?>
                            <tr class='odd pointer'>
                            <td class='a-center '><input type='checkbox' class='flat' name='table_records'></td>
                            <td> <?php echo $row['id'] ?> </td>
                            <td> <?php echo $row['job_title'] ?> </td>
                            <td> <?php echo $row['exp_level'] ?> </td>
                            <td>$<?php echo $row['payment_amount'] . "/" . $row['rate'] ?> </td>
                            <td> <?php echo $row['techs'] ?> </td>
                            <td> <?php echo $row['location'] ?> </td>
                            <td> <?php echo $row['date_submitted'] ?> </td>
                            <td> <?php echo $row['status'] ?> </td>
                            <td class='last'>
                            <form action="pages-user-listings-manage.php" method="post">
                            <button type="submit" name="view_button" value="<?php echo $row['id']; ?>"
                                    class="btn-view"><span class="glyphicon glyphicon-eye-open"></span> View
                            </button>
							<?php if ($_SESSION['role'] == $owner || ($_SESSION['role'] == 'Admin' && $owner == 'Admin')) { ?>
								<?php if ($row['status'] == 'Open') { ?>
                                    <button type="submit" name="disable_button" value="<?php echo $row['id']; ?>"
                                            class="btn-negative"><span class="glyphicon glyphicon-remove"></span>
                                        Disable
                                    </button>
								<?php } elseif ($row['status'] == 'Closed') { ?>
                                    <button type="submit" name="enable_button" value="<?php echo $row['id']; ?>"
                                            class="btn-positive"><span class="glyphicon glyphicon-ok"></span> Enable
                                    </button>
								<?php } ?>
                                </form>
                                </td>
                                </tr>
							<?php }
						}
						
					} elseif (sizeof($results) == 0) { ?>
                        <tr class='odd pointer'>
                            <td class='a-center '><input type='checkbox' class='flat' name='table_records'></td>
                            <td> No listings here yet</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
					<?php }
					
				}
				disconnect($mysqli);
			}
			
		}
		
	}
	
	function loadListingData($listingID)
	{
		
		$mysqli = connect();
		
		if ($mysqli) {
			
			$sql = "SELECT `userID`, `job_title`, `job_level`, `payment_amount`, `payment_rate`, `techs`, `location`, `description`, `status`
                    FROM `listings` WHERE `id`=?";
			$stmt = getStatement($mysqli, $sql);
			
			if ($stmt) {
				
				$stmt->bind_param("i", $listingID);
				$result = fetchResults($stmt);
				
				$data = $result[0];
				
				if ($result != null && sizeof($result) == 1) {
					
					$sql = "SELECT `rate` FROM `payment_rates` WHERE `id`=?";
					$stmt = getStatement($mysqli, $sql);
					
					if ($stmt) {
						
						$stmt->bind_param("i", $data['payment_rate']);
						$result = fetchResults($stmt);
						
						if (sizeof($result) == 1) {
							
							$data['payment_rate'] = $result[0]['rate'];
							
							$sql = "SELECT `exp_level` FROM `exp_levels` WHERE `id`=?";
							$stmt = getStatement($mysqli, $sql);
							if ($stmt) {
								
								$stmt->bind_param("i", $data['job_level']);
								
								$result = fetchResults($stmt);
								
								if (sizeof($result) == 1) {
									
									disconnect($mysqli);
									$data['job_level'] = $result[0]['exp_level'];
									return $data;
								}
							}
						}
					}
					
					disconnect($mysqli);
					return null;
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
			
		} else {
			header("Location: 500.php");
			exit();
		}
		
	}
	
	function loadExpLevels()
	{
		$con = connect();
		
		if ($con) {
			
			$stmt = getStatement($con, "SELECT `exp_level` FROM `exp_levels`");
			$result = fetchResults($stmt);
			
			if (sizeof($result) > 0) { //check if any data exists
				
				/* fetch values */
				foreach ($result as $row) {
					echo "<option>" . $row['exp_level'] . "</option>";
				}
				
			} else {
				echo "ERROR WHILE COMMUNICATING WITH HOST";
			}
			
			disconnect($con);
		} else {
			echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
		}
		
	}
	
	function loadExpLevelsWithSelection($selection)
	{
		$con = connect();
		
		if ($con) {
			
			$stmt = getStatement($con, "SELECT `exp_level` FROM `exp_levels` WHERE `exp_level`<>?");
			
			if ($stmt) {
				
				$stmt->bind_param("s", $selection);
				$result = fetchResults($stmt);
				
				if (sizeof($result) > 0) { //check if any data exists
					
					echo "<option>" . $selection . "</option>";
					foreach ($result as $row) {
						echo "<option>" . $row['exp_level'] . "</option>";
					}
					
				} else {
					echo "ERROR WHILE COMMUNICATING WITH HOST";
				}
				
				disconnect($con);
			} else {
				echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
			}
		} else {
			echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
		}
		
		
	}
	
	function loadRates()
	{
		
		$mysqli = connect();
		
		if ($mysqli) {
			
			$stmt = getStatement($mysqli, "SELECT `rate` From `payment_rates` ORDER BY id ASC");
			$result = fetchResults($stmt);
			
			if (sizeof($result) > 0) {//check if any data exists
				
				foreach ($result as $row) {
					echo "<option>" . $row['rate'] . "</option>";
				}
				
			} else {
				echo "ERROR WHILE COMMUNICATING WITH HOST";
			}
			
			disconnect($mysqli);
		} else {
			echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
		}
		
	}
	
	function loadRatesWithSelection($selection)
	{
		$mysqli = connect();
		
		if ($mysqli) {
			
			$stmt = getStatement($mysqli, "SELECT `rate` From `payment_rates` WHERE `rate`<>?");
			
			if ($stmt) {
				
				$stmt->bind_param("s", $selection);
				$result = fetchResults($stmt);
				
				if (sizeof($result) > 0) {//check if any data exists
					
					echo "<option>" . $selection . "</option>";
					foreach ($result as $row) {
						echo "<option>" . $row['rate'] . "</option>";
					}
					
				} else {
					echo "ERROR WHILE COMMUNICATING WITH HOST";
				}
				
			} else {
				echo "ERROR WHILE COMMUNICATING WITH HOST";
			}
			
			disconnect($mysqli);
		} else {
			echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
		}
	}
	
	function loadProfile($userID)
	{
		
		$mysqli = connect();
		
		if ($mysqli) {
			
			$sql = "SELECT `photo`, `name`, `birthday`, `phone`, `country`, `email`, `job`, `website`
                    FROM `profiles`
                    WHERE `userID`=?";
			
			$stmt = getStatement($mysqli, $sql);
			
			if ($stmt) {
				
				$stmt->bind_param("i", $userID);
				
				$result = fetchResults($stmt);
				
				disconnect($mysqli);
				
				if (sizeof($result) == 1) {
					return $result[0];
				} else {
					return null;
				}
				
			}
			
		}
		return null;
	}
	
	function loadUsersWithStatus($userStatus)
	{
		if (isset($_SESSION) && isset($_SESSION['role'])) {
			
			$con = connect();
			
			if ($con) {
				$stmt = getStatement($con, "SELECT * FROM `users` WHERE `status`= ?");
				
				$stmt->bind_param("s", $userStatus);
				$stmt->execute();
				$results = fetchResults($stmt);
				
				printUsers($results, $userStatus);
				
				disconnect($con);
			}
		}
		
	}
	
	function loadUsersWithRole($role, $status)
	{
		
		if (isset($_SESSION) && isset($_SESSION['role'])) {
			
			$con = connect();
			
			if ($con) {
				
				$stmt = getStatement($con, "SELECT * FROM `users` WHERE `status`= ? AND `role`=?");
				$stmt->bind_param("ss", $status, $role);
				$results = fetchResults($stmt);
				
				printUsers($results, $status);
				
				disconnect($con);
			}
		}
	}
	
	function printUsers($users, $status)
	{
		
		if ($users != null) {
			foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['username'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['role'] ?></td>
                    <td><?php echo $user['registration_date'] ?></td>
                    <td>
						<?php loadUserButtons($user['id'], $status); ?>
                    </td>
                    <td>
                        <form method="post" action="pages-user-profile-edit.php">
                            <button type="submit" name="manage_button" value="<?php echo $user['id']; ?> " class="btn fa fa-edit" title="Edit Profile" data-placement="auto" data-toggle="tooltip">
                            </button>
                        </form>
                    </td>
                </tr>
				<?php
			}
		} else {
			?>
            <tr>
                <td> No users here</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
			<?php
		}
		
		
	}
	
	function loadUserButtons($id, $status)
	{
		$titlePositive = "";
		$titleNegative = "";
		
		if ($status == 'Active') {
			$titlePositive = "View";
			$titleNegative = "Suspend";
		}
		if ($status == 'Pending Confirmation') {
			$titlePositive = "Approve";
			$titleNegative = "Dismiss";
		}
		if ($status == 'Suspended') {
			$titlePositive = "Re-Activate";
			$titleNegative = "Delete";
		}
		?>
        <a href="user-approve.php?userID=<?php echo $id ?>&action=accept&status=<?php echo $status ?>" class="mr-3"
           title="<?php echo $titlePositive ?>" data-placement="auto" data-toggle="tooltip"><span
                    class="glyphicon glyphicon-ok-circle"></span></a>
        <a href="user-approve.php?userID=<?php echo $id ?>&action=decline&status=<?php echo $status ?>" class="mr-3"
           title="<?php echo $titleNegative ?>" data-placement="auto" data-toggle="tooltip"><span
                    class="glyphicon glyphicon-remove-circle"></span></a>
	<?php }
	
	function loadSkills($userID)
	{
		
		$mysqli = connect();
		
		if ($mysqli) {
			
			$sql = "SELECT `skill1`, `value1`, `skill2`, `value2`, `skill3`, `value3`, `skill4`, `value4` FROM `skills` WHERE `userID`=?";
			
			$stmt = getStatement($mysqli, $sql);
			
			if ($stmt) {
				
				$stmt->bind_param("i", $userID);
				
				$results = fetchResults($stmt);
				
				if (sizeof($results) == 1) {
					disconnect($mysqli);
					return $results[0];
					
				}
				
			}
			
			disconnect($mysqli);
			
		}
		return null;
		
	}
	
	function loadPollWithStatus($status)
	{
		if (isset($_SESSION) && isset($_SESSION['role'])) {
			
			$con = connect();
			
			if ($con) {
				
				$sql = "SELECT * FROM polls WHERE `status`=?";
				$stmt = getStatement($con, $sql);
				$stmt->bind_param("s", $status);
				
				if ($stmt) {
					
					$results = fetchResults($stmt);
					
					if (sizeof($results) > 0) {
						foreach ($results as $row) { ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['title'] ?></td>
                                <td><?php echo $row['date_created'] ?></td>
                                <td><?php echo $row['status'] ?></td>
                                <td>
                                    <form method="post" action="pages-admin-view-poll.php">
                                        <button type="submit" name="view_poll" value="<?php echo $row['id'] ?>"
                                                class="btn-view">
                                            <span class="glyphicon glyphicon-eye-open"></span> View
                                        </button>
										<?php if ($row['status'] == 'Closed') { ?>
                                            <button type="submit" name="delete_poll" value="<?php echo $row['id'] ?>"
                                                    class="btn-negative">
                                                <span class="glyphicon glyphicon-trash"></span> Delete
                                            </button>
                                            <button type="submit" name="open_poll" value="<?php echo $row['id'] ?>"
                                                    class="btn-positive">
                                                <span class="glyphicon glyphicon-ok"></span> Open
                                            </button>
										<?php } ?>
                                    </form>
                                </td>
                            </tr>
							<?php
						}
					} else {
						?>
                        <tr>
                            <td> No polls here</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
						<?php
					}
				}
				
				disconnect($con);
			}
		}
	}
	
	function loadPollWithID($theID)
	{
		if ($con = connect()) {
			
			$sql = "SELECT * FROM polls WHERE `id`=?";
			$stmt = getStatement($con, $sql);
			$stmt->bind_param("i", $theID);
			
			if ($stmt) {
				$results = fetchResults($stmt);
				disconnect($con);
				return $results[0];
			}
			
			disconnect($con);
		}
	}
	
	function loadPollOptions($theID)
	{
		if ($con = connect()) {
			
			$sql = "SELECT * FROM poll_options WHERE `pollID`=?";
			$stmt = getStatement($con, $sql);
			$stmt->bind_param("i", $theID);
			
			if ($stmt) {
				
				$results = fetchResults($stmt);
				
				if (sizeof($results) > 0) {
					for ($i = 0; $i < sizeof($results); $i++) {
						?>
                        <strong>Option <?php echo $i + 1 ?>:</strong><input type="text"
                                                                            placeholder="<?php echo $results[$i]['value'] ?>"
                                                                            disabled="disabled"> <br><br>
					
					<?php }
					
				}
			}
			
			disconnect($con);
		}
	}
	
	function loadAllPolls()
	{
		if (isset($_SESSION) && isset($_SESSION['role'])) {
			
			$con = connect();
			
			if ($con) {
				
				$sql = "SELECT * FROM polls";
				$stmt = getStatement($con, $sql);
				
				if ($stmt) {
					
					$results = fetchResults($stmt);
					
					if (sizeof($results) > 0) {
						foreach ($results as $row) { ?>
                            <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['date_created'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                            <td>
                            <form method="post" action="upload-poll-options.php">
                            <button type="submit" name="view_poll" value="<?php echo $row['id'] ?>"
                                    class="btn-view">
                                <span class="glyphicon glyphicon-eye-open"></span> View
                            </button>
							
							
							<?php if ($row['status'] == 'Closed') { ?>
                                <button type="submit" name="open_poll" value="<?php echo $row['id'] ?>"
                                        class="btn-positive">
                                    <span class="glyphicon glyphicon-ok"></span> Re-Open
                                </button>
							
							<?php } elseif ($row['status'] == 'Open') { ?>
                                <button type="submit" name="close_poll" value="<?php echo $row['id'] ?>"
                                        class="btn-negative">
                                    <span class="glyphicon glyphicon-remove"></span> Close
                                </button>
                                </form>


                                </td>
                                </tr>
							<?php }
						}
					} else {
						?>
                        <tr>
                            <td> No polls here</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
						<?php
					}
				}
				
				disconnect($con);
			}
		}
	}
	
	function loadSentApplications($role, $userID)
	{
		
		if (isset($userID)) {
			
			$mysqli = connect();
			
			if ($mysqli) {
				
				$sql = "SELECT `a`.`id` AS `application id`, `u`.`username` AS `user`, `l`.`job_title` AS `job`, `a`.`application_date` AS `date`
                        FROM `users` AS `u`, `applications` AS `a`, `listings` AS `l`
                        WHERE `u`.`id`=`a`.`posterID` AND `l`.`id`=`a`.`listingID`";
				
				if ($role != 'Admin') {
					$sql = $sql . " AND `a`.`applicantID`=?";
				}
				
				$stmt = getStatement($mysqli, $sql);
				
				if ($stmt) {
					
					$stmt->bind_param("i", $_SESSION['id']);
					
					$results = fetchResults($stmt);
					
					if ($results) {
						
						displayApplications($results);
						
					}
					
				}
				disconnect($mysqli);
			}
			
		}
		
	}
	
	function loadReceivedApplications($role, $userID)
	{
		
		if (isset($userID)) {
			
			$mysqli = connect();
			
			if ($mysqli) {
				
				$sql = "SELECT `a`.`id` AS `application id`, `u`.`username` AS `user`, `l`.`job_title` AS `job`, `a`.`application_date` AS `date`
                        FROM `users` AS `u`, `applications` AS `a`, `listings` AS `l`
                        WHERE `u`.`id`=`a`.`applicantID` AND `l`.`id`=`a`.`listingID`";
				
				if ($role != 'Admin') {
					$sql = $sql . " AND `a`.`posterID`=?";
				}
				
				$stmt = getStatement($mysqli, $sql);
				
				if ($stmt) {
					
					$stmt->bind_param("i", $_SESSION['id']);
					
					$results = fetchResults($stmt);
					
					displayApplications($results);
					
				} else {
					header("Location: 500.php");
					exit();
				}
				disconnect($mysqli);
			}
			
		}
		
	}
	
	function displayApplications($applications)
	{
		
		if (sizeof($applications) > 0) {
			
			foreach ($applications as $app) { ?>

                <tr>
                    <td> <?php echo $app['application id']; ?> </td>
                    <td> <?php echo $app['user']; ?> </td>
                    <td> <?php echo $app['job']; ?> </td>
                    <td> <?php echo $app['date']; ?> </td>
                </tr>
			
			<?php }
			
		} else { ?>

            <tr>
                <td> No applications here yet</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
		
		<?php }
		
		
	}
	
	function loadNotifications($role, $userID)
	{
		
		if (isset($userID)) {
			
			$mysqli = connect();
			
			if ($mysqli) {
				
				$sql = "SELECT `a`.`id` AS `application id`, `u`.`username` AS `poster`, `l`.`job_title` AS `job`
                        FROM `users` AS `u`, `applications` AS `a`, `listings` AS `l`
                        WHERE `u`.`id`=`a`.`posterID` AND `l`.`id`=`a`.`listingID`
                        ORDER BY `a`.`application_date` DESC
                        LIMIT 3";
				
				if ($role != 'Admin') {
					$sql = $sql . " AND `a`.`posterID`=?";
				}
				
				$stmt = getStatement($mysqli, $sql);
				
				if ($stmt) {
					
					$stmt->bind_param("i", $_SESSION['id']);
					
					$results = fetchResults($stmt);
					
					disconnect($mysqli);
					return $results;
					
				} else {
					header("Location: 500.php");
					exit();
				}
			}
			
			disconnect($mysqli);
		}
		return null;
		
	}
	
	function displayNotifications($notifications)
	{
		
		if (sizeof($notifications) > 0) {
			foreach ($notifications as $not) { ?>
                <li class="nav-item">
                    <a class="dropdown-item">
                        <span>
                            <!-- Username from notification -->
                            <span><?php echo $not['username']; ?></span>
                        </span>
                        <span class="message">
                            <?php echo $not['username'] . " applied for " . $not['job'] ?>
                        </span>
                    </a>
                </li>
			<?php }
		} else { ?>
            <li class="nav-item">
                <a class="dropdown-item"><span>No notifications</span></a>
            </li>
		<?php }
		
	}
	
	function countListings($userID)
	{
		
		if (isset($userID)) {
			
			$mysqli = connect();
			
			if ($mysqli) {
				
				$sql = "SELECT COUNT(`id`) AS `count` FROM `listings` WHERE `userID`=?";
				
				$stmt = getStatement($mysqli, $sql);
				
				if ($stmt) {
					
					$stmt->bind_param("i", $userID);
					
					$results = fetchResults($stmt);
					
					disconnect($mysqli);
					
					return $results[0]['count'];
				}
				
			}
			disconnect($mysqli);
		}
		return 0;
	}
	
	function countApplications($userID, $owner)
	{
		
		if (isset($userID) && isset($owner)) {
			
			$mysqli = connect();
			
			if ($mysqli) {
				
				$sql = "SELECT COUNT(`id`) AS `count` FROM `applications`";
				
				if ($owner == $_SESSION['role']) {
				    $sql=$sql." WHERE `posterID`=?";
				}else{
				    $sql=$sql." WHERE `applicantID`=?";
                }
				
				$stmt = getStatement($mysqli, $sql);
				
				if ($stmt) {
					
					$stmt->bind_param("i", $userID);
					
					$results = fetchResults($stmt);
					
					disconnect($mysqli);
					
					return $results[0]['count'];
					
				}
				
			}
			disconnect($mysqli);
		}
		
		return 0;
	}

?>


























































