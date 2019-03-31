<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/posts/css/bootstrap.min.css">
    <link rel="stylesheet" href="/posts/css/main.css">
    <title>Posts</title>
</head>



<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/posts/index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tech</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Trips</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Nature</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">People</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">

                    <?php

                    if (isset($_SESSION['userId'])) {
                        // If Loggedin
                        ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <?= $_SESSION['username']; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0" action="/posts/includes/logout.inc.php" method="post">
                            <button class="btn btn-outline-dark my-2 my-sm-0" name="logout-submit"
                                type="submit">Logout</button>
                        </form>
                    </li>

                    <?php

                } else {
                    // If not Loggedin
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/posts/auth/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/posts/auth/register.php">Register</a>
                    </li>

                    <?php

                }

                ?>


                </ul>
            </div>

        </nav>