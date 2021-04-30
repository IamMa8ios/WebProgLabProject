<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico"/>

    <title>Bytes 4 Hire</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">
		
		
		<?php include("sidebar.php"); ?>
		<?php include("top-active.php"); ?>
		<?php require_once "load-profile.php"; ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Profile </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    <form class="form-label-left input_mask">

                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="inputSuccess2"
                                   placeholder="<?php echo $first; ?>" <?php echo $disabled; ?>>
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                            <input type="text" class="form-control" id="inputSuccess3"
                                   placeholder="<?php echo $last; ?>" <?php echo $disabled; ?>>
                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                            <input type="email" class="form-control has-feedback-left" id="inputSuccess4"
                                   contentEditable="false" placeholder="<?php echo $email; ?>" <?php echo $disabled; ?>>
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                            <input type="tel" class="form-control" id="inputSuccess5"
                                   placeholder="<?php echo $phone; ?>" <?php echo $disabled; ?>>
                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                            <label class="col-form-label col-md-3 col-sm-3 ">Gender</label>
                            <div class="col-md-6 col-sm-6 ">
                                <div id="gender" class="btn-group" data-toggle="buttons">
                                    <label class="<?php echo $mClass; ?>" data-toggle-class="btn-primary"
                                           data-toggle-passive-class="btn-default">
                                        <input type="radio" name="gender" value="male" class="join-btn"> &nbsp; Male &nbsp;
                                    </label>
                                    <label class="<?php echo $fClass; ?>" data-toggle-class="btn-primary"
                                           data-toggle-passive-class="btn-default">
                                        <input type="radio" name="gender" value="female" class="join-btn"> Female
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                            <label class="col-form-label col-md-3 col-sm-3 ">Date Of Birth</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input class="date-picker form-control"
                                       placeholder="<?php echo date("d-m-Y", strtotime($birthday)); ?>" type="text"
                                       onfocus="this.type='date'" onmouseover="this.type='date'"
                                       onclick="this.type='date'" onblur="this.type='text'"
                                       onmouseout="timeFunctionLong(this)" <?php echo $disabled; ?>>
                                <script>
                                    function timeFunctionLong(input) {
                                        setTimeout(function () {
                                            input.type = 'text';
                                        }, 60000);
                                    }
                                </script>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 col-sm-9  offset-md-3">
                                <?php if ($disabled == "") { ?>
                                    <button type="button" class="btn btn-primary" href="profile.php">Cancel</button>
                                <?php } ?>
                                <?php if ($disabled != "") { ?>
                                    <button class="btn btn-primary" type="submit" >Edit</button>
                                <?php } ?>
                                <?php if ($disabled == "") { ?>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                <?php } ?>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
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
