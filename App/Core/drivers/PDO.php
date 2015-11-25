<?php
class driver_PDO
{
	private $_dbname;
	private $_dbhost;
	private $_dbuser;
	private $_dbpass;
	private $_dbcon;
	private $_error = false;

	
	public function connect($hostname, $username, $password, $dbname) {
		$this->_dbhost = $hostname;
		$this->_dbuser = $username;
		$this->_dbpass = $password;
		$this->_dbname = $dbname;
		       
        try
        {     
	        $opts = array(
				PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_EMULATE_PREPARES => false
			); 
        
			$this->_dbcon = new PDO('mysql:host='.$this->_dbhost.';dbname='.$this->_dbname.';charset=UTF8',$this->_dbuser, $this->_dbpass, $opts);
			$this->_dbcon->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->_dbcon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			
        } catch(PDOException $e) {
			$this->_error = $e;
			$this->error('CONNECTION',$e);
			return false;
		}
	}
	
	private function error($query,$error)
	{
		//TODO: Handle Errors as required
		
		$CP = Bootstrap::get_instance();
		$CP->log->error('mysql error on query '.$query);
		$CP->log->error($error);
		return true;
	}
	
	public function query($sql,$params = array()) {
		try {
			$stmt = $this->_dbcon->prepare($sql);
			if(!empty($params)) {
				foreach($params as $param) {
					if($param['type']==="int") {
						$stmt->bindParam($param['name'],$param['value'],PDO::PARAM_INT);
					} else {
						$stmt->bindParam($param['name'],$param['value'],PDO::PARAM_STR);
					}
				}
			}
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_CLASS);
		} catch(PDOException $e) {
			$this->_error = $e;
			$this->error($sql,$e);
			return false;
		}
	}
	
		
}