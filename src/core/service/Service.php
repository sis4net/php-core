<?php
/**
 * Servicio Para implementar la Logica de los servicios
 *
 * @author iflores
 *
 */
class Service implements Config {

	private $db = NULL;

	private $dao;

	public function __construct($db) {
		$this->db = $db;
	}

	public function getDAO($dao) {

		$class = $dao . 'DAO';


		$this->dao = new $class($this->db);

		//$this->close($db);

		return $this->dao;
	}

	/**
	 * Methodo para enviar Correos
	 *
	 * @param unknown_type $email
	 * @param unknown_type $message
	 */
	protected function sendMail($email, $message) {
		if (self::sendMail_cliente) {
			$contact = $email;
			$subject = self::title_mail;
	
			$cabeceras = 'From: '. self::mail_to . "\r\n" .
					'Reply-To: ' . self::mail_to  . "\r\n" .
                      			'Content-type: text/html'."\r\n" .
					'X-Mailer: PHP/' . phpversion();
	
			mail($contact, $subject, $message, $cabeceras);
		}
	}

	/**
	 * Methodo que genera pass randomo
	 * @param unknown_type $length
	 */
	protected function rand_string( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		
		$str = '';
		
		$size = strlen( $chars );
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}

		return $str;
	}
	
	/**
	 * Methodo para formatear las fechas (dd/mm/yyyy to yyyy/mm/dd)
	 * @param unknown_type $date
	 */
	protected function formatDate($date) {
		$date = strtotime($date);
		return  date("Y-m-d H:i:s", $date);
		// Php >= 5.3
		//$fecha = DateTime::createFromFormat('d/m/Y', $date);
		//return  $fecha->format('Y-m-d');
	}
	
	protected function getUrl() {
		return "http://" . $_SERVER["SERVER_NAME"] . self::site_url;
	}

	/**
	* Methodo que agrupa un listado de opciones en App - Module - Opt - Hijas
	*
	*/
	protected function groupOption($opts) {
		$list = array();

		$appNew = null;
		$modNew = null;
		$optNew = null;
		foreach ($opts as &$opt) {
			if ($appNew !=  $opt->app) {
				if (isset($app)) {
					$list[] = $app;
				}

				$app = new Application();
				$app->id = $opt->app;
				$app->name = $opt->appName;

				$appNew = $opt->app;
			}

			if ($modNew !=  $opt->module) {
				$mod = new Module();
				$mod->id = $opt->module;
				$mod->name = $opt->modName;

				$modNew = $opt->module;

				$app->modules[] = $mod;
			}

			if (isset($optNew) && $optNew == $opt->father) {
				$optionSon = new Option();
				$optionSon->id = $opt->id;
				$optionSon->name = $opt->optName;				
				if (isset($opt->check)) {
					$optionSon->check = $opt->check;
				}
				if (isset($opt->url)) {
					$optionSon->url = $opt->url;
				}
				if (isset($opt->optCode)) {
					$optionSon->code = $opt->optCode;
				}

				$option->option[] = $optionSon;
				continue;
			}

			if ($optNew !=  $opt->opt) {
				$option = new Option();
				$option->id = $opt->id;
				$option->name = $opt->optName;
				if (isset($opt->check)) {
					$option->check = $opt->check;
				}
				if (isset($opt->url)) {
					$option->url = $opt->url;
				}
				if (isset($opt->optCode)) {
					$option->code = $opt->optCode;
				}

				$optNew = $opt->opt;

				$mod->options[] = $option;	
			}		
		}

		if (isset($app)) {
			$list[] = $app;
		}

		return $list;
	}

	/**
	 * Methodos por Defecto de los Servicios
	 *
	 */
	
	public function listPaginated($init, $size) {
		return $this->dao->listPaginated($init, $size);
	}
	
	public function listAll() {
		return $this->dao->listAll();
	}

	public function add($obj) {
		$this->dao->add($obj);
	}

	public function load($obj) {
		return $this->dao->load($obj);
	}

	public function update($obj) {
		$this->dao->update($obj);
	}

	public function enabled($obj) {
		$this->dao->enabled($obj);
	}

	public function disabled($obj) {
		$this->dao->disabled($obj);
	}

	public function delete($obj) {
		$this->dao->delete($obj);
	}
	
	public function detail($obj) {
		return $this->dao->detail($obj);
	}

}

?>
