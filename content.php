<?php
/**
 * Created by PhpStorm.
 * User: j.fuchs
 * Date: 2018-07-19
 * Time: 09:08
 */

    /** Shall only be visible to logged in users */
//    session_start();
//    if(!isset($_SESSION["login"])) {
//        header("LOCATION:signup.php");
//        die();
//    }
?>
<html>
    <head>
        <title>Content Page</title>
    </head>
    <body>
        This is only viewable by logged in users.
    </body>
</html>