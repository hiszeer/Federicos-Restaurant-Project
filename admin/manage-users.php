<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="container">
        <h1 class="text-center mt-4">Manage Users</h1>

        <div class="text-center my-3">
            <?php 
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if (isset($_SESSION['user-not-found'])) {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }
            if (isset($_SESSION['pwd-not-match'])) {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }
            if (isset($_SESSION['change-pwd'])) {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }
            ?>
        </div>

        <a href="add-users.php" class="btn btn-primary mb-4">Add User</a>

        <table class="table table-hover table-bordered">
            <thead class="table-light">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Update User</th>
                    <th>Delete User</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT * FROM users";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $full_name = $rows['customer_name'];
                            $username = $rows['username'];
                            $email = $rows['customer_email'];
                            $contact = $rows['customer_contact'];
                            $address = $rows['customer_address'];
                            $created = $rows['created_at'];
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $contact; ?></td>
                                <td><?php echo $address; ?></td>
                                <td><?php echo $created; ?></td>
                                <td class="text-center">
                                    <a href="<?php echo SITEURL; ?>admin/update-users.php?id=<?php echo $id; ?>" class="btn btn-success btn-sm">Update</a>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo SITEURL; ?>admin/delete-users.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center text-muted'>No Users Found</td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>

<style>
    .main-content {
        min-height: 100vh;
        background-color: #f8f9fa;
    }
    .table {
        font-size: 0.9rem;
    }
    .btn {
        transition: all 0.3s;
    }
    .btn:hover {
        transform: translateY(-3px);
    }
    @media (max-width: 768px) {
        .table {
            font-size: 0.8rem;
        }
        .btn {
            font-size: 0.8rem;
            padding: 0.4rem 0.6rem;
        }
    }
</style>
