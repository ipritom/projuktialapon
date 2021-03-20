<!DOCTYPE html>
<?php
//authenticating admin entry
session_start();
if(!isset($_SESSION['id'])){
        header("location:login_page.php?profile=access denied");
        exit();
                
    }
else{
    $iid = $_SESSION['admin'];
    if($iid!=1){
        header("location:index.php?profile=access denied");
        exit();        
    }
}
?>
<html>
<head>
    <title>Projukti Alapon - Admin Control Panel</title>
    <meta charset="utf-8">
    <link rel="icon" href="res/icon.png" type="image/png" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap-4.0.0\dist\css\bootstrap.css">
    <link rel="stylesheet" href="effect.css">
</head>
<body class="bg-dark">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <!-- Brand/logo -->
        <a class="navbar-brand" href="index.php">প্রযুক্তি আলাপন</a>
        <li class="nav nav-item text-light">ADMIN CONTROL PANEL</li>
        <a class="nav nav-item ml-auto text-light" href="includes/logout.inc.php">LOG OUT</a>
        
    </nav>
    
    <!--main field-->
    <div class="container-fluid">
        <div class="row">
            <!--side bar-->
            <?php include_once 'admin_sidebar.php';?>
            <!--admin insights-->
            <div class="col-md-6 py-5 text-white">
                
                <div class="row">
                    <!--cards-->
                    <div class="col-md-3 btn-outline-light zoomtext rounded py-1">
                        <img class="card-img-top" src="res/users.png">
                        <div class="card-body">
                            <h4 class="card-title">Users</h4>
                            <p class="card-text">
                            <?php
                                include_once "includes/connect_db.php";
                                $sql = "select * from user_list where state=1;";
                                $res= mysqli_query($conn,$sql);
                                $rows = mysqli_num_rows($res);
                                echo "Total ".$rows." active users in <p style='font-family:ekush;font-size:20px'>প্রযুক্তি আলাপন!</p>";
                            ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-3 btn-outline-light zoomtext rounded py-1">
                        <img class="card-img-top" src="res/request.png">
                        <div class="card-body">
                            <h4 class="card-title">Requests</h4>
                            <p class="card-text">
                            <?php
                                include_once "includes/connect_db.php";
                                $sql = "select * from user_list where state=0;";
                                $res= mysqli_query($conn,$sql);
                                $rows = mysqli_num_rows($res);
                                echo $rows." user request are pending for admin approval.";
                            ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-3 btn-outline-light zoomtext rounded py-1">
                        <img class="card-img-top" src="res/writing.png">
                        <div class="card-body">
                            <h4 class="card-title">Articles</h4>
                            <p class="card-text">
                            <?php
                                include_once "includes/connect_db.php";
                                $sql = "select * from posts where state=1;";
                                $res= mysqli_query($conn,$sql);
                                $rows = mysqli_num_rows($res);
                                echo "Total ".$rows." published articles are being read!";
                                
                                
                            ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-3 btn-outline-light zoomtext rounded py-1">
                        <img class="card-img-top" src="res/pending_post.png">
                        <div class="card-body">
                            <h4 class="card-title">To Publish</h4>
                            <p class="card-text">
                            <?php
                                include_once "includes/connect_db.php";
                                $sql = "select * from posts where state=0;";
                                $res= mysqli_query($conn,$sql);
                                $rows = mysqli_num_rows($res);
                                echo $rows." articles are yet to be published!";
                                
                                
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
    </div>
    
</body>
</html>