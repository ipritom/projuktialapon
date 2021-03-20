<?php
session_start();

if(isset($_GET['submit'])){
    include_once "connect_db.php";
    
    $user= mysqli_real_escape_string($conn,$_GET['user']);
    $pass= mysqli_real_escape_string($conn,$_GET['pass']);
    
    //error handlers
    //any empty fields?
    if(empty($user) || empty($pass)){
        header("location: ../login_page.php?user&pass=invalid");
        exit();
    }
    else{
        $sql = "select * from user_list where username='$user' && password='$pass';";
        $result = mysqli_query($conn,$sql);
        $chk = mysqli_num_rows($result);
        if($chk > 0){
            //checking user state
            $row=mysqli_fetch_assoc($result);
                
            if($row['state']==1){ //logging in --->
                $_SESSION['id'] = $row['id'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['admin'] = $row['admin'];
                header("location: ../paper.php?login=success".$_SESSION['id']);
                exit();
            }
            elseif($row['state']==0){ //pending msg
                header("location: ../msg.php?login=failed".$_SESSION['id']);
            }
            elseif($row['state']==2){ //block msg
                header("location: ../msg2.php?login=blocked".$_SESSION['id']);
            }
            
            
           
        }
        else{
            header("location: ../login_page.php?user&pass=invalid");
            exit();
        }
    }
}
//checking log-in button pressing
else{
    echo "Access Denied";
}
?>