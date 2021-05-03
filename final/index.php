<?php
	
	session_start();
	
	if (!isset($_SESSION['username'])) {
		header("Location: localhost:63342/gentelella-master/final/pages/users/login.php");
	}
	
	if (!isset($_SESSION['role'])) {
		header("Location: localhost:63342/gentelella-master/final/pages/users/login.php");
	}
	
	if (!isset($_SESSION['status'])) {
		header("Location: localhost:63342/gentelella-master/final/pages/users/login.php");
	}
	
	if ($_SESSION['role'] == 'Admin') {
		if ($_SESSION['status'] == 'Active') {
			header("Location: localhost:63342/gentelella-master/final/pages/index/admin.php");
		} else {
			header("Location: localhost:63342/gentelella-master/final/pages/index/inactive.php");
		}
	} elseif ($_SESSION['role'] == 'Freelancer') {
		if ($_SESSION['status'] == 'Active') {
			header("Location: localhost:63342/gentelella-master/final/pages/index/freelancer.php");
		} else {
			header("Location: localhost:63342/gentelella-master/final/pages/index/inactive.php");
		}
	} elseif ($_SESSION['role'] == 'Business') {
		if ($_SESSION['status'] == 'Active') {
			header("Location: localhost:63342/gentelella-master/final/pages/index/business.php");
		} else {
			header("Location: localhost:63342/gentelella-master/final/pages/index/inactive.php");
		}
	} else {
		echo "YOU ARE A GUEST";
	}

?>