<?php
	// Initialize the session
	session_start();
	
	// Check if the user is already logged in, if yes then redirect him to welcome page
	if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION['role']) && $_SESSION['role'] != 'Guest') {
		header("location: index.php");
		exit;
	}
	
	// Include config file
	require_once "scripts.php";
	
	$mysqli=connect();
	
	// Define variables and initialize with empty values
	$username = $password = "";
	$username_err = $password_err = $login_err = "";
	
	// Processing form data when form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// Check if username is empty
		if (empty(trim($_POST["username"]))) {
			$username_err = "Please enter username.";
		} else {
			$username = trim($_POST["username"]);
		}
		
		// Check if password is empty
		if (empty(trim($_POST["password"]))) {
			$password_err = "Please enter your password.";
		} else {
			$password = trim($_POST["password"]);
		}
		
		// Validate credentials
		if (empty($username_err) && empty($password_err)) {
		 
			// Prepare a select statement
			$sql = "SELECT `id`, `username`, `password`, `roleID`, `status` FROM `users` WHERE `username` = ?";
			
			$stmt=getStatement($mysqli, $sql);
			
			if($stmt){
			    
			    $stmt->bind_param("s", $username);
			    
			    $results=fetchResults($stmt);
			    
			    if(sizeof($results)==1){
			        
			        if(password_verify($password, $results[0]['password'])){
			        
						$_SESSION["loggedin"] = true;
						$_SESSION["id"] = $results[0]['id'];
						$_SESSION["username"] = $results[0]['username'];
						$_SESSION["role"] = $results[0]['roleID'];
						$_SESSION["status"] = $results[0]['status'];
				
						$sql = "UPDATE `users` SET `last_login`=CURRENT_TIMESTAMP() WHERE `id`=? AND `username`=?";
						$stmt=getStatement($mysqli, $sql);
				
						if ($stmt){
						    
							$stmt->bind_param("is", $results[0]['id'], $results[0]['username']);
			    
							$mysqli->autocommit(false);
			                if(!executeUpdate($stmt)){
			                    $login_err="Login succeeded, but there was an error while contacting the server";
                            }
			                $mysqli->autocommit(true);
			                
			                unset($_POST);
			                header("Location: index.php");
			                exit();
			                
                        }
			            
                    }else{
			            $login_err="Wrong password";
                    }
			        
                }else{
			        $login_err="Username not found";
                }
			    
            }else{
			    $login_err="Error while contacting the server";
            }
			
			
		}
		
		// Close connection
		$mysqli->close();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Icarus ICSD</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="login_files/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_files/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_files/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_files/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_files/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_files/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_files/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_files/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_files/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login_files/css/util.css">
    <link rel="stylesheet" type="text/css" href="login_files/css/main.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="myStyles.css">
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('login_files/images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
	
			<?php
				if ($username_err!=""){
					displayError($username_err);
					return;
				}
				if ($password_err!=""){
					displayError($password_err);
					return;
				}
				if ($login_err!=""){
					displayError($login_err);
					return;
				}
			?>
            
            <form class="login100-form validate-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<span class="login100-form-title p-b-49">Login</span>

                <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is required">
                    <span class="label-input100">Username</span>
                    <input class="input100" type="text" name="username" placeholder="Type your username">
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" placeholder="Type your password">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                <div class="text-right p-t-8 p-b-31">
                    <a href="#">
                        Forgot password?
                    </a>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </div>

                <div class="flex-col-c p-t-155">
						<span class="txt1 p-b-17">
							OR
						</span>

                    <a href="register.php" class="txt2">
                        Sign Up
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="login_files/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="login_files/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="login_files/vendor/bootstrap/js/popper.js"></script>
<script src="login_files/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="login_files/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="login_files/vendor/daterangepicker/moment.min.js"></script>
<script src="login_files/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="login_files/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="login_files/js/main.js"></script>

</body>
</html>