<?php
/**
 * Servicio Para implementar la Logica de los DAO
 * 
 * @author iflores
 *
 */
class DAO {

	private $factoryDB = NULL;

	public function __construct($factoryDB) {
		$this->factoryDB = $factoryDB;
	}

	protected function real_escape_string($val) {
		return $this->factoryDB->real_escape_string($val);
	}

	/**
	 * Methodo que Retorna Un Listado Paginado
	 * @param unknown_type $query
	 * @throws Exception
	 */
	protected function listDataPaginated($sql, $init, $size) {
		return $this->factoryDB->listDataPaginated($sql, $init, $size);
	}

	/**
	 * Methodo que Retorna Un Listado
	 * @param unknown_type $query
	 * @throws Exception
	 */
	protected function listData($query) {
		return $this->factoryDB->listData($query);
	}

	/**
	 * Methodo para Agregar
	 * @param unknown_type $query
	 * @throws Exception
	 * @return boolean
	 */
	protected function executeData($query) {
		return $this->factoryDB->executeData($query);
	}

	/**
	 * Methodo para Agregar un elemento
	 * @param unknown_type $query
	 * @throws Exception
	 */
	protected function addData($query) {
		return $this->factoryDB->addData($query);
	}

	/**
	 * Methodo para contar la Data
	 *
	 * @param unknown_type $query
	 * @throws Exception
	 */
	protected function countData($query) {
		return $this->factoryDB->countData($query);
	}

	/**
	 * Methodo para verificar si existe un registro
	 * @param unknown_type $query
	 */
	protected function existData($query) {
		return $this->factoryDB->existData($query);
	}

	/**
	 * Methodo para cargar data
	 * @param unknown_type $query
	 */
	protected function loadData($query) {
		return $this->factoryDB->loadData($query);
	}

}

?>