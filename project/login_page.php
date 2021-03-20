<!DOCTYPE html>
<?php
session_start();

if(isset($_SESSION['id'])){
    header("location: paper.php?login=loggedin");
    exit();
} 
?>
<html>
<?php include_once 'header.php';?>
<body>
    <?php include_once 'navbar.php'; ?>
    <!--LOG-IN FORM -->
    <div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            
            <div class="row">
                <div class="col-md-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h2 class="text-center mb-0" style="font-family:balooda;">প্রবেশদ্বার</h2>
                        </div>
                        <div class="card-body">
                            <form class="form"  role="form" autocomplete="off" id="formLogin" novalidate="" method="GET" action="includes/login.inc.php">
                                <div class="form-group">
                                    <label for="uname1">Username</label>
                                    <input type="text" name="user" class="form-control form-control-lg rounded-0" id="uname1">
                                    <div class="invalid-feedback">Oops, you missed this one.</div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="pass" class="form-control form-control-lg rounded-0" id="pwd1"  autocomplete="new-password">
                                    <div class="invalid-feedback">Enter your password too!</div>
                                </div>
                              
                                <button type="submit" name ="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Login</button>
                            </form>
                            
                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST" action="signup_page.php">
                                <button type="submit" name="signup" class="btn btn-success btn-lg float-left" id="btnLogin">Sign Up</button>
                            </form>                               
                            
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->

                </div>


            </div>
            <!--/row-->

        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>


</body>
</html>