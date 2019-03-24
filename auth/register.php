<?php include('../includes/header.php'); ?>
<?php include('../connection/db.php');
session_start();

$_SESSION['message'] = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //  two password are equal to each other
    if ($_POST['password'] == $_POST['confirmPassword']) {


        $username = $mysqli->real_escape_string($_POST['username']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = md5($_POST['password']);
        $avatar_path = $mysqli->real_escape_string('images/' . $_FILES['avatar']['name']);

        //   make sure file type is image

        if (preg_match("!image!", $_FILES['avatar']['type'])) {

            // copy image to image folder
            if (copy($_FILES['avatar']['tmp_name'], $avatar_path)) {
                $_SESSION['username'] = $username;
                $_SESSION['avatar'] = $avatar_path;

                $sql = "INSERT INTO users (username, email, password, user_image) "
                    . "VALUES('$username', '$email', '$password', '$avatar_path')";

                // if query is seccessful, redirect to index.php, done
                if ($mysqli->query($sql) === true) {
                    $_SESSION['message'] = "Registration successful!. added username to the database!";
                    header('location: ../index.php');
                } else {
                    $_SESSION['message'] = "User Could not be added to the database!! ";
                }
            } else {
                $_SESSION['message'] = "file upload failed";
            }
        } else {
            $_SESSION['message'] = "Pleas only upload GIG, JPG, PNG images ";
        }
    } else {
        $_SESSION['message'] = "Two passwords did not match ";
    }
}

?>

<div class="container auth-box">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Register</h5>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data" autocomplete="off">
                        <div class="alert alert-error"><?= $_SESSION['message'] ?></div>

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
                        <div class="form-group">
                            <label for="avatar">Select Your Image</label>
                            <input type="file" name="avatar" action="image/*" class="form-control" id="avatar">
                        </div>
                        <p>
                            <button type="submit" name="register" class="btn btn-primary  btn-block">Register</button>
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
<!-- <div class="form-group">
            <label for="register__user_image">User Image</label>
            <input type="file" name="register_user_image" class="form-control-file"
                id="register__user_image">
         </div> -->