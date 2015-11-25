<?php

class log
{
    private $config = NULL;
    var $logfile = NULL;


    public function __construct($params)
    {
    	if(!$params['active']){
    		return false;
    	}
    	
    	$this->config = $params;
    	if(!is_dir(LOG)){
	    	mkdir(LOG);
    	}
    
    	$name = strftime($params['name']);
    	
    	$filepath = LOG.'/'.$name.'.log';
    	
    	$this->logfile = $filepath;

    }


    public function info($message)
    {
    	if(!$this->config['active']){
    		return false;
    	}
    	if(!in_array($this->config['level'], array('ALL','ERROR','INFO'))){
    		return false;
    	}
    	
    	$this->_write($message, 'ERROR');
    }

    public function error($message)
    {
    	if(!$this->config['active']){
    		return false;
    	}
    	if(!in_array($this->config['level'], array('ALL','ERROR'))){
    		return false;
    	}
    	$this->_write($message, 'INFO');
    }
    private function _write($message, $level){
    
        $message = date('c') .' - ['.$level.']: '.$message."\n";
        return file_put_contents( $this->logfile, $message, FILE_APPEND );
    }

} 
