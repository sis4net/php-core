<?php
/**
 *
 * Classe que controla el Sitio
 *
 **/
include_once (__LIB_PATH . '/config/config.php');

abstract class AbstractController implements Config {

	// Key de CAPTCHA
	protected $publickey = self::publickey ; // you got this from the signup page

	protected $privatekey = self::privatekey;

	protected $mailhide_pubkey = self::mailhide_pubkey;

	protected $mailhide_privkey = self::mailhide_privkey;

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

		// Cargamos la logica del Sitio
		$this->initSite();
	}

	/**
	 * Methodo para que los Sitios Implementes sus logicas al inicio de la carga del controlador
	 */
	protected  function initSite() {}

	/**
	 * Methodo publico para la ejecucion de los controladores
	 *
	 * @param unknown_type $controllerName
	 * @throws Exception
	 */
	public function index($controllerName) {
		$controller = false;
		try {
			// Seteamos Todas las COnfiguraciones Iniciales
			$this->init();
				
			// Entregamos Session al Sitio
			$this->registry->template->sessionSite = $this->getSessionSite();
				
			$error = false;
			if ($this->accessControl()) {
				if ($this->isLogin()) {
					if ($this->isOwn() && !$this->isAdmin()) {
						// Guardamos Data para validar si es dueño
						$this->setOwnData();
						// Validamos si el Dueño
						$own = $this->getOwn();
							
						if (!$own) {
							throw new Exception("No posee permiso para esta opcion.");
						}
							
					} else if ($this->onlyAdmin()) {
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

			// Cargamos logica de sitios
			$this->indexSite();

		} catch (Exception $e) {
			error_log("Ocurrio un error en la Aplicacion no detectado : " + $e->getMessage(), 0);
			$this->registry->template->msg = $e->getMessage();
			$controllerName = ".";
			$action = "error";
		}

		if ($this->isGloba()) {
			$controllerName = ".";
		}

		// Verificamos si es una respuesta de controlador
		if (strstr($action, '->') != '') {
			$controller = true;
			$action =  substr(strstr($action, '->'),2);
		}
		// Verificamos si se debe exportar
		if ($this->export()) {
			header("Content-type: application/vnd.ms-excel; name='excel'");
			header("Content-Disposition: filename=".$controllerName.".xls");
			header("Pragma: no-cache");
			header("Expires: 0");
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
	* 
	* Methodo para guardar data para avlidar si es dueño
	*
	*/
	protected  function setOwnData() {}

	/**
	 * Methodo para implementar en sitios Logicas especificas al cargar controlador
	 */
	protected  function indexSite() {}

	/**
	 * Methodo para exportar el contenido
	 */
	protected  function export() {
		return false;
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
	 * Methodo para agregar logica para manjera la informacion
	 * @return boolean
	 */
	protected function getOwn() {
		return false;
	}

	/**
	 * Methodo para setear el lang del Cliente
	 */
	private function setLang() {
		$lang_site = 'es';
		$lang_file = 'lang.es.php';

		if(isset($_GET['lang'])) {
			$lang_site = $_GET['lang'];
		} else if(isSet($this->getSessionSite()->lang)) {
			$lang_site = $this->getSessionSite()->lang;
		} else if(isSet($_COOKIE['lang'])) {
			$lang_site = $_COOKIE['lang'];
		} else {
			$lang_site = 'es';
		}
		if (!isSet($_SESSION['lang'])) {
			$this->getSessionSite()->lang = $lang_site;
			setcookie('lang', $lang_site, time() + (3600 * 24 * 30));
		}
		// Setetamos el Lang
		switch ($lang_site) {
			case 'es':
				$lang_file = 'lang.es.php';
				break;
			case 'en':
				$lang_file = 'lang.en.php';
				break;
			case 'de':
				$lang_file = 'lang.de.php';
				break;
			case 'pt':
				$lang_file = 'lang.pt.php';
				break;
			default:
				$lang = 'es';
				$lang_file = 'lang.es.php';
		}

		if (file_exists(__SITE_PATH . '/lang/'.$lang_file) == false) {
			include_once __LIB_PATH . '/../lang/'.$lang_file;
		} else {
			// Lag del Sitio
			include_once __SITE_PATH . '/lang/'.$lang_file;
		}

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

	/**
	 * Methodo para validar si eres dueños de la informacion
	 */
	protected function isOwn() {
		return false;
	}

	/**
	 * Methodo que obtiene la Session del $_SESSION
	 */
	private function getSession() {
		if (isset($_SESSION[self::site_name])) {
			return $_SESSION[self::site_name];
		}
		return null;
	}

	/**
	 * Methodo que crea la session para el Grupo
	 * @param $obj
	 */
	final protected function createSession($obj) {
		session_regenerate_id();
		session_register(self::site_name . '-login');

		$_SESSION[self::site_name] = $obj;

		if ($this->getUserSession() == null) {
			throw new Exception('No se pudo crear la session');
		}
	}

	/**
	 * Methodo que destruye la Session del Sitio
	 */
	final protected function deleteSession() {
		$session = $this->getSession();
		$session = null;
		session_destroy();
	}

	/**
	 * Methodo que obtiene la Session para ser utilizada en el Sitio
	 */
	final protected function getSessionSite() {
		return $this->getSession();
	}

	/**
	 * Methodo que valida si esta Logeado
	 */
	final protected function isLogin() {
		$session = $this->getSessionSite();
		if (isset($session)) {
			if ($session != null) {
				return true;
			}
		} else if(isset($_COOKIE[self::site_name])) {
			$session = $_COOKIE[self::site_name];
		}
		return false;
	}

	/**
	 * Methodo que obtiene los datos de la Session
	 */
	final protected function getUserSession() {
		$user = null;
		$session = $this->getSessionSite();
		if(isset($session)) {
			$user = $session;
		}
		return $user;
	}

	/**
	 * Methodo que valida si es Administrador
	 * @return boolean
	 */
	final protected function isAdmin() {
		return $this->validAdminProfile();
	}

	/**
	 * Methodo para resscribir la validacion para saber si el usuario conectado es un administrador
	 */
	protected function validAdminProfile() {
		return false;
	}

	/**
	 * Methodo que valida si es Cliente
	 */
	final protected function isClient() {
		$user = $this->getUserSession();
		if ($user != null) {
			if (isset($user->profile)) {
				if ($user->profile == 3) {
					return true;
				}
			}
		}
		return false;
	}

	private function getUrl() {
		return "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}

}

?>
