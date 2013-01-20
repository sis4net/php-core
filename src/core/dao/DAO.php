<?php
/**
 * Servicio Para implementar la Logica de los DAO
 * 
 * @author iflores
 *
 */
class DAO {

	private $db = NULL;

	public function __construct($db) {
		$this->db = $db;
	}

	protected function real_escape_string($val) {
		return mysqli_real_escape_string($this->db, $val);
	}

	private function isError($result) {
		if (!$result) {
			throw new Exception($this->db->error);
		}
	}

	/**
	 * Methodo que Retorna Un Listado
	 * @param unknown_type $query
	 * @throws Exception
	 */
	protected function listData($query) {
		$result = $this->db->query($query);

		$this->isError($result);

		$list = array();

		while ($row = mysqli_fetch_object($result, 'User')) {
			$list[] = $row;
		}

		mysqli_free_result($result);

		return $list;
	}

	/**
	 * Methodo para Agregar
	 * @param unknown_type $query
	 * @throws Exception
	 * @return boolean
	 */
	protected function executeData($query) {
		$result = $this->db->query($query);
		$this->isError($result);
		return true;
	}

	/**
	 * Methodo para Agregar un elemento
	 * @param unknown_type $query
	 * @throws Exception
	 */
	protected function addData($query) {
		$result = $this->db->query($query);
		$this->isError($result);
		return $this->db->insert_id;
	}

	/**
	 * Methodo para contar la Data
	 *
	 * @param unknown_type $query
	 * @throws Exception
	 */
	protected function countData($query) {
		$result = $this->db->prepare($query);
		$result->execute();
		$result->store_result();
		$num_of_rows = $result->num_rows;
		$this->isError($result);
		return $num_of_rows;
	}

	/**
	 * Methodo para verificar si existe un registro
	 * @param unknown_type $query
	 */
	protected function existData($query) {
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
	protected function loadData($query) {
		$result = $this->db->query($query);

		return mysqli_fetch_object($result, 'User');
	}

}

?>