<?php
// Definimos Ubicacion del Sitio
$site_path = realpath(dirname(__FILE__));

// Cargamos Classe de API
include_once $site_path . '/src/core/servlet/PhpCore.php';

// Iniciamos el API
new PhpCore($site_path);
?>
