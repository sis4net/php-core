<?php 

class UrlOption {
	
	public $name;
	public $url;
	public $icon;
	public $title;
	public $dialog;
	public $evaluation;
	
	function __construct($name, $url, $icon, $dialog) {
		$this->name = $name;
		$this->url = $url;
		$this->icon = $icon;
		$this->dialog = $dialog;
	}
	
}

?>