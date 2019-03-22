<?php include('./includes/header.php') ?>

<?php 
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<div class="header__image">
    <div class="profile-pic"><img src="./images/profile.jpg" alt=""></div>
    <h1>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem vitae ab </h1>
</div>
</header>

<!-- latest Posts -->
<?php include('./components/lettestPosts.php') ?>

<!-- middle bennar -->
<?php include('./components/bennerPost.php') ?>

<!-- Main 6 Posts -->
<?php include('./components/mainPosts.php') ?>

<!-- oldest Posts -->
<?php include('./components/oldestPosts.php') ?>

<!-- Newsletter -->
<?php include('./components/newsletter.php') ?>
<!-- Footer -->
<?php include('./includes/footer.php'); ?>