<?php
    session_start();
	if(!(isset($_SESSION['username']) && isset($_SESSION['role']) && isset($_SESSION['status']) && $_SESSION['status']=='Pending Confirmation')){
	    header("Location: authentication-login.php");
		exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once "navigation-head.php" ?>
</head>

<body class="">

<div class="container body">
    <div class="main_container">

        <!-- top navigation -->
		<?php require_once "navigation-top-inactive.php"; ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

            <!-- Profile Widget -->
            <div class="col-md-3   widget widget_tally_box">
                <div class="x_panel fixed_height_390">
                    <div class="x_content">

                        <div class="flex">
                            <ul class="list-inline widget_profile_box">
                                <li>
                                    <a>
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <img src="Images/user.png" alt="..." class="img-circle profile_img">
                                </li>
                                <li>
                                    <a>
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Get data from DB -->
                        <h3 class="name"><?php echo $_SESSION['username']; ?></h3>

                        <div class="flex">
                            <ul class="list-inline count2" style="font-size: large">
                                <b>Pending Confirmation</b>
                            </ul>
                        </div>
                        <p>
                            Your account must be verified by an admin before you can continue. An admin will soon review
                            your application.
                        </p>
                    </div>
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

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>
