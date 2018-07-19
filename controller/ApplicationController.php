<?php
/**
 * Created by PhpStorm.
 * User: j.fuchs
 * Date: 2018-07-19
 * Time: 14:35
 */

class ApplicationController {
    function __construct() {
        $requestUrl = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $urlParams = explode('/', $requestUrl);

        $class = null;
        $method = null;

        if(count($urlParams) > 1 && $urlParams[1]) { $class = $urlParams[1]; }
        if(count($urlParams) > 2 && $urlParams[2]) { $method = strtolower($urlParams[2]); }

        $defaultController = 'Home';
        $defaultMethod = 'init';

        /**
         * Controller
         */
        if(isset($class) && class_exists($class . 'Controller')) {
            $class = ucfirst($class) . 'Controller';
        } else {
            $class = $defaultController . 'Controller';
        }

        // TODO: test
//        echo ($class . " <----class , method-----> " . $method);

        $class =  new $class();

        /**
         * Method
         */
        if(is_object($class)) {
            /**
             * Suche nach einer angegebenen gewollten Methode
             */
            if(method_exists($class, $method)) {
                $class->$method();
            } else {
                /**
                 * Suche nach der init Methode da keine angegeben wurde bzw. die angegebene nicht existiert
                 */
                echo ("loading default page");
                if(method_exists($class, $defaultMethod)) {
                    $class->$defaultMethod();
                } else {
                    die('DU HAST PECH GEHABT!!!');
                }
            }
        }
    }
}