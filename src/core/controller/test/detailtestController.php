<?php 

class detailtestController extends DetailController {
	
	protected  function getTitle() {
		return "TITLE_ADD";
	}
	
	protected function setFields() {
		$this->addField('name', "INIT_NAME", 'input', 30, true);
		$this->addField('description', "INIT_DESCRIPTION", 'text', 200, false);
		$this->addField('Number', "INIT_NUMBER", 'number', 10, true);
	}
	
	protected function loadData() {
		return new FieldTable('test', '');
	}
	
	protected function accessControl() {
		return false;
	}
	
}

?>