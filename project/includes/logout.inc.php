<?php
    session_start();

    if(isset($_SESSION['id'])){
        session_unset();
        session_destroy();
        header("location: ../index.php?logout=success");
        exit();
    }
    else{
        header("location: ../index.php");
        exit();
    }
?>