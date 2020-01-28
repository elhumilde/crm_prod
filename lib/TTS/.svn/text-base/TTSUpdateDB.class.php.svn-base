<?php
header('Access-Control-Allow-Origin: *');
class TDB{
	
	private $__user,
			$__pass,
			$__dsn,
			$__db,
			$__url_schema;
	
	public function __construct($dsn,$user,$pass){

		$this->__dsn = $dsn;
		$this->__user = $user;
		$this->__pass = $pass;
		if(strstr($dsn, "SQL Server")){
			preg_match("/Server\=([^;]+);[ ]*Database=(.+)/",$dsn,$rgexp_dst);
		}
		elseif(strstr($dsn, "mysql")){
			preg_match("/host\=([^;]+);[ ]*dbname=(.+)/",$dsn,$rgexp_dst);
		}
		elseif(strstr($dsn, "pgsql")){
			preg_match("/host\=([^;]+);[ ]*dbname=(.+)/",$dsn,$rgexp_dst);
		}
		$this->__db = $rgexp_dst[2];
	}
	
	public function setSchema($sch){
		$this->__url_schema = $sch;
	}
	
	public function execute($schema = ''){
		if($schema) $schema = $schema;
		else $schema = '';
		$data = sfYaml::load($this->__url_schema);
		$query = "";
		$dbh = new PDO($this->__dsn, $this->__user, $this->__pass);
		
		
		if(strstr($this->__dsn, "SQL Server")){
			$autoincrement = "IDENTITY(1,1)";
			$where = "and table_catalog = '$this->__db'";
			$modify = "ALTER";
			$sep = "";
		}
		elseif(strstr($this->__dsn, "mysql")){
			$autoincrement = "AUTO_INCREMENT";
			$where = "and table_schema = '$this->__db'";
			$modify = "MODIFY";
			$sep = ";";
		}
		elseif(strstr($this->__dsn, "pgsql")){
			$autoincrement = "SERIAL";
			$where = "and table_catalog = '$this->__db' and table_schema = '$schema'";
			$modify = "ALTER";
			$sep = ";";
		}
		if(strstr($this->__dsn, "mysql"))
		    $infoTable = $dbh->query("select lower(TABLE_NAME) as TABLE_NAME,COLUMN_KEY,COLUMN_NAME, DATA_TYPE, IS_NULLABLE, CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION, NUMERIC_SCALE FROM INFORMATION_SCHEMA.COLUMNS where 1=1 $where")->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
		else 
		    $infoTable = $dbh->query("select lower(TABLE_NAME) as TABLE_NAME,COLUMN_NAME, DATA_TYPE, IS_NULLABLE, CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION, NUMERIC_SCALE FROM INFORMATION_SCHEMA.COLUMNS where 1=1 $where")->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
		
		foreach($data as $k=>$row){
			$k = strtolower($k);
			if(!in_array(strtolower($k),array_keys($infoTable))){
				$cols=array();
				if(strstr($this->__dsn, "mysql")){
    				$add_index="";
    				$add_foreing="";
				}
				foreach($row["columns"] as $krow =>$col){
					$col["primary"] = empty($col["primary"]) ? 'false' : $col["primary"];
					$col["autoincrement"] = empty($col["autoincrement"]) ? 'false' : $col["autoincrement"];

					$col["notnull"] = empty($col["notnull"]) && $col["primary"] != "true" ? "false" : "true";
					if(strstr($this->__dsn, "mysql") ){
						$col["index"] = empty($col["index"]) ? 'false' : $col["index"];
						$col["foreign"] = empty($col["foreign"]) ?  "" : $col['foreign'];
						if( $col["type"]  == "nvarchar(-1)"){
							$col["type"] = str_replace("nvarchar(-1)","text", $col["type"]);
						}
						else {
							$col["type"] = str_replace("nvarchar","varchar", $col["type"]);
						}
						
					}
					
					if(strstr($this->__dsn, "pgsql") ){
						if(strstr($col["type"], "nvarchar") ){
							$col["type"] = str_replace("nvarchar","varchar", $col["type"]);
						}
						array_push($cols, "$krow  ".($col["autoincrement"] == "true" ? " $autoincrement " : "$col[type]")." ".($col["primary"] == "true" ? " PRIMARY KEY " : "")." ".($col["notnull"] != "true" && $col["primary"] != "true" ? " NULL " : " NOT NULL ")."");
					}
					else{
						array_push($cols, "$krow $col[type] ".($col["autoincrement"] == "true" ? " $autoincrement " : "")." ".($col["primary"] == "true" ? " PRIMARY KEY " : "")." ".($col["notnull"] != "true" && $col["primary"] != "true" ? " NULL " : " NOT NULL ")."");
						if(strstr($this->__dsn, "mysql")){
    						$add_index.=($col["index"] == "true" ? "ALTER TABLE $k ADD INDEX `$krow` (`$krow`) $sep" : "");
    						$add_foreing .= ( $col["foreign"] != "" ? " ALTER TABLE $k ADD CONSTRAINT fk_"."$krow FOREIGN KEY (".$krow.") REFERENCES ".$col['foreign']." $sep"   : "");
						}
					}
				}
				if(strstr($this->__dsn, "pgsql") ){
					$query = " CREATE TABLE $schema.$k (".join(",",$cols).") $sep";
					
				}elseif(strstr($this->__dsn, "mysql")){
					$query = " CREATE TABLE $k (".join(",",$cols).") $sep $add_index $add_foreing";
				}
				else
				{
				    $query = " CREATE TABLE $k (".join(",",$cols).") $sep";
				}
				echo $query;
				$res = $dbh->query($query);
				if($res) echo "<br><br>OK<br><br>";
				else echo "<br><br>ERREUR<br><br>";
				
			}else{
				$cols = array();
				foreach($infoTable[strtolower($k)] as $rowCol){
					if(strstr($this->__dsn, "pgsql")){
						$cols[$rowCol["column_name"]] = $rowCol;
					}else{
						$cols[$rowCol["COLUMN_NAME"]] = $rowCol;
					}
				}
				foreach($row["columns"] as $krow=>$col){
					$col["primary"] = empty($col["primary"]) ? 'false' : $col["primary"];
					$col["autoincrement"] = empty($col["autoincrement"]) ? 'false' : $col["autoincrement"];
					$col["notnull"] = empty($col["notnull"]) && $col["primary"] != "true" ? 0 : true;
					$q_primary = ($col["primary"] == "true" ? " PRIMARY KEY " : "");
					$q_auto = ($col["autoincrement"] == "true" ? " $autoincrement " : "");
					if(strstr($this->__dsn, "mysql")){
    					$col["index"] = empty($col["index"]) ? 'false' : $col["index"];
    					
    					$col["foreign"] = empty($col["foreign"]) ?  "" : $col['foreign'];
    					$q_index = ($col["index"] == "true" ? " ,ADD INDEX `$krow` (`$krow`) " : "");
    					$q_foreign = ( $col["foreign"] != "" ?  " ALTER TABLE $k ADD FOREIGN KEY (".$krow.") REFERENCES ".$col['foreign'] : "");
    					
    					if($col["index"] == "true"){
    					    $query = "ALTER TABLE $k ADD INDEX `$krow` (`$krow`) ";
    					    $res = $dbh->query($query);
    					    if ($res)
    					        echo "<br><br>OK<br><br>";
    					    
    					}
					}
					if(in_array($krow,array_keys($cols))){
					    
						if(strstr($this->__dsn, "pgsql")){
							$type = $cols[$krow]["data_type"];
						}else{
							$type = $cols[$krow]["DATA_TYPE"];
						}
						
						if(strstr($this->__dsn, "mysql")){
						    if($cols[$krow]["COLUMN_KEY"]!="MUL")
						        $column_key= 1;
						    else 
						        $column_key = 0;
						}
						if(strstr($this->__dsn, "pgsql")){
							$is_notnull = $cols[$krow]["is_nullable"] == "YES" ? 0 : 1;
						}else{
							$is_notnull = $cols[$krow]["IS_NULLABLE"] == "YES" ? 0 : 1;
						}
						
						if($type == "nvarchar" || $type == "varchar") $type.="(".$cols[$krow]["CHARACTER_MAXIMUM_LENGTH"].")";
						elseif($type == "decimal") $type.="(".$cols[$krow]["NUMERIC_PRECISION"].",".$cols[$krow]["NUMERIC_SCALE"].")";
						
						if(strstr($this->__dsn, "mysql") ){
							if( $col["type"]  == "nvarchar(-1)"){
								$col["type"] = str_replace("nvarchar(-1)","text", $col["type"]);
							}
							else {
								$col["type"] = str_replace("nvarchar","varchar", $col["type"]);
							}
							
						}
						
						if(strstr($this->__dsn, "pgsql") ){
							if($type == "character varying") $type.="(".$cols[$krow]["character_maximum_length"].")";
								
						}
                        if (strstr($this->__dsn, "mysql") && (1 == $column_key)) {
                            
                            if ($col["foreign"] != "") {
                                $query = $q_foreign . $sep;
                                
                                $res = $dbh->query($query);
                                if ($res)
                                    echo "<br><br>OK<br><br>";
                                else
                                    echo "<br><br>ERREUR<br><br>";
                            }
                            if ($col["index"] == "true") {
                                $query = " ALTER TABLE $k ADD INDEX `$krow` (`$krow`) $sep";
                                echo $query;
                                $res = $dbh->query($query);
                                if ($res)
                                    echo "<br><br>OK<br><br>";
                                else
                                    echo "<br><br>ERREUR<br><br>";
                            }
                        }

						if($col["type"] != $type || ($col["notnull"] != $is_notnull)){
							
							if(strstr($this->__dsn, "pgsql") ){

								$q_null = ($col["notnull"] == false) ? "DROP NOT NULL" : "SET NOT NULL";
								$query = " ALTER TABLE $schema.$k $modify COLUMN $krow type $col[type] $sep ";
								echo $query;
								$res = $dbh->query($query);
								if($res) echo "<br><br>OK<br><br>";
								else echo "<br><br>ERREUR<br><br>";
								$query = " ALTER TABLE $schema.$k $modify COLUMN $krow  $q_null $sep";
								echo $query;
								$res = $dbh->query($query);
								if($res) echo "<br><br>OK<br><br>";
								else echo "<br><br>ERREUR<br><br>";
								if($col["primary"] == "true") $query = " ALTER TABLE $schema.$k ADD PRIMARY KEY ($krow) $sep";
								
							}else{
								$q_null = ($col["notnull"] == false) ? "NULL" : "NOT NULL";
								$query = " ALTER TABLE $k $modify COLUMN $krow $col[type] $q_null $sep";
								if($col["primary"] == "true") $query = " ALTER TABLE $k ADD PRIMARY KEY ($krow) $sep";
							}
							
							echo $query;
							$res = $dbh->query($query);
							if($res) echo "<br><br>OK<br><br>";
							else echo "<br><br>ERREUR<br><br>";
							
						}
					}else{
						if(strstr($this->__dsn, "mysql") && strstr($col["type"], "nvarchar")) $codification = " CHARACTER SET utf8 COLLATE utf8_unicode_ci ";
						else $codification = "";
						
						if(strstr($this->__dsn, "mysql") ){
							if( $col["type"]  == "nvarchar(-1)"){
								$col["type"] = str_replace("nvarchar(-1)","text", $col["type"]);
							}
							else {
								$col["type"] = str_replace("nvarchar","varchar", $col["type"]);
							}
								
						}
						$q_null = ($col["notnull"] == false) ? "NULL" : "NOT NULL";
						
						if(strstr($this->__dsn, "pgsql") ){

							$query = " ALTER TABLE $schema.$k ADD $krow $col[type] $codification $q_null $q_auto $q_primary $sep ";
							
						}
						elseif(strstr($this->__dsn, "mysql") ) {
							$query = " ALTER TABLE $k ADD $krow $col[type] $codification $q_null $q_auto $q_index $q_primary $sep $q_foreign ";
						}
						else {
						    $query = " ALTER TABLE $k ADD $krow $col[type] $codification $q_null $q_auto $q_primary $sep ";
						}
						echo $query;
						$res = $dbh->query($query);
						if($res) echo "<br><br>OK<br><br>";
						else echo "<br><br>ERREUR<br><br>";
					}
				}
				foreach($cols as $krow=>$col){
					if(!in_array($krow,array_keys($row["columns"]))){
						if(strstr($this->__dsn, "pgsql") ){
							$query = " ALTER TABLE $schema.$k DROP COLUMN $krow $sep ";
						}
						else{
							$query = " ALTER TABLE $k DROP COLUMN $krow $sep ";
						}

						echo $query;
						$res = $dbh->query($query);
						if($res) echo "<br><br>OK<br><br>";
						else echo "<br><br>ERREUR<br><br>";
						
					}
				}
			}
		}
		
			echo "Aucune mise � jour pr�vue";
		
	}
	
}