<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Order</h1><br><br>

        <?php 
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
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Update Orders</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                // Get all the orders from database
                $sql = "SELECT users.*, tbl_order.* FROM users INNER JOIN tbl_order ON users.id=tbl_order.u_id"; // Display the Latest Order at First

                // Execute Query
                $res = mysqli_query($conn, $sql);

                // Count the Rows
                $count = mysqli_num_rows($res);

                $sn = 1; // Create a Serial Number and set its initial value as 1

                if($count>0)
                {
                    // Order Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // Get all the order details
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $food; ?></td>
                            <td>₱<?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td>₱<?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>

                            <td>
                                <?php 
                                    if($status=="Ordered")
                                    {
                                        echo "<label>$status</label>";
                                    }
                                    elseif($status=="On Delivery")
                                    {
                                        echo "<label style='color: orange;'>$status</label>";
                                    }
                                    elseif($status=="Delivered")
                                    {
                                        echo "<label style='color: green;'>$status</label>";
                                    }
                                    elseif($status=="Cancelled")
                                    {
                                        echo "<label style='color: red;'>$status</label>";
                                    }
                                ?>
                            </td>

                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary text-nowrap">Update Order</a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                else
                {
                    // Order not Available
                    echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<style>
    .main-content {
        background-color: #f8f9fa;
        padding: 20px;
        min-height: 100vh;
    }
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
        color: #ffffff;
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
    .btn-secondary {
        color: white;
        background-color: #007bff;
        padding: 5px 10px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }
    .btn-secondary:hover {
        background-color: #0056b3;
    }
    .text-nowrap {
        white-space: nowrap;
    }
    .error {
        color: #e74c3c;
    }
</style>
