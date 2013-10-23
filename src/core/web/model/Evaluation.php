<?php

class Evaluation {
	
	public $param;
	public $condition;
	public $value;

	function __construct($param, $condition, $value) {
		$this->param = $param;
		$this->condition = $condition;
		$this->value = $value;
	}

}

?>