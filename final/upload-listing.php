<?php
	
	if (isset($_POST)) {//check if data was given
		
		$submitted = $_POST['submit_button'];
		
		if (isset($submitted)) {//check if it came through a valid channel
			
			if ($submitted == 'freelancer_listing') {//check type of listing
				
				$exp_level = $_POST['exp_level'];
				$rate=$_POST['rate'];
				$jobTitle = $_POST['job_title'];
				$amount = doubleval($_POST['amount']);
				$techs = $_POST['techs'];
				$location = $_POST['location'];
				$description = $_POST['description'];
				
				if (isset($jobTitle) && isset($amount) && isset($techs) && isset($location) && isset($description) &&
				isset($rate) && isset($exp_level) && $rate!='Choose option' && $exp_level!='Choose option'){
					
					$con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');
					
					if ($con){
						
						session_start();
						$stmt = $con->prepare("SELECT id FROM users WHERE username=?");
						$stmt->bind_param("s", $_SESSION['username']);
						//echo "username ".$_SESSION['username']."<br>";
						$stmt->execute();
						
						$stmt->bind_result($text);
						$stmt->fetch();
						$freelancerID = intval($text);
						/*echo "id ".$freelancerID."<br>";
						echo "amount ".$amount."<br>";*/
						
						$stmt->free_result();
						$stmt = $con->prepare("INSERT INTO
    					freelancer_listings (freelancerID, job_title, job_level, payment_amount, payment_rate, techs, location, description)
						VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
						$stmt->bind_param("issdssss", $freelancerID, $jobTitle, $exp_level, $amount, $rate, $techs, $location, $description);
						
						$stmt->execute();
						
						$stmt->close();
						$con->close();
						
						header("Location: listings-personal.php");
						
					}
					
				}
				
			}
			
		}
		
	}
	
	/*
	if ($exp_level == 'Choose option') {
		echo "<div class='alert alert-warning alert-dismissible ' role='alert'>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
								<strong>Choose an experience level!</strong>
							</div>";
	}
	
	$rate = $_POST['rate'];
	if (isset($rate)) {
		
		if ($rate == 'Choose option') {
			echo "<div class='alert alert-warning alert-dismissible ' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
						<strong>Choose a payment rate!</strong>
					</div>";
		}
		
	}
	*/
?>


