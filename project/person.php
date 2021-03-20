<!DOCTYPE html>
<?php
    session_start();
    if(isset($_GET['userid'])){
        include_once "includes/connect_db.php";
        $iid = $_GET['userid'];
        //to fetch Bangla charset
        mysqli_query($conn,'SET CHARACTER SET utf8');
        mysqli_query($conn,"SET SESSION collation_connection ='utf8_general_ci'");
    }
    else{
        header('location: index.php?id=not_set');
    }
?>
<html>
<?php include_once 'header.php';?>
<body>
    <?php include_once 'navbar.php'; ?>
    
    <div class="col-xl col-sm col-md align-self-center text-center py-3">
        <?php
            //getting USER INFO
            $sql = "select * from user_list where id=$iid;";
            $res = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($res);
            //printing user-info
        ?>
        <h1 class="h1 text-success"><?php
            echo $row['firstname']." ".$row['lastname']."</a>"; 
            ?> 
        </h1>
        
    
    </div>
    <div class="container py-3">
        
        <div class="row">
            <p>
                <?php
                $sql = "select * from posts where user_id='$iid';";
                $res = mysqli_query($conn,$sql);
                
                while($row = mysqli_fetch_assoc($res)){
                    $id = $row['post_id'];
                    //getting feature photo
                    $sql2 = "select * from picture where post_id=$id;";
                    $res2 = mysqli_query($conn,$sql2);
                    $pic = mysqli_fetch_assoc($res2);
                    $loc = "uploads/".$pic['pic']; //getting pic source
                    
                    //echo "<a href='read.php?ID=$id'>".$row['title']."</a>"."<br>";
                    if($row['state']==1){
                        echo 
                        "<div class='col-sm-3 zoomtext'>
                            <a href='read.php?ID=$id' style='text-decoration:none;'>
                            <img class='card-img-top' src=$loc alt='Card image' style='height:10rem;widht:6px;'></a>
                            <div class='card-body'>
                                <a href='read.php?ID=$id' style='text-decoration:none;color:black;'>
                                <h4 class='card-title'>".$row['title']."</h4></a>
                                <p class='card-text'>".mb_substr($row['content'],0,125)."...</p>
                                <button class='btn btn-info bg-light btn-block text-dark'> <img src='res/star1.png' style='width:20px'; height:20px;> পছন্দ</button>
                            </div>
                        </div>";
                    }
                }
                ?>
        </p>
        
        </div>
        
    
    </div>
    
</body>
</html>