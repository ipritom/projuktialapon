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
        <a class="nav nav-item text-light" href="admin.php">ADMIN CONTROL PANEL</a>
        <a class="nav nav-item ml-auto text-light" href="includes/logout.inc.php">LOG OUT</a>
        
    </nav>
    
    <!--main field-->
    <div class="container-fluid">
        <div class="row">
            <!--side bar-->
            <?php include_once 'admin_sidebar.php';?>
            <!--adminship field-->
            <div class="col py-3">
                <img class="img-fluid" src="res/admin.png" style="height:40px;width:35px;">
                <p class="h2 text-light">Adminship Control</p>
                <!--Active Admin-->
                <p class="text-primary container-fluid">Active Admins</p>
                <div class="row">
                
                 <?php
                        include_once "includes/connect_db.php";
                    
                        $sql1 = "select * from user_list where admin=1;";
                        $res = mysqli_query($conn,$sql1);
                        while($row = mysqli_fetch_assoc($res)){
                            $name = $row['firstname']." ".$row['lastname'];
                            $id = $row['id'];
                            if($id!=1){
                                echo "<div class='col-sm-3 glow1'>
                                <div class='card-body'>
                                    <h4 class='card-title text-light'>$name</h4>
                                    <form class='form-group' action='includes/adminship.inc.php' method='get'>
                                        <button class='btn' name='admin_op_remove' value=$id>REMOVE</button> 
                                    </form>
                                </div>
                            </div>"; 
                            }
                            else{
                                echo "<div class='col-sm-3 glow1'>
                                <div class='card-body'>
                                    <h4 class='card-title text-light'>$name</h4>
                                </div>
                            </div>";
                            }
                            
                        }
                ?>   
                </div>
                <!--Active Members to make admin-->
                <br>
                <p class="text-primary container-fluid">Active Members</p>
                <div class="row">
                
                 <?php
                        include_once "includes/connect_db.php";
                    
                        $sql1 = "select * from user_list where state=1;";
                        $res = mysqli_query($conn,$sql1);
                        while($row = mysqli_fetch_assoc($res)){
                            $name = $row['firstname']." ".$row['lastname'];
                            $isAdmin = $row['admin'];
                            $id = $row['id'];
                            if($isAdmin!=1){
                                echo "<div class='col-sm-3 glow2'>
                                <div class='card-body'>
                                    <h4 class='card-title text-light'>$name</h4>
                                    <form class='form-group' action='includes/adminship.inc.php' method='get'>
                                        <button class='btn' name='admin_op_make' value=$id>Make Admin</button> 
                                    </form>
                                </div>
                            </div>"; 
                            }
                            
                        }
                ?>   
                </div>
                

            </div>
            

        </div>
            
    </div>
    
</body>
</html>