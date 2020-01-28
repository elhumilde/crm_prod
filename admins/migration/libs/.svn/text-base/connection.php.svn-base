<?php
class CONNECT{
	
	protected static $__CON;
	private $__ERROR;
	private $__QUERY;
	
	public static function setConnection($server,$user,$password, $dsn){
		if(!isset(self::$__CON)){
			
			if(strstr($dsn, "SQL Server")){
				self::$__CON = new PDO($dsn, $user, $password);
			
			}
			elseif(strstr($dsn, "mysql")){
				self::$__CON = new PDO("mysql:host=$server;", $user, $password);
				CMigration::$DBO = "";
			}elseif(strstr($dsn, "pgsql")){
				self::$__CON = new PDO("$dsn;user=$user; password=$password");
				CMigration::$DBO = "";
			}
			if(!self::$__CON) {
				die("Probleme de connection!");
				return false;
			}else{
				return true;
			}
		}else return true;
	}
	
	public function getError(){
		return $this->__ERROR;
	}
	
	public function prepare($query){
		$this->__QUERY = $query;
	}
	
	public function execute(){
	    print_r($this->__QUERY);
		$res = self::$__CON->query($this->__QUERY);
		return $res;
	}
	
	public function fetch($res){
		return $res->fetch();
	}
	
}