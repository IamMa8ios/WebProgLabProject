
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"><i class="fa fa-dollar"></i> <span>Bytes 4 Hire</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="Images/user.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
				<?php echo "<h2>" . $_SESSION['username'] . "</h2>"; ?>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <div id='sidebar-menu' class='main_menu_side hidden-print main_menu'>
            <div class='menu_section'>
                <h3>General</h3>
                <ul class='nav side-menu'>
                    <!-- Home -->
                    <li><a href='index.php'><i class='fa fa-home'></i> Home </a></li>
					
					<?php
						
						if (isset($_SESSION['role']) && isset($_SESSION['status'])) {
							
							if ($_SESSION['status'] == 'Active') {
								if ($_SESSION['role'] == 'Admin') { ?>
                                    <!-- Manage Users -->
                                    <li><a><i class='fa fa-edit'></i> Users <span class='fa fa-chevron-down'></span></a>
                                        <ul class='nav child_menu'>
                                            <li><a href='pages-admin-manage-nice.php'>Manage Users</a></li>
                                            <li><a href='pages-admin-manage-naughty.php'>Suspended</a></li>
                                        </ul>
                                    </li>

                                    <!-- Manage Polls -->
                                    <li><a><i class='fa fa-bar-chart-o'></i> Polling <span
                                                    class='fa fa-chevron-down'></span></a>
                                        <ul class='nav child_menu'>
                                            <li><a href='chartjs.html'>Create New</a></li>
                                            <li><a href='chartjs2.html'>Ongoing</a></li>
                                            <li><a href='morisjs.html'>History</a></li>
                                        </ul>
                                    </li>
									<?php
								} else {
									$listings = '';
									if ($_SESSION['role'] == 'Freelancer') {
										$listings = 'Business Listings';
									}
									
									if ($_SESSION['role'] == 'Business') {
										$listings = 'Freelancer Listings';
									} ?>
                                    <!-- Manage Listings -->
                                    <li><a><i class='fa fa-edit'></i> Listings <span class='fa fa-chevron-down'></span></a>
                                        <ul class='nav child_menu'>
                                            <li><a href='pages-user-listings-new.php'>New Listing</a></li>
                                            <li><a href='pages-user-listings-browse.php'><?php echo $listings; ?></a></li>
                                            <li><a href='pages-user-listings-history.php'>Manage My Listings</a></li>
                                        </ul>
                                    </li>

                                    <!-- Statistics -->
                                    <li><a><i class='fa fa-bar-chart-o'></i> Statistics </a></li>
								<?php }
							}else{
							    header("Location: index.php");
							    exit();
							}
						} ?>
                </ul>
            </div>
        </div>
    </div>
</div>
