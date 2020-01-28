<?php
header('Access-Control-Allow-Origin: *');
class Filter{

	public static $__TWF_DB;
	
	private $__table,
			$__attribute,
			$__field,
			$__infoAttribute,
			$__filter,
			$__db,
			$__like,
			$__not_quot,
			$__field_array,
			$__top,
			$__equal,
			$__server;
	

	public $__num_id;
	public static $AUTH_ZERO = false;
	
	public function __construct($table,$alias = "",$db = "",$shema=""){
		$this->__shema =  $shema ? $shema.'.' : '' ;
		$this->__table = strtolower($table);
		$this->__db = $db ? $db : self::$__TWF_DB;
		if($alias === "") $alias = $table;
		$this->__alias = $alias;
		$req = "SELECT COLUMN_NAME,IS_NULLABLE,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$this->__table."'";
		$connection = Doctrine_Manager::getInstance()->getConnection($this->__db);
		$dbh = $connection->getDbh();
		$db = $connection->getOptions();
		$dsn = $db['dsn'];
		$this->__server = $dbh->getAttribute(PDO::ATTR_DRIVER_NAME);
		
		if($this->__server  == "mysql"){
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
			preg_match("/Server\=([^;]+);[ ]*Database=(.+)/",$dsn,$rgexp_dst);
			$this->__db = $rgexp_dst[2];
			$where = " and table_catalog = '$this->__db'";
		}
		
		$res = $dbh->query($req.$where)->fetchAll(PDO::FETCH_GROUP);
		$connection->close();
		$this->__infoAttribute = array_change_key_case($res);
		$this->__attribute = array_map("strtolower",array_keys($res));
		$this->__field = $this->__attribute;
		$data = array_fill(0,count($this->__attribute),'');
		$this->__data = array_combine($this->__attribute,$data);
		$this->__filter = array();
		$this->__like = array();
		$this->__equal = array();
		$this->__not_quot = array();
		$this->__field_array = array();
		$this->__num_id = 1;
	}
	

	private function is_empty(&$val){
		if(self::$AUTH_ZERO){
			return (!isset($val) || $val === false || $val === null);
		}else{
			return empty($val);
		}
	}
	
	public function setup(){
		$this->setParam();
		$this->setBalise();
		return $this->__paramString;
	}
	
	public function setupQuery($req){
		$top = $this->__top;
		if(!$top) return $req;
		if($this->__server == "mysql") $req_ = preg_replace('/^([^a-zA-Z]*select)/i', "select ", $req.' limit '.$top);
		else $req_ = preg_replace('/^([^a-zA-Z]*select)/i', "select TOP $top ", $req);
		return $req_;
	}
	
	public function getNbResult(){
		echo TTSList::getListBox(array(
				"query" => "#:Nb_Result#",
				"form" => $this->setup(),
				"oForm" => $this,
				"key" => "tts_nb_result",
				"value_default" => $this->__top
		));
	}
	
	public function setFieldArray($field){
		array_push($this->__field_array, $field);
	}
	
	public function setLikeFilter($field){
		array_push($this->__like, $field);
	}
	
	public function setEqualFilter($field){
		array_push($this->__equal, $field);
	}
	
	private function setBalise(){
		foreach($this->__attribute as $c){
			$this->__balise[$c] = array("balise" => "input");
		}
	}
	
	private function setParam(){
		foreach($this->__field as $c){
			$name = $this->__table."[$c]";
			if(in_array($c,$this->__field_array)) $name .= "[]";
			$id = $this->__table."_$c";
			$this->__param[$c] = array("name" => $name, "id" => $id);
			if(isset($_REQUEST[$this->__table][$c]) && !is_array($_REQUEST[$this->__table][$c]))  
				$this->__param[$c]["value"] = $_REQUEST[$this->__table][$c];
			
			if(preg_match("/date/",$c)) {
				if(empty($this->__param[$c]["class"])) $this->__param[$c]["class"] = "";
				$this->__param[$c]["class"] .= " input-datepicker ";
			}
		}
		$this->strParam();
	}
	
	public function getName($field){
		return $this->__param[$field]["name"];
	}
	
	public function getTable(){
		return $this->__table;
	}
	
	public function getIsSelected($field,$val){
		if(!empty($_REQUEST)){
			$post = $_REQUEST[$this->__table];
			if(isset($post[$field])){
				if(!is_array($post[$field]))
				return $post[$field] == $val ? " selected " : "";
				else return in_array($val,$post[$field]) ? " selected " : "";
			}
		}
	}
	
	public function setSelected($field,$val){
		echo $this->getIsSelected($field, $val);
	}
	
