<?php 

class detailtestController extends DetailController {
	
	protected  function getTitle() {
		return "TITLE_ADD";
	}
	
	protected function setFields() {
		$this->addField('input', "INIT_NAME");
		$this->addField('text', "INIT_DESCRIPTION");
		$this->addField('number', "INIT_NUMBER");
		$this->addField('select', "INIT_NUMBER");
	}
	
	protected function loadData() {
		$test = new Test();
		$test->id = 1;
		$test->input = "Input";
		$test->text = "Text";
		$test->number = 123;
		$test->select = 1;

		return $test;
	}
	
	protected function accessControl() {
		return false;
	}
	
}

?>