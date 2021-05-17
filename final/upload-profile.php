<?php

	require_once "scripts.php";
	require_once "data-uploader.php";
	sessionCheck();
	
	if(isset($_POST) && isset($_POST['save'])){
		
		$data=$_POST;
		
		if($_POST['save']=='profile'){
			uploadProfile($data);
		}elseif ($_POST['save']=='skills'){
			uploadSkills($data);
		}
		
	}else{
		header("Location: 404.php");
		exit();
	}


?>