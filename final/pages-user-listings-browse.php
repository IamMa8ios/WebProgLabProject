<?php
	require_once "scripts.php";
	require_once "data-loader.php";
	sessionCheck();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once "navigation-head.php" ?>
</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">
		
		<?php require_once "navigation-sidebar.php"; ?>
		<?php require_once "navigation-top-user.php"; ?>

        <!-- page content -->
        <div class="right_col" role="main">


            <div class="col-md-6">
                <h3>My Listings</h3>
            </div>

            <!-- Listings Table -->
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">

                        <thead>
                        <tr class="headings">
                            <th>
                                <input type="checkbox" id="check-all" class="flat"></th>
                            </th>
                            <th class="column-title">ID</th>
                            <th class="column-title">Job Title</th>
                            <th class="column-title">Level</th>
                            <th class="column-title">Payment</th>
                            <th class="column-title">Techs</th>
                            <th class="column-title">Location</th>
                            <th class="column-title">Date Submitted</th>
                            <th class="column-title">Status</th>
                            <th class="column-title no-link last"><span class="nobr">Actions</span>
                            <th class="bulk-actions" colspan="9">
                                <a class="antoo" style="color:#fff; font-weight:500;">Select All ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                        </thead>

                        <tbody>
						<?php
							if($_SESSION['role']=='Admin'){
								loadListings($_SESSION['role']);
							}elseif($_SESSION['role']=='Business'){
	                            loadListings('Freelancer');
                            }elseif($_SESSION['role']=='Freelancer'){
	                            loadListings('Business');
                            }
                        ?>
                        </tbody>
                    </table>
                </div>


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
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>
