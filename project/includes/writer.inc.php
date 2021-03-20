<?php
session_start();
if(isset($_SESSION['id'])){

    include_once "connect_db.php";
    
    //operation on content from Writer  
    
    if(isset($_POST['wop_edit'])){
        $op = $_POST['wop_edit']; 
        header("location: ../paper_edit.php?id=$op");
        
    }
    elseif(isset($_POST['wop_del'])){
        $op = $_POST['wop_del'];
        $sql = "update posts set state=2 where post_id=$op;";
        mysqli_query($conn,$sql);
        header('location: ../profile.php');
        
    }
        
    
}
else{
    header('Location: ../index.php?access_denied');
}

    
?>