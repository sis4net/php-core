<?php

class owntestController extends BaseController {
	
	public function action() {
		
		return "simple";
	}

	protected function onlyAdmin() {
		return true;
	}
	
}

?>