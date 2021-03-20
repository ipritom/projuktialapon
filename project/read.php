<!DOCTYPE html>
<?php
    session_start();
    if(isset($_GET['ID'])){
        include_once "includes/connect_db.php";
        $iid = $_GET['ID'];
        //to fetch Bangla charset
        mysqli_query($conn,'SET CHARACTER SET utf8');
        mysqli_query($conn,"SET SESSION collation_connection ='utf8_general_ci'");
    }
    else{
        header('location: index.php?id=not_set');
    }
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
?>
<html>
<?php include_once 'header.php';?>
<body class="bg-light">
    <?php include_once 'navbar.php'; ?>
    
    <div class="container-fluid">
        <?php
            //getting article
            $sql1 = "select * from posts where post_id=$iid";
            $res1 = mysqli_query($conn,$sql1);
            $article = mysqli_fetch_assoc($res1); 
            //getting writter info
            $sql2 = "select * from user_list where id=".$article['user_id'].";";
            $res2 = mysqli_query($conn,$sql2);
            $writer = mysqli_fetch_assoc($res2);
            $writer_name = $writer['firstname']." ".$writer['lastname'];
            $writer_id= $writer['id'];
            //getting feature image
            $sql3 = "select * from picture where post_id=".$article['post_id'].";";
            $res3 = mysqli_query($conn,$sql3);
            $img = mysqli_fetch_assoc($res3);
            $loc = "uploads/".$img['pic'];
            
        ?>
        <!--main fields-->
        <div class="row py-3">
            <!--article reader-->
            <div class="col-xl-6   border border-white">
               <?php echo "<img class='img-fluid align-items-stretch' src=$loc style='height:; width:100%;'>" ?><br><br>
                
                <h class="h3 py-2"><?php echo $article['title']; ?></h>
                <br>
                <h class="h3" style="font-family:ekush;">লেখকঃ <?php echo "<a href='person.php?userid=$writer_id' style='text-decoration:none;color:black;'>$writer_name</a>" ?></h>
                <br>
                <h class="h6 py-2 text-info"><?php echo time_elapsed_string($article['date']); ?></h>
                <br><br>
                <p class="text-dark"><?php echo $article['content']; ?></p>
                
            </div>
            
            <div class="col">
                <!--cards-->
                <?php
                    //getting other posts
                    $sql = "select * from posts where state=1;";
                    $res = mysqli_query($conn,$sql);
                    $i=0;
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['post_id'];
                        if($id!=$iid){
                           //getting feature photo
                            $sql2 = "select * from picture where post_id=$id;";
                            $res2 = mysqli_query($conn,$sql2);
                            $pic = mysqli_fetch_assoc($res2);
                            $loc = "uploads/".$pic['pic']; //getting pic source
                            echo 
                                "<div class='col-md-5 float-right'>
                                    <a href='read.php?ID=$id' style='text-decoration:none;'>
                                    <img class='card-img-top' src=$loc alt='Card image' style='height:10rem;widht:6px;'></a>
                                    <div class='card-body'>
                                        <a href='read.php?ID=$id' style='text-decoration:none;color:black;'>
                                        <h4 class='h6'>".$row['title']."</h4></a>
                                    </div>
                                </div>"; 
                            $i = $i+1;
                        }
                        if($i>6){break;}
                        
                    }
                ?>
            
            </div>
            
        
        </div>
        <!--comments-->
        <div class="col-xl-6 col-sm-8">
            <?php 
    
                if(isset($_SESSION['id'])){ //if logged in
                    //LIKE button
                    echo "<button class='btn btn-info bg-light text-dark'><img src='res/star1.png' style='width:20px'; height:20px;> পছন্দ</button><br><br><h5 class=' h5 text-danger'>মন্তব্য<h5>";
                    //query for COMMENT data
                    $query1 = "select * from comment where post_id=$iid";
                    $inject1 = mysqli_query($conn,$query1);
                    //fetching all COMMENT
                    while($take1 = mysqli_fetch_assoc($inject1)){
                        $person_id = $take1['user_id'];
                        $query2 = "select * from user_list where id=$person_id;";
                        $inject2 = mysqli_query($conn,$query2);
                        $take2 = mysqli_fetch_assoc($inject2);
                        //COMMENT box info
                        $person = $take2['firstname']." ".$take2['lastname'];
                        $comment = $take1['text'];
                        $time = $take1['date'];
                        echo "<div class='card-body border border-info rounded'>
                              <a href='person.php?userid=$person_id' style='text-decoration:none;color:black;'>
                                <h5 class='h5 card-title'>".$person."</h5></a>
                                <p class='h6 card-text'>$comment</p>
                                <p class='text-left small'>$time<a class='text-right' style='font-size:12px;' href='report.php'>রিপোর্ট</a></p>
                              </div>";
                    }
                    echo "<br>
                            <div class='col'>
                                <form class='form-group' method='post' action='includes/com.inc.php'>
                                    <textarea class='form-control' rows='2' name='com'></textarea>
                                    <br>
                                    <button class='btn btn-outline-primary' type='submit' name='submit_com' value=$iid>মন্তব্য</button>
                                </form>
                            </div>";
                }
                else{//if NOT logged in
                    echo "<a href='login_page.php'><h class='text-danger'>আপনার মতামত জানাতে লগ-ইন করুন</h></a>";
                }
            ?>
            
            
            
        </div>
       
        
        </div>
    <div class="col text-center small"><p>projuktialapon.com &#169; 2018</p></div>
    
</body>
</html>