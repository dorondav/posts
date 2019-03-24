<?php include('../includes/header.php'); ?>

<?php include('../connection/db.php');
session_start();
$errors = array();

// LOGIN USER
if (isset($_POST['login_user'])) {
    $errors = array();

    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $results = mysqli_query($mysqli, $query);
        if (mysqli_num_rows($results) == 1) {
            $user = mysqli_fetch_array($results);
            $_SESSION['avatar'] = $user['user_image'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "You are now logged in";
            header('location: ../index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}


?>

<div class="container auth-box">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Login</h5>

                    <form action="login.php" method="post">

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
                            <button type="submit" name="login_user" class="btn btn-primary  btn-block">Login</button>
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
<?php include('../includes/footer.php');   ?>