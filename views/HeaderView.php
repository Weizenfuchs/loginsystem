<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
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
<?php
/**
 * Created by PhpStorm.
 * User: j.fuchs
 * Date: 2018-07-19
 * Time: 15:28
 */

Class HomeView {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function showLogin() {
        if($loggedIn) {
            ?>
            <a href="../controller/logout.inc.php">Logout</a>
            <?php
        } else {
            ?>
            <form action="/User/login" method="POST">
                <input type="text" name="username" placeholder="Username/e-mail">
                <input type="password" name="password" placeholder="password">
                <button type="submit" name="submit">Login</button>
            </form>
            <a href="/Signup/init">Sign up</a>
            <?php
        }
    }
}
?>
            </div>
        </div>
    </nav>
</header>