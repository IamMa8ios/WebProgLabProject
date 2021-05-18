<?php
	require_once "scripts.php";
	require_once "data-loader.php";
	require_once "data-uploader.php";
	sessionCheck();
	
	$data=array();
	if(!isset($_POST)){
	    header("Location: 404.php");
	    exit();
    }elseif(isset($_POST['view_button'])){
	   $data=loadListingData($_POST['view_button']);
    }elseif(isset($_POST['enable_button'])){
		editListingStatus("enable", $_POST['enable_button']);
		header("Location: pages-user-listings-history.php");
		exit();
	}elseif(isset($_POST['disable_button'])){
		editListingStatus("disable", $_POST['disable_button']);
		header("Location: pages-user-listings-history.php");
		exit();
	}
	
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
                    <label class="control-label col-md-3 col-sm-3 ">Listing ID</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input id="listingID" type="text" class="form-control" name="listingID"
                               value="<?php echo $_POST['view_button']; ?>" required="required">
                    </div>
                </div>
                
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Job Title<span
                            class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" name="job_title"
                               value="<?php echo $data['job_title']; ?>" required="required">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Level<span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 ">
                        <select class="form-control" name="exp_level">
                            <?php loadExpLevelsWithSelection($data['job_level']); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Payment Amount<span
                            class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" name="amount" value="<?php echo $data['payment_amount']; ?>"
                               required="required">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Rate<span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 ">
                        <select class="form-control" name="rate">
                            <?php loadRatesWithSelection($data['payment_rate']); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Techs</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="tags form-control" name="techs" value="<?php echo $data['techs']; ?>"/>
                        <div id="suggestions-container"
                             style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Location</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" name="location" id="autocomplete-custom-append"
                               class="form-control " required="required" value="<?php echo $data['location']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Description</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input value="<?php echo $data['techs']; ?>" type="text" class="tags form-control" name="description"/>
                        <div style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9  offset-md-3">
                        <?php if($data['userID']==$_SESSION['id'] || $_SESSION['role']=='Admin'){ ?>
                        <input id="editButton" class="btn btn-dark" type="button" name='edit' value='Edit'>
                        <input id="saveButton" class="btn-positive" type="submit" name='submit_button' value='Update' hidden="hidden">
                        <?php }else{ ?>
                            <button type="submit" name="applyButton" value="<?php echo $_POST['view_button']; ?>" class="btn-positive">Apply</button>
                        <?php } ?>
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

<script>

    $(document).ready(function(){

        $("form input[type=text],form input[type=checkbox], select").prop("disabled",true);

        $("input[name=edit]").on("click",function(){

            $("input[type=text],input[type=checkbox],select").removeAttr("disabled");
        })

        document.getElementById("listingID").setAttribute("disabled", "disabled");

    })

    $(function(){
        $("#editButton").on('click',function() {
            $(this).hide();
            $("#saveButton").prop("hidden",false);
        });
    });

    $(function(){
        $("#saveButton").on('click',function() {
            $(this).prop("hidden",true);
            $("#editButton").show();
        });
    });
</script>

</body>
</html>
