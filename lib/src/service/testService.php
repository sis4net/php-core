<?php
/**

Servicio para Usuarios

**/
class userService extends Service  {


	public function login($user) {
		$userDAO = $this->getDAO("user");


		$login = $userDAO->loadLogin($user);
			
		if ($login == null) {
			// Error por Login
			throw new Exception("Ingreso a Sitio Erroneo");
		}
		// Verificamos el Estado
		if ($login->enabled == 2) {
			// Primer Login
			throw new Exception("Debe Activar su Cuenta, Revise su correo");
		}
		
		// Obtenemos datos del Usuario
		$login = $userDAO->login($user);
		
		if ($login == null) {
			// Error por Login
			throw new Exception("Ingreso a Sitio Erroneo");
		}
		
		// Obtenemos Informacion Adicional
		$userDAO->updatelogin($login);

		return $login;
	}

	public function forgetPass($user) {
		$userDAO = $this->getDAO("user");
		// Verificamos si existe el id
		if (isset($user->id)) {
			$user = $userDAO->load($user);
		}
		
		// Verificamos si existe el usuario
		if ($userDAO->existRut($user)) {
			$user = $userDAO->loadRut($user);

			if ($user->id != 1) {
				$email = $user->email;
				$user->password = $this->rand_string(8);

				// Actualizamos Clave
				$userDAO->changePassword($user);

				// Creamos el mensaje
				$message = "Su Datos de conexion son : "
				. " Login : " . $user->login
				. " Clave : " . $user->password;
				// Enviamos el Correo
				$this->sendMail($email, $message);
			} else {
				throw new Exception("Rut Ingresado no permite reset de clave");
			}
		} else {
			throw new Exception("Rut Ingresado no existe");
		}
	}

	public function listUser() {
		return $this->getDAO("user")->listUser();
	}

	public function listClient() {
		return $this->getDAO("user")->listClient();
	}


	public function loadRut($user) {
		return $this->getDAO("user")->loadRut($user);
	}

	public function registerUser($user) {
		$userDAO = $this->getDAO("user");
				
		$user->date = $this->formatDate($user->date);

		// Verificamos si existe el usuario
		if (!$userDAO->existRut($user)) {
			$user->password = $this->rand_string(8);
			// Creamos Usuario
			$userDAO->add($user);
			// Obtenemos el ID
			$user->id = $userDAO->loadId($user)->id;
		} else {
			throw new Exception("Rut Ingresado ya existe");
		}
		// Verificamos si existe el usuario
		if (!$userDAO->existLogin($user)) {
			// Creamos el Login
			$userDAO->addLogin($user);
		}
		
		$email = $user->email;
		// Creamos el mensaje
		$message = 'Debes activar tu cuenta clickeando en el siguiente link /user/active/'. $user->id .' <br> Tu Contraseña es : ' . $user->password;
		// Enviamos el Correo
		$this->sendMail($email, $message);

		return $user->id;
	}

	public function addUser($user) {
		$userDAO = $this->getDAO("user");
		
		$user->date = $this->formatDate($user->date);

		// Verificamos si existe el usuario
		if (!$userDAO->existRut($user)) {
			$user->password = $this->rand_string(8);
			// Creamos Usuario
			$userDAO->add($user);
			// Obtenemos el ID
			$user->id = $userDAO->loadId($user)->id;
		} else {
			// Actualizamos
			$userDAO->update($user);
		}
		// Verificamos si existe el usuario
		if (!$userDAO->existLogin($user)) {
			// Creamos el Login
			$userDAO->addLogin($user);
		}
	
		$email = $user->email;
		// Creamos el mensaje
		$message = 'Debes activar tu cuenta clickeando en el siguiente link /user/active/'. $user->id .' <br> Tu Contraseña es : ' . $user->password;
		// Enviamos el Correo
		$this->sendMail($email, $message);

		return $user->id;
	}
	
	public function addUserApp($user) {
		$userDAO = $this->getDAO("user");

		$user->date = $this->formatDate($user->date);
	
		// Verificamos si existe el usuario
		if (!$userDAO->existRut($user)) {
			$user->password = $this->rand_string(8);
			// Creamos Usuario
			$userDAO->add($user);
			// Obtenemos el ID
			$user->id = $userDAO->loadId($user)->id;
		} else {
			throw new Exception("Rut Ingresado ya existe");
		}
		// Verificamos si existe el usuario
		if (!$userDAO->existLogin($user)) {
			// Creamos el Login
			$userDAO->addLogin($user);
		}
	
		$email = $user->email;
		// Creamos el mensaje
		$message = 'Debes activar tu cuenta clickeando en el siguiente link /user/active/'. $user->id .' <br> Tu Contraseña es : ' . $user->password;
		// Enviamos el Correo
		$this->sendMail($email, $message);
	
		return $user->id;
	}

	public function updateUser($user) {
		$user->date = $this->formatDate($user->date);

		$this->getDAO("user")->update($user);
	}

	public function loadClient($user) {
		return $this->getDAO("user")->loadClient($user);
	}

	public function activeUser($user) {
		$userDAO = $this->getDAO("user");

		// Activamos Usuario
		$userDAO->active($user);
		// Activamos Login
		$userDAO->activeLogin($user);
	}
	
	public function disabledUser($user) {
		$userDAO = $this->getDAO("user");
	
		// Activamos Usuario
		$userDAO->disabled($user);
		// Activamos Login
		$userDAO->disabledLogin($user);
	}

}

?>
