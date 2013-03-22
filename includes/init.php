<?php
 include_once (__LIB_PATH . '/config/config.php');
 /*** include the controller class ***/
 include_once __LIB_PATH . '/application/' . 'AbstractController.php';
 include_once __LIB_PATH . '/application/' . 'crudController.php';
 include_once __LIB_PATH . '/application/' . 'uploadController.php';
 include_once __LIB_PATH . '/application/' . 'jsonController.php';
 include_once __LIB_PATH . '/application/' . 'exportController.php';

 /*** include the registry class ***/
 include_once __LIB_PATH . '/application/' . 'registry.class.php';

 /*** include the router class ***/
 include_once __LIB_PATH . '/application/' . 'router.class.php';

 /*** include the template class ***/
 include_once __LIB_PATH . '/application/' . 'template.class.php';
 
  /*** include the Manager class ***/
 include_once __LIB_PATH . '/application/' . 'Manager.class.php';

/* Classes */
// Servicios
include_once (__LIB_PATH  .'/service/Service.php');

// DAOs
include_once (__LIB_PATH  .'/dao/DAO.php');

// Model
include_once (__LIB_PATH  .'/model/Object.php');

// Se agrega lo propio del proyecto
$init = __SITE_PATH  .'/../includes/init.php';
if (file_exists($init) == true) {
	include_once ($init);
}
?>
