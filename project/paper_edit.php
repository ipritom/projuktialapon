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
    //editing permission to all writer
    /* 
    if($iid!=1){
        header("location:index.php?profile=access denied");
        exit();        
    } */ 
    //admin_entry successfull
    //operation --> id = operation on post_id(op_id)
    $op_id = $_GET['id'];
}
?>
<html>
<?php include_once 'header.php';?>
<body>
    <?php include_once 'navbar.php'; ?>
    <p class="text-center" style="font-family:ekush; font-size:35px;">লেখা সম্পাদনা</p>
 
    <!--main field-->
    <div class="container-fluid">
        
        <!--row wise allign-->
        <div class="row">
            <?php 
                $sql = "select * from posts where post_id=$op_id;";
                $res = mysqli_query($conn,$sql);
                $art = mysqli_fetch_assoc($res); //article
                $title = $art['title']; //getting title
                $content = $art['content']; //getting content
                //existence of feature image
                $sql = "select * from picture where post_id=$op_id;";
                $res2 = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res2); //0=false, 1=true
                
            ?>
            <!-- writing form-->
            <div class="col-8 border-0 border-info float-left">
                <form action="includes/update.throw.inc.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>শিরোনাম</label>
                        <input type="text" name="title"  class="form-control" value ='<?php echo $title;?>'>
                    </div>
                    <div class="form-group">
                        <label>আপনার প্রবন্ধ লিখুন</label>
                        <br>
                        <input type="button" onclick="doBreak(event)" value="break">
                        <input type="button" value="image">
                        <input type="button" onclick="doItalic(event)" value="italic">
                        <input type="button" value="highlight">
                        <input type="button" value="highlighted-italic">
                        <br><br>
                        <textarea id="article" class="form-control" rows="10" name="article"><?php echo $content;?></textarea>
                    </div>
                    <!--IMAGE UPLOAD-->
                    <div class="form-group">
                        <label class="h6">ফীচার ছবি</label>
                        <?php
                            if($count==0){
                                echo "<input type='file' name='image'>
                                    <label class='h6'>ছবির ক্যাপশন </label>
                                    <input type='text' name='caption'>";
                            }
                            elseif($count>0){
                                $pic = mysqli_fetch_assoc($res2);
                                $loc = $pic['pic'];
                                echo "<img class='col-3' src='uploads/$loc'>
                                    পরিবর্তন
                                    <input type='file' name='image'>";
                            }
                        ?>
                        
                        
                    </div>
                    <div class="form-group">
                        <?php echo "<input type='hidden' name='lekhok' value=$op_id>"; ?>
                        
                        <input class="btn btn-light btn-outline-primary" type="submit" name="submit_article" value="জমা দিন">
                    </div>
                </form>
            </div>
            
            <!-- writer info-->
        </div>
        
    </div>
</body>
</html>