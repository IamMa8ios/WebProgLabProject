<?php
	require_once "scripts.php";
	require_once "data-loader.php";
	sessionCheck();
	
	$name = "";
	$birthday = "";
	$phone = "";
	$country = "";
	$email = "";
	$job = "";
	$website = "";
	
	$profile = loadProfile($_SESSION['id']);
	
	if ($profile) {
		$name = $profile['name'];
		$birthday = date('d/m/Y', strtotime($profile['birthday']));
		$phone = "+" . $profile['phone'];
		$phone = substr_replace($phone, "-", 3, 0);
		$country = $profile['country'];
		$email = $profile['email'];
		$job = $profile['job'];
		$website = $profile['website'];
	}
	
	$skill1 = "";
	$value1 = 0;
	$skill2 = "";
	$value2 = 0;
	$skill3 = "";
	$value3 = 0;
	$skill4 = "";
	$value4 = 0;
	
	$skills = loadSkills($_SESSION['id']);
	
	if ($skills) {
		$skill1 = $skills['skill1'];
		$value1 = $skills['value1'];
		$skill2 = $skills['skill2'];
		$value2 = $skills['value2'];
		$skill3 = $skills['skill3'];
		$value3 = $skills['value3'];
		$skill4 = $skills['skill4'];
		$value4 = $skills['value4'];
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
                                        <img class="img-responsive avatar-view" src="images/picture.jpg"
                                             alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>
                                <h3><?php echo $name; ?></h3>

                                <ul class="list-unstyled user_data">

                                    <li><i class="fa fa-birthday-cake user-profile-icon"></i> <?php echo $birthday; ?>
                                    </li>

                                    <li><i class="fa fa-phone user-profile-icon"></i> <?php echo $phone; ?> </li>

                                    <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $country; ?></li>

                                    <li><i class="fa fa-envelope-o user-profile-icon"></i> <?php echo $email; ?></li>

                                    <li><i class="fa fa-briefcase user-profile-icon"></i> <?php echo $job; ?> </li>

                                    <li class="m-top-xs">
                                        <i class="fa fa-external-link user-profile-icon"></i>
                                        <a href="https://<?php echo $website; ?>"
                                           target="_blank"><?php echo $website; ?></a>
                                    </li>

                                </ul>

                                <!-- start skills -->
                                <h4>Skills</h4>
                                <ul class="list-unstyled user_data">
									
									<?php if ($skill1 != "") { ?>

                                        <li>
                                            <p> <?php echo $skill1; ?> </p>
                                            <div class="progress progress_sm">
                                                <div class="progress-bar bg-green" role="progressbar"
                                                     data-transitiongoal="<?php echo $value1; ?>"></div>
                                            </div>
                                        </li>
									
									<?php } ?>
									
									<?php if ($skill2 != "") { ?>

                                        <li>
                                            <p> <?php echo $skill2; ?> </p>
                                            <div class="progress progress_sm">
                                                <div class="progress-bar bg-green" role="progressbar"
                                                     data-transitiongoal="<?php echo $value2; ?>"></div>
                                            </div>
                                        </li>
									
									<?php } ?>
									
									<?php if ($skill3 != "") { ?>

                                        <li>
                                            <p> <?php echo $skill3; ?> </p>
                                            <div class="progress progress_sm">
                                                <div class="progress-bar bg-green" role="progressbar"
                                                     data-transitiongoal="<?php echo $value3; ?>"></div>
                                            </div>
                                        </li>
									
									<?php } ?>
									
									<?php if ($skill4 != "") { ?>

                                        <li>
                                            <p> <?php echo $skill4; ?> </p>
                                            <div class="progress progress_sm">
                                                <div class="progress-bar bg-green" role="progressbar"
                                                     data-transitiongoal="<?php echo $value4; ?>"></div>
                                            </div>
                                        </li>
									
									<?php } ?>

                                    <!-- end of skills -->

                                    <a class="btn btn-success" href="pages-user-profile-edit.php"><i
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
