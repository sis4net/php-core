<?php

interface Config {
	// Nombre del Sitio
	const site_name = "kfcdelivery";
	
	// Datos Sitio
	const site_url = "/kfcdelivery";
	
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
	const db_name = "walkerdi_kfcdelivery";
	const db_user = "walkerdi_kfc";
	const db_pass = "wH@Ia5M%JrLa";

}
?>