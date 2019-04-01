<?php 
session_start();

if (isset($_POST['save'])) {
    require('../connection/db.php');
    $posTitle =  mysqli_real_escape_string($conn, $_POST['post_title']);
    $postDesc =  mysqli_real_escape_string($conn, $_POST['post_desc']);
    $postBody =  mysqli_real_escape_string($conn, $_POST['post_body']);
    $authorId = $_SESSION['userId'];
    $date = date('Y-m-d');

    // $postImage = 'placeholder';
    $postImage = $_FILES['post_image'];


    $postImageName = $_FILES['post_image']['name'];
    $postImageTmpName = $_FILES['post_image']['tmp_name'];
    $postImageSize = $_FILES['post_image']['size'];
    $postImageError = $_FILES['post_image']['error'];




    if (empty($posTitle) || empty($postDesc) || empty($postBody) || empty($postImage)) {
        header("Location: ../user.php?userid=" . $_SESSION['userId'] . "&error=emptyfileds");
        exit();
    } else {

        // Upload image

        // select file type
        $fileExt = explode('.', $postImageName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {

            if ($postImageError === 0) {

                if ($postImageSize < 1000000) {
                    $imageNewName = uniqid('', true) . "." . $fileActualExt;
                    $imagePath = '../images/posts/' .  $imageNewName;

                    move_uploaded_file($postImageTmpName,  $imagePath);
                    header("Location: ../user.php?userid=" . $_SESSION['userId'] . "&post=success");
                    exit();
                } else {
                    header("Location: ../user.php?userid=" . $_SESSION['userId'] . "&error=filesize");
                    exit();
                }
            } else {
                header("Location: ../user.php?userid=" . $_SESSION['userId'] . "&error=imageerror");
                exit();
            }
        } else {
            header("Location: ../user.php?userid=" . $_SESSION['userId'] . "&error=imagefiletype");
            exit();
        }




        // insert post to database
        $sql = "INSERT INTO articles (title, description, articleBody, postImage, authorId, date) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../user.php?userid=" . $_SESSION['userId'] . "&=sqlerror");
            exit();
        } else {
            // bind params
            mysqli_stmt_bind_param($stmt, 'ssssss', $posTitle, $postDesc,  $postBody, $postImage, $authorId, $date);
            mysqli_stmt_execute($stmt);
            header("Location: ../user.php?userid=" . $_SESSION['userId'] . "&post=success");
            exit();
        }
    }
}