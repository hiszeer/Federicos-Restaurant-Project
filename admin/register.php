<?php 
include('../config/constants.php');

if (isset($_POST['check_username'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    $check_admin = "SELECT * FROM tbl_admin WHERE username='$username'";
    $check_manager = "SELECT * FROM tbl_manager WHERE username='$username'";

    $check_admin_result = mysqli_query($conn, $check_admin);
    $check_manager_result = mysqli_query($conn, $check_manager);

    if (mysqli_num_rows($check_admin_result) > 0 || mysqli_num_rows($check_manager_result) > 0) {
        echo 'false';
    } else {
        echo 'true';
    }
    exit();
}
?>
<html>
    <head>
        <title>Register - Food Order System</title>
        <link rel="stylesheet" href="../css/adminlogin.css">
        <!-- Website Logo -->
        <link rel="website icon" type="png" href="../images/fedlogo.png">
    </head>

    <body>
        <div class="login">
            <br><br>
            <h2 class="text-center">Register Account</h2>
            <br>

            <?php 
                if(isset($_SESSION['register']))
                {
                    echo $_SESSION['register'];
                    unset($_SESSION['register']);
                }
            ?>
            <br>
            <div class="container">
                <div class="myform">
                    <!-- Registration Form Starts Here -->
                    <form action="" method="POST">
                        Full Name: <br>
                        <input type="text" name="full_name" placeholder="Enter Full Name" required><br><br>

                        Username: <br>
                        <input type="text" name="username" placeholder="Enter Username" required><br><br>

                        Password: <br>
                        <input type="password" name="password" placeholder="Enter Password" required><br><br>

                        Confirm Password: <br>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required><br><br>
                        Role: <br>
                        <select name="role" required>
                            <option value="manager">Manager</option>
                        </select><br><br>

                        <input type="submit" name="submit" value="Register" class="btn-primary" onclick="return validateForm()">
                        <br><br>
                        <p class="text-center">Already have an account? <a href="login.php">Login</a></p>
                        
                        <script>
                            function validateForm() {
                                const password = document.getElementsByName('password')[0].value;
                                const confirmPassword = document.getElementsByName('confirm_password')[0].value;
                                const username = document.getElementsByName('username')[0].value;

                                if (password.length < 8 || !/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
                                    alert('Password must be at least 8 characters long and contain both letters and numbers');
                                    return false;
                                }

                                if (password !== confirmPassword) {
                                    alert('Passwords do not match');
                                    return false;
                                }

                                // Check username uniqueness
                                let isUnique = false;
                                const xhr = new XMLHttpRequest();
                                xhr.open('POST', '', false); // Synchronous request to the same page
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr.onload = function() {
                                    if (xhr.status === 200) {
                                        isUnique = xhr.responseText === 'true';
                                    }
                                };
                                xhr.send('check_username=true&username=' + encodeURIComponent(username));

                                if (!isUnique) {
                                    alert('Username already exists. Please choose a different username.');
                                    return false;
                                }

                                return true;
                            }
                        </script>
                    </form>
                </div>
                <div class="image">
                    <img src="../images/image.jpg">
                </div>
            </div>
        </div>
    </body>
</html>

<?php 
    if(isset($_POST['submit']))
    {
        // Get data from form
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);
    
        // Validation
        if($password != $confirm_password)
        {
            $_SESSION['register'] = "<div class='error'>Passwords do not match.</div>";
            header('location:'.SITEURL.'admin/register.php');
            exit();
        }
    
        // Check if username already exists in both tables
        $check_admin = "SELECT * FROM tbl_admin WHERE username='$username'";
        $check_manager = "SELECT * FROM tbl_manager WHERE username='$username'";
        
        $check_admin_result = mysqli_query($conn, $check_admin);
        $check_manager_result = mysqli_query($conn, $check_manager);
    
        if(mysqli_num_rows($check_admin_result) > 0 || mysqli_num_rows($check_manager_result) > 0)
        {
            $_SESSION['register'] = "<div class='error'>Username already exists.</div>";
            header('location:'.SITEURL.'admin/register.php');
            exit();
        }
    
        // Hash password
        $hashed_password = md5($password);
    
        // Insert into appropriate table based on role
        if($role == 'admin')
        {
            $sql = "INSERT INTO tbl_admin SET 
                full_name='$full_name',
                username='$username',
                password='$hashed_password',
                role='$role'
            ";
        }
        else if($role == 'manager')
        {
            $sql = "INSERT INTO tbl_manager SET 
                full_name='$full_name',
                username='$username',
                password='$hashed_password',
                role='$role'
            ";
        }
    
        // Execute Query
        $res = mysqli_query($conn, $sql);
    
        if($res)
        {
            $_SESSION['user'] = $username;
            $_SESSION['user_role'] = $role;  // Changed to match login
            $_SESSION['logged_in'] = true;   // Add this line
            $_SESSION['login'] = "<div class='success'>Registration Successful. Welcome!</div>";
            header('location:'.SITEURL.'admin/');
            exit();
        }
        else
        {
            $_SESSION['register'] = "<div class='error'>Failed to Register. Please try again.</div>";
            header('location:'.SITEURL.'admin/register.php');
            exit();
        }
    }
?>