	public function setChecked($field){
		echo " value='1' ";
		if(!empty($_POST[$this->__table][$field])){
			$post = $_POST[$this->__table];
			if(isset($post[$field])){
				echo $post[$field] ? " checked " : "";
			}
		}else{
			if(isset($this->__data[$field])){
				echo $this->__data[$field] ? " checked " : "";
			}
		}
	}
	
	private function strParam_old(){
		foreach($this->__param as $k=>$c){
			$params = "";
			foreach($c as $k2=>$c2){
				if($c2) $params .= " $k2 = $c2 ";
			}
			$this->__paramString[$k] = $params;
		}
	}
	
	private function strParam(){
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
	
	public function addField($field,$add_quot = true){
		array_push($this->__field,$field);
		if(!$add_quot) array_push($this->__not_quot,$field);
	}
	
	public function getValue($field = null){
		if(!empty($field)){
			if(isset($_REQUEST[$this->__table][$field]))
				return $_REQUEST[$this->__table][$field];
			else return null;
		}else{
			if(isset($_REQUEST[$this->__table])){
				return $_REQUEST[$this->__table];
			}
			else return null;
		}
	}
	
	public function getData($field = null){
		return $this->getValue($field);
	}
	
	public function setValue($field,$val){
		if(!isset($_REQUEST[$this->__table][$field])){ 
			$_REQUEST[$this->__table][$field] = $val;
		}
	}
	
	public function addFilter($filter){
		if(!empty($_POST)){
			$post = $_POST[$this->__table];
			preg_match_all("/:([a-zA-Z_]+)/",$filter,$match);
			$query = "";
			foreach ($match[1] as $c){
				if(!empty($post[$c])){
					if(!is_numeric($post[$c])) {
						if(!is_array($post[$c])){
 							if(strstr($c,'date') && ($this->__server == 'mysql' || $this->__server == 'pgsql'))  $post[$c] = Common::convert_date($post[$c],'Y-m-d');
							if(!in_array($c, $this->__not_quot)){
									$post[$c] = "'$post[$c]'";
							}
						}else{
							if(!in_array($c, $this->__not_quot)){
								$post[$c] = "'".join("','",$post[$c])."'";
							}else{
								$post[$c] = join(",",$post[$c]);
							}
						}
					}
					$filter = str_replace(":$c",$post[$c],$filter);
					$query = $filter;
				}
			}
			if($query) array_push($this->__filter,$query);
		}
	}
	
	public function getFilter(){
		$this->createFilter();
		if($this->__filter){
			return "WHERE ".join(" and ",$this->__filter);
		}
	}
	
	private function isnumeric($attribute){
		if($this->__server  == "pgsql"){
			$type = !empty($this->__infoAttribute[$attribute]) ? $this->__infoAttribute[$attribute][0]['data_type'] : '';
		}else{
		$type = !empty($this->__infoAttribute[$attribute]) ? $this->__infoAttribute[$attribute][0]['DATA_TYPE'] : '';
		}
		return $type == 'decimal' || $type == 'int' || $type == 'integer';
	}
	
	private function getType($attribute){
		if($this->__server  == "pgsql"){
			$type = !empty($this->__infoAttribute[$attribute]) ? $this->__infoAttribute[$attribute][0]['data_type'] : '';
		}else{
		$type = !empty($this->__infoAttribute[$attribute]) ? $this->__infoAttribute[$attribute][0]['DATA_TYPE'] : '';
		}
		return $type;
	}
	
	public function andWhere($cond){
		array_push($this->__filter,$cond);
	}
	
	private function createFilter(){
		$this->addField('tts_nb_result');
		$this->setValue('tts_nb_result', '10');
		$this->__top = $this->getData('tts_nb_result');
		if(!empty($_POST)){
			$post = $_POST[$this->__table];
			foreach($post as $k=>$c){
			    if($this->isnumeric($k) || $this->getType($k) == "bit"){
					$op = "=";
				}else{
					$op = "like";
				}
				if(in_array($k,$this->__attribute) && $c !== null && $c !== ''){
					//if(!is_numeric($c)) $c = "'$c'";
					if(!$this->isnumeric($k)) {
					    $c = str_replace("'",$this->__server == "mysql" ? "\\'" : "''",str_replace("\\",$this->__server == "mysql" ? "\\\\" : "\\",$c));
					    if(in_array($k,$this->__like)) {
							$op = "like";
						}
						if(in_array($k,$this->__equal)) {
							$op = "=";
						}
						if($op == "like"){
						    $c = strtolower($c);
							$c = "'%$c%'";
							
						}
						else{
						 	if(!in_array($k, $this->__not_quot)) $c = "'$c'";
						}
					}
					else{
					    $c = floatval($c);
					}

					if($this->__alias !== false){
					   $query = "$this->__alias".".$k $op $c";
					}
					else $query = "$k $op $c";
					
					array_push($this->__filter,$query);
				}
			}
		}
	}
	
	
}