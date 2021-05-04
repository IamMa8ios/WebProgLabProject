<?php

	require_once "scripts.php";
	sessionCheck();
	
	if($_SESSION['role']=='Admin'){
		header("Location: index-admin.php");
		exit();
	}elseif ($_SESSION['role']=='Business'){
		header("Location: index-business.php");
		exit();
	}elseif ($_SESSION['role']=='Freelancer'){
		header("Location: index-freelancer.php");
		exit();
	}elseif ($_SESSION['role']=='Guest'){
		header("Location: index-guest.php");
		exit();
	}

?>