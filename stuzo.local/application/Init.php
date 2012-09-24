<?php

/* Main application class. */

define("BP", __DIR__);
define("DS", DIRECTORY_SEPARATOR);
include "autoload.php";

final class Init
{

    /*
     * Application class.
     * @var Core_Controller_Application object
     */
    private static $_app;

    /* Front end main entry point. */
    public static function run()
    {
        try {
            self::app()->run();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /*
     * Get initialized application object.
     * @return Core_Controller_Application object
     */
    public static function app()
    {
        if (!self::$_app) {
            self::$_app = new Core_Controller_Application();
        }
        return self::$_app;
    }

    /*
     * Retrieve model object.
     * @return object
     */
    public static function getModel($path)
    {
        try {
            list($module, $file) = explode(DS, $path);
            $className = ucfirst($module) . "_Model_" . ucfirst($file);
            return new $className();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /*
    * Retrieve base url.
    * @param string path
    * @return string base url
    */
    public static function getBaseUrl($path)
    {
        if (isset($path))
            return 'http://' . $_SERVER['SERVER_NAME'] . DS . $path;
    }

    /*
    * Retrieve base dir path.
    * @param string path
    * @return string base dir
    */
    public static function getBaseDir($path)
    {
        return DS . "application" . DS . $path;
    }
}