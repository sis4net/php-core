<?php

abstract class JsonController extends AbstractController {
	
	public final function action() {
		$action = "json";
		$msg = " ";
		// Ejecutamos Logica
		$msg =  $this->jsonAction();
		// COnvertimos respuesta en json
		$json = $this->json_encode($msg);
		// Se setea mSg a Mostrar en Pagina
		$this->setAttribute('msg', $json);
		
		return $action;
	}

	/**
	* Methodo que convierte Array o Objetc a Json
	*
	*/
	private function json_encode($object) {
		$json = '{';

		if (is_array($object)) {
			$count = 0;
			foreach ($object as &$elem) {
				if ($count > 0) {
					$json .= ',';
				}
				$json .= '"'.$elem->id.'":"'.$elem->name.'"';
				$count++;
			}
		} else if (is_object($object)) {
			$json .= '"'.$object->id.'":"'.$object->name.'"';
		}
		$json .= '}';

		return $json;
	}
	
	/**
	 * @all controllers que ejecuta Crud
	 */
	protected abstract function jsonAction();
	
	protected final function isModal() {
		return true;
	}
	
	protected final  function isGloba() {
		return true;
	}
	
}
?>
