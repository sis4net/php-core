<?php

class indexController extends AbstractController {

	public function action() {

		return "index";
	}

	protected function accessControl() {
		return false;
	}

}

?>
