<?php
	
	require_once "scripts.php";
	sessionCheck();
	
	function loadListings($owner){
		
		if(isset($_SESSION['id'])){
			
			$mysqli=connect();
			
			if($mysqli){
				
				$sql="SELECT `l`.`id` AS `id`, `job_title`, `techs`, `payment_amount`, `location`,
                                            `date_submitted`, `status`, `exp_level`, `rate`
                                            FROM `listings` AS `l`, `exp_levels` AS el, `payment_rates` AS pr";
				
				$condition="";
				if(isset($_SESSION['role']) && $_SESSION['role']==$owner){
					$condition="
                                            WHERE `userID`=? AND `el`.`id`=`job_level` AND `pr`.`id`=`payment_rate`";
				}elseif (isset($_SESSION['role']) && $_SESSION['role']!=$owner){
					$condition="
                                            WHERE `userID`<>? AND `el`.`id`=`job_level` AND `pr`.`id`=`payment_rate`";
				}
				
				$stmt=getStatement($mysqli, $sql.$condition);
				if($stmt){
					$stmt->bind_param("i", $_SESSION['id']);
					
					$results=fetchResults($stmt);
					
					if(sizeof($results)>0){
						
						foreach ($results as $row){ ?>
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
                                <td class=' last'><i href='#'>View</i></td>
							</tr>
						<?php                   }
						
					}elseif(sizeof($results)==0){ ?>
						<tr class='odd pointer'>
							<td class='a-center '><input type='checkbox' class='flat' name='table_records'></td>
							<td> No listings here yet </td>
							<td>  </td>
							<td>  </td>
							<td>  </td>
							<td>  </td>
							<td>  </td>
							<td>  </td>
							<td>  </td>
							<td>  </td>
						</tr>
					<?php               }
					
				}
				disconnect($mysqli);
			}
			
		}
		
	}
	
	function loadExpLevels(){
		$con = connect();
		
		if ($con) {
			
			$stmt = getStatement($con, "SELECT `exp_level` From `exp_levels`");
			$result = fetchResults($stmt);
			
			if (sizeof($result)>0) { //check if any data exists
				
				/* fetch values */
				foreach ($result as $row){
					echo"<option>".$row['exp_level']."</option>";
				}
				
			} else {
				echo "ERROR WHILE COMMUNICATING WITH HOST";
			}
			
			disconnect($con);
		} else {
			echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
		}
		
	}
	
	function loadRates(){
		
		$mysqli=connect();
		
		if ($mysqli) {
			
			$stmt = getStatement($mysqli,"SELECT `rate` From `payment_rates` ORDER BY id ASC");
			$result = fetchResults($stmt);
			
			if (sizeof($result)>0) {//check if any data exists
				
				foreach ($result as $row){
					echo"<option>". $row['rate'] ."</option>";
				}
				
			} else {
				echo "ERROR WHILE COMMUNICATING WITH HOST";
			}
			
			disconnect($mysqli);
		} else {
			echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
		}
		
	}
	
	function loadProfile(){
		
		$mysqli=connect();
		
		if ($mysqli) {
			
			$sql = "SELECT `first_name`, `p`.`email`, `last_name`, `phone`, `gender`, `birthday`
                    FROM `profiles` AS `p`, `users` AS `u`
                    WHERE `user_id`=?";
			
			$stmt=getStatement($mysqli, $sql);
			
			if ($stmt) {
				
				$stmt->bind_param("i", $_SESSION['id']);
				
				$result=fetchResults($stmt);
				
				disconnect($mysqli);
				
				if(sizeof($result)==1){
					return $result[0];
				}else{
					return null;
				}
				
			}
			
		}
		return null;
	}
	
	function loadUsersWithStatus($userStatus){
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
	
	function loadUsersWithRole($role, $status){
		
		if (isset($_SESSION) && isset($_SESSION['role'])) {
			
			$con=connect();
			
			if($con){
				
				$stmt = getStatement($con, "SELECT * FROM `users` WHERE `status`= ? AND `role`=?");
				$stmt->bind_param("ss", $status, $role);
				$results = fetchResults($stmt);
				
				printUsers($results, $status);
				
				disconnect($con);
			}
		}
	}
	
	function printUsers($users, $status){
		
	    if($users!=null){
		    foreach ($users as $user){ ?>
                <tr>
                    <td><?php echo $user['id']  ?></td>
                    <td><?php echo $user['username']  ?></td>
                    <td><?php echo $user['email']  ?></td>
                    <td><?php echo $user['role']  ?></td>
                    <td><?php echo $user['registration_date']  ?></td>
                    <td>
					    <?php loadUserButtons($user['id'], $status); ?>
                    </td>
                </tr>
			    <?php
		    }
        }else{
		    ?>
            <tr><td> No users here</td><td></td><td></td><td></td><td></td><td></td></tr>
		    <?php
	    }
		
		
	}
	
	function loadUserButtons($id, $status){
	    $titlePositive="";
	    $titleNegative="";
	    
	    if($status=='Active'){
	        $titlePositive="View";
	        $titleNegative="Suspend";
        }if($status=='Pending Confirmation'){
			$titlePositive="Approve";
			$titleNegative="Dismiss";
		}if($status=='Suspended'){
			$titlePositive="Re-Activate";
			$titleNegative="Delete";
		}
?>
        <a href="user-approve.php?userID=<?php echo $id ?>&action=accept&status=<?php echo $status ?>" class="mr-3"
           title="<?php echo $titlePositive ?>" data-placement="auto" data-toggle="tooltip"><span class="glyphicon glyphicon-ok-circle"></span></a>
        <a href="user-approve.php?userID=<?php echo $id ?>&action=decline&status=<?php echo $status ?>" class="mr-3"
           title="<?php echo $titleNegative ?>" data-placement="auto" data-toggle="tooltip"><span class="glyphicon glyphicon-remove-circle"></span></a>
	<?php }
 
?>