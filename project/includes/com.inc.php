<?php
//commenting program
session_start();
if(isset($_POST['submit_com'])){
    //logged in or not?
    if(isset($_SESSION['id'])){
        include_once "connect_db.php";
        //take the comment
        $com = mysqli_real_escape_string($conn,$_POST['com']); 
        $uid = $_SESSION['id'];
        $p_id = $_POST['submit_com'];
        $sql1 = "insert into comment(com_id,post_id,user_id,text,date) values(null,$p_id,$uid,'$com',curdate());";
        
        mysqli_query($conn,'SET CHARACTER SET utf8');
        mysqli_query($conn,"SET SESSION collation_connection ='utf8_general_ci'");
        //injecting sql1 table: comment
        $result1 = mysqli_query($conn,$sql1);
        header("location: ../read.php?ID=$p_id");
        exit();
    }
}
else{
    header('Location: ../index.php?access_denied');
}
?>

