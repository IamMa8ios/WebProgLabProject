<?php
    require_once "scripts.php";
    require_once "data-uploader.php";
	
	if (session_status() != PHP_SESSION_ACTIVE) {
		session_start();
	}
 
	if(isset($_SESSION['role']) && isset($_SESSION['loggedin'])){
		if($_SESSION['role']=='Guest' && $_SESSION['loggedin']==false){
			$_SESSION['loggedin']=true;
			logGuest();
		}
    }else{
		$_SESSION['loggedin']=true;
		$_SESSION['status']='Guest';
		logGuest();
    }
	
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once "navigation-head.php"; ?>
</head>

<body class="nav-md">

<div class="container body">
	<div class="main_container">
		
		<?php include("navigation-top-guest.php"); ?>
		
		<!-- page content -->
		<div class="right_col" role="main">
		
		</div>
		<!-- /page content -->
		
		<!-- footer content -->
		<?php include_once "navigation-footer.php"; ?>
		<!-- /footer content -->
	</div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>
