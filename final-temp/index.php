<?php
	
	session_start();
	
	if (!isset($_SESSION['username'])) {
		header("Location: account/login.php");
	}
	
	if (!isset($_SESSION['role'])) {
		header("Location: account/login.php");
	}
	
	if (!isset($_SESSION['status'])) {
		header("Location: account/login.php");
	}
	
	if ($_SESSION['role'] == 'Admin') {
		if ($_SESSION['status'] == 'Active') {
			header("Location: admin.php");
		} else {
			header("Location: inactive.php");
		}
	} elseif ($_SESSION['role'] == 'Freelancer') {
		if ($_SESSION['status'] == 'Active') {
			header("Location: freelancer.php");
		} else {
			header("Location: inactive.php");
		}
	} elseif ($_SESSION['role'] == 'Business') {
		if ($_SESSION['status'] == 'Active') {
			header("Location: index-business.php");
		} else {
			header("Location: inactive.php");
		}
	} else {
		echo "YOU ARE A GUEST";
	}


?>