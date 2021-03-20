<?php

if(isset($_GET['register'])){
    echo "Success";
    include_once "connect_db.php";
    
    $first= mysqli_real_escape_string($conn,$_GET['first']);
    $last= mysqli_real_escape_string($conn,$_GET['last']);
    $user= mysqli_real_escape_string($conn,$_GET['user']);
    $emailadd= mysqli_real_escape_string($conn,$_GET['emailadd']);
    $pass= mysqli_real_escape_string($conn,$_GET['pass']);
    $vpass= mysqli_real_escape_string($conn,$_GET['vpass']);
    
    //error handlers
    //any empty field?
    if(empty($first) || empty($last) || empty($user) || empty($emailadd) || empty($pass) || empty($vpass)){
        header("location: ../signup_page.php?emptyfield");
        exit();
    }
    else{
        //math pass and vpass?
        if($pass==$vpass){
            $sql = "select * from user_list where username='$user';";
            $result = mysqli_query($conn,$sql);
            $chk = mysqli_num_rows($result);
            //user already exist?
            if($chk > 0){
                
                header("location: ../signup_page.php?signup=usertaken");
                exit();
            }
            //inserting data into database
            else{
                $sql = "insert into user_list(id,username,firstname,lastname,password,email,state) values(NULL,'$user','$first','$last','$pass','$emailadd', 0);";
                $result = mysqli_query($conn,$sql);
                header("location: ../login_page.php?signup=success");
                
            }
        }
        else{
            header("location: ../signup_page.php?pass=invalid");
            exit();
        }
    }
   
    
}
//checking sign-up button pressing
else{
    echo "Access Denied";
}
?>