<?php require('./components/header.php'); ?>
<!-- Secondery Navbar -->

<?php
if (isset($_SESSION['userId'])) {
    require_once('./connection/db.php');

    ?>
<!-- 
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><?php if (isset($_SESSION['userId'])) {
                                            echo $_SESSION['username'];
                                        }  ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#user-navbar"
        aria-controls="user-navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="user-navbar">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/posts/index.php">Posts <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/posts/index.php">Edit User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Posts</a>
            </li>

        </ul>

    </div>
</nav> -->

<!-- User Container: -->
<div class="userPate-layout">

    <div class="userinput">
        <h1>Add new post</h1>

        <form action="./includes/posts.inc.php" class="add-post-form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control" name="post_title" id="post_title" placeholder="Enter Title">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="post_desc" name="post_desc"
                    placeholder="Enter Post Description">
            </div>
            <div class="form-group">
                <textarea class="form-control" id="post_body" name="post_body" placeholder="Post Content"
                    rows="10"></textarea>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input-dark" name="post_image" id="validatedCustomFile">
                <label class="custom-file-label" for="validatedCustomFile">Post Image...</label>
            </div>
            <button type="submit" name="save" class="btn btn-dark btn-lg btn-block">Save New Post</button>
            <button type="submit" name="delete-post" class="btn btn-danger btn-lg btn-block">Delete Post</button>

            <button type="submit" name="edit-post" class="btn btn-dark btn-lg btn-block">Edit Post</button>

        </form>

    </div>



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
                <a href="./user.php?article=<?= $row['articleId'] ?>">
                    <div class="show-post">
                        <div class="post-name"><?= $row['title'] ?></div>
                        <small class="post-date"><?= $row['date'] ?></small>
                        <small class="post-category"><?= $row['category'] ?></small>
                    </div>
                </a></li>
            <?php

        }
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


<?php require('./components/footer.php'); ?>