<?php

	require_once "scripts.php";
	require_once "data-uploader.php";
	
	if (isset($_POST)){
		
		if($_POST['save']=='profile'){
			
			$data=$_POST;
			uploadProfile($data);
			unset($_POST);
		}
		
	}
	
	header("Location: pages-user-profile-view.php");
	exit();

?>