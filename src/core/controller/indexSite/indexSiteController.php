<?php

class indexSiteController extends AbstractController {

	public function action() {

		return "index";
	}

	protected function accessControl() {
		return false;
	}

}

?>
