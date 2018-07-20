<?php
    require_once './library/Autoloader.php';

    $autoloader = Autoloader::getInstance();
    spl_autoload_register(array('Autoloader', 'autoload'));

    $include_path = './library/' . PATH_SEPARATOR;
    $include_path .= './controller/' . PATH_SEPARATOR;
    $include_path .= './abstract/' . PATH_SEPARATOR;
    $include_path .= './models/' . PATH_SEPARATOR;
    $include_path .= './views/' . PATH_SEPARATOR;
    $include_path .= get_include_path();
    set_include_path($include_path);

    $oApplicationController = new ApplicationController();
?>