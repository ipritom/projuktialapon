<?php
//authenticating admin entry
session_start();
if(!isset($_SESSION['id'])){
        header("location:../login_page.php?operation=access denied");
        exit();
                
    }
else{
    $iid = $_SESSION['id']==1;
    if($iid!=1){
        header("location:../msg3.php?operation=access denied");
        exit();
    }
    
    //operation: delete [not permanatly from admin panel]
    include_once "connect_db.php";
    $op = $_GET['btn_op'];
    $sql = "UPDATE user_list set state=3 WHERE id=$op;";
    $res = mysqli_query($conn,$sql);
    header("location:../admin_users_list.php?operation=success".$op);
    exit();
    
}
?>