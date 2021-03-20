<!DOCTYPE html>
<?php
    session_start();
    include_once "includes/connect_db.php";
    //to fetch Bangla charset
    mysqli_query($conn,'SET CHARACTER SET utf8');
    mysqli_query($conn,"SET SESSION collation_connection ='utf8_general_ci'");
    $id = $_SESSION['id'];
    
    //check logged in or not
    if(!isset($_SESSION['id'])){
        header("location: index.php?profile=access denied");
        exit();
                
    }
?>
<html>
<?php include_once 'header.php';?>
<body>
    <?php include_once 'navbar.php'; ?>
    
    <div class="container py-4">
        
        <div class="row">
            <div class="col-sm-6 py-5">
                    <h2 class="text-primary"><?php
                    echo $_SESSION['firstname']." ".$_SESSION['lastname']."</a>"; 
                    ?>
                    
                </h2>
            </div>
            
            <div class="col-sm-6 py-5">
                <h4><a class="float-right" href="includes/logout.inc.php">LOG OUT</a></h4>
            </div>
        
       
            
        <?php
                $sql = "select * from posts where user_id='$id';";
                $res = mysqli_query($conn,$sql);
                
                while($row = mysqli_fetch_assoc($res)){
                    $pid = $row['post_id'];
                    //getting feature photo
                    $sql2 = "select * from picture where post_id=$pid;";
                    $res2 = mysqli_query($conn,$sql2);
                    $pic = mysqli_fetch_assoc($res2);
                    $loc = "uploads/".$pic['pic']; //getting pic source
                    
                    //echo "<a href='read.php?ID=$id'>".$row['title']."</a>"."<br>";
                    if($row['state']==1){
                        echo "<div class='col-sm-3 zoomtext'>
                            <h5><span class='badge badge-success float-right'>Published</span></h5>
                            <a href='read.php?ID=$pid' style='text-decoration:none;'>
                            <img class='card-img-top' src=$loc alt='Card image' style='height:10rem;widht:6px;'></a>
                            <div class='card-body'>
                                <a href='read.php?ID=$pid' style='text-decoration:none;color:black;'>
                                <h4 class='card-title'>".$row['title']."</h4></a>
                                <p class='card-text'>".mb_substr($row['content'],0,125)."...</p>
                                <form class='form-inline' method='post' action='includes/writer.inc.php'>
                                    <button class='btn btn-info btn-sm bg-light text-dark' name='wop_edit' value=$pid>সম্পাদনা</button>&nbsp;
                                    <button class='btn btn-info btn-sm btn-outline-danger text-dark' name='wop_del' value=$pid>মুছে ফেলা</button>
                                </form>
                            </div>
                        </div>";
                   }
                    if($row['state']==0){
                        echo "<div class='col-sm-3 zoomtext'>
                            <h5><span class='badge badge-secondary float-right'>Unublished</span></h5>
                            <a href='read.php?ID=$pid' style='text-decoration:none;'>
                            <img class='card-img-top' src=$loc alt='Card image' style='height:10rem;widht:6px;'></a>
                            <div class='card-body'>
                                <a href='read.php?ID=$pid' style='text-decoration:none;color:black;'>
                                <h4 class='card-title'>".$row['title']."</h4></a>
                                <p class='card-text'>".mb_substr($row['content'],0,125)."...</p>
                                <form class='form-inline' method='post' action='includes/writer.inc.php'>
                                    <button class='btn btn-info btn-sm bg-light text-dark' name='wop_edit' value=$pid>সম্পাদনা</button>&nbsp;
                                    <button class='btn btn-info btn-sm btn-outline-danger text-dark' name='wop_del' value=$pid>মুছে ফেলা</button>
                                </form>
                                
                            </div>
                        </div>";
                    }
                      
                 
                
                }
            ?>
                        
                        
                        
                
        </div>
    
    
    </div>
    
    
</body>
</html>