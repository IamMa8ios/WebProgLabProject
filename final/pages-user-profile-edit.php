<?php
	require_once "scripts.php";
	sessionCheck();
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
                                        <form class="form-horizontal form-label-left" action="upload-profile.php" method="post">

                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Profile Photo</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                                        <input type="file" class="sr-only" id="inputImage" name="photo" accept="image/*">
                                                        <span class="docs-tooltip" data-toggle="tooltip" title="Upload">
                                                            <span class="fa fa-upload"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Full Name</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="name" type="text" class="form-control">
                                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Birthday</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="birthday" type="text" class="form-control" data-inputmask="'mask': '99/99/9999'">
                                                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Phone Number</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="phone" type="text" class="form-control" data-inputmask="'mask' : '(+99) 999-9999999'">
                                                    <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Country</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" name="country" id="autocomplete-custom-append"
                                                           class="form-control ">
                                                    <span class="fa fa-globe form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="email" type="email" class="form-control">
                                                    <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Job</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="job" type="text" class="form-control">
                                                    <span class="fa fa-briefcase form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Website</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="website" type="text" class="form-control">
                                                    <span class="fa fa-external-link form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>

                                            <div class="form-group">
                                                <div class="col-md-9 col-sm-9 col-xs-9 btn-group">
                                                    <button type="button" class="btn btn-secondary" href="pages-user-profile-view.php">Cancel</button>
                                                
                                                    <button type="reset" class="btn btn-dark">Clear</button>
                                                
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                </div>
                                            </div>
                                            
                                        </form>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- /Profile form -->

                            <!-- Skill form -->
                            <div class="col-md-6 col-sm-12  ">
                                <div class="x_panel">
                                    
                                    <div class="x_title">
                                        <h2>Skillset</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    
                                    <div class="x_content">
                                        <br />
                                        <form class="form-horizontal form-label-left" action="#" method="post">

                                            <div class="form-group row">
                                                <label class="col-md-3 col-sm-3 col-xs-3">
                                                    <input name="skillName1" type="text" class="form-control" placeholder="Skill 1">
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="skill1" class="knob" data-width="110" data-height="120" data-displayPrevious=true data-fgColor="#26B99A" data-skin="tron" data-thickness=".2" value="75">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Use slider to determine your proficiency</label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-sm-3 col-xs-3">
                                                    <input name="skillName2" type="text" class="form-control" placeholder="Skill 2">
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="skill2" class="knob" data-width="110" data-height="120" data-displayPrevious=true data-fgColor="#26B99A" data-skin="tron" data-thickness=".2" value="75">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Use slider to determine your proficiency</label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-sm-3 col-xs-3">
                                                    <input name="skillName3" type="text" class="form-control" placeholder="Skill 3">
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input name="skill3" class="knob" data-width="110" data-height="120" data-displayPrevious=true data-fgColor="#26B99A" data-skin="tron" data-thickness=".2" value="75">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Use slider to determine your proficiency</label>
                                                    
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-sm-3 col-xs-3">
                                                    <input name="skillName4" type="text" class="form-control" placeholder="Skill 4">
                                                </label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Use slider to determine your proficiency</label>
                                                    <input name="skill4" class="knob" data-width="110" data-height="120" data-displayPrevious=true data-fgColor="#26B99A" data-skin="tron" data-thickness=".2" value="75">
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>
                                            
                                            <div class="form-group">
                                                <div class="col-md-9 col-sm-9 col-xs-9 btn-group">
                                                    <button type="button" class="btn btn-secondary" href="pages-user-profile-view.php">Cancel</button>

                                                    <button type="reset" class="btn btn-dark">Clear</button>

                                                    <button type="submit" class="btn btn-success">Save</button>
                                                </div>
                                            </div>

                                        </form>

                                    </div>

                                </div>
                            </div>
                            <!-- /Skill form -->
                            
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
