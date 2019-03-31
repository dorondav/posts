<?php
if (isset($_POST['register'])) {
    require('../connection/db.php');

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $passwordRepeat  = mysqli_real_escape_string($conn, $_POST['confirmPassword']);


    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../auth/register.php?error=emptyfields&uid=" . $username . "&mail=" . $email);
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../auth/register.php?error=invalidmail&uid");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../auth/register.php?error=invaliduidmail&uid=" . $username);
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../auth/register.php?error=invaliduid&=mail" . $email);
        exit();
    } elseif ($password !== $passwordRepeat) {
        header("Location: ../auth/register.php?error=passwordcheck&uid=mail" . $username . "&mail=" . $email);
        exit();
    } else {
        //  see if user name exiests 
        $sql = "SELECT  username, email FROM users WHERE username=? OR email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../auth/register.php?error=error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../auth/register.php?error=usertaken&mail=" . $email . "&username=" . $username);
                exit();
            } else {
                $sql = "INSERT INTO users (username, email, password) VALUES (?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../auth/register.php?error=sqlerror");
                    exit();
                } else {
                    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashPassword);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../auth/register.php?register=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../auth/register.php");
    exit();
}