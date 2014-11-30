<?php
/**
 * Classe encargada de generar la conexion a la BD
 */

class Connector implements Config {
	
	protected function getFactory() {			
		return $factoryDB = FactoryDAO::build(self::db_ip, self::db_user, self::db_pass, self::db_name, self::db_type);
	}	
	
}

?>
