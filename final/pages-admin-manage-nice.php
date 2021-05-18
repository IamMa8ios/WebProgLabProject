<?php
    require_once "scripts.php";
    require_once "data-loader.php";
    sessionCheck();
?>

<html lang="en">
<head>
    <?php require_once "navigation-head.php" ?>
</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">


        <?php include("navigation-sidebar.php"); ?>
        <?php include("navigation-top-admin.php"); ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-6  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-align-left"></i> General Info </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <!-- start accordion -->
                        <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                            <div class="panel">
                                <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                                    <h4 class="panel-title">Pending Confirmation</h4>
                                </a>
                                <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <table class="table table-striped jambo_table bulk_action table-bordered"> <!-- pending registration table-->
                                            <thead>
                                            <tr class="headings">
                                                <th class="column-title">ID</th>
                                                <th class="column-title">Username</th>
                                                <th class="column-title">E-mail</th>
                                                <th class="column-title">Desired Role</th>
                                                <th class="column-title">Account Registered</th>
                                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                                <th class="column-title no-link last"><span class="nobr">Manage</span>
                                                </th>
                                                <th class="bulk-actions" colspan="8">
                                                    <a class="antoo" style="color:#fff; font-weight:500;">Select All ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php loadUsersWithStatus("Pending Confirmation"); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo">
                                    <h4 class="panel-title">Active Businesses</h4>
                                </a>
                                <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <table class="table table-striped jambo_table bulk_action table-bordered"> <!-- business table-->
                                            <thead>
                                            <tr class="headings">
                                                <th class="column-title">ID</th>
                                                <th class="column-title">Username</th>
                                                <th class="column-title">E-mail</th>
                                                <th class="column-title">Role</th>
                                                <th class="column-title">Account Registered</th>
                                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                                <th class="column-title no-link last"><span class="nobr">Manage Profile</span>
                                                </th>
                                                <th class="bulk-actions" colspan="8">
                                                    <a class="antoo" style="color:#fff; font-weight:500;">Select All ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php loadUsersWithRole('Business', 'Active'); ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <a class="panel-heading collapsed" role="tab" id="headingThree1" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1" aria-expanded="false" aria-controls="collapseThree">
                                    <h4 class="panel-title">Active Freelancers</h4>
                                </a>
                                <div id="collapseThree1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <table class="table table-striped jambo_table bulk_action table-bordered"> <!-- business table-->
                                            <thead>
                                            <tr class="headings">
                                                <th class="column-title">ID</th>
                                                <th class="column-title">Username</th>
                                                <th class="column-title">E-mail</th>
                                                <th class="column-title">Role</th>
                                                <th class="column-title">Account Registered</th>
                                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                                <th class="column-title no-link last"><span class="nobr">Manage Profile</span>
                                                </th>
                                                <th class="bulk-actions" colspan="8">
                                                    <a class="antoo" style="color:#fff; font-weight:500;">Select All ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php loadUsersWithRole('Freelancer', 'Active'); ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end of accordion -->


                    </div>
                </div>
            </div>

        </div>

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
