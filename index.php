<?php 
	/*
	configurar nuestra aplicacion
	*/
	require 'config.php';
	require 'helpers.php';
	/*
	Llamar a los controladores individuales
	*/

	if (empty($_GET['url'])){
		$_GET['url'] = 'home';
	}
	
	controller($_GET['url']);


