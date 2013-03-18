<?php

interface Config {
	// Nombre del Sitio
	const site_name = "php-core";
	
	// Datos Sitio
	const site_url = "/php-core";
	
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
	
	// Modo develop
	const develop = false;
	
	// Title Mail
	const title_mail = 'Contacto Web';
	
	// Active/Disable mail
	const sendMail_cliente = false;
	
	const sendMail_user = true;

}
?>
