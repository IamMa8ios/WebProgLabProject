<?php

	require_once "scripts.php";
	
	if(isset($_GET)){
		
		//role
		//action
		//id
		
		sessionCheck();
		
		if(isset($_SESSION)){
			
			if($_SESSION['role']==$_GET['role']){
				
				if($_SESSION['role']==0){
					
					if($_GET['action']!='View'){
						header("Location: 404.php");
						exit();
					}else{
						
						$subjects=loadSubjects();
						
						
						
					}
					
				}
				
			}else{
				header("Location: 404.php");
				exit();
			}
			
		}
		
	}else{
		header("Location: 404.php");
		exit();
	}
	
?>