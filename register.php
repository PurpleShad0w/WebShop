<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Log in or Sign up!</title>
<link rel="stylesheet" href="css/register.css">
<title>Registration</title>

</head>
<body>

<?php
require_once "configfile.php";

$username  = "";
$username_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!filter_var(trim($_POST["username"]), FILTER_VALIDATE_EMAIL)){
        $username_err = "Invalid email format";
    } else{
        $sql = "SELECT id FROM usersTab WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
             mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["username"]);
             if(mysqli_stmt_execute($stmt)){
               
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
	
// Check input errors before inserting in database
    if(empty($username_err) ){
        //Create Random Password
        
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
         for ($i = 0; $i < 8; $i++) {
             $n = rand(0, 59);
             $pass[$i] = $alphabet[$n];
         }
         $password= $pass[0].$pass[1]. $pass[2]. $pass[3]. $pass[4]. $pass[5]. $pass[6]. $pass[7]."!";
        
       mail( "iis20118@uom.edu.gr", "Temporary Password", "assword");
        

       $password="dokimi!";
        $sql = "INSERT INTO usersTab (username, password) VALUES (?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
             $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
             if(mysqli_stmt_execute($stmt)){
                header("location: loginPage.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>
<div class="wrapper">
<img src="img/userIcon.png" >
        <h2>Sign Up</h2>
        <p>Please fill in your email to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <br><span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            
            
             <div class="form-group">
                <input type="submit" class="button" value="Send Email">
            </div>
            <p>Already have an account? <a href="loginPage.php">Login here</a>.</p>
        </form>
    </div> 
	



</body>
</html>