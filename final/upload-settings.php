<?php
	
	require_once "data-uploader.php";
	
	if (isset($_POST) && isset($_POST['save']) && $_POST['save']=='settings'){
		
		if(isset($_POST['password']) && isset($_POST['confirmPassword']) && $_POST['password']==$_POST['confirmPassword']){
			
			$data=$_POST;
			$data['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);
			
			updateSettings($data);
		}
	}
	
	header("Location: index.php");
	exit();
	
?>
