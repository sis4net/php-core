<?php
include (__LIB_PATH  .'/application/Connector.php');

class Manager extends Connector 
{
	
	private $service;	
	
	public function getService($service) {	
		
		$class = $service . 'Service';
		
		// Obtenemos Conexion a BD
		$db = $this->connect();		
		
		$this->service = new $class($db);
		// Cargamos los DAOs
		$this->service->getDAO($service);
		
		//$this->close($db);			
		
		return $this->service;		
	}
}

?>