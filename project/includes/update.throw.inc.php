<?php
session_start();
if(isset($_POST['submit_article'])){
    //logged in or not?
    if(isset($_SESSION['id'])){
        include_once "connect_db.php";
        //take the article_data
        $text1 = mysqli_real_escape_string($conn,$_POST['title']);
        $text2 = mysqli_real_escape_string($conn,$_POST['article']);
        $text3 = mysqli_real_escape_string($conn,$_POST['caption']); 
        
        $op_id = $_POST['lekhok'];
        //article sql -- table: posts
        $sql1 = "UPDATE posts set title='$text1',content='$text2',date=CURDATE() where post_id=$op_id;";
        mysqli_query($conn,'SET CHARACTER SET utf8');
        mysqli_query($conn,"SET SESSION collation_connection ='utf8_general_ci'");
        //injecting sql and take post_id;
        $result1 = mysqli_query($conn,$sql1);
        $postID = mysqli_insert_id($conn);
        if(isset($_POST['image'])){
        //uploading image to database with recent post_id -- table: picture
        $target_dir = "../uploads/";
        $target_file = $target_dir.basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $img_name = basename( $_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        //upload code start
        if(isset($_POST["submit_article"])) {
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["image"]["size"] > 1024100) { //~1 MegaBytes
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $sql = "insert into picture(pic_id,post_id,user_id,caption,pic) values(null,$op,$uid,'$text3','$img_name');";
                    mysqli_query($conn,$sql);
                }
                else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } 
        }
        //upload code end
        //echo $sql1."\nchechk query = ".$result1;
        header("location: ../read.php?ID=$op_id");
        exit();
    }
    else{
        echo "YOU ARE NOT LOGGED IN! LOG IN TO WRITE ARTICLE";
    }
    
}
else{
    echo "Access Denied";
    header("location: ../index.php?page_not_found");
}
?>

