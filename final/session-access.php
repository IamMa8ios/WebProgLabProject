<?php
	
	if(session_status()!=PHP_SESSION_ACTIVE){
		session_start();
	}
	
	if (!isset($_SESSION['username'])) {
		header("Location: login.php");
	}else{
		if(!isset($_SESSION['active'])){
			header("Location: login.php");
		}
		if ($_SESSION['active']!='yes'){
			header("Location: login.php");
		}
	}
	
?>