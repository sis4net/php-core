<?php 

class UrlOption {
	
	public $name;
	public $url;
	public $icon;
	public $title;
	
	function __construct($name, $url, $icon) {
		$this->name = $name;
		$this->url = $url;
		$this->icon = $icon;
	}
	
}

?>