<?php 

    include('../config/constants.php'); 
    include('login-check.php');

?>


<html>
    <head>
        <title>Food Order Website - Home Page</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity= "sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> 
            <!-- Website Logo -->
    <link rel="website icon" type="png" href="../images/fedlogo.png">
    
     
        
    </head>
    
    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center">
            <div class="wrapper d-flex align-items-center justify-content-between">
            <div class="logo">
                <a href="http://localhost/food-order/admin/index.php" title="Logo">
                    <img src="../images/fedlogo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
                <ul class="d-flex list-unstyled mb-0">
                    <li class="mr-3"><a href="index.php" class="text-decoration-none">Home</a></li>
                    <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                        <li class="mr-3"><a href="manage-admin.php" class="text-decoration-none">Admin</a></li>
                        <li class="mr-3"><a href="manage-users.php" class="text-decoration-none">Users</a></li>
                    <?php endif; ?>
                    <li class="mr-3"><a href="manage-category.php" class="text-decoration-none">Category</a></li>
                    <li class="mr-3"><a href="manage-food.php" class="text-decoration-none">Food</a></li>
                    <li class="mr-3"><a href="manage-order.php" class="text-decoration-none">Order</a></li>
                </ul>
                <div>
                    <a href="logout.php" class="text-decoration-none text-danger font-weight-bold">Logout</a>
                </div>
            </div>
        </div>
        <!-- Menu Section Ends -->
