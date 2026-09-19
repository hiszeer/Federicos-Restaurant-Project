<?php 
    // Include the constants
    include('../config/constants.php');

    // 1. Get the ID of Admin to be deleted
    $id = $_GET['id'];  

    // 2. Create SQL query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Execute the query 
    $res = mysqli_query($conn, $sql);

    // Check the query executed successfully or not 
    if($res==true)
    {
        // query executed successfully and admin deleted
        //echo "Admin Deleted!";

        //Create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully! </div>";
        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // Failed to delete admin
        //echo "Failed to Delete the Admin!";
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again!</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }


?>