<?php require('./components/header.php'); ?>
<!-- Secondery Navbar -->
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
                <a class="nav-link" href="/posts/index.php">Edit User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Posts</a>
            </li>

        </ul>

    </div>
</nav>

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
            <button type="submit" name="edit-post" class="btn btn-dark btn-lg btn-block">Edit Post</button>

        </form>



    </div>
    <div class=" userPosts">userPosts
    </div>


</div>


<?php require('./components/footer.php'); ?>