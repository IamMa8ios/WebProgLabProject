<?php
require_once "scripts.php";
require_once "data-loader.php";
sessionCheck();
?>
<?php
$pollTitle = '';
$pollID = '';
$pollOptions = array();

if (isset($_POST)) {

    if (isset($_POST['view_poll'])) {
        $thePoll = loadPollWithID($_POST['view_poll']);
        $pollTitle = $thePoll['title'];
        $pollID = $_POST['view_poll'];
    } elseif ($_POST['delete_poll']) { // scripts

    } elseif ($_POST['open_poll']) {

    }
}
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body"><strong>Poll Title: </strong><?php echo $pollTitle ?></div>
                        <div class="card-footer">
                            <?php loadPollOptions($pollID) ?>
                            <form method="post" action="upload-poll-options.php">
                                <button type="submit" name="delete_poll" value="<?php echo $pollID ?>"
                                        class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span> Delete Poll
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
