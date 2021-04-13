<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bytes 4 Hire</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="POST" action="authenticate.php">
                    <h1>Login Form</h1>

                    <input type="text" name="username" class="form-control" placeholder="Username" required="required" />

                    <input type="password" name="password" class="form-control" placeholder="Password" required="required" />

                    <select name="role" class="form-control" required="required">
                        <option>Choose Role</option>
                        <option>Admin</option>
                        <option>Business</option>
                        <option>Freelancer</option>
                    </select>

                    <input type="submit" name="action" class="btn btn-default submit" value="Log In">
                    <span>
                        <a class="reset_pass" href="#">Lost your password?</a>
                    </span>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="#signup" class="to_register"> Create Account </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i>Bytes 4 Hire</h1>
                            <p>©2021 No Rights Reserved. Bytes 4 Hire is a uni project. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form method="POST" action="authenticate.php">
                    <h1>Create Account</h1>

                    <input type="text" name="username" class="form-control" placeholder="Username" required="required" />

                    <input type="email" name="email" class="form-control" placeholder="Email" required="required" />

                    <input type="password" name="password" class="form-control" placeholder="Password" required="required" />

                    <input type="submit" name="action" class="btn btn-default submit" value="Register">

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i>Bytes 4 Hire</h1>
                            <p>©2021 No Rights Reserved. Bytes 4 Hire is a uni project. Privacy and Terms</p>
                        </div>

                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>
