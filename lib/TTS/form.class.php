<?php
header('Access-Control-Allow-Origin: *');
class Form{
	
	private $__table,
			$__attribute,
			$__infoAttribute,
			$__find,
			$__data,
			$__field,
			$__balise,
			$__param,
			$__paramString,
			$__dataInserted,
			$__dataUpdated,
			$__query,
			$__isArray,
			$__primary,
			$__globalField,
			$__enable_required,
			$__validate,
			$__id_auto_update,
			$__con,
			$__FKey,
			$__operation,
			$__operationTable,
			$__ajax,
			$__field_not_updated,
			$__contraint,
			$__query_validation,
			$__isIdIterate,
			$__server;
	private $__test;
	
	public $__num_id;
	public static $AUTH_ZERO = false;
	public static $UTF8 = true;
	public static $__TWF_DB;
	
	public function __construct($table,$primary = "id",$con = "",$shema = ""){
		$this->__shema =  $shema ? $shema.'.' : '' ;
		$this->__table = $table;
		$this->__primary = $primary;
		$this->__con = $con ? $con : self::$__TWF_DB ;
		$this->__dataInserted = array();
		$req = "SELECT COLUMN_NAME,IS_NULLABLE,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$this->__table."'";
		$connection = Doctrine_Manager::getInstance()->getConnection($this->__con);
		$dbh = $connection->getDbh();
		$db = $connection->getOptions();
		$dsn = $db['dsn'];
		
		$this->__server = $dbh->getAttribute(PDO::ATTR_DRIVER_NAME);
		
		if($this->__server  == "mysql"){
			$this->FormatDate = "Y-m-d";
			preg_match("/host\=([^;]+);[ ]*dbname=(.+)/",$dsn,$rgexp_dst);
			$this->__db = $rgexp_dst[2];
			$where = " and table_schema = '$this->__db'";
		}elseif($this->__server  == "pgsql"){
			$this->FormatDate = "Y-m-d";
			preg_match("/host\=([^;]+);[ ]*dbname=(.+)/",$dsn,$rgexp_dst);
			$this->__db = $rgexp_dst[2];
			$where = " and TABLE_Catalog = '$this->__db'";
		}
		else{
			$this->FormatDate = "d/m/Y";
			preg_match("/Server\=([^;]+);[ ]*Database=(.+)/",$dsn,$rgexp_dst);
			$this->__db = $rgexp_dst[2];
			$where = " and table_catalog = '$this->__db'";
		}
		
		
		$res = $dbh->query($req.$where)->fetchAll(PDO::FETCH_GROUP);
		$connection->close();
		$this->__infoAttribute = array_change_key_case($res);
		$this->__attribute = array_map("strtolower",array_keys($res));
		$data = array_fill(0,count($this->__attribute),'');
		$this->__data = array_combine($this->__attribute,$data);
		$this->__isArray = false;
		$this->__globalField = array();
		$this->__enable_required = true;
		$this->__validate = array();
		$this->__FKey = "";
		$this->__operation = array();
		$this->__query_validation = array();
		$this->__contraint = array();
		$this->__operationTable = array();
		$this->__ajax = false;
		$this->__field_not_updated = array();
		$this->__isIdIterate = false;
		$this->__num_id = 1;
	}
	
	private function is_empty(&$val){
		if(self::$AUTH_ZERO){
			return (!isset($val) || $val === false || $val === null);
		}else{
			return empty($val);
		}
	}
	
	public function isAjax(){
		$this->__ajax = true;
	}
	
	public function getAttribute(){
		return $this->__infoAttribute;
	}
	
	public function isRequired($bool){
		$this->__enable_required = $bool;
	}
	
	public function utf8_encode($text){
		if(self::$UTF8) return utf8_encode($text);
		else return $text;
	}
	
	public function utf8_decode($text){
		if($this->__ajax  && $this->__server != 'mysql') return utf8_decode($text);
		else return $text;
	}
	
	public function setAutoUpdate($id){
		$this->__id_auto_update = $id;
	}
	
	public function find($attr,$val_attr){
		if(!$this->isnumeric($attr)) $val_attr = "'$val_attr'";
		$this->__find = "$attr = $val_attr";
		$this->setData();
		return $this;
	}
	
	public function setFieldNotUpdated($attr){
		array_push($this->__field_not_updated,$attr);
	}
	
