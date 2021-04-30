<?php
	session_start();
	
	// remove all session variables
	session_unset();
	
	unset($_SESSION);
	//$_SESSION=[];
	
	// destroy the session
	session_destroy();
	header("Location: account/login.php");
?>
