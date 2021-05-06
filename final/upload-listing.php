<?php
	
	require_once "scripts.php";
	require_once "data-uploader.php";
	require_once "data-loader.php";
	
	if (isset($_POST)) {//check if data was given
		
		echo "posted<br>";
		
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		
		if (isset($_POST['submit_button'])) {
			
			echo "submitted<br>";
			
			$data['job_title'] = $_POST['job_title'];
			$data['exp_level'] = $_POST['exp_level'];
			$data['amount']= $_POST['amount'];
			$data['rate'] = $_POST['rate'];
			$data['techs'] = $_POST['techs'];
			$data['location'] = $_POST['location'];
			$data['description'] = $_POST['description'];
			
			if (isset($_POST['job_title']) && isset($_POST['exp_level']) && isset($_POST['rate']) &&
				isset($_POST['amount']) && isset($_POST['amount']) && isset($_POST['techs']) && isset($_POST['location'])
				&& $_POST['rate']!='Choose option' && $_POST['exp_level']!='Choose option'){
				
				if($_POST['submit_button']=='Create'){
					uploadListing($data, "Create");
				}elseif ($_POST['submit_button']=='Update' && isset($_POST['listingID'])){
					
					$oldData=loadListingData($_POST['listingID']);
					
					if($data['job_title']==$oldData['job_title'] && $data['exp_level']==$oldData['job_level'] &&
						$data['amount']==$oldData['payment_amount'] && $data['rate']==$oldData['payment_rate'] &&
						$data['techs']==$oldData['techs'] && $data['location']==$oldData['location'] &&
						$data['description']==$oldData['description']){
						echo "nothing changed";
					}else{
						$data['id']=$_POST['listingID'];
						uploadListing($data, "Update");
					}
					
				}
				
			}
			
		}
		
	}
?>


