<?php include('../includes/header.php'); ?>
<?php include('../connection/server.php') ?>


<div class="container auth-box">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Login</h5>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <?php include('errors.php'); ?>

                        <div class="form-group">
                            <label for="login__user-email">Email address</label>
                            <input type="email" name="email" class="form-control" id="login__user-email"
                                aria-describedby="emailHelp" placeholder="Enter email">

                        </div>
                        <div class="form-group">
                            <label for="login__user-password">Password</label>
                            <input type="password" class="form-control" name="password" id="login__user-password"
                                placeholder="Password">
                        </div>
                        <p>
                            <button type="submit" name="submit" class="btn btn-primary  btn-block">Login</button>
                            <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>Login via
                                facebook</a>
                        </p>
                    </form>
                    <small>Not A Member?<a href="./register.php"> Register Now!</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<?php include('../includes/footer.php'); ?>