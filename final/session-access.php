<?php
	
	if(session_status()!=PHP_SESSION_ACTIVE){
		session_start();
	}
	
//	$_SESSION["loggedin"] = true;
//	$_SESSION["id"] = $id;
//	$_SESSION["username"] = $username;
//	$_SESSION["role"] = $role;
//	$_SESSION["status"] = $status;
	
	if(!isset($_SESSION)){
		header("Location: account/login.php");
	}else{
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false){
			header("Location: account/login.php");
		}else{
			if (!isset($_SESSION['username'])) {
				header("Location: account/login.php");
			}else{
				if(!isset($_SESSION['status'])){
					header("Location: account/login.php");
				}
				if ($_SESSION['status']!='Active'){
					header("Location: account/login.php");
				}
			}
		}
	}
	
?>