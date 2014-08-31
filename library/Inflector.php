<?php 

class Inflector{
	//metodo statico, que se llama sin necesidad de crear nuevo objeto
	public static function camel($value)
	{
		//dividir la cadena con -
		$segments = explode('-', $value);
		// pasar lista de segmentos, item x item a traves del array junto 
		// a una funcion anonima.
		array_walk($segments, function(&$item){
			// cambiando el item por referencia convirtiendo a mayuscula
			$item = ucfirst($item);
		});
		//armar la cadena	
		return implode('',$segments);
	}
	public static function lowerCamel($value){

		return lcfirst(static::camel($value));
	}
}