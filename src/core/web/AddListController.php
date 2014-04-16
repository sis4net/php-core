<?php

abstract class AddListController extends AbstractListController {

	protected final function getAction() {
		return "addList";
	}

	protected final  function create() {
		return true;
	}

	protected final function isForm() {
		return true;
	}

	protected function setFilters() {}

}

?>