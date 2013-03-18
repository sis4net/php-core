<?php

class error404Controller extends AbstractController {

	public function action() 
	{
	        $this->setAttribute('error','Pagina No Existe');
	        return 'error404';
	}
	
	protected function accessControl() {
		return false;
	}
	
	protected  function isGloba() {
		return true;
	}

}
?>
