<?php
    require_once "scripts.php";
    require_once "data-uploader.php";
    require_once "data-loader-guest.php";
	
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

            <div class="x_content">

                <div class="table-responsive">
                    <table class="table table-striped jambo_table ">

                        <thead>
                        <tr class="headings">
                            <th class="column-title">ID</th>
                            <th class="column-title">Job Title</th>
                            <th class="column-title">Level</th>
                            <th class="column-title">Payment</th>
                            <th class="column-title">Techs</th>
                            <th class="column-title">Location</th>
                            <th class="column-title">Date Submitted</th>
                            <th class="column-title">Status</th>
                        </tr>
                        </thead>

                        <tbody>
						<?php loadGuestListings(); ?>
                        </tbody>
                    </table>
                </div>

            </div>
            
            
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
