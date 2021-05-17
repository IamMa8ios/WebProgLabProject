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

        <?php require_once "navigation-sidebar.php"; ?>
        <?php require_once "navigation-top-admin.php"; ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="container">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">Manage Suspended Users</div>
                        <div class="card-footer">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">ID</th>
                                    <th class="column-title">Username</th>
                                    <th class="column-title">E-mail</th>
                                    <th class="column-title">Desired Role</th>
                                    <th class="column-title">Account Registered</th>
                                    <th class="column-title no-link last"><span class="nobr">Action</span>
                                    </th>
                                    <th class="bulk-actions" colspan="6">
                                        <a class="antoo" style="color:#fff; font-weight:500;">Select All ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php loadUsersWithStatus("Suspended"); ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
        
        <!-- footer content -->
        <?php require_once "navigation-footer.php"?>
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

