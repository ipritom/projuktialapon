<?php
//server properties
$server = "localhost";
$username = "root";
$pass = "";
$db_name = "blogdb";
//connection
$conn = mysqli_connect($server,$username,$pass,$db_name);
//check connection
if(!$conn){
    echo "FAILED";
}
?>