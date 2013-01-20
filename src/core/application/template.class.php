<?php

class Template {

	/*
	 * @the registry
	 * @access private
	 */
	private $registry;

	/*
	 * @Variables array
	 * @access private
	 */
	private $vars = array();

	/**
	 *
	 * @constructor
	 *
	 * @access public
	 *
	 * @return void
	 *
	 */
	function __construct($registry) {
		$this->registry = $registry;

	}


	 /**
	 *
	 * @set undefined vars
	 *
	 * @param string $index
	 *
	 * @param mixed $value
	 *
	 * @return void
	 *
	 */
	 public function __set($index, $value)
	 {
		$this->vars[$index] = $value;
	 }


	function show($controller, $name, $isModal) {
		// Definimos el Container
		$container = __SITE_PATH.'/views/container/container.php';
		// Definimos la Pagina a Cargar
		if ($controller == '.') {
			$path = __SITE_PATH . '/views/'.  $name . '.php';
		} else {
			$path = __SITE_PATH . '/views/'. $controller . '/' .  $name . '.php';
		}

		if (file_exists($path) == false)
		{
			throw new Exception('Template not found in '. $path);
			return false;
		}

		// Load variables
		foreach ($this->vars as $key => $value)
		{
			$$key = $value;
		}
		
		if (!$isModal) {
			// Cargamos Body
			$body = $path;
			
			include ($container);      
		} else {
			include ($path);
		}         
	}


}

?>
