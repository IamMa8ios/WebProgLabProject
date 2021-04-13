<?php
    session_start();
	if (!isset($_SESSION['username'])) {
		header("Location: login.php");
	}else{
		if(!isset($_SESSION['active'])){
			header("Location: login.php");
		}
		if ($_SESSION['active']!='yes'){
			header("Location: login.php");
		}
    }
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
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index-freelancer.php" class="site_title"><i class="fa fa-dollar"></i> <span>Bytes 4 Hire</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="Images/user.png" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2><?php echo $_SESSION['username']; ?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <!-- Home -->
                            <li><a href="index-freelancer.php"><i class="fa fa-home"></i> Home </a></li>

                            <!-- Manage Listings -->
                            <li><a><i class="fa fa-edit"></i> Listings <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="listings-new.php">New Listing</a></li>
                                    <li><a href="listings-business.php">Business Listings</a></li>
                                    <li><a href="listings-personal.php">Manage My Listings</a></li>
                                </ul>
                            </li>

                            <!-- Statistics -->
                            <li><a><i class="fa fa-bar-chart-o"></i> Statistics </a></li>

                            <!-- Manage Tables -->
                            <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="tables.html">Tables</a></li>
                                    <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->
                
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                    <ul class=" navbar-right">
                        <li class="nav-item dropdown open" style="padding-left: 15px;">
                            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                               id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                <img src="Images/user.png" alt=""><?php echo $_SESSION['username']; ?>
                            </a>
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="javascript:;"> Profile</a>
                                <a class="dropdown-item" href="javascript:;">
                                    <span>Settings</span>
                                </a>
                                <a class="dropdown-item" href="javascript:;">Help</a>
                                <a class="dropdown-item" href="session-close.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                            </div>
                        </li>

                        <!-- Notifications - To be replaced with php -->
                        <li role="presentation" class="nav-item dropdown open">
                            <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                               data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">1</span>
                            </a>
                            <ul class="dropdown-menu list-unstyled msg_list" role="menu"
                                aria-labelledby="navbarDropdown1">

                                <li class="nav-item">
                                    <a class="dropdown-item">
                                        <span class="image"><img src="Images/user.png" alt="Profile Image"/></span>
                                        <span>
                                            <!-- Username from notification -->
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
                        <!-- /Notifications -->

                    </ul>
                </nav>
            </div>
        </div>
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
                            <ul class="list-inline count2">
                                <li>
                                    <h3>123</h3>
                                    <span>Listed</span>
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
