<?php 

/**
* Interpretar la direccion URL y llamar al controlador adecuado
*/
class Request 
{
	//declarando propiedades
	protected $url;
	protected $controller;
	protected $defaultController = 'home';
	protected $defaultAction = 'index';
	protected $action;
	protected $params = array();


	public function __construct($url)
	{
		$this->url = $url;

		//controlador/parametro/
		//team/about/
		//
		$segments = explode('/', $this ->getUrl());

		// var_dump($segments);
		// exit();
		$this->resolveController($segments);
		$this->resolveAction($segments);
		//obtener parametros
		$this->resolveParams($segments);
	}
	//dividir los segmentos separandolos
	public function resolveController(&$segments)
	{
		//pasando por referencia
		$this->controller = array_shift($segments);
		
		//si controlador vacio asignaremos un controlador por defecto
		if(empty($this->controller))
		{
			$this->controller = $this->defaultController;
		}
	}
	public function resolveAction(&$segments)
	{
		//pasando por referencia
		$this->action = array_shift($segments);
		
		//si controlador vacio asignaremos un controlador por defecto
		if(empty($this->action))
		{
			$this->action = $this->defaultAction;
		}
	}
	//guardando en una propidad
	public function resolveParams(&$segments)
	{
		$this->params = $segments;
	}
	

	/*
	 Permiten obtener los valores dentro de una clase
	 Declarada o no en la clase
	*/


	public function getUrl()
	{
		return $this->url;
	}

	//segmento que contenga el nombredel controlador
	public function getController()
	{
		return $this->controller;
	}
	
	//nombre de la clase del controlador
	public function getControllerClassName()
	{
		//clase estatica para instaciar(funcion dentro de un objeto)
		return Inflector::camel($this->getController()).'Controller';
	}

	//archivo que contiene el controlador
	public function getControllerFileName()
	{
		return 'controllers/' . $this->getControllerClassName() . '.php';
	}

	public function getAction()
	{
		return $this->action;
	}

	public function getActionMethodName()
	{
		return Inflector::lowerCamel($this->getAction()).'Action';
	}
	
	//devuelve el 3er parametro
	public function getParams()
	{
		return $this->params;
	}

	//Instanciando las clases dinamicamente : Ejecutar
	public function execute()
	{
		//obteniendo la informacion de la URL
		$controllerClassName = $this->getControllerClassName();
		$controllerFileName = $this->getControllerFileName();
		$actionMethodName = $this->getActionMethodName();
		$params = $this->getParams();

		//Validacion del archivo del controlador exista
		if (!file_exists($controllerFileName))
		{
			exit('Controlador No Existe');
		}
		
		require $controllerFileName;

		// instanciando creando objeto con nombre variable
		$controller = new $controllerClassName();
		
		//llamando al controlador con el parametro y a la accion
		call_user_func_array([$controller,$actionMethodName], $params);

		//creando metodo de forma variable
		//$controller->$actionMethodName;
	}

}
