<?php

class error404Controller extends AbstractController {

	public function action() 
	{
	        $this->registry->template->error = 'Pagina No Existe';
	        return 'error404';
	}
	
	protected function accessControl() {
		return false;
	}

}
?>
