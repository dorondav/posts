<?php require('./components/header.php'); ?>
<!-- Secondery Navbar -->

<?php
if (isset($_SESSION['userId'])) {
    require_once('./connection/db.php');
    $update = false;

    //* get article information from database

    if (isset($_GET['edit'])) {
        $articleId = $_GET['edit'];
        $update = true;

        $sql = "SELECT * FROM articles WHERE articleId = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./user.php?userid=" . $_SESSION['userId']);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 's', $articleId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $articleId = $row['articleId'];
                $title = $row['title'];
                $postBody = $row['articleBody'];
                $description = $row['description'];
                $postImage = $row['postImage'];
                $category = $row['category'];


                //* update form
                if (isset($_POST['save'])) {
                    $postTitle =  mysqli_real_escape_string($conn, $_POST['post_title']);
                    $postDesc =  mysqli_real_escape_string($conn, $_POST['post_desc']);
                    $postBody =  mysqli_real_escape_string($conn, $_POST['post_body']);
                    $category =  mysqli_real_escape_string($conn, $_POST['post_cat']);

                    $postImage = $conn->real_escape_string('./images/posts/' . $_FILES['post_image']['name']);

                    // * upload image to database
                    if (preg_match("!image!", $_FILES['post_image']['type'])) {
                        //* copy image to image folder
                        if (copy($_FILES['post_image']['tmp_name'], $postImage)) {

                            $sql = "UPDATE articles SET title=?, description=?, articleBody=?, postImage=?, category=? WHERE articleId='$articleId'";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                print_r($conn);
                                die("Connection error: " . mysqli_connect_error());
                                header("Location: ./user.php?edit=postupdate" .  $articleId . "&=sqlerror");
                                exit();
                            } else {
                                // bind params
                                mysqli_stmt_bind_param($stmt, 'sssss', $postTitle, $postDesc,  $postBody, $postImage, $category);
                                mysqli_stmt_execute($stmt);
                                header("Location: ./user.php?edit=" .  $articleId .  "&postupdate=success");
                                exit();
                            }
                        } else {
                            header("Location: ./user.php?edit=" .  $articleId .  "&error=imageupdatefaild");
                        }
                    }
                }
            }
        }
    } else {
        // * reset form
        $title = '';
        $postBody = '';
        $description = '';
        $postImage = '';
        $category = '';
        // * add new post to database

        if (isset($_POST['save'])) {
            $postTitle =  mysqli_real_escape_string($conn, $_POST['post_title']);
            $postDesc =  mysqli_real_escape_string($conn, $_POST['post_desc']);
            $postCat =  mysqli_real_escape_string($conn, $_POST['post_cat']);

            $postBody =  mysqli_real_escape_string($conn, $_POST['post_body']);
            $authorId = $_SESSION['userId'];
            $date = date('Y-m-d');

            $postImage = $conn->real_escape_string('./images/posts/' . $_FILES['post_image']['name']);


            if (empty($postTitle) || empty($postDesc) || empty($postBody) || empty($postImage) || $postCat == 'default') {
                header("Location: ./user.php?userid=" . $_SESSION['userId'] . "&error=emptyfileds");
                exit();
            } else {

                // * upload image to database
                if (preg_match("!image!", $_FILES['post_image']['type'])) {
                    // copy image to image folder
                    if (copy($_FILES['post_image']['tmp_name'], $postImage)) {
                        // insert post to database
                        $sql = "INSERT INTO articles (title, description, articleBody, postImage, authorId, date, category) VALUES (?,?,?,?,?,?,?)";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ./user.php?userid=" . $_SESSION['userId'] . "&=sqlerror");
                            exit();
                        } else {
                            // bind params
                            mysqli_stmt_bind_param($stmt, 'sssssss', $postTitle, $postDesc,  $postBody, $postImage, $authorId, $date, $postCat);
                            mysqli_stmt_execute($stmt);
                            header("Location: ./user.php?userid=" . $_SESSION['userId']);
                            exit();
                        }
                    }
                }
            }
        }
    }
    ?>

<!-- User Container: -->
<div class="userPate-layout">

    <div class="userinput">
        <h1>Add new post</h1>

        <!-- <form action="./includes/posts.inc.php" class="add-post-form" method="post" enctype="multipart/form-data"> -->
        <form action="" class="add-post-form" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <input type="text" class="form-control" name="post_title" id="post_title" placeholder="Enter Title"
                    value="<?php echo $title; ?>">
            </div>
            <div class="form-group">
                <select class="form-control" name="post_cat" value="<?php echo $category; ?>">
                    <!-- <option value="default">Select Category</option> -->


                    <?php
                        if ($category == '') {
                            ?>
                    <option value="default">Select Category</option>
                    <?php } else {
                        ?>
                    <option value="<?= $category ?>"><?= $category ?></option>

                    <?php
                    } ?>
                    <option value="trip">Trips</option>

                    <!-- Get the default value from database -->

                    <option value="tech">Tech</option>
                    <option value="trip">Trips</option>
                    <option value="nature">Nature</option>
                    <option value="people">People</option>
                </select>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="post_desc" name="post_desc"
                    placeholder="Enter Post Description" value="<?php echo $description; ?>">
            </div>
            <div class="form-group">
                <textarea class="form-control" id="post_body" name="post_body" placeholder="Post Content"
                    rows="10"><?php echo $postBody; ?></textarea>
            </div>
            <div class="custom-file">
                <!-- !echo the image path automatcliy befure form update  -->
                <input type="file" class="custom-file-input-dark" name="post_image" id="validatedCustomFile">
                <input type="hidden" name="post_image">

                <label class="custom-file-label" for="validatedCustomFile">Post Image...</label>
            </div>
            <button type="submit" name="save" class="btn btn-dark btn-lg btn-block">Save New Post</button>

            <?php
                if ($update == true) {
                    ?>
            <a href="./user.php?userid=<?= $_SESSION['userId'] ?>" class="btn btn-danger btn-lg btn-block">Cancel</a>
            <?php
            } ?>


        </form>

    </div>

    <!-- show user pists by user id: -->
    <!-- show user pists by user id: -->

    <div class=" userPosts">
        <h1>My Posts</h1>

        <ul class="show-user-list">

            <?php
                $sql = "SELECT * FROM articles WHERE authorId = ?";
                $stmt = mysqli_stmt_init($conn);
                $authorId = $_SESSION['userId'];

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: user.php?userid=" . $_SESSION['userId']);
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, 's', $authorId);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
            <li class="show-user-item">
                <div class="show-post">
                    <div class="post-name"><?= $row['title'] ?></div>
                    <small class="post-date"><?= $row['date'] ?></small>
                    <small class="post-category"><?= $row['category'] ?></small>

                    <a class="btn btn-dark btn-lg" href="./user.php?edit=<?= $row['articleId'] ?>">Edit</a>
                    <a class="btn btn-danger btn-lg" href="./user.php?delete=<?= $row['articleId'] ?>">Delete</a>

                </div>
            </li>
            <?php

                }
            }
            ?>

            <?php

                $deleteMgs = '<div class="alert alert-danger" role="alert">Are you sure?</div>';

                if (isset($_GET['delete'])) {
                    $id = $_GET['delete'];
                    $conn->query("DELETE FROM articles WHERE articleId=$id") or die($conn->error);
                    echo $deleteMgs
                    ?>

            <?php


                // header("Location: user.php?deleted=" . $id . '&articledeleted');
            }

            ?>



        </ul>
    </div>
</div>
<?php

} else {
    header("Location: auth/login.php");
    exit();
}

?>


<?php require('./components/footer.php');  ?>