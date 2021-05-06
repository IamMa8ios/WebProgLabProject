<?php
	require_once "scripts.php";
	require_once "data-loader.php";
	sessionCheck();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once "navigation-head.php" ?>

    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
</head>

<body class="nav-md">


<div class="container body">
    <div class="main_container">
    
		<?php require_once "navigation-sidebar.php"; ?>
		<?php require_once "navigation-top-user.php"; ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
            
            <!-- listing form -->
            <form class="form-horizontal form-label-left" method="POST" action="upload-listing.php">

                <span class="section">Listing Info</span>

                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Job Title<span
                                class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" name="job_title"
                               placeholder="e.g. Developer" required="required">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Level<span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 ">
                        <select class="form-control" name="exp_level">
                            <option>Choose option</option>
							<?php loadExpLevels(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Payment Amount<span
                                class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="number" class="form-control" name="amount" placeholder=""
                               required="required">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Rate<span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 ">
                        <select class="form-control" name="rate">
                            <option>Choose option</option>
							<?php loadRates(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Techs</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input id="tags_1" type="text" class="tags form-control" name="techs" value=""/>
                        <div id="suggestions-container"
                             style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Location</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" name="location" id="autocomplete-custom-append"
                               class="form-control " required="required">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Description</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="tags form-control" name="description"/>
                        <div style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <button type="submit" name="submit_button" value="Create"
                                class="btn btn-success">Submit
                        </button>
                    </div>
                </div>

            </form>
            <!-- /listing form -->

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
