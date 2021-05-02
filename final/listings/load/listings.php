<?php
	
	if (isset($_SESSION) && isset($_SESSION['role']) && isset($_SESSION['status'])) {
		
		if ($_SESSION['role'] == 'Freelancer' && $_SESSION['status'] == 'Active') {
			
			include_once "../../query-executor.php";

			$mysqli=connect();

			if($mysqli){

			    $stmt=getStatement($mysqli, "SELECT `id` FROM `users` WHERE `username`=?");
				$stmt->bind_param("s", $_SESSION['username']);
				$results=fetchResults($stmt);
				
				$userID = $results[0]['id'];
				
				$stmt = getStatement($mysqli, "SELECT `l`.`id`, `job_title`, `techs`, `payment_amount`, `location`,
                                            `date_submitted`, `status`, `exp_level`, `rate`
                                            FROM `listings` AS `l`, `exp_levels` AS el, `payment_rates` AS pr
                                            WHERE `userID`=? AND `el`.`id`=`job_level` AND `pr`.`id`=`payment_rate`");
				$stmt->bind_param("i", $userID);
                $results=fetchResults($stmt);
				
				for ($i=0;$i<sizeof($results);$i++){ ?>
                        <tr class='odd pointer'>
                            <td class='a-center '><input type='checkbox' class='flat' name='table_records'></td>
                            <td> <?php echo $results[$i]['id'] ?> </td>
                            <td> <?php echo $results[$i]['job_title'] ?> </td>
                            <td> <?php echo $results[$i]['exp_level'] ?> </td>
                            <td> $<?php echo $results[$i]['payment_amount'] ?>/<?php echo $results[$i]['rate'] ?> </td>
                            <td> <?php echo $results[$i]['techs'] ?> </td>
                            <td> <?php echo $results[$i]['location'] ?> </td>
                            <td> <?php echo $results[$i]['date_submitted'] ?> </td>
                            <td> <?php echo $results[$i]['status'] ?> </td>
                            <td class=' last'><i href='#'>View</i>
                        </tr>
				<?php }

				disconnect($mysqli);
            }
			
		}
		
	}

?>