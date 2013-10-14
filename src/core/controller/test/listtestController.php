<?php 

class listtestController extends ListController {
	
	protected  function getTitle() {
		return "TITLE_LIST";
	}
	
	protected function setColumns() {
		$this->addColumns('name', "INIT_NAME");
	}
	
	protected function setList($page, $size) {
		for ($i = 1; $i <= $size; $i++) {
			$list[] = new FieldTable('test'. $i, '');
		}
		
		return $list;
	}
	
	protected function setOptions() {
		$this->addOptions('edit', 'edit', 'icon-refresh');
		$this->addDialogs('active', 'delete', 'icon-ok');
	}
	
	protected function accessControl() {
		return false;
	}
	
}

?>