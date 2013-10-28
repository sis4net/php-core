<?php

abstract class DetailListController extends AbstractListController {

	protected final function getAction() {
		return "detailList";
	}

	protected final function setUrl() {
		return "";
	}

	protected final function isForm() {
		return true;
	}

}

?>