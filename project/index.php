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
    <!Head Banner>
    <div class="jumbotron text-center bg-secondary text-light"
         style="background-image:url('res/cover2.jpg');
                bacground-size:cover;
                bacground-repeat:no-repeat;background-position:right top;background-attachment:fixed;">
       
        <h1 class="h1" style="font-family:ekush; font-size:70px;">প্রযুক্তি আলাপন</h1>
        <p>বাংলা ভাষায় প্রযুক্তির ব্যবচ্ছেদ</p> 
        
        
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link text-light bg-dark h5" href="index.php">নীড়পাতা</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link text-light bg-dark h5" href="news.php">নিউজ</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link text-light bg-dark h5" href="all_article.php">তালিকা</a>
            </li>
            
             <li class="nav-item">
                <a class="nav-link text-light bg-dark h5" href="login_page.php">লেখালেখি</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link text-light bg-dark h5" href="about.php">আমাদের কথা</a>
            </li>
        </ul>
    </div>
        <!--articles feeds-->
    <div class="container-fluid">
        
        <div class="row px-2">
            <!--cards-->
            
            <?php
                //getting posts
                $sql = "select * from posts where state=1;";
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