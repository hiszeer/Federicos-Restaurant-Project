<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="container">
        <h1 class="text-center mt-4">Manage Category</h1>

        <div class="text-center my-3">
            <?php 
            if (isset($_SESSION['add'])) { echo $_SESSION['add']; unset($_SESSION['add']); }
            if (isset($_SESSION['remove'])) { echo $_SESSION['remove']; unset($_SESSION['remove']); }
            if (isset($_SESSION['delete'])) { echo $_SESSION['delete']; unset($_SESSION['delete']); }
            if (isset($_SESSION['no-category-found'])) { echo $_SESSION['no-category-found']; unset($_SESSION['no-category-found']); }
            if (isset($_SESSION['update'])) { echo $_SESSION['update']; unset($_SESSION['update']); }
            if (isset($_SESSION['upload'])) { echo $_SESSION['upload']; unset($_SESSION['upload']); }
            if (isset($_SESSION['failed-remove'])) { echo $_SESSION['failed-remove']; unset($_SESSION['failed-remove']); }
            ?>
        </div>

        <div class="text-center mb-4">
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn btn-primary shadow-sm">Add Category</a>
        </div>

        <table class="table table-bordered table-hover content-table text-center">
            <thead class="table-light">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Update Category</th>
                    <th>Delete Category</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $title; ?></td>
                            <td>
                                <?php  
                                if ($image_name != "") {
                                    echo "<img src='" . SITEURL . "images/category/" . $image_name . "' class='img-thumbnail' width='100px'>";
                                } else {
                                    echo "<div class='text-danger'>Image not Added.</div>";
                                }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn btn-success btn-sm">Update</a>
                            </td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7" class="text-danger">No Category Added.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<style>
    .main-content {
        min-height: 100vh;
        background-color: #f8f9fa;
    }
    .table {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .btn {
        border-radius: 5px;
        transition: all 0.3s;
    }
    .btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    .img-thumbnail {
        border: 2px solid #ddd;
        border-radius: 10px;
        transition: transform 0.3s;
    }
    .img-thumbnail:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    @media (max-width: 768px) {
        .table {
            font-size: 0.9rem;
        }
        .btn {
            font-size: 0.8rem;
        }
    }
</style>
