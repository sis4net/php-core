<?php
/**
 * Servicio Para implementar la Logica de los DAO
 * 
 * @author iflores
 *
 */
class PostgresqlDAO {

	private $db = NULL;

	public function __construct($dbIp, $dbUser, $dbPass, $dbName) {
		// Connectamos a la BD
		$this->db = $this->connect($dbIp, $dbUser, $dbPass, $dbName);
	}

	private function connect($dbIp, $dbUser, $dbPass, $dbName) {
	  	$dbconn = pg_connect("host=$dbIp port=5432 dbname=$dbName user=$dbUser password=$dbPass");
		
	  	if (!$dbconn) {
		  die("Fallo al contectar a POSTGRESQL: (" . pg_last_error() . ") ");
		}

		return $dbconn;
	}	
	
	public function close($db) {
		pg_close($db);		
	}

	public function real_escape_string($val) {
		return pg_escape_string($this->db, $val);
	}

	private function isError($result) {
		if (!$result) {
			throw new Exception(pg_last_error());
		}
	}

	/**
	 * Methodo que Retorna Un Listado Paginado
	 * @param unknown_type $query
	 * @throws Exception
	 */
	public function listDataPaginated($sql, $init, $size) {
		$sql .= " LIMIT %s OFFSET %s";
	
		$query =  sprintf($sql,
				$this->real_escape_string($init),
				$this->real_escape_string($size));

		return $this->listData($query);
	}

	/**
	 * Methodo que Retorna Un Listado
	 * @param unknown_type $query
	 * @throws Exception
	 */
	public function listData($query) {
		$result = pg_query($this->db, $query);

		$this->isError($result);

		$list = array();

		while ($row = pg_fetch_object($result, 'Object')) {
			$list[] = $row;
		}

		pg_free_result($result);

		return $list;
	}

	/**
	 * Methodo para Agregar
	 * @param unknown_type $query
	 * @throws Exception
	 * @return boolean
	 */
	public function executeData($query) {
		$result = pg_query($this->db, $query);
		$this->isError($result);
		return true;
	}

	/**
	 * Methodo para Agregar un elemento
	 * @param unknown_type $query
	 * @throws Exception
	 */
	public function addData($query) {
		$result = pg_query($this->db, $query);
		$this->isError($result);
		return $this->db->insert_id;
	}

	/**
	 * Methodo para contar la Data
	 *
	 * @param unknown_type $query
	 * @throws Exception
	 */
	public function countData($query) {
		$result = pg_query($this->db, $query);

		$this->isError($result);

		$num_of_rows = pg_num_rows($result);

		return $num_of_rows;
	}

	/**
	 * Methodo para verificar si existe un registro
	 * @param unknown_type $query
	 */
	public function existData($query) {
		$num_rows = $this->countData($query);
		
		if ($num_rows > 0) {
			return true;
		}

		return false;
	}

	/**
	 * Methodo para cargar data
	 * @param unknown_type $query
	 */
	public function loadData($query) {
		$result = pg_query($this->db, $query);

		return pg_fetch_object($result, 'Object');
	}

}

?>