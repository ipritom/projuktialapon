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

        </div>
            
    </div>
    
</body>
</html>