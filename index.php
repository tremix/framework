<?php 
	/*
	configurar nuestra aplicacion
	*/
	require 'config.php';
	require 'helpers.php';

	//Library
	require 'library/Request.php';
	require 'library/Inflector.php';

	
	//controller($_GET['url']);

	if (empty($_GET['url']))
	{
		$url = "";
	}
	else
	{
		$url = $_GET['url'];
	}

	$request = new Request($url);
	$request -> execute();
	//var_dump($request->getUrl());
	//var_dump($request->getController());
	//var_dump($request->getControllerClassName());
	//var_dump($request->getControllerFileName());
	//var_dump($request->getAction());
	//var_dump($request->getActionMethodName());
	//var_dump($request->getParams());
