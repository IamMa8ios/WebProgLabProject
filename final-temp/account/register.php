<?php
	// Include config file
	require_once "config.php";
	
	// Define variables and initialize with empty values
	$username = $email = $password = $confirm_password = $role = "";
	$username_err = $email_err = $password_err = $confirm_password_err = $role_err = "";
	
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
				}
				
				// Close statement
				$stmt->close();
			}
		}
		
		//validate email
		if (empty(trim($_POST["email"]))) {
			$username_err = "Please enter an email.";
		} else {
			// Prepare a select statement
			$sql = "SELECT id FROM users WHERE email = ?";
			
			if ($stmt = $mysqli->prepare($sql)) {
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("s", $param_email);
				
				// Set parameters
				$param_email = trim($_POST["email"]);
				
				// Attempt to execute the prepared statement
				if ($stmt->execute()) {
					// store result
					$stmt->store_result();
					
					if ($stmt->num_rows == 1) {
						$email_err = "This email is already taken.";
					} else {
						$email = trim($_POST["email"]);
					}
				} else {
					echo "Oops! Something went wrong. Please try again later.";
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
		if (empty(trim($_POST["role"]))) {
			$role_err = "Please choose a role";
		} else {
			$role = trim($_POST["role"]);
			if ($role != 'Admin' && $role != 'Business' && $role != 'Freelancer') {
				$role_err = "Not a valid role.";
			}
		}
		
		// Check input errors before inserting in database
		if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($role_err)) {
			
			// Prepare an insert statement
			$sql = "INSERT INTO users (username, email, pass, role) VALUES (?, ?, ?, ?)";
			
			if ($stmt = $mysqli->prepare($sql)) {
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("ssss", $param_username, $param_email, $param_password, $_POST['role']);
				
				// Set parameters
				$param_username = $username;
				$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
				
				// Attempt to execute the prepared statement
				if ($stmt->execute()) {
					// Redirect to login page
					header("location: login.php");
				} else {
					echo "Oops! Something went wrong. Please try again later.";
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
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username"
                   class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $username; ?>" required="required">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email"
                   class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $email; ?>" required="required">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password"
                   class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $password; ?>" required="required">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password"
                   class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                   value="<?php echo $confirm_password; ?>" required="required">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>

        <div class="form-group">
            <label>Choose Role</label>
            <select name="role" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>"
                    required="required">
                <option>Admin</option>
                <option>Business</option>
                <option>Freelancer</option>
            </select>
            <span class="invalid-feedback"><?php echo $role_err; ?></span>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</div>
</body>
</html>