	public function findBy($attr,$val_attr){
		$find = array();
		foreach($attr as $k=>$c){
			$this->setFixedValue($c, $val_attr[$k]);
			if(!$this->isnumeric($c)) $val = "'$val_attr[$k]'";
			else $val = "$val_attr[$k]";
			array_push($find,"$c = $val");
		}
		$this->__find = join(" AND ",$find);
		$this->setData(false);
	}
	
	public function addGlobalField($field,$value){
		$this->__globalField[$field] = $value;
	}
	
	public function isArray(){
		$this->__isArray = true;
	}
	
	public function isIdIterate(){
		$this->__isIdIterate = true;
	}
	
	public function setup(){
		$this->setParam();
		$this->setBalise();
		return $this->__paramString;
	}
	
	private function createData(){
		
		$req = "SELECT * FROM ".$this->__shema.$this->__table;
		$req .= " WHERE $this->__find";
		$connection = Doctrine_Manager::getInstance()->getConnection($this->__con);
		$dbh = $connection->getDbh();
		$res = $dbh->query($req)->fetch(PDO::FETCH_ASSOC);
		$connection->close();
		return is_array($res) ? array_change_key_case($res) : array();
	}
	
	private function setData($bloq = true){
		if( !empty($this->__find) ){
			$data = $this->createData();
			if($bloq){
				if(!count($data) && empty($this->__id_auto_update)) die("L'&eacute;l&eacute;ment n'existe pas dans la table \"$this->__table\"");
				if(count($data)) $this->__data = $data;
			}else{
				if(count($data)) $this->__data = $data;
				else $this->__find = "";
			}
		}
	}
	
	public function getData($field = null){
		if($field){
			if(isset($_REQUEST[$this->__table][$field])) $c = $_REQUEST[$this->__table][$field];
			else $c = $this->__data[$field];
			if($this->__server  == "pgsql"){
				$type = !empty($this->__infoAttribute[$field]) ? $this->__infoAttribute[$field][0]['data_type'] : "";
				
			}else{
				$type = !empty($this->__infoAttribute[$field]) ? $this->__infoAttribute[$field][0]['DATA_TYPE'] : "";
			}
			if($type == 'datetime' || $type == 'smalldatetime'|| $type == 'date') {
				$c = Common::convert_date($c,'d/m/Y');
			}
			return $c;
		}else{
			return $this->__data;
		}
	}
	
	public function getTable(){
		return $this->__table;
	}
	
	public function setValue($field,$val){
		if($this->is_empty($_REQUEST[$this->__table][$field]) && empty($this->__data[$field]))
		$_REQUEST[$this->__table][$field] = $val;
	}
	
	public function setFixedValue($field,$val){
		if(!in_array($field,$this->__attribute)) die("Le champs \"$field\" n'existe pas dans la table \"$this->__table\"");
		$_REQUEST[$this->__table][$field] = $val;
		$this->__data[$field] = $val;
	}
	
	public function setOption($field,$option){
		foreach($option as $k=>$c){
			$this->__param[$field][$k] = $c;
		}
	}
	
	public function getIsSelected($field,$val){
		if(!$this->is_empty($_REQUEST[$this->__table][$field])){
			$post = $_REQUEST[$this->__table];
			if(isset($post[$field])){
				if(!is_array($post[$field]))
					return $post[$field] == $val ? " selected " : "";
				else return in_array($val,$post[$field]) ? " selected " : "";
			}
		}else{
			if(isset($this->__data[$field])){
				if(!is_array($this->__data[$field]))
					return $this->__data[$field] == $val ? " selected " : "";
				else return in_array($val,$this->__data[$field]) ? " selected " : "";
			}
		}
	}
	
	public function setSelected($field,$val){
		echo $this->getIsSelected($field, $val);
	}
	
	public function setChecked($field,$value = null){
		if($value == null) echo " value='1' ";
		else echo " value='$value' ";
		
		if(!$this->is_empty($_REQUEST[$this->__table][$field])){
			$post = $_REQUEST[$this->__table];
			if(isset($post[$field])){
				if($value == null) echo $post[$field] ? " checked = 'checked' " : "";
				else echo $post[$field] == $value ? " checked = 'checked' " : "";
			}
		}else{
			if(isset($this->__data[$field])){
				if($value == null) echo $this->__data[$field] ? " checked = 'checked' " : "";
				else echo $this->__data[$field] == $value ? " checked = 'checked' " : "";
			}
		}
	}
	
