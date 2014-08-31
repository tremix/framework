<?php 

class View{

	protected $template;
	protected $vars = array();

	public function __construct($template, $vars = array())
	{
		$this->template = $template;
		$this->vars = $vars;

		extract($vars);
		require "views/template.tpl.php";
	}
}