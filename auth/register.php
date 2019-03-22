<?php include('../includes/header.php'); ?>
<?php include('../connection/server.php') ?>

<div class="container auth-box">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Register</h5>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method='post'>
                        <?php include('errors.php'); ?>

                        <div class=" form-group">
                            <label for="register__username">Username</label>
                            <input type="text" class="form-control" name="register_username" id="register__username"
                                aria-describedby="emailHelp" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label for="register__user_image">User Image</label>
                            <input type="file" name="register_user_image" class="form-control-file"
                                id="register__user_image">
                        </div>
                        <div class="form-group">
                            <label for="register__user-email">Email address</label>
                            <input type="email" class="form-control" name="register_email" id="register__user-email"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="register__user-password">Password</label>
                            <input type="password" name="register_pass" class="form-control"
                                id="register__user-password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="verify__user-password">Verify Password</label>
                            <input type="password" name="verify_pass" class="form-control" id="verify__user-password"
                                placeholder="Password">
                        </div>
                        <p>
                            <button type="submit" name="submit" class="btn btn-primary  btn-block">Register</button>
                            <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>Connect via
                                facebook</a>
                        </p>
                    </form>
                    <small>All Ready A Member?<a href="./login.php"> Login Now!</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<?php include('../includes/footer.php'); ?>