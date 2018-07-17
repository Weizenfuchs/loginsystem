<?php
    require_once 'header.php';
//    require_once "..\library\autoloader.php";
//    $loader = new autoloader();
//    set_include_path(".\includes;.\library");
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Signup</h2>

        <?php
        if(isset($_GET['signup']) && $_GET['signup'] == 'empty')
        {
            ?>
            <h1 style="color:red;">Please fill out the missing fields</h1>
            <?php
        } else if(isset($_GET['signup']) && $_GET['signup'] == 'usertaken')
        {
            ?>
            <h1 style="color:red;">The username is already taken</h1>
            <?php
        } else if(isset($_GET['signup']) && $_GET['signup'] == 'email')
        {
            ?>
            <h1 style="color:red;">This is not a valid email adress, pls check spelling</h1>
            <?php
        } else if(isset($_GET['signup']) && $_GET['signup'] == 'invalid')
        {
            ?>
            <h1 style="color:red;">Some of the Characters you used are not valid, pls use normal ASCII</h1>
            <?php
        }
        ?>

        <form class="signup-form" action="includes/signup.inc.php" method="POST">
            <input type="text" name="first" placeholder="Firstname">
            <input type="text" name="last" placeholder="Lastname">
            <input type="text" name="email" placeholder="E-mail">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="submit">Sign up</button>
        </form>
    </div>
</section>

<?php
    require_once 'footer.php';
?>