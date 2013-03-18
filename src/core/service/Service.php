<?php
include_once (__LIB_PATH . '/config/config.php');
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
	 * Methodos por Defecto de los Servicios
	 *
	 */
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