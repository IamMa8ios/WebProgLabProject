<?php
	
	if(session_status()!=PHP_SESSION_ACTIVE){
		session_start();
	}
	
	if (!isset($_SESSION['username'])) {
		header("Location: login.php");
	}else{
		if(!isset($_SESSION['status'])){
			header("Location: login.php");
		}
		if ($_SESSION['status']!='Active'){
			header("Location: login.php");
		}
	}
	
?>