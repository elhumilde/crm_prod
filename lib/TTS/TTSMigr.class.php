<?php
header('Access-Control-Allow-Origin: *');
class CMigration{
	
	private $tabeSource, 
			$tabDistin, 
			$attrSource,
			$attrDistin,
			$fk,
			$attrInserted,
			$cond,
			$actifAI,
			$truncate,
			$queryBefore,
			$not_duplicate;
	
	public static $DBO;
	
	public function __construct($tabeSource, $tabDistin,$server = "",$schema = ""){
		if($schema){
		    $this->tabeSource = $schema.".".$tabeSource;
		    $this->tabDistin = $schema.".".$tabDistin;
		    
		}else{
		    $this->tabeSource = $tabeSource;
		    $this->tabDistin = $tabDistin;
		    
		}
	    $this->actifAI = false;
		$this->truncate = true;
		$this->queryBefore = "";
		$this->not_duplicate = false;
		if(self::$DBO === null) self::$DBO = ".dbo";
		$this->__server = $server;
		
	}
	
	public function setAttrSource($attrSource){
		$this->attrSource = $attrSource;
	}
	
	public function setTruncate($bool){
		$this->truncate = $bool;
	}
	
	public function setAttrDistin($attrDistin){
		$this->attrDistin = $attrDistin;
	}
	
	public function setAI($p){
		$this->actifAI = $p;
	}
	
	public function setCond($cond){
		$this->cond = $cond;
	}
	
	public function setFK($fk){
		$this->fk = $fk;
	}
	
	public function defineParam($param,$equiv){
		$query = "CASE ";
		$else = "";
		foreach($equiv as $k=>$c){
			if($c) $query .= "WHEN $c THEN $k ";
			else $query .= "ELSE $k";
		}
		$query .= " END ";
		$this->attrSource = array_str_replace(":".$param,$query,$this->attrSource);
	}
	
	public function executeBefore($query){
		$this->queryBefore = $query;
	}
	
	public function fill($data){
		
		$tableD = new Ctable($this->tabDistin, DB_DSTN);
		if($this->truncate) $tableD->viderTable();
		
		echo "start fill $this->tabDistin ----------------------<br>";
		foreach($data as $c){
			$attr = join(",",array_keys($c));
			
			foreach($c as $k=>$v){
				$c[$k] = "'".utf8_decode($v)."'";
			}
			$val = join(",",$c);
			
			$where = " where ";
			$sep = "";
			foreach($c as $each_k=>$each_c){
				$where .= $sep." $each_k = $each_c ";
				$sep = " AND ";
			}
			
			$con = new CONNECT();
			$do_fill = true;
			if($this->not_duplicate){
				if($this->__server == "pgsql"){
					$con->prepare("select * from ".strtolower($this->tabDistin)." $where");
				}else{
					$con->prepare("select * from ".DB_DSTN.self::$DBO.".".strtolower($this->tabDistin)." $where");
				}
				$resV = $con->execute();
				
				$dataV = $con->fetch($resV);
				if(!empty($dataV)) $do_fill = false;
			}
			if($do_fill){
				if($this->__server == "pgsql"){
					$req = "insert into ".strtolower($this->tabDistin)." ($attr) values ($val)";
				}else{
					$req = "insert into ".DB_DSTN.self::$DBO.".".strtolower($this->tabDistin)." ($attr) values ($val)";
				}
				$con->prepare($req);
				$res = $con->execute();
			}
			if(!empty($res)) echo "<font color='green'> -- $val inserted<br></font>";
			//else echo "<font color='red'> -- $val not inserted<br></font>";
		}
		echo "end fill $this->tabDistin ------------------------<br>";
		
	}
	
	public function run(){
		if($this->__server == "pgsql"){
			$idInsert = "SET IDENTITY_INSERT ".strtolower($this->tabDistin);
		}else{
		$idInsert = "SET IDENTITY_INSERT ".DB_DSTN.self::$DBO.".strtolower($this->tabDistin)";
		}
		$req = "";
		
		if($this->queryBefore) $req .= $this->queryBefore."\n";
		
		if(!$this->actifAI) $req = $idInsert." ON\n";
		$req .= $this->createQuery()."\n";
		if(!$this->actifAI) $req .= $idInsert." OFF\n";
				
		echo nl2br($req);
		
		$con = new CONNECT();
		$con->prepare($req);
		$res = $con->execute();
		if(!$res) die($con->getError());
		else echo "<font color='green'>Table <u>".DB_SRC.".$this->tabeSource</u> Migr� vers <u>".DB_DSTN.".$this->tabDistin</u> avec <b>succes</b><br></font>";
		
	}
	
