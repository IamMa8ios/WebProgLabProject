<?php
	require_once "scripts.php";
	require_once "data-loader.php";
	
	sessionCheck();
	$userID=$_SESSION['id'];
	
	if (isset($_POST) && isset($_POST['manage_settings'])){
		$userID=$_POST['manage_settings'];
	}
	
	$username = "";
	$email = "";
	
	$settings = loadSettings($userID);
	
	if ($settings) {
	    $username=$settings['username'];
	    $email=$settings['email'];
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
		
		
		<?php require_once "navigation-sidebar.php"; ?>
		<?php require_once "navigation-top-user.php"; ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="x_content">

                <!-- Settings form -->
                <div class="col-md-6 col-sm-12  ">
                    <div class="x_panel">

                        <div class="x_title">
                            <h2>Personal Info</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <br />
                            <form class="form-horizontal form-label-left" action="upload-settings.php" method="post" enctype="multipart/form-data">

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">User ID</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input name="userID" type="text" class="form-control" value="<?php echo $userID; ?>" readonly="readonly">
                                        <span class="fa fa-credit-card form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Username</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input name="username" type="text" class="form-control" value="<?php echo $username; ?>">
                                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">EmailName</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input name="email" type="email" class="form-control" value="<?php echo $email; ?>">
                                        <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Password</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input name="password" type="password" class="form-control" placeholder="(Leave blank if you do not wish to change password)">
                                        <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Confirm Password</label>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input name="confirmPassword" type="password" class="form-control" placeholder="(Leave blank if you do not wish to change password)">
                                        <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>

                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-9 btn-group">
                                        <button type="button" class="btn-gray" href="index.php">Cancel</button>

                                        <button type="reset" class="btn-view">Reset</button>

                                        <button name="save" type="submit" class="btn-positive" value="settings">Save</button>
                                    </div>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
                <!-- /Settings form -->

            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
		<?php require_once "navigation-footer.php"; ?>
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
