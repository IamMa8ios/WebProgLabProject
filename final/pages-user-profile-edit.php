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
		$phone = $profile['phone'];
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
    <!-- jQuery Knob -->
    <script src="../vendors/jquery-knob/dist/jquery.knob.min.js"></script>
</head>

<body class="nav-md">

<div class="container body">
	<div class="main_container">
		
		
		<?php include("navigation-sidebar.php"); ?>
		<?php
			if ($_SESSION['role']=='Admin'){
				require_once "navigation-top-admin.php";
			}else{
				require_once "navigation-top-user.php";
			}
		?>
		
		<!-- page content -->
		<div class="right_col" role="main">
			
			<div class="row">
				<div class="col-md-12 col-sm-12 ">
     
					<div class="x_panel">
      
						<div class="x_title">
							<h2>Edit Profile</h2>
                            <div class="clearfix"></div>
                        </div>
                        
						<div class="x_content">

                            <!-- Profile form -->
                            <div class="col-md-6 col-sm-12  ">
                                <div class="x_panel">
                                    
                                    <div class="x_title">
                                        <h2>Personal Info</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    
                                    <div class="x_content">
                                        <br />
                                        <form class="form-horizontal form-label-left" action="upload-profile.php" method="post" enctype="multipart/form-data">

                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Profile Photo</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <label class="btn-view btn-upload" for="inputImage" title="Upload image file">
                                                        <input type="file" class="sr-only" id="inputImage" name="photo" accept="image/*" value="<?php echo $photo; ?>">
                                                        <span class="docs-tooltip" data-toggle="tooltip" title="Upload">
                                                            <span class="fa fa-upload"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">User ID</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="userID" type="text" class="form-control" value="<?php echo $userID; ?>" readonly="readonly">
                                                    <span class="fa fa-credit-card form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">First Name</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="firstName" type="text" class="form-control" value="<?php echo $firstName; ?>">
                                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Last Name</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="lastName" type="text" class="form-control" value="<?php echo $lastName; ?>">
                                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Phone Number</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="phone" type="text" class="form-control" data-inputmask="'mask' : '9999999999'" value="<?php echo $phone; ?>">
                                                    <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="email" type="email" class="form-control" value="<?php echo $email; ?>">
                                                    <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Rank</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="rank" type="text" class="form-control" value="<?php echo $rank; ?>">
                                                    <span class="fa fa-briefcase form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Website</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="website" type="text" class="form-control" value="<?php echo $website; ?>">
                                                    <span class="fa fa-external-link form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>

                                            <div class="form-group">
                                                <div class="col-md-9 col-sm-9 col-xs-9 btn-group">
                                                    <button type="button" class="btn-gray" href="pages-user-profile-view.php">Cancel</button>
                                                
                                                    <button type="reset" class="btn-view">Reset</button>
                                                
                                                    <button name="save" type="submit" class="btn-positive" value="profile">Save</button>
                                                </div>
                                            </div>
                                            
                                        </form>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- /Profile form -->
                            
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
<!-- jquery.inputmask -->
<script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<!-- jQuery autocomplete -->
<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- Ion.RangeSlider -->
<script src="../vendors/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
<!-- jQuery Knob -->
<script src="../vendors/jquery-knob/dist/jquery.knob.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>
