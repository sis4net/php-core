<?php

 /*** error reporting on ***/
 error_reporting(E_ALL);

 /*** define the site path ***/
 $site_path = realpath(dirname(__FILE__));
 define ('__LIB_PATH', $site_path . '/src/core/');
 
 $siteController = $site_path . '/../../src/';
 
 if (file_exists($siteController) == false) {
 	$siteController = $site_path . '/src/core/';
 }
 
 define ('__SITE_PATH', $siteController);
 

 /*** include the init.php file ***/
 include_once $site_path . '/includes/init.php';
	
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

?>
