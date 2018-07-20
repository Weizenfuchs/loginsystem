<?php
/**
 * Created by PhpStorm.
 * User: j.fuchs
 * Date: 2018-07-20
 * Time: 13:06
 */

Class HomeModel extends A_Model
{
    public $displayMessage = "<h2>No account yet? <br> Sign up now!</h2>"; // message to display

    public function __construct()
    {

    }

    public function showMessage() {
        echo($this->displayMessage);
    }
}


    /*
    ?>
        <section class="main-container">
            <div class="main-wrapper">
                <?php
                if(isset($_GET['signup']) && $_GET['signup'] == 'success') {
                    ?>
                    <h1 style="color:green;">You've been signed up!</h1>
                    <?php
                } else if(isset($_GET['login']) && $_GET['login'] == 'success') {
                    ?>
                    <h1 style="color:green;">You've been logged in!</h1>
                    <?php
                } else if(isset($_GET['login']) && $_GET['login'] == 'empty') {
                    ?>
                    <h1 style="color:red;">Empty login fields</h1>
                    <?php
                } else if(isset($_GET['login']) && $_GET['login'] == 'error') {
                    ?>
                    <h1 style="color:red;">Wrong username or password</h1>
                    <?php
                } else {
                    ?>
                    <h2>No account yet? <br> Sign up now!</h2>
                    <?php
                }
                ?>
            </div>
        </section>
    <?php
    */
