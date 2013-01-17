<?php

class typeDAO extends DAO  {

	public function listAll() {
	
		$query = 'SELECT * FROM Type ';
		
		return $this->listData($query);
	}
	
	public function add($type) {
		$query = sprintf("INSERT INTO Type (name, description) values ('%s', '%s')", 
				$this->real_escape_string($type->name),
				$this->real_escape_string($type->description));
		
		$this->addData($query);
	}
	
	public function load($type) {
	
		$query =  sprintf("SELECT * FROM Type WHERE id = %s", 
				$this->real_escape_string($type->id));
	
		return $this->loadData($query);
	}
	
	public function update($type) {
		$query = sprintf("UPDATE Type SET name = '%s', description = '%s' WHERE id = %s",
				$this->real_escape_string($type->name),
				$this->real_escape_string($type->description),
				$this->real_escape_string($type->id));
	
		$this->executeData($query);
	}
	
}
?>