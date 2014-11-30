<?php

class Manager extends Connector 
{
	
	private $service;	
	
	public function getService($service) {	
		
		$class = $service . 'Service';
		
		// Obtenemos el Factory

		// Obtenemos Conexion a BD
		$factoryDB = $this->getFactory();		
		
		$this->service = new $class($factoryDB);
		// Cargamos los DAOs
		$this->service->getDAO($service);
		
		//$this->close($db);			
		
		return $this->service;		
	}
}

?>