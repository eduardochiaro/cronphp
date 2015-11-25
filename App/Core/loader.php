<?php
class Loader{

	function __construct(){
		// Grab the super object
		
	}
	public function first_run()
	{
	
		$CP = Bootstrap::get_instance();
		$this->_load_log();
	
		foreach($CP->config->autoload as $load){
			$func = '_load_'.$load;
			if(is_callable(array($this, $func))){
				$this->$func();
			}
		}
	}
	private function _load_database()
	{
		
		$CP = Bootstrap::get_instance();
		$this->load('db');
		
		if(empty($CP->config->database)){
			return false;
		}
		$CP->databases = new stdClass();
		foreach($CP->config->database as $key => $paramets){
			
			$CP->databases->$key = new db($key, $paramets);
			
			
			
		}
		
	}
	private function _load_log()
	{
		
		$CP = Bootstrap::get_instance();
		$this->load('log');
		
		
		$CP->log = new Log($CP->config->log);
		
		
	}

	private function load($classname)
	{
		if($classname == 'loader') return;
		
		$filename = CORE.'/'.$classname.'.php';
		if(is_file($filename)){
			require_once $filename;
		}
	}
}