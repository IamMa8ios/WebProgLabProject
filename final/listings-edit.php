<?php
	include("session-access.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../production/images/favicon.ico" type="image/ico" />
	
	<title>Bytes 4 Hire</title>
	
	<!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- Switchery -->
	<link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
	
	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">

<div class="container body">
	<div class="main_container">
		
		<!-- sidebar -->
        <?php include("sidebar.php"); ?>
		<!-- /sidebar -->
		
		<!-- top navigation -->
		<div class="top_nav">
			<div class="nav_menu">
				<div class="nav toggle">
					<a id="menu_toggle"><i class="fa fa-bars"></i></a>
				</div>
				<nav class="nav navbar-nav">
					<ul class=" navbar-right">
						<li class="nav-item dropdown open" style="padding-left: 15px;">
							<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
								<img src="Images/user.png" alt=""><?php echo $_SESSION['username']; ?>
							</a>
							<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item"  href="javascript:;"> Profile</a>
								<a class="dropdown-item"  href="javascript:;">
									<span>Settings</span>
								</a>
								<a class="dropdown-item"  href="javascript:;">Help</a>
								<a class="dropdown-item"  href="session-close.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
							</div>
						</li>
						
						<!-- Notifications - To be replaced with php -->
						<li role="presentation" class="nav-item dropdown open">
							<a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
								<i class="fa fa-envelope-o"></i>
								<span class="badge bg-green">1</span>
							</a>
							<ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
								
								<li class="nav-item">
									<a class="dropdown-item">
										<span class="image"><img src="Images/user.png" alt="Profile Image" /></span>
										<span>
                                            <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                        </span>
										<span class="message">
                                            Film festivals used to be do-or-die moments for movie makers. They were where...
                                        </span>
									</a>
								</li>
								
								<li class="nav-item">
									<div class="text-center">
										<a class="dropdown-item">
											<strong>See All Alerts</strong>
											<i class="fa fa-angle-right"></i>
										</a>
									</div>
								</li>
							</ul>
						</li>
					
					
					</ul>
				</nav>
			</div>
		</div>
		<!-- /top navigation -->
		
		<!-- page content -->
		<div class="right_col" role="main">
			
			<div class="row">
				<div class="col-md-6 ">
					<div class="x_panel">
						
						<div class="x_content">
							<br />
							<form class="form-horizontal form-label-left" method="POST" action="upload-listing.php">
								
								<span class="section">Listing Info</span>
								
								<div class="form-group row ">
									<label class="control-label col-md-3 col-sm-3 ">Job Title<span class="required">*</span></label>
									<div class="col-md-9 col-sm-9 ">
										<input type="text" class="form-control" name="job_title" placeholder="e.g. Developer" required="required">
									</div>
								</div>
								
								<div class="form-group row">
									<label class="control-label col-md-3 col-sm-3 ">Level</label>
									<div class="col-md-9 col-sm-9 ">
										<select class="form-control" name="exp_level">
											<option>Choose option</option>
											<?php include("load-explevels.php"); ?>
										</select>
									</div>
								</div>
								
								<div class="form-group row ">
									<label class="control-label col-md-3 col-sm-3 ">Payment Amount<span class="required">*</span></label>
									<div class="col-md-9 col-sm-9 ">
										<input type="text" class="form-control" name="amount" placeholder="" required="required">
									</div>
								</div>
								
								<div class="form-group row">
									<label class="control-label col-md-3 col-sm-3 ">Rate<span class="required">*</span></label>
									<div class="col-md-9 col-sm-9 ">
										<select class="form-control" name="rate">
											<option>Choose option</option>
											<?php include("load-rateoptions.php"); ?>
										</select>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="control-label col-md-3 col-sm-3 ">Techs</label>
									<div class="col-md-9 col-sm-9 ">
										<input id="tags_1" type="text" class="tags form-control" name="techs" value="" />
										<div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="control-label col-md-3 col-sm-3 ">Location</label>
									<div class="col-md-9 col-sm-9 ">
										<input type="text" name="location" id="autocomplete-custom-append" class="form-control col-md-10" required="required">
									</div>
								</div>
								
								<div class="form-group row">
									<label class="control-label col-md-3 col-sm-3 ">Description</label>
									<div class="col-md-9 col-sm-9 ">
										<input type="text" class="tags form-control" name="description" />
										<div style="position: relative; float: left; width: 250px; margin: 10px;"></div>
									</div>
								</div>
								
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-9 col-sm-9  offset-md-3">
										<button type="reset" class="btn btn-primary">Reset</button>
										<button type="submit" name="submit_button" value="freelancer_listing" class="btn btn-success">Submit</button>
									</div>
								</div>
							
							</form>
						</div>
					
					</div>
				</div>
			</div>
		
		</div>
		<!-- /page content -->
		
		<!-- footer content -->
		<footer>
			<div class="pull-right">
				Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
			</div>
			<div class="clearfix"></div>
		</footer>
		<!-- /footer content -->
	
	</div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery Tags Input -->
<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="../vendors/switchery/dist/switchery.min.js"></script>
<!-- jQuery autocomplete -->
<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- validator -->
<script src="../vendors/validator/validator.js"></script>



<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>
