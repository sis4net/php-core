<?php

abstract class AddController extends FormController {

	protected final function getAction() {
		return "add";
	}

	protected final function loadService() {
		return null;
	}

	protected final  function create() {
		return true;
	}

}

?>