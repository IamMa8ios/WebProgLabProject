<?php
	require_once "scripts.php";
	
	$mysqli=connect();
	
	// Define variables and initialize with empty values
	$username = $password = $confirm_password = $role = "";
	$username_err = $password_err = $confirm_password_err = $role_err = "";
	
	// Processing form data when form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		// Validate username
		if (empty(trim($_POST["username"]))) {
			$username_err = "Please enter a username.";
		} else {
			// Prepare a select statement
			$sql = "SELECT id FROM users WHERE username = ?";
			
			if ($stmt = $mysqli->prepare($sql)) {
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("s", $param_username);
				
				// Set parameters
				$param_username = trim($_POST["username"]);
				
				// Attempt to execute the prepared statement
				if ($stmt->execute()) {
					// store result
					$stmt->store_result();
					
					if ($stmt->num_rows == 1) {
						$username_err = "This username is already taken.";
					} else {
						$username = trim($_POST["username"]);
					}
				} else {
					echo "Oops! Something went wrong. Please try again later.";
					echo "Username query not executed.";
				}
				
				// Close statement
				$stmt->close();
			}
		}
		
		// Validate password
		if (empty(trim($_POST["password"]))) {
			$password_err = "Please enter a password.";
		} elseif (strlen(trim($_POST["password"])) < 6) {
			$password_err = "Password must have atleast 6 characters.";
		} else {
			$password = trim($_POST["password"]);
		}
		
		// Validate confirm password
		if (empty(trim($_POST["confirm_password"]))) {
			$confirm_password_err = "Please confirm password.";
		} else {
			$confirm_password = trim($_POST["confirm_password"]);
			if (empty($password_err) && ($password != $confirm_password)) {
				$confirm_password_err = "Password did not match.";
			}
		}
		
		// Validate role
		$role=0;
		if(isset($_POST['student']) && !isset($_POST['professor']) && !isset($_POST['admin'])){
		    $role=3;
        }elseif (!isset($_POST['student']) && isset($_POST['professor']) && !isset($_POST['admin'])){
			$role=2;
		}elseif (!isset($_POST['student']) && !isset($_POST['professor']) && isset($_POST['admin'])){
		    $role=1;
        }else{
		    $role_err="Please choose exactly ONE role";
        }
		
		// Check input errors before inserting in database
		if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($role_err)) {
			
			// Prepare an insert statement
			$sql = "INSERT INTO users (username, password, roleID) VALUES (?, ?, ?)";
			
			if ($stmt = $mysqli->prepare($sql)) {
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("sss", $param_username, $param_password, $param_role);
				
				// Set parameters
				$param_username = $username;
				$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $param_role = $role;
				
				// Attempt to execute the prepared statement
				if ($stmt->execute()) {
					// Redirect to login page
					header("location: login.php");
					exit();
				} else {
					echo "Oops! Something went wrong. Please try again later.\n";
					echo "Insert query not executed.\n";
					echo $param_role;
				}
				
				// Close statement
				$stmt->close();
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
    <link rel="icon" type="image/png" href="Images/logo.png"/>
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
    <link rel="stylesheet" type="text/css" href="login.css">
    <!--===============================================================================================-->
</head>
<body>

<?php
	if ($username_err!=""){
		displayError($username_err);
		return;
	}
	if ($password_err!=""){
		displayError($password_err);
		return;
	}
	if ($confirm_password_err!=""){
		displayError($confirm_password_err);
		return;
	}
    if ($role_err!=""){
        displayError($role_err);
        return;
    }
?>

<div class="limiter">
    <div class="container-login100" style="background-image: url('login_files/images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">

            <form class="login100-form validate-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<span class="login100-form-title p-b-49">Register</span>

                <div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
                    <span class="label-input100">Username</span>
                    <input class="input100" type="text" name="username" placeholder="Type your username">
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>
                
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" placeholder="Type your password">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="confirm_password" placeholder="Re-Type your password">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>
                
                <div class="wrap-input100 validate-input" data-validate="Choose a role">
                    <span class="label-input100">Role</span>
                    <ul>
                        <li>
                            <input type="checkbox" id="cb1" name="student"/>
                            <label for="cb1"><img src="Images/graduates.png" />   Student</label>
                        </li>
                        <li>
                            <input type="checkbox" id="cb2" name="professor"/>
                            <label for="cb2"><img src="Images/professor.png" />   Professor</label>
                        </li>
                        <li>
                            <input type="checkbox" id="cb3" name="faculty"/>
                            <label for="cb3"><img src="Images/admin.png" />   Admin</label>
                        </li>
                    </ul>
                </div>

                <br>
                
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Register
                        </button>
                    </div>
                </div>

                <div class="flex-col-c p-t-155">
						<span class="txt1 p-b-17">
							OR
						</span>

                    <a href="login.php" class="txt2">
                        Log In
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