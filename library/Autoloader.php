<?php
/**
 * @desc PHP Autoloader
 * @author Manuel Kramm
 * @license Manuel Kramm
 * @version 1.5;
 */
class Autoloader
{
    /**
     * @desc Class-Instance
     * @var object $instance
     */
    private static $instance;

    /**
     * @desc Exclude file Formats
     * @var array $file_formats
     */
    public static $file_formats = array('.jpeg', '.jpg', '.png', '.html', '.php', '.js', '.css', '.', '..');

    /**
     * @desc Self-Constructor
     */
    private final function __construct() {}

    /**
     * @desc Get Self-Instance
     * @final
     */
    public static final function getInstance() {
        if(is_object(self::$instance) === false) {
            self::$instance = new Autoloader();
        }
        return (self::$instance);
    }

    /**
     * @desc Scan Dirs and Autoload Classes
     * @final
     */
    public static function autoload($class_name) {
        echo("test");

        foreach(explode(PATH_SEPARATOR, get_include_path()) as $dir) {

            $paths = explode(PATH_SEPARATOR, $class_name);

            $file = $dir;

            for($i = 0; $i < (count($paths) - 1); $i++) {
                $file .= $paths[$i] . '/';
                echo($file .= $paths[$i] . '/');
            }
            $file .= $paths[$i] . '.php';
            if(file_exists($file)) {
                require_once $file;
            }
        }
    }
}
?>

<!--USE:-->
<!--require_once './library/Autoloader.php';-->
<!--$autoloader = autoloader::getInstance();-->
<!--spl_autoload_register(array('Autoloader', 'autoload'));-->
<!--set_include_path('./library/' . PATH_SEPARATOR . get_include_path());-->


<!--
//class Autoloader {
//
//    public function __construct() {
//        spl_autoload_register(array($this, 'loader'));
//    }
//
//    private function loader($classname) {
//        echo("-test-test-test-test-test-test-test-test-test-test-test-test");
//
//        $includepath = explode(";", get_include_path());
//
//        foreach ($includepath as $value) {
//            $path = $value . DIRECTORY_SEPARATOR . $classname. '.php';
//
//            echo ("path = " . $path);
//
//            if (file_exists($path))
//            {
//                require_once $path;
//            }
//        }
//    }
//
//}

// USE:
//require_once ".\library\Autoloader.php";
//$loader = new autoloader();
//set_include_path(".\includes;.\library");
-->