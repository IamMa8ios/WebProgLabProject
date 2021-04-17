<?php
	
	include("session-access.php");
	
	if (isset($_SESSION['role'])) {
		
		echo "<div id='sidebar-menu' class='main_menu_side hidden-print main_menu'>
                    <div class='menu_section'>
                        <h3>General</h3>
                        <ul class='nav side-menu'>
                            <!-- Home -->
                            <li><a href='index.php'><i class='fa fa-home'></i> Home </a></li>";
		
		if ($_SESSION['role'] == 'Admin') {
			echo "<!-- Manage Users -->
                    <li><a><i class='fa fa-edit'></i> Users <span class='fa fa-chevron-down'></span></a>
                        <ul class='nav child_menu'>
                            <li><a href='form.html'>New Applications</a></li>
                            <li><a href='form_advanced.html'>Businesses</a></li>
                            <li><a href='form_validation.html'>Freelancers</a></li>
                            <li><a href='form_wizards.html'>Suspended</a></li>
                        </ul>
                    </li>
                    
                    <!-- Manage Polls -->
                    <li><a><i class='fa fa-bar-chart-o'></i> Polling <span class='fa fa-chevron-down'></span></a>
                        <ul class='nav child_menu'>
                            <li><a href='chartjs.html'>Create New</a></li>
                            <li><a href='chartjs2.html'>Ongoing</a></li>
                            <li><a href='morisjs.html'>History</a></li>
                        </ul>
                    </li>";
		} elseif ($_SESSION['role'] == 'Freelancer') {
			echo "<!-- Manage Listings -->
                    <li><a><i class='fa fa-edit'></i> Listings <span class='fa fa-chevron-down'></span></a>
                        <ul class='nav child_menu'>
                            <li><a href='listings-new.php'>New Listing</a></li>
                            <li><a href='listings-business.php'>Business Listings</a></li>
                            <li><a href='listings-personal.php'>Manage My Listings</a></li>
                        </ul>
                    </li>
        
                    <!-- Statistics -->
                    <li><a><i class='fa fa-bar-chart-o'></i> Statistics </a></li>";
		} elseif ($_SESSION['role'] == 'Business') {
		
		} else {
			header("Location: index.php");
		}
		
		echo "</ul></div></div>";
		
		
	}
?>