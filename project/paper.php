<!DOCTYPE html>
<?php
session_start();
include_once "includes/connect_db.php";
if(!isset($_SESSION['id'])){
        header("location: login_page.php?profile=access denied");
        exit();
                
    }
?>
<html>
<?php include_once 'header.php';?>
<body>
    <?php include_once 'navbar.php'; ?>
    <p class="text-center" style="font-family:ekush; font-size:35px;"> স্বাগতম লেখালেখির খাতায়  </p>
 
    <!--main field-->
    <div class="container-fluid">
        <!--row wise allign-->
        <div class="col">
            <!-- writing form-->
            <div class="col-8 border-0 border-info float-left">
                <form action="includes/throw.inc.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>শিরোনাম</label>
                        <input type="text" name="title"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label>আপনার প্রবন্ধ লিখুন</label>
                        <br>
                        <input type="button" onclick="doBreak(event)" value="break">
                        <input type="button" onclick="doImage(event)"  value="image">
                        <input type="button" onclick="doHighlight(event)" value="highlight">
                        <input type="button" onclick="doHighlightItalic(event)" value="highlighted-italic">
                        <br><br>
                        <textarea id="article" class="form-control" rows="10" name="article"></textarea>
                    </div>
                    <!--IMAGE UPLOAD-->
                    <div class="form-group">
                        <label class="h6">ফীচার ছবি</label>
                        
                        <input type="file" name="image">
                        <label class="h6">ছবির ক্যাপশন </label>
                        <input type="text" name="caption">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-light btn-outline-primary" type="submit" name="submit_article" value="জমা দিন">
                    </div>
                </form>
            </div>
            
            <!-- writer info-->
            <div class="col-4 col-sm-4 float-right bg-light">
                    <p class="text-center">
                    <?php
                        if(isset($_SESSION['id'])){
                            echo "Logged in as <a href='profile.php' style='text-decoration:none; color:blue;'>".$_SESSION['firstname']." ".$_SESSION['lastname']."</a>";
                        }
                        else{
                            echo "NOT LOGGED IN";
                        }
                    ?>
                    </p>
                <p> 
                        <?php
                            //checking admin/member
                            if($_SESSION['admin']==1){
                                echo "<a href='admin.php' style='text-decoration:none; color:blue;'>Admin</a>";
                            }
                            else{
                                echo "Member";
                            }
                        ?>
                
                    </p>
                    <p>Total Article =
                        <?php
                        $uid = $_SESSION['id'];
                        $sql = "select * from posts where user_id='$uid';";
                        $results = mysqli_query($conn,$sql);
                        $rows = mysqli_num_rows($results);
                        echo $rows;
                        ?>
                    </p>
                    
                    <p class="text-center">
                    <?php
                        if(isset($_SESSION['id'])){
                                echo "<a href='includes/logout.inc.php'style='text-decoration:none; color:blue;'>LOG OUT</a>";
                            }
                        else{
                                echo "...";
                        }
                    ?>
                
                    </p>
                    
            </div>
        </div>
        
    </div>
</body>
</html>