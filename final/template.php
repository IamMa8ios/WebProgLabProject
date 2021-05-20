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
		
		
		<?php include("navigation-sidebar.php"); ?>
		<?php include("navigation-top-user.php"); ?>

        <!-- page content -->
        <div class="right_col" role="main">

        </div>
        <!-- /page content -->

        <!-- footer content -->
		<?php include_once "navigation-footer.php"; ?>
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
