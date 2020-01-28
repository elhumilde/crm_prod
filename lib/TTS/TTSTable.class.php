<?php
header('Access-Control-Allow-Origin: *');
class Ctable{
	
	private $table,$db;
	
	public function __construct($table,$db){
		$this->table = $table;
		$this->db = $db;
	}
	
	public function viderTable(){
		$con = new CONNECT();
		$req = "
		DELETE FROM $this->db.dbo.$this->table
		USE $this->db
		DBCC CHECKIDENT ($this->table, RESEED, 0)
		";
		//var_dump($req);die;
		$con->prepare($req);
		$res = $con->execute();
		if(!$res) die($con->getError());
	}
	
	public function getInfoTable(){
		
		$con = new CONNECT();
		$req = "SELECT COLUMN_NAME,IS_NULLABLE,DATA_TYPE FROM ".$this->db.".INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$this->table."'";
		$con->prepare($req);
		$res = $con->execute();
		
		if(!$res) die($con->getError());
		$column = array();
		
		while($row = $con->fetch($res)){
			$column[$row["COLUMN_NAME"]] = array("isnull" => $row["IS_NULLABLE"], "type" => $row["DATA_TYPE"]);
		}
		
		return $column;
		
	}	
	
	public function getQuerySelect(){
		
		$column = $this->getInfoTable();
		$req = "select ";
		$sep = "";
		
		foreach ($column as $c){
			$req .= $sep;
			$req .= $c;
			$sep = ",";
		}
		
		$req .= " from $this->db.$this->table";
		
		return $req;
		
	}

}