<?php
/**
* Clase para descargas archivos
**/
abstract class downloadController extends CrudController {

	public final function crudAction() {
		// Obtenemos Archivo a descaegar
		$file = $this->fileDownload();

		header("Content-Type: application/octet-stream"); 
		header('Content-Disposition: attachment; filename="'.basename($file).'"');
		header('Content-Length: ' . filesize($file));

		readfile($file);
	}

	abstract function fileDownload();

}
?>