	public function setContent($field){
		if(!$this->is_empty($_REQUEST[$this->__table])){
			$post = $_REQUEST[$this->__table];
			if(isset($post[$field])){
				echo $post[$field];
			}
		}else{
			if(isset($this->__data[$field])){
				echo $this->__data[$field];
			}
		}
	}
	
	public function setClassValidation($field,$option){
		foreach($option as $k=>$c){
			$this->__validate[$field][$k] = $c;
		}
	}
	
	private function setBalise(){
		foreach($this->__attribute as $c){
			$this->__balise[$c] = array("balise" => "input");
		}
	}
	
	private function setValidation($c){
		$data = $this->__data[$c];
		if($this->__server  == "pgsql"){
			$type = $this->__infoAttribute[$c][0]['data_type'];
			$max = $this->__infoAttribute[$c][0]['character_maximum_length'];
		}else{
			$type = $this->__infoAttribute[$c][0]['DATA_TYPE'];
			$max = $this->__infoAttribute[$c][0]['CHARACTER_MAXIMUM_LENGTH'];
		}

		if($type == 'datetime' || $type == 'smalldatetime'|| $type == 'date') {
			$this->__validate[$c]["custom[date]"] = true;
		}elseif($type == 'decimal'){
			$this->__validate[$c]["custom[number]"] = true;
		}elseif($type == 'int'){
			$this->__validate[$c]["custom[number]"] = true;
		}
		
		if($max){
			$this->__validate[$c]["maxSize[$max]"] = true;
		}
		
		
		
		
		if($this->__enable_required){
			if($this->__server  == "pgsql"){
				$is_null = $this->__infoAttribute[$c][0]['is_nullable'];
			}else{
				$is_null = $this->__infoAttribute[$c][0]['IS_NULLABLE'];
			}
			
			if($is_null == "NO") {
				if(!isset($this->__validate[$c]["required"])){
					//$this->__validate[$c]["required"] = true;
				}
				if(!isset($this->__param[$c]["required"])){
					$this->__param[$c]["required"] = true;

					if(empty($this->__param[$c]["class"])) $this->__param[$c]["class"] = "";
					$this->__param[$c]["class"] .= " required_form ";
				}
			}
		}
	}
	
	private function setParam(){
		foreach($this->__attribute as $c){
			
			$data = $this->__data[$c];
			if($this->__server  == "pgsql"){
				$type = $this->__infoAttribute[$c][0]['data_type'];
				$max = $this->__infoAttribute[$c][0]['character_maximum_length'];
			}else{
				$type = $this->__infoAttribute[$c][0]['DATA_TYPE'];
			$max = $this->__infoAttribute[$c][0]['CHARACTER_MAXIMUM_LENGTH'];
			}
			
			if( in_array($c, $this->__field_not_updated)){
				$this->__param[$c]["disabled"] = "disabled";
			}
			if($max){
				$this->__param[$c]["maxlength"] = $max;
			}
			
			$name = $this->__table."[$c]";
			if($this->__isIdIterate){
				$id = $this->__table."_$c"."_____::id::";
			}else{
				$id = $this->__table."_$c";
			}
			if($this->__isArray){
				$name .= "[]";
			}
			$this->__param[$c]["name"] = $name;
			$this->__param[$c]["id"] = $id;
			if(isset($_REQUEST[$this->__table][$c]))  {
				if(!$this->__isArray) $this->__param[$c]["value"] = $_REQUEST[$this->__table][$c];
			}
			else {
				
				if($type == 'datetime' || $type == 'smalldatetime'|| $type == 'date') {
					$data = Common::convert_date($data,'d/m/Y');
					if(empty($this->__param[$c]["class"])) $this->__param[$c]["class"] = "";
					$this->__param[$c]["class"] .= " input-datepicker ";
				}
				
				if(!$this->is_empty($data)) {
					if(!$this->__isArray) $this->__param[$c]["value"] = $data;
				}

				if($type == "bit") {
					if($data) $this->__param[$c]["checked"] = "checked";
				}
				
			}
			
			
			$this->setValidation($c);
			
		}
		$this->strParam();
	}
	
	private function strValidation(){
		foreach($this->__validate as $k=>$c){
			$params = "validate[";
			$sep = "";
			foreach($c as $k2=>$c2){
				if($c2) $params .= $sep."$k2";
				$sep = ",";
			}
			$params .= "]";
			if(empty($this->__param[$k]["class"])) $this->__param[$k]["class"] = "";
			$this->__param[$k]["class"] .= $params;
		}
	}
	
