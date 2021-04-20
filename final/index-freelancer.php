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
    <link rel="icon" href="../production/images/favicon.ico" type="image/ico"/>

    <title>Bytes 4 Hire</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">
		
		<?php include("navigation-sidebar.php"); ?>
		<?php include("navigation-top.php"); ?>

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
			
			<?php //echo hash('sha3-256', 'test'); ?>

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

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>
