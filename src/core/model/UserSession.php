<?php

class UserSession {

	// Datos del Usuario Logeado
	public $id;
	public $name;
	public $lastName;
	public $login;
	public $user;
	public $identificator;
	public $email;
	public $profile;
	public $type;

	/**
	* Datos compañia
	*/
	public $company;
	public $companyName;
	/**
	* Optiones habiliatadas por el Perfil
	*/
	public $applications;
	
	// App seleccionada
	public $application;

	// Modulo Seleccionado
	public $module;

	// Opcion Seleccionado
	public $option;

	/**
	* Optiones habiliatadas para el Acceso
	*/
	public $options;

	// Guarda la navegacion de la Session
	public $navBar;

}

?>