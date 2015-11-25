<?php

define('APP', realpath(dirname(__FILE__)));
define('INDEX', realpath(APP.'/../'));
define('CORE', realpath(APP.'/Core/'));
define('LOG', INDEX.'/log/');

class Bootstrap{

	private static $instance;
	
	public $config = array();
	public $loader;

	function __construct($ENVIROMENT = 'production'){
	
		self::$instance =& $this;
	
		// Load config file
		$config = null;
		$configFile = APP . '/Config/'.$ENVIROMENT.'.php';
		
		if (is_readable($configFile)) {
			
		    require_once $configFile;
		}else{
			throw new Exception('config file not correctly set or readble for '.$ENVIROMENT);
		}
		
		// Init config data
		$this->config = (object)$config;
		
		//var_dump($this->config);
		
		include(APP.'/Core/loader.php');
		
		$loader = new Loader();
		
		$this->loader = $loader;
		
		$this->loader->first_run();
		
		
	}
	
	public static function get_instance()
	{
		return self::$instance;
	}
}