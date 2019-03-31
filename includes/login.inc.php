<?php


if (isset($_POST['login_user'])) {
    require('../connection/db.php');

    $userMail = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($userMail) || empty($password)) {
        header("Location: ../auth/login.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../auth/login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 's', $userMail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $checkedPass = password_verify($password, $row['password']);
                if ($checkedPass == false) {
                    header("Location: ../auth/login.php?error=wrongpwd");
                    exit();
                } else if ($checkedPass == true) {
                    //  Enter user to website:

                    session_start();
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['userId'] = $row['id'];
                    header("Location: ../index.php");
                    exit();
                } else {
                    header("Location: ../auth/login.php?error=wrongpwd");
                    exit();
                }
            } else {
                header("Location: ../auth/login.php?error=nousers");
                exit();
            }
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}