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
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap-4.0.0\dist\css\bootstrap.css">
</head>
<body class="bg-dark">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <!-- Brand/logo -->
        <a class="navbar-brand" href="index.php">প্রযুক্তি আলাপন</a>
        <a class="nav nav-item text-light" href="admin.php">ADMIN CONTROL PANEL</a>
        <a class="nav nav-item ml-auto text-light" href="includes/logout.inc.php">LOG OUT</a>
        
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!--side bar-->
            <?php include_once 'admin_sidebar.php';?>
            
            <div class="col-md">
                 <div class="card rounded border-warning">
                     <!--Member Table-->
                     <table class="table table-hover">
                         <thead>
                             <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                          <!--Retrive From Database with Active Inactive Status--> <!--operation control: site creator only-->
                             <?php
                                include_once "includes/connect_db.php";
                                $sql = "select * from user_list where id>1;";
                                $res = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_assoc($res)){
                                    if($row['state']==0){//inactive_data row
                                        echo "<tr class='table-active'><td>".$row['firstname']."</td><td>".$row['lastname']."</td><td>".$row['username']."</td><td>".$row['email']."</td><td>INACTIVE</td>
                                        <td>
                                        <form action='includes/mem.act.php' method='GET'>
                                        <button class='btn btn-block btn-primary' name='btn_op' type='submit' value=".$row['id'].">Active</button></form>
                                        <form action='includes/mem.del.php' method='GET'>
                                        <button class='btn btn-block btn-danger' name='btn_op' type='submit' value=".$row['id'].">Delete</button></form></td></tr>";
                                        
                                    }
                                    elseif($row['state']==1){//active_data row
                                        echo "<tr class='table-success'><td>".$row['firstname']."</td><td>".$row['lastname']."</td><td>".$row['username']."</td><td>".$row['email']."</td><td>ACTIVE</td>
                                        <td>
                                        <form action='includes/mem.dis.php' method='GET'><button class='btn btn-block btn-secondary' name='btn_op' type='submit' value=".$row['id'].">Disable</button>
                                        </form>
                                        <form action='includes/mem.blk.php' method='GET'>
                                        <button class='btn btn-block btn-dark' name='btn_op' type='submit' value=".$row['id'].">Block</button></form></td></tr>";
                                    }
                                    elseif($row['state']==2){//blocked_data row
                                        echo "<tr class='table-danger'><td>".$row['firstname']."</td><td>".$row['lastname']."</td><td>".$row['username']."</td><td>".$row['email']."</td><td>BLOCKED</td>
                                        <td>
                                        <form action='includes/mem.act.php' method='GET'><button class='btn btn-block btn-primary' name='btn_op' type='submit' value=".$row['id'].">Active</button>
                                        </form>
                                        <form action='includes/mem.del.php' method='GET'>
                                        <button class='btn btn-block btn-danger' name='btn_op' type='submit' value=".$row['id'].">Delete</button></form></td></tr>";
                                    }
                                    
                                }
                             
                             ?>
                         </tbody>
                     
                     </table>
                    
                </div>
            </div>

        </div>
            
    </div>
        
      
        
            
    
</body>
</html>