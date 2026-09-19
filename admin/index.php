<?php 
include('partials/menu.php');

// Check if user is logged in
if(!isset($_SESSION['user']) || !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
    header('location:'.SITEURL.'admin/login.php');
    exit();
}
?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="container">
        <h1 class="text-center mt-4">Dashboard</h1>
        <div class="text-center my-3">
            <?php 
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>
        </div>

        <div class="row text-center g-4">
            <div class="col-md-4">
                <?php 
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                ?>
                <div class="card p-3 shadow-sm depth">
                    <h2><?php echo $count; ?></h2>
                    <p>Categories</p>
                </div>
            </div>

            <div class="col-md-4">
                <?php 
                $sql2 = "SELECT * FROM tbl_food";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                ?>
                <div class="card p-3 shadow-sm depth">
                    <h2><?php echo $count2; ?></h2>
                    <p>Foods</p>
                </div>
            </div>

            <div class="col-md-4">
                <?php 
                $sql3 = "SELECT * FROM tbl_order";
                $res3 = mysqli_query($conn, $sql3);
                $count3 = mysqli_num_rows($res3);
                ?>
                <div class="card p-3 shadow-sm depth">
                    <h2><?php echo $count3; ?></h2>
                    <p>Total Orders</p>
                </div>
            </div>

            <div class="col-md-4">
                <?php 
                $sql4 = "SELECT * FROM users";
                $res4 = mysqli_query($conn, $sql4);
                $count4 = mysqli_num_rows($res4);
                ?>
                <div class="card p-3 shadow-sm depth">
                    <h2><?php echo $count4; ?></h2>
                    <p>Total Users</p>
                </div>
            </div>

            <div class="col-md-4">
                <?php 
                $sql5 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                $res5 = mysqli_query($conn, $sql5);
                $row5 = mysqli_fetch_assoc($res5);
                $total_revenue = $row5['Total'];
                ?>
                <div class="card p-3 shadow-sm depth">
                    <h2>₱<?php echo $total_revenue; ?></h2>
                    <p>Revenue Generated</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>

<style>
    .main-content {
        min-height: 100vh;
        background-color: #e5e7eb;
    }
    .card {
        border: none;
        background: #ffffff;
        border-radius: 10px;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .card h2 {
        font-size: 2rem;
        margin: 0;
        color: #333;
    }
    .card p {
        margin: 0;
        font-size: 1.2rem;
        color: #666;
    }
    .depth {
        margin-bottom: 20px;
        padding: 20px;
    }
    @media (max-width: 768px) {
        .card h2 {
            font-size: 1.5rem;
        }
        .card p {
            font-size: 1rem;
        }
    }
</style>
