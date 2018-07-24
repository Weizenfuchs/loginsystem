<?php
/**
 * Created by PhpStorm.
 * User: j.fuchs
 * Date: 2018-07-20
 * Time: 13:06
 */

Class HomeModel extends A_Model
{
    public $displayMessage;

    public function __construct()
    {
        if (isset($_GET['signup']) && $_GET['signup'] == 'success') {
            $this->displayMessage = "<h1 style='color:green;'>You've been signed up!</h1>";
        } else if (isset($_GET['login']) && $_GET['login'] == 'success') {
            $this->displayMessage = "<h1 style='color:green;'>You've been logged in!</h1>";
        } else if (isset($_GET['login']) && $_GET['login'] == 'empty') {
            $this->displayMessage = "<h1 style='color:red;'>Empty login fields</h1>";
        } else if (isset($_GET['login']) && $_GET['login'] == 'error'){
            $this->displayMessage = "<h1 style='color:red;'>Wrong username or password</h1>";
        } else
            $this->displayMessage = "<h2>No account yet? <br> Sign up now!</h2>"; // message to display
    }

    public function showMessage() {
        $html = '<section class="main-container">';
        $html .=  '    <div class="main-wrapper">';
        echo $html;
        echo($this->displayMessage);
        $html = '    </div>';
        $html .= '</section>';
        echo($html);
    }
}
