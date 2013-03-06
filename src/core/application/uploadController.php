<?php

abstract class uploadController extends CrudController {
	
	var $UPLOAD_ERR_NO_FILE = 4;
	
	var $UPLOAD_ERR_INI_SIZE = 1;
	
	var $UPLOAD_ERR_FORM_SIZE = 2;
	
	public function crudAction() {
		try {
			$file = null;
			// Nombre de Input
			$input = $this->getInput();
			
			if ($_FILES[$input]["error"]) {
				if ($_FILES[$input]["error"] == $this->UPLOAD_ERR_INI_SIZE || $_FILES[$input]["error"] == $this->UPLOAD_ERR_FORM_SIZE) {
					throw new Exception("Archivo Excede Tamaño Maximo Permitido (".$_FILES[$input]["error"].")");
				} else if ($_FILES[$input]["error"] != $this->UPLOAD_ERR_NO_FILE) {
					throw new Exception("Ocurrio un error al Subir el Archivo " . $_FILES[$input]["error"] );
				}
			} else if (!$this->validateType($_FILES[$input]["type"])) {
				throw new Exception("Tipo de Archivo Invalido ");
			} else {
				$dir = $this->getPathUpload();
				// Procesamos Data Subida
				$destination_path = getcwd().DIRECTORY_SEPARATOR;				
				
				// Creamos directorio si no existe
				$estructura = $destination_path . $dir;
				if (!is_dir($estructura)) {
					if(!mkdir($estructura, 0777))
					{
						throw new Exception("Ocurrio un Error al Generar el Directorio");
					}
				}
				
				// Verificamos si reemplazamos el nombre
				if ($this->replace()) {
					$ext = pathinfo($_FILES[$input]["name"], PATHINFO_EXTENSION);					
					
					$file = $dir . $this->setName() . '.' . $ext;
					
					$file_path = $destination_path . $file;
				} else {
					$file = $dir . basename( $_FILES[$input]["name"]);
					$file_path = $destination_path . $file;
				}
				
				if (!file_exists($file_path)) {
					// MOvemos Archivo
					@move_uploaded_file($_FILES[$input]["tmp_name"], $file_path);
					
					$result = 1;
				} else {
					throw new Exception("Archivo Ya Existe, ingrese una nueva o use otro nombre de archivo");
				}
			}
			
			// Ejecutamos Logica
			$this->uploadAction($file);
			
		} catch (Exception $e) {
			error_log("Ocurrio un error al hacer el Crud: " + $e->getMessage(), 0);
			throw new Exception($e->getMessage());
		}
	}
	
	protected abstract function validateType($type);
	
	protected abstract function getInput();
	
	protected abstract function getPathUpload();
	
	/**
	 * @all controllers que ejecuta Crud
	 */
	protected abstract function uploadAction($file);
	
	/**
	 * Methodo para Reemplazar el nombre del archivo subido, por uno custom
	 * Se debe utilizar el methodo getName() para setetar en nuevo nombre
	 */
	protected function replace() {
		return false;
	}
	
	/**
	 * Methodo para Setetar el nuevo nombre del Archivo
	 */
	protected function setName() {
		return "";
	}
	
	protected function isModal() {
		return false;
	}
}
?>