<?php include "../../../account/session-access.php" ?>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../../Images/icon.ico" type="image/ico"/>

    <title>Bytes 4 Hire</title>

    <!-- Bootstrap -->
    <link href="../../../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../../../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">


        <?php include("../../navigation/sidebar.php"); ?>
        <?php include("../../navigation/top-active.php"); ?>
        <?php include("../../../users/load/pending.php"); ?>

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
                                                </th>
                                                <th class="bulk-actions" colspan="8">
                                                    <a class="antoo" style="color:#fff; font-weight:500;">Select All ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php loadUserWithStatus("Pending Confirmation"); ?>
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
                                                <th class="column-title">Last Update</th>
                                                <th class="column-title">Last Login</th>
                                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                                </th>
                                                <th class="bulk-actions" colspan="8">
                                                    <a class="antoo" style="color:#fff; font-weight:500;">Select All ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php loadTypeOfUser("Business"); ?>
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
                                                <th class="column-title">Last Update</th>
                                                <th class="column-title">Last Login</th>
                                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                                </th>
                                                <th class="bulk-actions" colspan="8">
                                                    <a class="antoo" style="color:#fff; font-weight:500;">Select All ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php loadTypeOfUser("Freelancer"); ?>
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
		<?php include("../../navigation/footer.php"); ?>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="../../../../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../../../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../../../../build/js/custom.min.js"></script>

</body>
</html>