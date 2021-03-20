<!DOCTYPE html>
<html>
<?php include_once 'header.php';?>
<body>
    <?php include_once 'navbar.php'; ?>
    <!-- Sign Up Div -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card border-secondary">
                            <div class="card-header">
                                <h3 class="mb-0 my-2">Sign Up</h3>
                            </div>
                            <div class="card-body">
                                <!-- Sign Up Form -->
                                <form class="form" role="form" autocomplete="off" action="includes/signup.inc.php" method="GET">
                                    <div class="form-group">
                                        <label for="inputName">First Name</label>
                                        <input type="text" name="first" class="form-control" id="inputName" placeholder="first name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Last Name</label>
                                        <input type="text" name="last" class="form-control" id="inputName" placeholder="last name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">User Name</label>
                                        <input type="text" name="user" class="form-control" id="inputName" placeholder="user name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3">Email</label>
                                        <input type="email" name="emailadd" class="form-control" id="inputEmail3" placeholder="email@gmail.com" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3">Password</label>
                                        <input type="password" name="pass" class="form-control" id="inputPassword3" placeholder="password" pattern=".{5,100}" required title="At least 5 numbers/char">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputVerify3">Verify</label>
                                        <input type="password" name="vpass" class="form-control" id="inputVerify3" placeholder="password (again)" required="">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-lg float-right" name="register">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->

            </div>
            <!--/col-->
        </div>
        <!--/row-->
    </div>
    <!--/container-->
</body>
</html>