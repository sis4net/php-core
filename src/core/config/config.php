<?php

interface Config {
	// Nombre del Sitio
	const site_name = "bandztorm";
	
	// Datos Sitio
	const site_url = "/web-music";
	
	const mail_to = "info@mvc.cl";
	
	const publickey = "6Lcn5tESAAAAAO8bt2zLZ4iOiUgg4kcIs9tHmRz-"; // you got this from the signup page
	
	const privatekey = "6Lcn5tESAAAAAIS4jGH4-vv4fNFmpAByoGuEMVct";
	
	const mailhide_pubkey = '01UgYg_HejXCyK5VugKY7ffA==';
	
	const mailhide_privkey = 'f02bf086c8fee2cbf0362af410df7713';
	
	/*
	 * Datos Conexion BD
	 */
	const db_ip = "localhost";
	const db_name = "bandztor_db";
	const db_user = "bandztor_user";
	const db_pass = "bandztorm";

}
?>