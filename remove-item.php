<?php
include('config/constants.php');
session_start();

if(isset($_POST['id'])){
    $id = intval($_POST['id']);
    $sql = "DELETE FROM tbl_order WHERE id=$id AND u_id={$_SESSION['u_id']} AND status='Ordered'";
    if(mysqli_query($conn, $sql)){
        echo "success";
    } else {
        echo "error";
    }
}
?>