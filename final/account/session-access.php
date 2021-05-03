<?php
	
	if (session_status() != PHP_SESSION_ACTIVE) {
		session_start();
	}
	
	//if no session has been initialized, then redirect to choose role
	if (!isset($_SESSION)) {
		header("Location: localhost:63342/gentelella-master/final/pages/users/login.php");
	} else {//if a session already exists
		
		//check if everything is set and redirect to corresponding page
		if(!isset($_SESSION['loggedin'])){
			header("Location: localhost:63342/gentelella-master/final/pages/users/login.php");
		}
		if($_SESSION['loggedin']==false){
			header("Location: localhost:63342/gentelella-master/final/pages/users/login.php");
		}
		if (!isset($_SESSION['username'])) {
			header("Location: localhost:63342/gentelella-master/final/pages/users/login.php");
		}
		if (!isset($_SESSION['status'])) {
			header("Location: localhost:63342/gentelella-master/final/pages/users/login.php");
		}
		if (!isset($_SESSION['role'])) {
			header("Location: localhost:63342/gentelella-master/final/pages/users/login.php");
		}
		if (!isset($_SESSION['id'])) {
			header("Location: localhost:63342/gentelella-master/final/pages/users/login.php");
		}
		if ($_SESSION['status']!='Active') {
			header("Location: localhost:63342/gentelella-master/final/pages/index/inactive.php");
		}
		
	}
?>