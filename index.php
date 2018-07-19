<?php
    require_once 'header.php';
    require_once './library/Autoloader.php';

    $autoloader = Autoloader::getInstance();
    spl_autoload_register(array('Autoloader', 'autoload'));
    set_include_path('./library/' . PATH_SEPARATOR . './controller/' . PATH_SEPARATOR . get_include_path());

    $oApplicationController = new ApplicationController();

    require_once 'footer.php';
?>