<?php
	include("../../account/session-access.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../Images/icon.ico" type="image/ico"/>

    <title>Bytes 4 Hire</title>

    <!-- Bootstrap -->
    <link href="../../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../../../vendors/switchery/dist/switchery.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">


<div class="container body">
    <div class="main_container">
    
		<?php include("../../pages/navigation/sidebar.php"); ?>
		<?php include("../../pages/navigation/top-active.php"); ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
            
            <!-- listing form -->
            <form class="form-horizontal form-label-left" method="POST" action="../../listings/upload/insert.php">

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
							<?php include("../../listings/load/explevels.php"); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Payment Amount<span
                                class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" name="amount" placeholder=""
                               required="required">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Rate<span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 ">
                        <select class="form-control" name="rate">
                            <option>Choose option</option>
							<?php include("../../listings/load/rates.php"); ?>
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
                        <button type="submit" name="submit_button" value="freelancer_listing"
                                class="btn btn-success">Submit
                        </button>
                    </div>
                </div>

            </form>
            <!-- /listing form -->

        </div>
        <!-- /page content -->

        
        
        <!-- footer content -->
				<?php include("../../pages/navigation/footer.php"); ?>
        <!-- /footer content -->
    </div>
</div>


<!-- jQuery -->
<script src="../../../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery Tags Input -->
<script src="../../../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="../../../vendors/switchery/dist/switchery.min.js"></script>
<!-- jQuery autocomplete -->
<script src="../../../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- validator -->
<script src="../../../vendors/validator/validator.js"></script>


<!-- Custom Theme Scripts -->
<script src="../../../build/js/custom.min.js"></script>

</body>
</html>
