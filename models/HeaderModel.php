<?php
/**
 * Created by PhpStorm.
 * User: j.fuchs
 * Date: 2018-07-20
 * Time: 15:19
 */


Class HeaderModel extends A_Model
{
    public $displayMessage = ""; // message to display

    public function __construct()
    {

    }

    public function showMessage() {
        $html = "<!DOCTYPE html>";
        $html .="<html>";
        $html .="<head>";
        $html .="<meta charset='UTF-8'>";
        $html .="<title>Login</title>";
        $html .="<link rel='stylesheet' type='text/css' href='../assets/css/style.css'>";
        $html .="</head>";
        $html .="<body>";
        $html .="<header>";
        $html .="<nav>";
        $html .="<div class='main-wrapper''>";
            <ul>
                <li>
                    <a href="/Home/init">Home</a>
                </li>
            </ul>
            <div class="nav-login">
    }

    public function showLogin() {

    }
}
?>
            </div>
        </div>
    </nav>
</header>