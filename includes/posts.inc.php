<?php
session_start();

if (isset($_POST['save'])) {
    require('../connection/db.php');
    $postTitle =  mysqli_real_escape_string($conn, $_POST['post_title']);
    $postDesc =  mysqli_real_escape_string($conn, $_POST['post_desc']);
    $postBody =  mysqli_real_escape_string($conn, $_POST['post_body']);
    $authorId = $_SESSION['userId'];
    $date = date('Y-m-d');

    // $postImage = 'placeholder';
    $postImage = $conn->real_escape_string('../images/posts/' . $_FILES['post_image']['name']);


    if (empty($postTitle) || empty($postDesc) || empty($postBody) || empty($postImage)) {
        header("Location: ../user.php?userid=" . $_SESSION['userId'] . "&error=emptyfileds");
        exit();
    } else {

        // upload image to database
        if (preg_match("!image!", $_FILES['post_image']['type'])) {
            // copy image to image folder
            if (copy($_FILES['post_image']['tmp_name'], $postImage)) {

                // insert post to database
                $sql = "INSERT INTO articles (title, description, articleBody, postImage, authorId, date) VALUES (?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../user.php?userid=" . $_SESSION['userId'] . "&=sqlerror");
                    exit();
                } else {
                    // bind params
                    mysqli_stmt_bind_param($stmt, 'ssssss', $postTitle, $postDesc,  $postBody, $postImage, $authorId, $date);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../user.php?userid=" . $_SESSION['userId'] . "&post=success");
                    exit();
                }
            }
        }
    }
}




/* 
// Update 
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM aericle WHERE id=$id") or die($mysqli->error);
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id='$id'") or die($mysqli->error);

    $_SESSION['message'] = 'Record has been updated';
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
} */