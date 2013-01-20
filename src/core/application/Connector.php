<?php
/**
 * Classe encargada de generar la conexion a la BD
 */
include_once (__LIB_PATH . '/config/config.php');

class Connector implements Config {
	
	protected function connect() {
	  	$mysqli = new mysqli(self::db_ip, self::db_user, self::db_pass, self::db_name);
	  	
	  	if ($mysqli->connect_errno) {
    		die("Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
		}		
		
		return $mysqli;
	}	
	
	protected function close($db) {
		mysql_close($db);		
	}
	
}

?>
