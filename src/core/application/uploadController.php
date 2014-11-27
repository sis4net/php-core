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
					throw new Exception("file.exed.tam");
				} else if ($_FILES[$input]["error"] != $this->UPLOAD_ERR_NO_FILE) {
					throw new Exception("file.upload");
				}
			} else if (!$this->validateType($_FILES[$input]["type"])) {
				throw new Exception("file.type.invalid");
			} else {
				$dir = $this->getPathUpload();
				// Procesamos Data Subida
				$destination_path = getcwd().DIRECTORY_SEPARATOR;				
				
				// Creamos directorio si no existe
				$estructura = $destination_path . $dir;
				if (!is_dir($estructura)) {
					if(!mkdir($estructura, 0777, true))
					{
						throw new Exception("file.upload.mkdir");
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

				if ($this->deleteFile()) {
					if (file_exists($file_path)) {
						// Borramos Archivo
						unlink($file_path);
					}
				}
				
				if (!file_exists($file_path)) {
					// MOvemos Archivo
					@move_uploaded_file($_FILES[$input]["tmp_name"], $file_path);
					
					$result = 1;
				} else {
					throw new Exception("file.upload.exist");
				}
			}
			
			// Ejecutamos Logica
			$this->uploadAction($file, $file_path);
			
		} catch (Exception $e) {
			error_log("Ocurrio un error al hacer el Crud: " + $e->getMessage(), 0);
			throw new Exception($e->getMessage());
		}
	}

	/**
	* Methodo para borra archivo subido si existe
	**/
	protected function deleteFile() {
		return false;
	}
	
	/**
	* Methodo para implementar las validaciones los tipos de datos permitidos
	**/
	protected abstract function validateType($type);
	
	/**
	* Mehodo para setar el Nombre del imput file
	*/
	protected abstract function getInput();
	
	/**
	* Mehodo para definir la ruta de subida del archivo
	**/
	protected abstract function getPathUpload();
	
	/**
	 * @all controllers que ejecuta Crud
	 */
	protected abstract function uploadAction($file, $file_path);
	
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
	
	protected final function isModal() {
		return false;
	}
}
?>