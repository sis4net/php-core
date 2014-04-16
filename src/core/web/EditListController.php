<?php

abstract class EditListController extends AbstractListController {

	protected final function getAction() {
		return "addList";
	}

	protected final function isForm() {
		return true;
	}

	protected function setFilters() {}

}

?>