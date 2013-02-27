<?php
/**
 *
 * Classe que controla el Sitio
 *
 **/
include_once (__LIB_PATH . '/config/config.php');

abstract class BaseController implements Config {
	
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

		// Por Defecto estan en False
		$this->registry->template->comment = false;
		$this->registry->template->like = false;
		$this->registry->template->rating = false;

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
					if ($this->isOwn() && !$this->isAdmin()) {
						// Buscamos si el Grupo esta en Session
						$this->setGroup();
						// Validamos si el Dueño
						$own = $this->getOwn();
							
						if (!$own) {
							throw new Exception("Acceso No Autorizado.");
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

			// Verificamos si lleva Like
			if ($this->addLike()) {
				$this->registry->template->like = true;
				$this->registry->template->msgTwitter = $this->getMsgTwitter();
			}
			// Verificamos si lleva rating
			if ($this->addRating()) {
				$this->registry->template->rating = true;
			}
				
			// Verificamos si lleva Comentarios
			$this->setComment();

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
		} else if(isSet($_SESSION['lang'])) {
			$lang_site = $_SESSION['lang'];
		} else if(isSet($_COOKIE['lang'])) {
			$lang_site = $_COOKIE['lang'];
		} else {
			$lang_site = 'es';
		}
		if (!isSet($_SESSION['lang'])) {
			$_SESSION['lang'] = $lang_site;
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
	 * Methodo para setear la Noticia
	 */
	protected function getNotice() {
		return 0;
	}
	
	/**
	 * Methodo para setear el Grupo
	 */
	protected function getGroup() {
		return 0;
	}
	
	private function delGroupSession() {
		// Borramos el Grupo de la Session
		$_SESSION['group'] = null;
	}
	
	/**
	 * Methodo para setear mensaje de Twitter
	 */
	protected function getMsgTwitter() {
		return "";
	}
	
	/**
	 * Methodo para agregar rating a pagina
	 */
	protected function addRating() {
		return false;
	}
	/**
	 * Methodo para agregar botones de Like
	 * @return boolean
	 */
	protected function addLike() {
		return false;
	}
	
	/**
	 * Methodo para agregar comentarios en pagina
	 */
	protected function addComment() {
		return false;
	}
	
	/**
	 * Methodo para Incluir los Comentarios
	 */
	private function setComment() {
		//TODO: Eliminar este methodo
		if ($this->addComment()) {
			$this->registry->template->comment = true;
			$this->registry->template->commentUrl = __SITE_PATH.'/views/comment/comment.php';
	
			// Agregamos noticia o grupo a Session
			$_SESSION['notice'] = $this->getNotice();
			$_SESSION['groups'] = $this->getGroup();
			// Setamos el listado de Noticias
			$listComment = $this->registry->manager->getService('comment')->listComment();
			$this->registry->template->listComment = $listComment;
		}
	}
	
	/**
	 * Methodo que valida si esta Logeado
	 */
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
	
	/**
	 * Methodo que obtiene los datos de la Session
	 */
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
			if (isset($user->profile)) {
				if ($user->profile == 1) {
					return true;
				}
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
			if (isset($user->profile)) {
				if ($user->profile == 3) {
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * Methodo para validar si eres del Grupo
	 */
	protected function isGroupMember() {
		// Verificamos si existe la Session del Grupo
		if (isset($_SESSION['group'])) {
			// Validamos si es Integrante o Manager del Grupo
			$group = new Group();
			$group->user = $this->getUserSession()->id;
			$group->id = $_SESSION['group'];

			$groups = $this->getUserSession()->groups;

			$valid = false;

			foreach ($groups as &$elem) {
				if ($elem->id == $group->id) {
					$valid = true;
				}
			}

			return $valid;
		}
		return false;
	}

	/**
	 * Methodo que obtiene el Grupo de la Session
	 */
	private function setGroup() {
		if (!isset($_SESSION['group']) || $_SESSION['group'] == null) {
			session_register("id");
			$_SESSION['group'] = $_GET['id'];
		}
	}

	private function getUrl() {
		return "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}

}

?>
