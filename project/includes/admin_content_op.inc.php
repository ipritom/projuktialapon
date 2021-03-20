<?php
//authenticating admin entry
session_start();
if(!isset($_SESSION['id'])){
        header("location:../login_page.php?profile=access denied");
        exit();
                
    }
else{
    include_once "connect_db.php";
    //to fetch Bangla charset
    mysqli_query($conn,'SET CHARACTER SET utf8');
    mysqli_query($conn,"SET SESSION collation_connection ='utf8_general_ci'");
    //checking admin/member
    $iid = $_SESSION['admin'];
    if($iid!=1){
        header("location:../index.php?profile=access denied");
        exit();        
    }
    //admin_entry successfull
    //operation --> opcode = operation on post_id(op_id) | content_op = operation on content(con_op) --> 1 = EDIT | 2 = PUBLISH | 3 = DELETE | 4 = READ
    $op_id = $_POST['opcode'];
    $con_op = $_POST['content_op'];
    //echo $op_id."xx".$con_op; //check
    
    //do operation
    if($con_op==1){//edit
       header("location: ../paper_edit.php?id=$op_id");
    }
    elseif($con_op==2){//publish
        $sql = "update posts set state=1 where post_id=$op_id;";
        mysqli_query($conn,$sql);
        header('location: ../admin_content.php?op=pend');
    }
    elseif($con_op==3){//delete [not permanatly from admin panel]
        $sql = "update posts set state=2 where post_id=$op_id;";
        mysqli_query($conn,$sql);
        header('location: ../admin_content.php?op=all');
    }
    elseif($con_op==4){//read
        header("location: ../read.php?ID=$op_id");
        
    }
    
}
?>