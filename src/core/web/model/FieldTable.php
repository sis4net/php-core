<?php 
/**
* Objeto que representa un Elemento de un formulario
*/
class FieldTable {
	
	public $name;	
	public $key;
	public $type;
	public $length;
	public $validate;
	public $list;
	public $ajax = false;
	public $value;
	public $regex;
	public $preview = false;
	public $size;
	public $url;
	public $show = true;
	
	function __construct($name, $key) {
		$this->name = $name;
		$this->key = $key;
	}
	
}

?>