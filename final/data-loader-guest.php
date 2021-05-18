<?php
	
	function loadGuestListings(){
		$mysqli=connect();
		
		if($mysqli){
			
			$sql="SELECT `l`.`id` AS `id`, `job_title`, `techs`, `payment_amount`, `location`,
                    `date_submitted`, `status`, `exp_level`, `rate`
                    FROM `listings` AS `l`, `exp_levels` AS el, `payment_rates` AS pr
                    WHERE `el`.`id`=`job_level` AND `pr`.`id`=`payment_rate`";
			$stmt=getStatement($mysqli, $sql);
			
			if($stmt){
				
				$results=fetchResults($stmt);
				
				if(sizeof($results)>0){
					
					foreach ($results as $row){ ?>
						<tr class='odd pointer'>
							<td> <?php echo $row['id'] ?> </td>
							<td> <?php echo $row['job_title'] ?> </td>
							<td> <?php echo $row['exp_level'] ?> </td>
							<td>$<?php echo $row['payment_amount'] . "/" . $row['rate'] ?> </td>
							<td> <?php echo $row['techs'] ?> </td>
							<td> <?php echo $row['location'] ?> </td>
							<td> <?php echo $row['date_submitted'] ?> </td>
							<td> <?php echo $row['status'] ?> </td>
						</tr>
					<?php                   }
					
				}elseif(sizeof($results)==0){ ?>
					<tr class='odd pointer'>
						<td> No listings here yet </td>
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

?>