<?php 

class loadtestController extends EditController {
	
	protected  function getTitle() {
		return "TITLE_ADD";
	}
	
	protected function setFields() {
		$this->addFieldDetail('id', "INIT_NAME");
		$this->addField('input', "INIT_NAME", 'input', 30, true);
		$this->addField('text', "INIT_DESCRIPTION", 'text', 200, false);
		$this->addField('number', "INIT_NUMBER", 'number', 10, true);
		$this->addFieldList('select', "INIT_SELECT", 'select', 0, true, $this->listSelect());
		$this->addField('checkbox', "INIT_CHECKBOX", 'checkbox', 0, true);
		$this->addFieldList('radio', "INIT_RADIO", 'radio', 0, true, $this->listRadio());
	}
	
	private function listRadio() {
		for ($i = 1; $i <= 3; $i++) {
			$test = new Test();
			$test->id = $i;
			$test->name = 'Opcion' . $i;
	
			$list[] = $test;
		}
	
		return $list;
	}

	private function listSelect() {
		for ($i = 1; $i <= 5; $i++) {
			$test = new Test();
			$test->id = $i;
			$test->name = 'List' . $i;

			$list[] = $test;
		}
		
		return $list;
	}
	
	protected function loadData() {
		$test = new Test();
		$test->id = 1;
		$test->input = "Input";
		$test->text = "Text";
		$test->number = 123;
		$test->select = 1;
		$test->radio = 2;
		$test->checkbox = 1;

		return $test;
	}

	protected function setUrl() {
		return 'edit';
	}
	
	protected function accessControl() {
		return false;
	}
	
}

?>