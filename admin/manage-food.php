<?php include('partials/menu.php'); 

if(isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'toggle') {
    $id = $_GET['id'];
    
    // First get the current status
    $sql = "SELECT active FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    
    if($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $current_status = $row['active'];
        
        // Toggle the status
        $new_status = ($current_status == "Yes") ? "No" : "Yes";
        
        // Update the status in database
        $sql2 = "UPDATE tbl_food SET active='$new_status' WHERE id=$id";
        $res2 = mysqli_query($conn, $sql2);

        if($res2) {
            $_SESSION['update'] = "<div class='success'>Food Status Updated Successfully.</div>";
        } else {
            $_SESSION['update'] = "<div class='error'>Failed to Update Food Status.</div>";
        }
    }
    
    // Redirect to the same page
    header('location:'.SITEURL.'admin/manage-food.php');
    exit();
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Food</h1><br><br>

        <!-- Button to add Food -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a><br><br>

        <?php 

        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['unauthorize']))
        {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        ?><br><br>

        <table class="content-table">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price (₱)</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                // Create a SQL to get all the food
                $sql = "SELECT * FROM tbl_food";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Count rows to check whether we have foods or not
                $count = mysqli_num_rows($res);

                $sn=1; // create serial number variable and set default value as 1

                if($count>0)
                {
                    // We have food in DB
                    // Get the food from DB and display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // Get the values from individual columns
                        $id= $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td>₱<?php echo $price; ?></td>
                            <td>
                                <?php 

                                    // Check whether we have image or not
                                    if($image_name=="")
                                    {
                                        //we do not have image, Display image error
                                        echo "<div class='error'>Image not Added.</div>";
                                    }
                                    else
                                    {
                                        // we have image, display image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" width="100px">
                                        <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                <a href="<?php echo SITEURL; ?>admin/manage-food.php?id=<?php echo $id; ?>&action=toggle" class="btn-warning">
                                    <?php echo $active == "Yes" ? "Deactivate" : "Activate"; ?>
                                </a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                else
                {
                    // Food not found
                    echo "<tr> <td colspan='7' class='error'>Food not Added Yet.</td></tr>";

                }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('partials/footer.php') ?>

<style>
    .btn-primary, .btn-secondary, .btn-warning, .btn-danger {
    padding: 10px 20px;
    border-radius: 5px;
    color: white;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-primary {
    background-color: #5cb85c;
}

.btn-primary:hover {
    background-color: #4cae4c;
    transform: scale(1.05);
}

.btn-secondary {
    background-color: #007bff;
}

.btn-secondary:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

.btn-warning {
    background-color: #f0ad4e;
}

.btn-warning:hover {
    background-color: #ec971f;
    transform: scale(1.05);
}

.btn-danger {
    background-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
    transform: scale(1.05);
}

/* Table Styles */
.content-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 1rem;
    text-align: left;
    background: white;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
}

.content-table thead tr {
    background-color: #009879;
    color: white;
    text-align: left;
    font-weight: bold;
}

.content-table th, .content-table td {
    padding: 12px 15px;
}

.content-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.content-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.content-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

.error {
    color: #e74c3c;
}

/* Add more consistent spacing between elements */
.main-content {
    background-color: #f8f9fa;
    padding: 20px;
    min-height: 100vh;
}
</style>
