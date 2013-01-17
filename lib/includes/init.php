<?php

 /*** include the controller class ***/
 include_once __SITE_PATH . '/application/' . 'controller_base.class.php';
 include_once __SITE_PATH . '/application/' . 'crudController.php';
 include_once __SITE_PATH . '/application/' . 'uploadController.php';

 /*** include the registry class ***/
 include_once __SITE_PATH . '/application/' . 'registry.class.php';

 /*** include the router class ***/
 include_once __SITE_PATH . '/application/' . 'router.class.php';

 /*** include the template class ***/
 include_once __SITE_PATH . '/application/' . 'template.class.php';
 
  /*** include the Manager class ***/
 include_once __SITE_PATH . '/service/' . 'Manager.class.php';

/* Classes */
// Servicios
include_once (__SITE_PATH  .'/service/Service.php');
include_once (__SITE_PATH  .'/service/userService.php');
include_once (__SITE_PATH  .'/service/deliveryService.php');
include_once (__SITE_PATH  .'/service/cityService.php');
include_once (__SITE_PATH  .'/service/categoryService.php');
include_once (__SITE_PATH  .'/service/profileService.php');
include_once (__SITE_PATH  .'/service/shopService.php');
include_once (__SITE_PATH  .'/service/paymentService.php');
include_once (__SITE_PATH  .'/service/reportService.php');
include_once (__SITE_PATH  .'/service/promotionService.php');
include_once (__SITE_PATH  .'/service/productService.php');
include_once (__SITE_PATH  .'/service/typeService.php');
include_once (__SITE_PATH  .'/service/exchangeService.php');
include_once (__SITE_PATH  .'/service/comunasService.php');
include_once (__SITE_PATH  .'/service/quadrantService.php');
include_once (__SITE_PATH  .'/service/releasedService.php');
include_once (__SITE_PATH  .'/service/pointsService.php');

// DAOs
include_once (__SITE_PATH  .'/dao/DAO.php');
include_once (__SITE_PATH  .'/dao/userDAO.php');
include_once (__SITE_PATH  .'/dao/cityDAO.php');
include_once (__SITE_PATH  .'/dao/categoryDAO.php');
include_once (__SITE_PATH  .'/dao/profileDAO.php');
include_once (__SITE_PATH  .'/dao/shopDAO.php');
include_once (__SITE_PATH  .'/dao/deliveryDAO.php');
include_once (__SITE_PATH  .'/dao/pointsDAO.php');
include_once (__SITE_PATH  .'/dao/paymentDAO.php');
include_once (__SITE_PATH  .'/dao/reportDAO.php');
include_once (__SITE_PATH  .'/dao/promotionDAO.php');
include_once (__SITE_PATH  .'/dao/productDAO.php');
include_once (__SITE_PATH  .'/dao/typeDAO.php');
include_once (__SITE_PATH  .'/dao/exchangeDAO.php');
include_once (__SITE_PATH  .'/dao/comunasDAO.php');
include_once (__SITE_PATH  .'/dao/quadrantDAO.php');
include_once (__SITE_PATH  .'/dao/releasedDAO.php');

// Model
include_once (__SITE_PATH  .'/model/User.class.php');
include_once (__SITE_PATH  .'/model/Delivery.php');


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

 /*** a new registry object ***/
$registry = new registry;

/*** create the database registry object ***/
//$registry->db = db::getInstance();

?>
