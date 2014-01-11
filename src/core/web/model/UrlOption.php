<?php 

class UrlOption {
	
	public $name;
	public $url;
	public $icon;
	public $title;
	public $dialog;
	public $evaluation;
	public $show;
	
	function __construct($show, $name, $url, $icon, $dialog) {
		$this->name = $name;
		$this->url = $url;
		$this->icon = $icon;
		$this->dialog = $dialog;
		$this->show = $show;
	}
	
}

?>