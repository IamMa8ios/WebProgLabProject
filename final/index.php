<?php
	
	//TODO: Listings reference from users instead of other tables
	//TODO: header in separate file
	
	session_start();
	
	if (!isset($_SESSION['username'])) {
		header("Location: login.php");
	}
	
	if (!isset($_SESSION['role'])) {
		header("Location: login.php");
	}
	
	if (!isset($_SESSION['status'])) {
		header("Location: login.php");
	}
	
	if ($_SESSION['role'] == 'Admin') {
		if ($_SESSION['status'] == 'Active') {
			header("Location: index-admin.php");
		} else {
			header("Location: index-pending.php");
		}
	} elseif ($_SESSION['role'] == 'Freelancer') {
		if ($_SESSION['status'] == 'Active') {
			header("Location: index-freelancer.php");
		} else {
			header("Location: index-pending.php");
		}
	} elseif ($_SESSION['role'] == 'Business') {
		if ($_SESSION['status'] == 'Active') {
			header("Location: index-business.php");
		} else {
			header("Location: index-pending.php");
		}
	} else {
		echo "YOU ARE A GUEST";
	}


?>