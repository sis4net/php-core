<?php

class testDAO extends DAO {
	
	public function listAll() {
		for ($i = 1; $i <= $size; $i++) {
			$list[] = new FieldTable('test'. $i, '');
		}
		
		return $list;
	}

	public function load($data) {

		
	}

}

?>