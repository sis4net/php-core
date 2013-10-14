<?php 

class puttestController extends AddController {
	
	protected  function getTitle() {
		return "TITLE_ADD";
	}
	
	protected function setFields() {
		$this->addField('name', "INIT_NAME", 'input', 30, true);
		$this->addField('description', "INIT_DESCRIPTION", 'text', 200, false);
		$this->addField('Number', "INIT_NUMBER", 'number', 10, true);
	}
	
	protected function setUrl() {
		return 'add';
	}
	
	protected function accessControl() {
		return false;
	}
	
}

?>