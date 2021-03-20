<!DOCTYPE html>
<?php
//authenticating admin entry
session_start();
if(!isset($_SESSION['id'])){
        header("location:login_page.php?profile=access denied");
        exit();
                
    }
else{
    include_once "includes/connect_db.php";
    //to fetch Bangla charset
    mysqli_query($conn,'SET CHARACTER SET utf8');
    mysqli_query($conn,"SET SESSION collation_connection ='utf8_general_ci'");
    //checking admin/member
    $iid = $_SESSION['admin'];
    $op = $_GET['op']; //set operation all=all_contents|pub=published_contents|pend=pending_contents
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
            <!--set operation-->
            <?php
                $sql1 = "select * from posts where state!=2;"; //all
                $res1 = mysqli_query($conn,$sql1);
                $all =  mysqli_num_rows($res1);
                    
                $sql2 = "select * from posts where state=1;"; //published
                $res2 = mysqli_query($conn,$sql2);
                $pub =  mysqli_num_rows($res2);
                    
                $sql3 = "select * from posts where state=0;"; //pending
                $res3 =  mysqli_query($conn,$sql3);
                $pend =  mysqli_num_rows($res3);
               
            ?>
            <!--CONTENT TABLE-->
            <div class="col py-3">
                <p class="text-light"><a href='admin_content.php?op=all'>All(<?php echo $all; ?>)</a> | <a href='admin_content.php?op=pub'>Published(<?php echo $pub; ?>)</a> | <a href='admin_content.php?op=pend'>Pending(<?php echo $pend; ?>)</a> </p>
                <table class="table text-warning table-bordered">
                    <thead>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Action</th>
                    </thead>
                    <!--Fetching Contents following operation = $op-->
                    <?php
                        //button operation 1 = EDIT | 2 = PUBLISH | 3 = DELETE | 4 = READ //
                        if($op=='all'){
                            while($row = mysqli_fetch_assoc($res1)){
                                $uid = $row['user_id'];
                                $sql = "select * from user_list where id=$uid";
                                $res = mysqli_query($conn,$sql);
                                $user = mysqli_fetch_assoc($res);
                                //count commnets 
                                $com_sql = "select * from comment where post_id=".$row['post_id'].";";
                                $com_query = mysqli_query($conn,$com_sql);
                                $comments = mysqli_num_rows($com_query);
                                if($row['state']==1){
                                    echo "<tr class='text-light'>
                                    <td style='width:10%'>".$row['post_id']."</td>
                                    <td style='width:30%'>".$row['title']."</td>
                                    <td style='width:15%'>".$user['firstname']." ".$user['lastname']."</td>
                                    <td class='text-center' style='width:10%'>".$comments."</td>
                                    <td style='width:10%'>".$row['date']."</td>
                                    <td style='width:25%'><form class='form-group' action='includes/admin_content_op.inc.php' method='post'>
                            <input type='hidden' name='opcode' value=".$row['post_id'].">  
                            <button class='btn btn-sm btn-primary btn-outline-light' name='content_op' value=1>Edit</button>
                            <button class='btn btn-sm btn-primary text-light btn-outline-info' name='content_op' value=4>Read</button>
                            <button class='btn btn-sm btn-primary text-light btn-outline-danger' name='content_op' value=3>Delete</button></form></td>
                                    </tr>";
                                    
                                }
                                elseif($row['state']==0){
                                    echo "<tr class='text-light'>
                                    <td style='width:10%'>".$row['post_id']."</td>
                                    <td style='width:30%'>".$row['title']."</td>
                                    <td style='width:15%'>".$user['firstname']." ".$user['lastname']."</td>
                                    <td class='text-center' style='width:10%'>".$comments."</td>
                                    <td style='width:10%'>".$row['date']."</td>
                                    <td style='width:25%'><form class='form-group' action='includes/admin_content_op.inc.php' method='post'>
                            <input type='hidden' name='opcode' value=".$row['post_id'].">        
                            <button class='btn btn-sm btn-primary btn-outline-light' name='content_op' value=1>Edit</button>
                            <button class='btn btn-sm btn-primary text-light btn-outline-success' name='content_op' value=2>Publish</button>
                            <button class='btn btn-sm btn-primary text-light btn-outline-danger' name='content_op' value=3>Delete</button></form></td>
                                    </tr>";
                                    
                                }
                                
                            }
                        }
                        elseif($op=='pub'){
                            while($row = mysqli_fetch_assoc($res2)){
                                $uid = $row['user_id'];
                                $sql = "select * from user_list where id=$uid";
                                $res = mysqli_query($conn,$sql);
                                $user = mysqli_fetch_assoc($res);
                                //count commnets 
                                $com_sql = "select * from comment where post_id=".$row['post_id'].";";
                                $com_query = mysqli_query($conn,$com_sql);
                                $comments = mysqli_num_rows($com_query);
                                echo "<tr class='text-light'>
                                    <td style='width:10%'>".$row['post_id']."</td>
                                    <td style='width:30%'>".$row['title']."</td>
                                    <td style='width:15%'>".$user['firstname']." ".$user['lastname']."</td>
                                    <td class='text-center' style='width:10%'>".$comments."</td>
                                    <td style='width:10%'>".$row['date']."</td>
                                    <td style='width:25%'><form class='form-group' action='includes/admin_content_op.inc.php' method='post'>
                            <input type='hidden' name='opcode' value=".$row['post_id'].">
                            <button class='btn btn-sm btn-primary btn-outline-light' name='content_op' value=1>Edit</button>
                            <button class='btn btn-sm btn-primary text-light btn-outline-info' name='content_op' value=4>Read</button>
                            <button class='btn btn-sm btn-primary text-light btn-outline-danger' name='content_op' value=3>Delete</button></form></td>
                                    </tr>";
                            }
                        }
                        elseif($op=='pend'){
                            while($row = mysqli_fetch_assoc($res3)){
                                $uid = $row['user_id'];
                                $sql = "select * from user_list where id=$uid";
                                $res = mysqli_query($conn,$sql);
                                $user = mysqli_fetch_assoc($res);
                                
                                echo "<tr class='text-light'>
                                    <td style='width:10%'>".$row['post_id']."</td>
                                    <td style='width:30%'>".$row['title']."</td>
                                    <td style='width:15%'>".$user['firstname']." ".$user['lastname']."</td>
                                    <td style='width:10%'></td>
                                    <td style='width:10%'>".$row['date']."</td>
                                    <td style='width:25%'><form class='form-group' action='includes/admin_content_op.inc.php' method='post'>
                            <input type='hidden' name='opcode' value=".$row['post_id'].">
                            <button class='btn btn-sm btn-primary btn-outline-light' name='content_op' value=1>Edit</button>
                            <button class='btn btn-sm btn-primary text-light btn-outline-success' name='content_op' value=2>Publish</button>
                            <button class='btn btn-sm btn-primary text-light btn-outline-danger' name='content_op' value=3>Delete</button></form></td>
                                    </tr>";
                            }
                        }
                    
                    ?>
                    
                    <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                </table>
                
            </div>   
        </div>
         
    </div>
    
</body>
</html>