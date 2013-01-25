<?php
/**
 *
 * Classe que controla el Sitio
 *
 **/
include_once (__LIB_PATH . '/config/config.php');

abstract class BaseController implements Config {

	/*
	 * @registry object
	*/
	protected $registry;
	
	protected $lang;

	function __construct($registry) {
		$this->registry = $registry;
	}
	
	/**
	 * Methodo para setear variables globales del Sitio
	 */
	private function init() {
		session_start();
		header('Cache-control: private');
		// Seteamos Log
		error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
		// Setamos el Lang del sitio		
		$this->setLang();
		
		// Site Name
		$this->registry->template->site = self::site_url . "/";
		
		$this->registry->template->url = $this->getUrl();
	}

	public function index($controllerName) {
		$controller = false;
		try {
			// Seteamos Todas las COnfiguraciones Iniciales
			$this->init();
			$error = false;
			if ($this->accessControl()) {
				if ($this->isLogin()) {
					if ($this->onlyAdmin()) {
						// Verificamos si es un Administrador
						if (!$this->isAdmin()) {
							throw new Exception("Acceso No Autorizado.");
						}
					} else if ($this->isClient()) {
						if (!$this->accessClient()) {
							throw new Exception("Acceso No Autorizado.");
						}
					}
				} else {
					throw new Exception("Debe Ingresar al Sitio.");
				}
			} 
			
			// Cargamos Pagina
			$action = $this->action();		

		} catch (Exception $e) {
			error_log("Ocurrio un error en la Aplicacion no detectado : " + $e->getMessage(), 0);
			$this->registry->template->msg = $e->getMessage();
			$controllerName = ".";
			$action = "error";
		}
		
		if (isGloba()) {
			$controllerName = ".";
		}
		
		// Verificamos si es una respuesta de controlador
		if (strstr($action, '->') != '') {
			$controller = true;
			$action =  substr(strstr($action, '->'),2);
		}
		
		if (!$controller) {
			$this->registry->template->show($controllerName, $action, $this->isModal());
		} else {
			// Ejecutamos el controller (controller->[name])
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			header("Location: http://$host$uri/$action");
		}
		
	}
	
	/**
	 * Methodo para que la pagina la busque en el raiz
	 */
	protected  function isGloba() {
		return false;
	}
	
	/**
	 * Methodo para saber si una pagina es Modal
	 */
	protected function isModal() {
		return false;
	}
	
	/**
	 * Methodo para setear el lang del Cliente
	 */
	private function setLang() {
		$lang_site = 'es';	
		$lang_file = 'lang.es.php';

		
		include_once __LIB_PATH . '/../lang/'.$lang_file;
		
		// setamos el Lang en la Pagina
		//$this->lang = $lang;
		$this->registry->template->lang = $lang;
		
		$this->registry->template->lang_site = $lang_site;
	}

	/**
	 * @all controllers must contain an index method
	 */
	protected abstract function action();

	/**
	 *	Methodo para validar el acceso al Sitio
	 *
	 */
	protected function accessControl() {
		return true;
	}

	/**
	 * Methodo para validar que solo pueden entrar administradores
	 */
	protected function onlyAdmin() {
		return true;
	}
	
	/**
	 * Methodo para validar que no entren los clientes
	 */
	protected function accessClient() {
		return false;
	}
	
	protected function isLogin() {
		if (isset($_SESSION['user'])) {
			if ($_SESSION['user'] != null) {
				return true;
			}
		} else if(isset($_COOKIE['user'])) {
			$_SESSION['user'] = $_COOKIE['user'];
		}
		return false;
	}

	protected function getUserSession() {
		$user = null;
		if(isset($_SESSION['user'])) { 
			$user = $_SESSION['user']; 
		}
		return $user;
	}
	
	/**
	 * Methodo que valida si es Administrador
	 * @return boolean
	 */
	protected function isAdmin() {
		$user = $this->getUserSession();
		if ($user != null) {
			if ($user->profile == 1) {
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Methodo que valida si es Cliente
	 */
	protected function isClient() {
		$user = $this->getUserSession();
		if ($user != null) {
			if ($user->profile == 3) {
				return true;
			}
		}
		return false;
	}
	
	private function getUrl() {
		return "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}

}

?>
