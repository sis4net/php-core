<?php

class simpletestController extends BaseController {
	
	public function action() {
		
		return "simple";
	}

	protected function accessControl() {
		return false;
	}
	
}

?>