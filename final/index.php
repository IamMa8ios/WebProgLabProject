<?php
	
	session_start();
	
	if (!isset($_SESSION['username'])) {
		header("Location: pages/users/login.php");
	}
	
	if (!isset($_SESSION['role'])) {
		header("Location: pages/users/login.php");
	}
	
	if (!isset($_SESSION['status'])) {
		header("Location: pages/users/login.php");
	}
	
	if ($_SESSION['role'] == 'Admin') {
		if ($_SESSION['status'] == 'Active') {
			header("Location: pages/index/admin.php");
		} else {
			header("Location: pages/index/inactive.php");
		}
	} elseif ($_SESSION['role'] == 'Freelancer') {
		if ($_SESSION['status'] == 'Active') {
			header("Location: pages/index/freelancer.php");
		} else {
			header("Location: pages/index/inactive.php");
		}
	} elseif ($_SESSION['role'] == 'Business') {
		if ($_SESSION['status'] == 'Active') {
			header("Location: pages/index/business.php");
		} else {
			header("Location: pages/index/inactive.php");
		}
	} else {
		echo "YOU ARE A GUEST";
	}

?>