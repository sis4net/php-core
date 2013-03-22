<?php
/**
 * <p></p>
 * User: iflores
 * Date: 19-03-13
 * Time: 09:41 PM
 */
/*** error reporting on ***/
error_reporting(E_ALL);

class PhpCore {

    function  __construct($site_path) {
        $this->init($site_path);
    }

    private function init($site_path) {
        define ('__LIB_PATH', $site_path . '/src/core/');

        $siteController = $site_path . '/../../src/';

        if (file_exists($siteController) == false) {
            $siteController = $site_path . '/src/core/';
        }

        define ('__SITE_PATH', $siteController);


        /*** include the init.php file ***/
        include_once $site_path . '/includes/init.php';

        $registry = new registry;

        /***	Cargamos el Manager ***/
        $registry->manager = new Manager();
        /*** load the router ***/
        $registry->router = new router($registry);

        /*** set the controller path ***/
        $registry->router->setPath (__SITE_PATH . '/controller');

        /*** load up the template ***/
        $registry->template = new template($registry);

        /*** load the controller ***/
        $registry->router->loader();
    }

    /*** auto load model classes ***/
    function __autoload($class_name) {
        $filename = strtolower($class_name) . '.class.php';
        $file = __SITE_PATH . '/model/' . $filename;

        if (file_exists($file) == false)
        {
            return false;
        }
        include ($file);
    }

}