<?php

//Indice, define el servicio y las importaciones
  
require_once 'JuegoTikTakToe.php';
 
if (isset($_GET['wsdl'])) {
	header('Content-Type: application/soap+xml; charset=utf-8');
	echo file_get_contents('TikTakToe.wsdl');
}
else {
	// Evitar problemas de cache
	ini_set('soap.wsdl_cache_enabled', '0');
	ini_set('soap.wsdl_cache_ttl', '0');
	
	session_start();
	$servidorSoap = new SoapServer('http://titanic.ecci.ucr.ac.cr/~eb23452/gato/?wsdl');

	//se retorna el siguiente fallo cuando no hay solicitud (v.b. desde un navegador)
	if(!@$HTTP_RAW_POST_DATA){
		$servidorSoap->fault('SOAP-ENV:Client', 'Invalid Request');
		exit;
	}

	$servidorSoap->setClass('JuegoTikTakToe');
	$servidorSoap->setPersistence(SOAP_PERSISTENCE_SESSION);
	$servidorSoap->handle();
}

?>