<?php

class db {
	
	private $dbclass = null;
	private $params = null;
	
	public function __construct($name, $params = array()){
		
		$CP = Bootstrap::get_instance();
		$this->params = $params;
		
		$driver = $params['driver'];

		if ( ! isset($driver) OR $driver == '')
		{
			$CP->log->error('database driver for '.$name.' is empty');
			return;
		}
		
		if(is_file(CORE."/drivers/".$driver.'.php')){

			$classname = 'driver_'.$driver;
			if (!class_exists($classname)) {
				require_once(CORE."/drivers/".$driver.'.php');
			}
			$this->dbclass = new $classname;
			
			if($params['autoload']){
				$this->connect();
			}
		}else{
			$CP->log->error('database driver file for '.$name.' is missing');
		}
	}
	public function connect(){
		$params = $this->params;
		return $this->dbclass->connect($params['host'], $params['username'], $params['password'], $params['database']);
	}
	
	public function query($sql, $params = array()){
		return $this->dbclass->query($sql,$params);
	}
}