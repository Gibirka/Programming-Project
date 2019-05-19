<?php
// Initialize 
session_start();
 
// Check   logged in, an nai paei welcome
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
  exit;
}
 
// Include 
require_once "config.php";
 
// dieukrinish gia empty password
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data otan kanei submit
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check  username empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check  password  empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
  
    if(empty($username_err) && empty($password_err)){
        // select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind  statement me parametrous string
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parametrous
            $param_username = $username;
            
            // prospathia ekteleshs statement
            if(mysqli_stmt_execute($stmt)){
                // apothikeush apotelesmatos
                mysqli_stmt_store_result($stmt);
                
                // elegxos username an uparxei, an nai tote kane  verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result 
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password  correct, start a new session
                            session_start();
                            
                            // Store data 
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user 
                            header("location: welcome.php");
                        } else{
                            //  error message 
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    //  error message 
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body align="center">
<center>
    <div class="wrapper">
	<br><br><br><br><br><br>
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div> 
</center>	
</body>
</html>