	public function notDuplicate(){
		$this->setTruncate(false);
		$this->not_duplicate = true;
	}
	
	private function createQuery(){
		$query = $this->createQuerySelect();
		$list = join(",",array_keys($this->attrInserted));
		
		$req = "insert into ".DB_DSTN.".dbo.strtolower($this->tabDistin) ($list) $query";
		return $req;
	}
	
	private function createQuerySelect(){
		$query = 'select ';
		$attrMigr = $this->getAttrMigr();
		$query .= join(",",$attrMigr);
		$query .= " from ".DB_SRC.".dbo.$this->tabeSource";
		
		if(!empty($this->cond)) $query .= " $this->cond";
		return $query;
	}
	
	public function showDiff(){
		$rapport = $this->compareTable();
		
		echo "<pre> Source : <br>";
		print_r($rapport["TS"]);
		//echo join("','",$rapport["TS"]);
		echo "</pre>";
		
		echo "<pre> Distination : <br>";
		print_r($rapport["TD"]);
		//echo join("','",$rapport["TD"]);
		echo "</pre>";
		
		/*foreach($rapport["TD"] as $c){
			$key = array_keysi($rapport["TS"],str_replace("id_","N_",$c));
			echo "'".$rapport["TS"][$key[0]]."',";
		}*/
		
	}
	
	public function showConfli(){
		$detail = $this->getConfliType();
		print_r($detail);
	}
	
	public function getConfliType(){
		
		$confli = array();
		
		$tableD = new Ctable($this->tabDistin, DB_DSTN);
		$tabD = $tableD->getInfoTable();
		$tableS = new Ctable($this->tabeSource, DB_SRC);
		$tabS = $tableS->getInfoTable();
		
		$attrMigr = $this->getAttrMigr();
		
		$inserted = $this->attrInserted;
		
		while ((list($k,$c) = each($inserted)) && (list($k2,$c2) = each($attrMigr))){
			$ts = $tabS[$c2];
			if($c["type"] != $ts["type"]) {
				array_push($confli,$k);
			}
		}
		
		return $confli;
	}
	
	public function compareTable(){
		
		$rapport = array("TS" => array(), "TD" => array());
		
		$tableD = new Ctable($this->tabDistin, DB_DSTN);
		$tabD = $tableD->getInfoTable();
		$tableS = new Ctable($this->tabeSource, DB_SRC);
		$tabS = $tableS->getInfoTable();
		
		foreach($tabD as $k=>$c){
			if(!array_key_existsi($k,$tabS)) array_push($rapport["TD"],$k);
		}
		
		//asort($rapport["TD"]);
		
		foreach($tabS as $k=>$c){
			if(!array_key_existsi($k,$tabD)) array_push($rapport["TS"],$k);
		}
		
		//asort($rapport["TS"]);
		
		return $rapport;
	}
	
	public function getAttrMigr(){
		$tabMigr = array();
		
		$tableD = new Ctable($this->tabDistin, DB_DSTN);
		$tabD = $tableD->getInfoTable();
		if($this->truncate) $tableD->viderTable();
		$this->attrInserted = $tabD;
		
		$tableS = new Ctable($this->tabeSource, DB_SRC);
		$tabS = $tableS->getInfoTable();
		
		foreach($tabD as $k=>$c){
			$key = array_keysi($this->attrDistin,$k);
			if(!empty($key)){
				if(!empty($this->fk[$k])){
					array_push($tabMigr, "
					(select ".$this->fk[$k][1]." 
					from ".DB_DSTN.self::$DBO.".".$this->fk[$k][0]."
					where ".$this->attrSource[$key[0]]." = ".DB_SRC.self::$DBO.".".strtolower($this->tabDistin).".".$this->attrSource[$key[0]].")
					");
				}else{
					array_push($tabMigr, $this->attrSource[$key[0]]);
				}
			}elseif(array_key_existsi($k,$tabS)){
				array_push($tabMigr, $k);
			}else{
				unset($this->attrInserted[$k]);
			}
		}
		
		return $tabMigr;
	}

}