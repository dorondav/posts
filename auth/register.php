<?php require('../components/header.php'); ?>

<div class="container auth-box">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Register</h5>
                    <form action="../includes/register.inc.php" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        <div class=" form-group">
                            <label for="register__username">Username</label>
                            <input type="text" class="form-control" name="username" id="register__username"
                                placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label for="register__user-email">Email address</label>
                            <input type="email" class="form-control" name="email" id="register__user-email"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="register__user-password">Password</label>
                            <input type="password" name="password" autocomplete="new-password" class="form-control"
                                id="register__user-password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="verify__user-password">Verify Password</label>
                            <input type="password" name="confirmPassword" autocomplete="new-password"
                                class="form-control" id="verify__user-password" placeholder="Password">
                        </div>
                        <!--  <div class="form-group">
                            <label for="avatar">Select Your Image</label>
                            <input type="file" name="avatar" action="image/*" class="form-control" id="avatar">
                        </div> -->
                        <p>
                            <button type="submit" name="register" class="btn btn-primary  btn-block">Register</button>
                            <!-- <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>Connect via
                                facebook</a> -->
                        </p>
                    </form>
                    <small>All Ready A Member?<a href="./login.php"> Login Now!</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<?php include('../components/footer.php'); ?>
<!-- <div class="form-group">
            <label for="register__user_image">User Image</label>
            <input type="file" name="register_user_image" class="form-control-file"
                id="register__user_image">
         </div>  -->