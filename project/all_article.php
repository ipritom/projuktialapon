<!DOCTYPE html>
<!DOCTYPE html>
<?php
    require_once 'includes/connect_db.php';
    //to fetch Bangla charset
    mysqli_query($conn,'SET CHARACTER SET utf8');
    mysqli_query($conn,"SET SESSION collation_connection ='utf8_general_ci'");
?>
<html>
<?php include_once 'header.php';?>
<body>
    <?php include_once 'navbar.php'; ?>
    
    <div class="container-fluid py-5">
        
        <div class="row px-2">
            <!--cards-->
            
            <?php
                //getting posts
                $sql = "select * from posts where state=1 order by date DESC;";
                $res = mysqli_query($conn,$sql);
                
                while($row = mysqli_fetch_assoc($res)){
                    $id = $row['post_id'];
                    //getting feature photo
                    $sql2 = "select * from picture where post_id=$id;";
                    $res2 = mysqli_query($conn,$sql2);
                    $getPic = mysqli_num_rows($res2); //checking existance : feature image
                    
                    if($getPic>0){
                        $pic = mysqli_fetch_assoc($res2);
                        $loc = "uploads/".$pic['pic']; //getting pic source
                        echo "<div class='col-sm-3 zoomtext'>
                            <a href='read.php?ID=$id' style='text-decoration:none;'>
                            <img class='card-img-top' src=$loc alt='Card image' style='height:10rem;widht:6px;'></a>
                            <div class='card-body'>
                                <a href='read.php?ID=$id' style='text-decoration:none;color:black;'>
                                <h4 class='card-title'>".$row['title']."</h4></a>
                                <p class='card-text'>".mb_substr($row['content'],0,125)."...</p>
                            </div>
                        </div>";
                        
                    }
                }
            ?>
            
        </div>
        
        
        
    </div>

</body>
</html>