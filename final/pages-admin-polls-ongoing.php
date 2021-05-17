<?php
require_once "scripts.php";
require_once "data-loader.php";
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
            <div class="row"> <!-- View Reported Users -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">Ongoing Polls</div>
                        <div class="card-footer">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Poll ID</th>
                                    <th class="column-title">Title</th>
                                    <th class="column-title">Date Created</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>

                                </tr>
                                </thead>

                                <tbody>
                                <?php loadPollWithStatus('Open'); ?>
                                </tbody>
                            </table>

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
