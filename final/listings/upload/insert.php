<?php

if (isset($_POST)) {//check if data was given

	//check if it came through a valid channel
	if (isset($_POST['submit_button']) && $_POST['submit_button']=='Post_Listing') {

		$jobTitle = $_POST['job_title'];
		$exp_level = $_POST['exp_level'];
		$rate=$_POST['rate'];
		$amount = doubleval($_POST['amount']);
		$techs = $_POST['techs'];
		$location = $_POST['location'];
		$description = $_POST['description'];

		if (isset($jobTitle) && isset($amount) && isset($techs) && isset($location) && isset($description) &&
			isset($rate) && isset($exp_level) && $rate!='Choose option' && $exp_level!='Choose option'){

			include_once "../../query-executor.php";
			include_once "../../account/session-access.php";

			$mysqli=connect();

			if ($mysqli){

				//disable autocommit to ensure no garbage data are uploaded
				$mysqli->autocommit(false);

				//get id for experience level
				$stmt=getStatement($mysqli, "SELECT `id` FROM `exp_levels` WHERE `exp_level`=?");
				$stmt->bind_param("s", $exp_level);
				$results=fetchResults($stmt);
				$levelID=$results[0]['id'];

				//get id for payment rate
				$stmt=getStatement($mysqli, "SELECT `id` FROM `payment_rates` WHERE `rate`=?");
				$stmt->bind_param("s", $rate);
				$results=fetchResults($stmt);
				$rateID=$results[0]['id'];

				//insert in DB
				$stmt = getStatement("INSERT INTO
    					listings (userID, job_title, job_level, payment_amount, payment_rate, techs, location, description)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("isidisss", $_SESSION['id'], $jobTitle, $levelID, $amount, $rateID, $techs, $location, $description);
				executeUpdate($stmt);

				$mysqli->commit();
				$mysqli->autocommit(true);

				disconnect($mysqli);

				header("Location: history.php");

			}

		}

	}
	
}
?>