	private function strParam(){
		$this->strValidation();
		foreach($this->__param as $k=>$c){
			$params = "";
			foreach($c as $k2=>$c2){
				if(!$this->is_empty($c2)) {
					$c2 = preg_replace("/\"/","&quot;",$c2);
					$params .= " $k2 = \"$c2\" ";
				}
			}
			$obj_params = new TTSFormField($params);
			$obj_params->setForm($this);
			$this->__paramString[$k] = $obj_params;
		}
	}
	
	private function getDataToInsert(){
		$post = $_REQUEST[$this->__table];
		foreach($post as $k=>$c){
			if(in_array($k,$this->__attribute) && $c !== null && $c !== ''){
				//if(!is_numeric($c)) $c = "'$c'";
				if($this->__server  == "pgsql"){
					$type = $this->__infoAttribute[$k][0]['data_type'];
				}else{
					$type = $this->__infoAttribute[$k][0]['DATA_TYPE'];
				}
				if($type == "date") $c = "'".Common::convert_date($c, $this->FormatDate)."'";
				elseif(!$this->isnumeric($k)) 
				$c = "'".$this->utf8_decode($this->utf8_encode(str_replace("'",$this->__server == "mysql" ? "\\'" : "''",str_replace("\\",$this->__server == "mysql" ? "\\\\" : "\\",$c))))."'";
				if($this->isnumeric($k)) {
				    $c = floatval($c);
				}
				$this->__dataInserted[$k] = $c;
			}
		}
		foreach($this->__globalField as $k=>$c){
			if(in_array($k,$this->__attribute) && !$this->is_empty($c)){
				//if(!is_numeric($c)) $c = "'$c'";
				if(!$this->isnumeric($k)) $c = "'$c'";
				$this->__dataInserted[$k] = $c;
			}
		}
	}
	
	private function isnumeric($attribute){
		if($this->__server  == "pgsql"){
			$type = $this->__infoAttribute[$attribute][0]['data_type'];
		}else{
			$type = $this->__infoAttribute[$attribute][0]['DATA_TYPE'];
		}
		
		return $type == 'decimal';
	}
	
	private function getDataToInsertArray($request = null){
		$request = $request ? $request : $_REQUEST;
		$post = $request[$this->__table];
		foreach($post as $k=>$c){
			if($k == $this->__primary) continue;
			if(in_array($k,$this->__attribute)){
				if(is_array($c)){
					foreach($c as $k2=>$c2){
						if($this->__server  == "pgsql"){
							$type = $this->__infoAttribute[$k][0]['data_type'];
						}else{
						$type = $this->__infoAttribute[$k][0]['DATA_TYPE'];
						}
						if(empty($c2) && ($type == "smalldatetime" || $type == "datetime" || $type == "date")) $c2 = 'NULL';
						elseif(($type == "smalldatetime" || $type == "datetime"  || $type == "date") && !$this->is_empty($c2))
							$c2 = "'".Common::convert_date($c2, $this->FormatDate)."'";
						elseif(!$this->isnumeric($k)) $c2 = "'".$this->utf8_encode(str_replace("'",$this->__server == "mysql" ? "\\'" : "''",str_replace("\\",$this->__server == "mysql" ? "\\\\" : "\\",$c2)))."'";
						else{
							if(!$c2) $c2 = 0;
						}

						if($this->isnumeric($k)){
						    $c2 = floatval($c2);
						}
						$this->__dataInserted[$k2][$k] = $c2;
						
						foreach($this->__globalField as $kg=>$cg){
							if(in_array($kg,$this->__attribute) && !$this->is_empty($cg)){
								if(!$this->isnumeric($kg)) $cg = "'$cg'";
								$this->__dataInserted[$k2][$kg] = $cg;
							}
						}
						
					}
				}
			}
		}
	}
	
	private function getDataToUpdate(){
		$post = $_REQUEST[$this->__table];
		foreach($post as $k=>$c){
			if($this->__server  == "pgsql"){
				$type = $this->__infoAttribute[$k][0]['data_type'];
			}else{
				$type = $this->__infoAttribute[$k][0]['DATA_TYPE'];
			}
			if(in_array($k,$this->__attribute)){
			    if($c === "") $c = "NULL";
				elseif($type == "date") $c = "'".Common::convert_date($c, $this->FormatDate)."'";
				elseif(!$this->isnumeric($k)) $c = "'".$this->utf8_decode($this->utf8_encode(str_replace("'",$this->__server == "mysql" ? "\\'" : "''",str_replace("\\",$this->__server == "mysql" ? "\\\\" : "\\",$c))))."'";
				if($this->isnumeric($k)) $c = floatval($c);
				$this->__dataUpdated[] = "$k = $c";
			}
		}
	}
	
