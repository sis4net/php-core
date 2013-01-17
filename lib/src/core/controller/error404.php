<?php

class error404Controller extends BaseController {

	public function action() 
	{
	        $this->registry->template->blog_heading = 'Pagina No Existe';
	        return 'error404';
	}


}
?>
