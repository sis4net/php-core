<?php

class FactoryDAO {
	
	public static function build($dbIp, $dbUser, $dbPass, $dbName, $dbType) {

		$dao = NULL;

		// Cargamos Type
		switch($dbType) {
			case 'MYSQL':
				$dao = new MysqlDAO($dbIp, $dbUser, $dbPass, $dbName);
				break;
			case 'POSTGRESQL':
				$dao = new PostgresqlDAO($dbIp, $dbUser, $dbPass, $dbName);
				break;
		}

		return $dao;
	}

}

?>