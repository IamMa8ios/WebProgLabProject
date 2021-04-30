<div class="top_nav" style="margin-left: 0">
    <div class="nav_menu">
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                       id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="../../Images/user.png" alt=""><?php echo $_SESSION['username']; ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../users/profile-inactive.php"> Profile</a>
                        <a class="dropdown-item" href="javascript:;">
                            <span>Settings</span>
                        </a>
                        <a class="dropdown-item" href="javascript:;">Help</a>
                        <a class="dropdown-item" href="../../account/session-close.php"><i class="fa fa-sign-out pull-right"></i> Log
                            Out</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>