<?php
	require_once "scripts.php";
	sessionCheck();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once "navigation-head.php"; ?>
</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">
		
		
		<?php require_once "navigation-sidebar.php"; ?>
		<?php require_once "navigation-top-user.php"; ?>

        <!-- page content -->
        <div class="right_col" role="main">

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
