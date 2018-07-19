<?php
/**
 * Created by PhpStorm.
 * User: j.fuchs
 * Date: 2018-07-19
 * Time: 09:33
 */

// starting the session
session_start();
if(!isset($_SESSION["login"])) {
    // security check
} else {
    $_SESSION = array();
    header("Location: ../index.php");
    exit();
}