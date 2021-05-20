<?php

	require_once "scripts.php";
	sessionCheck();
	
	if($_SESSION['role']==1){
		header("Location: index-admin.php");
		exit();
	}elseif ($_SESSION['role']==2){
		header("Location: index-professor.php");
		exit();
	}elseif ($_SESSION['role']==3){
		header("Location: index-student.php");
		exit();
	}elseif ($_SESSION['role']==0){
		header("Location: index-guest.php");
		exit();
	}

?>