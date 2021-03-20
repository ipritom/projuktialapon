<?php
session_start();
if(isset($_GET['admin_op_make'])){
    include_once "connect_db.php";
    if(!isset($_SESSION['id'])){
        header('location: ../index.php?page_not_found');
    }
    //query for MAKING admin
    $iid = $_GET['admin_op_make'];
    $sql = "update user_list set admin=1 where id=$iid;";
    $res = mysqli_query($conn,$sql);
    header('location: ../admin_adminship.php?operation=success');
}
else if(isset($_GET['admin_op_remove'])){
    include_once "connect_db.php";
    if(!isset($_SESSION['id'])){
        header('location: ../index.php?page_not_found');
    }
    //query for REMOVING admin
    $iid = $_GET['admin_op_remove'];
    $sql = "update user_list set admin=0 where id=$iid;";
    $res = mysqli_query($conn,$sql);
    header('location: ../admin_adminship.php?operation=success');
    
}
else{
    header('location: ../index.php?page_not_found');
}
?>