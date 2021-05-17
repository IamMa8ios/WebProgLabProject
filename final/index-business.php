<?php
	require_once "scripts.php";
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
                            <ul class="list-inline count2">
                                <li>
                                    <h3>123</h3>
                                    <span>Listed</span>
                                </li>
                                <li>
                                    <h3>123</h3>
                                    <span>Applied</span>
                                </li>
                                <li>
                                    <h3>123</h3>
                                    <span>Applied</span>
                                </li>
                            </ul>
                        </div>
                        <p>
                            If you've decided to go in development mode and tweak all of this a bit, there are few
                            things you should do.
                        </p>
                    </div>
                </div>
            </div>
            <!-- /Profile Widget -->

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
