<?php

class Autoloader {

    public function __construct() {
        spl_autoload_register(array($this, 'load'));
    }

    public static function load($classname) {
        $includepath = explode(";", get_include_path());

        foreach ($includepath as $value) {
            $path = $value . DIRECTORY_SEPARATOR . $classname. '.php';

            echo ("path = " . $path);

            if (file_exists($path))
            {
                require_once $path;
            }
        }
    }

}

// USE:
// require_once 'includes/autoloader.php';
// set_include_path(".\includes;.\library");