<?php
    // starting the session
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>

<header>
    <nav>
        <div class="main-wrapper">
            <ul>
                <li>
                    <a href="/Home/init">Home</a>
                </li>
            </ul>
            <div class="nav-login">
                <?php if(!isset($_SESSION["login"])) { ?>
<!--                <form action="controller/login.inc.php" method="POST">-->
                    <form action="/User/login" method="POST">
                    <input type="text" name="username" placeholder="Username/e-mail">
                    <input type="password" name="password" placeholder="password">
                    <button type="submit" name="submit">Login</button>
                </form>
                <?php } ?>
                <a href="/Signup/init">Sign up</a>
                <?php if(isset($_SESSION["login"])) { ?>
                    <a href="controller/logout.inc.php">Logout</a>
                <?php } ?>
            </div>
        </div>
    </nav>
</header>