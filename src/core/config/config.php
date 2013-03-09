<?php

interface Config {
	// Nombre del Sitio
	const site_name = "php-mvc";
	
	// Datos Sitio
	const site_url = "/php-mvc";
	
	const mail_to = "info@kfc.cl";
	
	const publickey = ""; // you got this from the signup page
	
	const privatekey = "";
	
	const mailhide_pubkey = '';
	
	const mailhide_privkey = '';

	// Campos que define el atributo de donde sacar el perfil del Objeto de la session
	const profileType = 'profile';
	
	/*
	 * Datos Conexion BD
	 */
	const db_ip = "localhost";
	const db_name = "php-mvc";
	const db_user = "user";
	const db_pass = "pass";

}
?>