	private function getDataToUpdateArray($request = null){
		$request = $request ? $request : $_REQUEST;
		$post = $request[$this->__table];
		
		foreach($post[$this->__primary] as $key=>$row){
			$this->__dataUpdated[$key] = array();
			foreach($post as $attr=>$data){
				if($attr == $this->__primary) continue;
				if(in_array($attr,$this->__attribute) && !$this->is_empty($data[$key])){
					$data[$key] = str_replace("'",$this->__server == "mysql" ? "\\'" : "''",$data[$key]);
					if($data[$key] === '') $data[$key] = "NULL";
					elseif(!$this->isnumeric($attr)) $data[$key] = "'$data[$key]'";
					$this->__dataUpdated[$key][] = "$attr = $data[$key]";
				}
			}
		}
	}
	
	private function getQueryAutoUpdate(){
		$req = "SELECT * FROM ".$this->__shema.$this->__table;
		$req .= " WHERE $this->__find";
		$connection = Doctrine_Manager::getInstance()->getConnection($this->__con);
		$dbh = $connection->getDbh();
		$res = $dbh->query($req)->fetchAll();
		$connection->close();
	}
	
	private function createQuery(){
		$query = "";
		if(empty($this->__find)){
			if($this->__isArray) $this->getDataToInsertArray();
			else $this->getDataToInsert();
			if(!empty($this->__dataInserted)){
				if($this->__isArray){
					foreach($this->__dataInserted as $eachData){
						$query .= "INSERT INTO $this->__shema$this->__table (".join(",",array_keys($eachData)).") 
									VALUES ( ".join(",",$eachData)." ) ;";
					}
				}else{
					$query = "INSERT INTO $this->__shema$this->__table (".join(",",array_keys($this->__dataInserted)).")
								VALUES ( ".join(",",$this->__dataInserted)." )";
				}
				$this->__query = $query;
			}
		}else{
			if(!empty($this->__id_auto_update)) $this->getQueryAutoUpdate();
			else $this->getDataToUpdate();
			if(!empty($this->__dataUpdated)){
				$query = "UPDATE $this->__shema$this->__table SET ".join(",",$this->__dataUpdated)." WHERE $this->__find  ;";
				$this->__query = $query;
			}
		}
	}
	
	private function createQueryFK(){
		
		$query = "";
		
		$connection = Doctrine_Manager::getInstance()->getConnection($this->__con);
		$dbh = $connection->getDbh();
		$lastData = $dbh->query("SELECT $this->__primary FROM $this->__shema$this->__table where $this->__FKey")->fetchAll(PDO::FETCH_COLUMN);
		
		$request_insert = $_REQUEST;
		$request_update = $_REQUEST;
		$row_delete = array();
		
		foreach($request_insert[$this->__table][$this->__primary] as $k=>$c){
			if(in_array($c,$lastData)){
				foreach($request_insert[$this->__table] as $key=>$row){
					if(isset($request_insert[$this->__table][$key][$k])) {
						if(empty($this->__infoAttribute[$key])) continue;
						else unset($request_insert[$this->__table][$key][$k]);
					}
				}
			}
			
		}
		
		foreach($request_update[$this->__table][$this->__primary] as $k=>$c){
			if(!in_array($c,$lastData)){
				foreach($request_update[$this->__table] as $key=>$row){
					if(empty($this->__infoAttribute[$key])) continue;
					else unset($request_update[$this->__table][$key][$k]);
				}
			}
		}
		
		//var_dump($request_update[$this->__table]);
		
		foreach($lastData as $c){
			if(!in_array($c,$_REQUEST[$this->__table][$this->__primary])) array_push($row_delete,$c);
		}
		
		$this->getDataToInsertArray($request_insert);
		if(!empty($this->__dataInserted)){
			foreach($this->__dataInserted as $eachData){
				$query .= "INSERT INTO $this->__shema$this->__table (".join(",",array_keys($eachData)).")
				VALUES ( ".join(",",$eachData)." ) ;";
			}
		}
		
		$this->getDataToUpdateArray($request_update);
		if(!empty($this->__dataUpdated)){
			foreach($this->__dataUpdated as $k=>$row){
				$query .= "UPDATE $this->__shema$this->__table SET ".join(",",$row)." WHERE $this->__FKey and $this->__primary = ".$_REQUEST[$this->__table][$this->__primary][$k]." ;";
			}
		}
		
		if(count($row_delete)){
			$query .= "DELETE FROM $this->__shema$this->__table WHERE $this->__FKey and $this->__primary in (".join(",",$row_delete).") ";
		}
		
		$this->__query = $query;
	}
	
