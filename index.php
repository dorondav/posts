<?php 
/* 
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header("location: auth/login.php");
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: auth/login.php");
} */
?>
<?php include('./components/header.php');
?>
<div class="header__image">
    <div class="profile-pic"><img src='<?= $_SESSION['avatar'] ?>' alt='<?= $_SESSION['username'] ?>'></div>
    <h1>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem vitae ab </h1>
</div>
</header>

<!-- latest Posts -->
<?php
print_r($_SESSION['username']);

include('./components/lettestPosts.php') ?>

<!-- middle bennar -->
<?php include('./components/bennerPost.php') ?>

<!-- Main 6 Posts -->
<?php include('./components/mainPosts.php') ?>

<!-- oldest Posts -->
<?php include('./components/oldestPosts.php') ?>

<!-- Newsletter -->
<?php include('./components/newsletter.php') ?>
<!-- Footer -->
<?php include('./components/footer.php');
?>