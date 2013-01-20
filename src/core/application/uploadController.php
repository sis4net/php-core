<?php

abstract class uploadController extends CrudController {
	
	var $UPLOAD_ERR_NO_FILE = 4;
	
	public function crudAction() {
		try {
			$img = null;
			if ($_FILES["img"]["error"]) {
				if ($_FILES["img"]["error"] != $this->UPLOAD_ERR_NO_FILE) {
					throw new Exception("Ocurrio un error al Subir el Archivo " . $_FILES["img"]["error"] );
				}
			} else if (($_FILES["img"]["type"] != "image/gif")
					&& ($_FILES["img"]["type"] != "image/jpeg")
					&& ($_FILES["img"]["type"] != "image/png")
					&& ($_FILES["img"]["type"] != "image/pjpeg")) {
				throw new Exception("Archivo solo debe ser imagen " . $_FILES["img"]["type"]);
			} else {
				// Procesamos Data Subida
				$destination_path = getcwd().DIRECTORY_SEPARATOR;
				$img = '/images/product/' . basename( $_FILES["img"]["name"]);
				$img_path = $destination_path . $img;
				if (!file_exists($img_path)) {
					// MOvemos Archivo
					@move_uploaded_file($_FILES["img"]["tmp_name"], $img_path);
					$result = 1;
				} else {
					throw new Exception("Imagen Archivo Ya Existe, ingrese una nueva o use otro nombre de imagen");
				}
			}
			
			
			// Ejecutamos Logica
			$this->uploadAction($img);
			
		} catch (Exception $e) {
			error_log("Ocurrio un error al hacer el Crud: " + $e->getMessage(), 0);
			throw new Exception($e->getMessage());
		}
	}
	
	/**
	 * @all controllers que ejecuta Crud
	 */
	protected abstract function uploadAction($file);
	
	protected function isModal() {
		return false;
	}
}
?>