	public function getQuery(){
		return $this->__query;
	}
	
	private function executeQuery(){
		$connection = Doctrine_Manager::getInstance()->getConnection($this->__con);
		$dbh = $connection->getDbh();
		if($this->__query)  $res = $dbh->query($this->__query);
		$connection->close();
		return $res;
	}
	
	private function lastInserted(){
		$connection = Doctrine_Manager::getInstance()->getConnection($this->__con);
		$dbh = $connection->getDbh();
		
		
		$array_cond_session = array("1=1");
		
		if(!empty($this->__dataInserted) && empty($this->__find) && !$this->__isArray){
			foreach($this->__dataInserted as $ks=>$cs){
				if(in_array($ks,$this->__attribute) && !$this->is_empty($cs)){
					$array_cond_session[] = "$ks = $cs";
				}
			}
		}
		
		if(empty($this->__find)) $cond = "$this->__primary = (
		SELECT MAX($this->__primary)
		FROM $this->__shema$this->__table
		Where ".join(" AND ",$array_cond_session)."
		)";
		else $cond = $this->__find;
		$res = $dbh->query("SELECT * FROM $this->__shema$this->__table WHERE $cond")->fetch();
		$connection->close();
		return $res;
	}
	
	public function setFKey($attr,$val_attr){
		$fk = array();
		foreach($attr as $k=>$c){
			$val = "$val_attr[$k]";
			array_push($fk,"$c = $val");
		}
		$this->__FKey = join(" AND ",$fk);
	}
	
	public function setOperation($attr,$op,$table = null){
		$this->__operation[$attr] = $op;
		$this->__operationTable[$attr] = $table;
	}
	
	public function setContraint($op){
		array_push($this->__contraint,$op);
	}
	
	public function execJqueryOperation(){
		$operation = $this->__operation;
		$js = "\$(document).ready(function(){\n";
		foreach($operation as $attr => $op){
			$objTable = $this->__operationTable[$attr];
			$table = $objTable ? $objTable->getTable() : null;
			$events = array();
			if($this->__isArray){
						
					preg_match_all("/\#:(.*)\#/sU",$op,$p_op);
					preg_match_all("/\[\:(.*)\:\]/sU",$op,$pp_op);
	
					foreach($p_op[1] as $each){
						if($this->__isIdIterate){
							$id = "[id^=$this->__table"."_$each"."_____"."]";
						}else{
							$id = "[id=$this->__table"."_$each]";
						}
						$op = str_replace("#:$each#", "(parseFloat(!\$('$id')[index].value ? 0 : \$('$id')[index].value))", $op);
						array_push($events,"$id");
					}
					
					if(!empty($table)){
						foreach($pp_op[1] as $each){
							if($objTable->__isIdIterate){
								$id = "[id^=$table"."_$each"."_____"."]";
							}else{
								$id = "[id=$table"."_$each]";
							}
							$op = str_replace("[:$each:]", "(parseFloat(!\$('$id')[0].value ? 0 : \$('$id')[0].value))", $op);
							array_push($events,"$id");
						}
					}
	
			}else{
	
				if(!empty($table)){
					if($this->__isIdIterate){
						$id = "[id^=$this->__table"."_$attr"."_____"."]";
					}else{
						$id = "[id=$this->__table"."_$attr]";
					}
					$op = str_replace("#:$attr#", "parseFloat(!\$('$id').val() ? 0 : \$('$id').val())", $op);
				}
				
				preg_match_all("/\#:(.*)\#/sU",$op,$p_op);
				preg_match_all("/\[\:(.*)\:\]/sU",$op,$pp_op);
				
				foreach($p_op[1] as $each){
					if($this->__isIdIterate){
						$id = "[id^=$this->__table"."_$each"."_____"."]";
					}else{
						$id = "[id=$this->__table"."_$each]";
					}
					$op = str_replace("#:$each#", "(parseFloat(!\$('$id').val() ? 0  : \$('$id').val() ))", $op);
					array_push($events,"$id");
				}
				
				if(!empty($table)){
					
					foreach($pp_op[1] as $each){
						if($objTable->__isIdIterate){
							$id = "[id^=$table"."_$each"."_____"."]";
						}else{
							$id = "[id=$table"."_$each]";
						}
						$op = str_replace("[:$each:]", "(parseFloat(!\$('$id')[index].value ? 0 : \$('$id')[index].value))", $op);
						array_push($events,"$id");
					}
				}
	
			}

			if(empty($table)){
				if($this->__isIdIterate){
					$id = "[id^=$this->__table"."_$attr"."_____"."]";
				}else{
					$id = "[id=$this->__table"."_$attr]";
				}
				$q_op = "var op = $op; 
						if(!op) op = 0; 
						if(\$('$id')[index])
						\$('$id')[index].value = op.toFixed(2);
				";
			}else{
				if($this->__isIdIterate){
					$id_p = "[id^=$this->__table"."_$attr"."_____"."]";
				}else{
					$id_p = "[id=$this->__table"."_$attr]";
				}
				if($objTable && $objTable->__isIdIterate){
					$id = "[id^=$table"."_".$pp_op[1][0]."_____"."]";
				}else{
					$id = "[id=$table"."_".$pp_op[1][0]."]";
				}
				if(!$this->__isArray){
					$q_op = "\$('$id_p').val(0);
							 $('$id').each(function(index){
							 	var op = $op;
							 	if(!op) op = 0;
							 	if(\$('$id_p'))
								\$('$id_p').val(op.toFixed(2));
							 });\n";
				}else{
					$q_op = "var op = $op;
							if(!op) op = 0;
							if(\$('$id_p')[index])
							\$('$id_p')[index].value = op.toFixed(2);
					";
				}
			}
			
				
			foreach($events as $eachEv){
				$js .= "\$('".$eachEv."').live('change',function(){
				var obj = $(this);
				var index = $('".$eachEv."').index(obj);
				$q_op
				});
				
				$('".$eachEv."').livequery(function() {
					$(this).watchProperty('value', function() {
				    	$(this).change();
					});
				});
				
				\n\n";
			}
			
		}
		$js .= "});";
		
		return $js."\n\n";
	}
	
	public function executeOperation(){
		$operation = $this->__operation;
		foreach($operation as $attr => $op){
			if(empty($this->__infoAttribute[$attr])) continue;
			$objTable = $this->__operationTable[$attr] ? $this->__operationTable[$attr] : $this;
			$table = $objTable ? $objTable->getTable() : null;
			if($this->__server  == "pgsql"){
				$type = $this->__infoAttribute[$attr][0]['data_type'];
			}else{
				$type = $this->__infoAttribute[$attr][0]['DATA_TYPE'];
			}
			if($type == 'decimal'){
				$cast = true;
			}else $cast = false;
			if(is_array($_REQUEST[$this->__table][$attr])){
				
				foreach($_REQUEST[$this->__table][$attr] as $k=>$c){
					$temp_op = $op;
					
					preg_match_all("/\#:(.*)\#/sU",$temp_op,$p_op);

					foreach($p_op[1] as $each){
						if(!$cast)
							$temp_op = str_replace("#:$each#", $_REQUEST[$this->__table][$each][$k], $temp_op);
						else
							$temp_op = str_replace("#:$each#", floatval($_REQUEST[$this->__table][$each][$k]), $temp_op);
					}
					
					
					$q_op = "\$res = $temp_op;";
					
					eval($q_op);
					
					$_REQUEST[$this->__table][$attr][$k] = $res;
					$_POST[$this->__table][$attr][$k] = $res;
					
				}
				
			}else{
				
				$op = str_replace("#:$attr#", "\$res", $op);
				
				preg_match_all("/\#:(.*)\#/sU",$op,$p_op);
				preg_match_all("/\[\:(.*)\:\]/sU",$op,$pp_op);
				
				
				foreach($p_op[1] as $each){
					if(!$cast)
						$op = str_replace("#:$each#", floatval($_REQUEST[$this->__table][$each]), $op);
					else
						$op = str_replace("#:$each#", floatval($_REQUEST[$this->__table][$each]), $op);
				}
				
				if(empty($this->__operationTable[$attr])){
					eval("\$res = $op;");
				}else{
					eval("\$res = 0;");
					if(!empty($_REQUEST[$table]) && is_array($_REQUEST[$table][$pp_op[1][0]])){
						foreach($_REQUEST[$table][$pp_op[1][0]] as $k=>$c){
							$temp_op = $op;
							foreach($pp_op[1] as $each){
								$val = !empty($_REQUEST[$table]) ? $_REQUEST[$table][$each][$k] : 0;
								if(!$cast)
									$temp_op = str_replace("[:$each:]", $val, $temp_op);
								else
									$temp_op = str_replace("[:$each:]", floatval($val), $temp_op);
							}
							eval("\$res = $temp_op;");
						}
					}else{
						$temp_op = $op;
						foreach($pp_op[1] as $each){
							$val = !empty($_REQUEST[$table]) ? $_REQUEST[$table][$each] : 0;
							if(!$cast)
								$temp_op = str_replace("[:$each:]", $val, $temp_op);
							else
								$temp_op = str_replace("[:$each:]", floatval($val), $temp_op);
						}
						eval("\$res = $temp_op;");
					}
				}
				if($cast) $res = number_format($res,'2','.','');
				$_REQUEST[$this->__table][$attr] = $res;
				$_POST[$this->__table][$attr] = $res;
				
			}
		}
	}
	
	private function deleteFieldNotUpdate(){
		foreach($this->__field_not_updated as $each){
			unset($_REQUEST[$this->__table][$each]);
		}
	}
	
	public function setQueryValidation($validation){
		$this->__query_validation = $validation;
	}
	
	public function executeJqueryValidation(){
	
		sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
	
		$js = "
		
		var valide = false;
		$(document).ready(function(){
		$('form').submit(function(){
		var form = $(this);
		var reg = new RegExp('\#\:([A-Za-z_]+)\#','g');
		var reg_sl = new RegExp('\\\\','g');
		var attr = $('#$this->__table"."_".$this->__query_validation["attr"]."');
		var query = '".addslashes($this->__query_validation["query"])."';
		query = query.replace(reg,function(match){
			match = match.replace('#:','');
			match = match.replace('#','');
			var attr = $('#$this->__table"."_"."'+match);
			val_ = attr.val();
			val_ = val_".($this->__server != "mysql" ? "" : ".replace(reg_sl,\"\\\\\\\\\")").";
			val_ = val_".($this->__server != "mysql" ? ".replace(\"'\",\"''\")" : ".replace(\"'\",\"\\\'\")").";
			return val_;
		});
		var msg = '".addslashes($this->__query_validation["msg"])."';
		";
	
				$js .= "
				if(!valide){
				$.ajax({
				url: '".url_for("getResQuery")."',
				data: {q: query},
				type: 'post',
				success: function(data){
				if(data != '[]'){
				alert(msg);
				unloadPage();
			}else{
			valide = true;
			form.submit();
			}
			}
			});
			}
			";
			
				$js .= "if(!valide) return false; }); });";
			
				return $js;
	}
	
	
	private function executeContraint(){
		if(empty($this->__contraint)) return;
		global $request,$k;
		$request = $_REQUEST[$this->__table];
		$request_ = $request;
		$elem = array_shift($request_);
		
		foreach($elem as $k=>$c){
			$bool = true;
			foreach($this->__contraint as $each){
				// decode script ---------------------------------------
				$cnt = preg_replace_callback(
						"/\#\:(.+)\#/sU",
						create_function(
								'$matches',
								'global $request,$k;
								 $res = !empty($request[$matches[1]][$k])?$request[$matches[1]][$k]:0; return $res;'
						),
						$each
				);
				//------------------------------------------------------
				$bool = $bool && eval('return '.$cnt.';');
			}
			
			if(!$bool){
				foreach($request as $attr=>$c){
					unset($_REQUEST[$this->__table][$attr][$k]);
				}
			}
		}
	}
	
	
	
	public function save($force = false){
		
		if(!empty($_POST) || $force){
			
			$this->deleteFieldNotUpdate();
			
			$this->executeContraint();
			
			$this->executeOperation();
			
			if(!empty($this->__FKey)){
				$this->createQueryFK();
				//var_dump($this->__query);die;
			}else{
				$this->createQuery();
			}
			
			if($this->executeQuery()){
				$result = $this->lastInserted();
			}
			return $result;
		}
		return false;
	}
	
	
}