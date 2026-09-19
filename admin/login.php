<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/adminlogin.css">
        <!-- Website Logo -->
        <link rel="website icon" type="png" href="../images/fedlogo.png">
    </head>

    <body>
        
        <div class="login">
            <br><br><br>
            <h2 class="text-center">Moderator Login</h2>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            <div class="container">
            <div class="myform">
            <!-- Login Form Starts HEre -->
            <form action="" method="POST">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            <p class="text-center">Don't have an account? <a href="register.php">Register Here</a></p>
            </form>
            </div>
            <div class="image">
      <img src="../images/image.jpg">
    </div>
            </div>
            <!-- Login Form Ends HEre -->
        </div>

    </body>
</html>

<?php 

    //CHeck whether the Submit Button is Clicked or NOt
    // ... existing code ...

    if(isset($_POST['submit']))
    {
        //Process for Login
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        // Remove the double hashing - only hash once with md5
        $password = md5($_POST['password']); // Remove the mysqli_real_escape_string here
    
        // Check in admin table first
        $sql_admin = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        $res_admin = mysqli_query($conn, $sql_admin);
        
        // Check in manager table if not found in admin
        $sql_manager = "SELECT * FROM tbl_manager WHERE username='$username' AND password='$password'";
        $res_manager = mysqli_query($conn, $sql_manager);
    
        if(mysqli_num_rows($res_admin) == 1)
        {
            $row = mysqli_fetch_assoc($res_admin);
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username;
            $_SESSION['user_role'] = 'admin';
            $_SESSION['logged_in'] = true;
            $_SESSION['full_name'] = $row['full_name']; // Add this line
            
            // Clear any output before redirect
            ob_end_clean();
            
            header('location:'.SITEURL.'admin/');
            exit();
        }
        else if(mysqli_num_rows($res_manager) == 1)
        {
            $row = mysqli_fetch_assoc($res_manager);
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username;
            $_SESSION['user_role'] = 'manager';
            $_SESSION['logged_in'] = true;
            $_SESSION['full_name'] = $row['full_name']; // Add this line
            
            // Clear any output before redirect
            ob_end_clean();
            
            header('location:'.SITEURL.'admin/');
            exit();
        }
        else
        {
            $_SESSION['login'] = "<div class='error'>Username or Password is incorrect.</div>";
            header('location:'.SITEURL.'admin/login.php');
            exit();
        }
    }


?>