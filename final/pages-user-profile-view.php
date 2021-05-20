<?php
	require_once "scripts.php";
	require_once "data-loader.php";
	
	sessionCheck();
	
	$userID=$_SESSION['id'];
	$photo = "user.png";
	$firstName = "";
	$lastName = "";
	$phone = "";
	$email = "";
	$rank = "";
	$website = "";
	
	if(isset($_POST)){
		
		if(isset($_POST['userID']) && is_int($_POST['userID'] )){
			$userID=$_POST['userID'];
		}
		
	}
	
	$profile = loadProfile($userID);
	
	unset($_POST);
	
	if ($profile) {
		if($profile['photo']!="")
			$photo = $profile['photo'];
		$firstName = $profile['first_name'];
		$lastName = $profile['last_name'];
		$phone = "+30 - " . $profile['phone'];
		$email = $profile['email'];
		$rank = $profile['rank'];
		$website = $profile['website'];
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once "navigation-head.php"; ?>
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">
		
		
		<?php include("navigation-sidebar.php"); ?>
		<?php include("navigation-top-user.php"); ?>

        <!-- page content -->
        <div class="right_col" role="main">

            <div class="row">
                <div class="col-md-6 col-sm-3 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>User Profile</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!-- Profile -->
                            <div class="col-md-6 col-sm-3  profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view" src="profile-photos/<?php echo $photo; ?>"
                                             alt="Avatar" title="Change the avatar" style="max-height: 300px; max-width: 300px;">
                                    </div>
                                </div>
                                <h3><?php echo $firstName . " ". $lastName; ?></h3>

                                <ul class="list-unstyled user_data">

                                    <li><i class="fa fa-phone user-profile-icon"></i> <?php echo $phone; ?> </li>

                                    <li><i class="fa fa-envelope-o user-profile-icon"></i> <?php echo $email; ?></li>

                                    <li><i class="fa fa-star-o user-profile-icon"></i> <?php echo $rank; ?> </li>

                                    <li class="m-top-xs">
                                        <i class="fa fa-external-link user-profile-icon"></i>
                                        <a href="https://<?php echo $website; ?>"
                                           target="_blank"><?php echo $website; ?></a>
                                    </li>

                                </ul>

                                <!-- start skills -->
                                <h4></h4>
                                <ul class="list-unstyled user_data">
									
									<?php
                                        if (($_SESSION['role']!='2'))
                                            echo loadProfileStats($userID);
                                        ?>
									

                                    <!-- end of skills -->

                                    <a class="btn-view" href="pages-user-profile-edit.php"><i
                                                class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                                    <br/>

                            </div>
                            <!-- /Profile -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
	<?php include_once "navigation-footer.php"; ?>
    <!-- /footer content -->
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- morris.js -->
<script src="../vendors/raphael/raphael.min.js"></script>
<script src="../vendors/morris.js/morris.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>
