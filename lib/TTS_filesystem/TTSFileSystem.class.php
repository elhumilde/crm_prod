<?php
class TTSFileSystem {
	
	private $__id_fsystem;
	private $__path_fsystem;
	private $__path_exact;
	private $__is_trash;
	public static $RACINE;
	
	public function __construct($__path_fsystem = "",$absolute = false, $path_exact = true){
		
		//si racine non renseogne ---------------------------------------------------------------------
		if(!self::$RACINE) throw new Exception(utf8_decode("Vous devez spécifier le dossier racine !"));
		//---------------------------------------------------------------------------------------------
		
		//traiter lien absolu / relative --------------------------------------------------------------
		//$__path_fsystem = utf8_decode($__path_fsystem);
		if(!$__path_fsystem) $__path_fsystem = self::$RACINE;
		elseif(!$absolute) $__path_fsystem = self::$RACINE."/".$__path_fsystem;
		$this->__path_fsystem = $__path_fsystem;
		//---------------------------------------------------------------------------------------------
		
		//recuperer ID File system --------------------------------------------------------------------
		$obj = $this->getObject($this->__path_fsystem,$path_exact);
		if(empty($obj["id"]) && $__path_fsystem && $__path_fsystem != self::$RACINE) die("Identificateur Dossier introuvable !");
		$this->__id_fsystem = $obj["id"];
		$this->__is_trash = false;
		//---------------------------------------------------------------------------------------------
		
	}
	
	public function setExact($exact){
		$this->__path_exact = $exact;
	}
	
	public function isTrash(){
		$this->__is_trash = true;
	}
	
	public function getInfoFromId(){
		
		$fs_nom = $this->__path_fsystem;
		//get toutes les informations par rapport un fichier/dossier --------------------------------
		$stat = file_exists($fs_nom) ? stat($fs_nom) : 
		(file_exists(utf8_decode($fs_nom)) ? stat(utf8_decode($fs_nom)) : stat(utf8_decode(utf8_decode($fs_nom))) );
		
		$date = $stat["mtime"];
		$date = date("d/m/Y",$date);
		$obj = $this->getObject($fs_nom);
		$fsystem = array(
				"id" => $obj["id"],
				"path" => $fs_nom,
				"name" => $obj["name"],
				"taille"=> $stat["size"],
				"date"=>$date,
		);
		if (is_dir($fs_nom)){
			$fsystem["type"] = "d";
		}
		else{
			$fsystem["type"] = "f";
		}
		//-------------------------------------------------------------------------------------------
		
		return $fsystem;
	}
	
	public function getContentFolder(){
		
		// set connection ---------------------------------------------------------
		$connection = Doctrine_Manager::getInstance()->getConnection('ged');
		$dbh = $connection->getDbh();
		// ------------------------------------------------------------------------
		
		$fsystem = array();
		
		//recupere info dossier a partir son ID -----------------------------------------------
		$info_dossier = $this->getInfoFromId();
		$info_dossier["path"] = !is_dir(utf8_decode($info_dossier["path"])) ? dirname($info_dossier["path"]) : $info_dossier["path"];
		$dir = file_exists($info_dossier["path"]) ? opendir($info_dossier["path"]) : opendir(utf8_decode($info_dossier["path"]));
		//------------------------------------------------------------------------------------
		
		//parcourir les fichiers/dossiers ----------------------------------------------------
		while($element = readdir($dir)){
			if($element != '.' && $element != '..'){
				$path = $info_dossier["path"]."/".$element;
				$obj = $this->getObject($path);
				$oFS = new self($path,true);
				if($this->__is_trash){
					$oFS->isTrash();
				}
				
				$tempo=$oFS->getInfoFromId();
				//Fichier/dossier actif oui ou non-------------------------------------------
				if($dbh->query("select actif from TTS_File_System where id='".intval($tempo['id'])."' and actif='".($this->__is_trash ? "0" : "1")."'")->fetch())
					$fsystem[$obj["id"]] = $oFS->getInfoFromId();
				//-----------------------------------------------------------------------------
			}
		}
		//------------------------------------------------------------------------------------
		
		closedir($dir);
	
		return $fsystem;
		
	}
    
	public function getContentFolderSystem(){
	
		// set connection ---------------------------------------------------------
		$connection = Doctrine_Manager::getInstance()->getConnection('ged');
		$dbh = $connection->getDbh();
		// ------------------------------------------------------------------------
	
		$fsystem= array();
	
		//recupere info dossier a partir son ID -----------------------------------------------
		$info_dossier = $this->getInfoFromId();
		$dir = opendir($info_dossier["path"]);
		//------------------------------------------------------------------------------------
	
		//parcourir les fichiers/dossiers ----------------------------------------------------
		while($element = readdir($dir)){
	
			if($element != '.' && $element != '..'){
				$path = $info_dossier["path"]."/".$element;
				$obj = $this->getObject($path);
				$oFS = new self($path,true);
				if($this->__is_trash){
					$oFS->isTrash();
				}
				$tempo=$oFS->getInfoFromId();
				//Fichier/dossier actif oui ou non-------------------------------------------
				$res=$dbh->query("select * from TTS_File_System where id=".$tempo['id'])->fetch();
				if($this->__is_trash && $tempo["type"] == "f"){
					if($res["actif"]) continue;
				}
				$fsystem[$obj["id"]] = $oFS->getInfoFromId();
				$fsystem[$obj["id"]]["actif"]=$res["actif"];
				//-----------------------------------------------------------------------------
			}
		}
		//------------------------------------------------------------------------------------
	
		closedir($dir);
	
		return $fsystem;
	}
	
	public function getContentAllFolder(){
		
		// set connection ---------------------------------------------------------
		$connection = Doctrine_Manager::getInstance()->getConnection('ged');
		$dbh = $connection->getDbh();
		// ------------------------------------------------------------------------
		
		$fsystem= array();
		
		//recupere info dossier a partir son ID -----------------------------------------------
		$info_dossier = $this->getInfoFromId();
		$dir = opendir($info_dossier["path"]);
		//------------------------------------------------------------------------------------
		
		//parcourir les fichiers/dossiers ----------------------------------------------------
		while($element = readdir($dir)){
			
			if($element != '.' && $element != '..'){
				$path = $info_dossier["path"]."/".$element;
				$obj = $this->getObject($path);
				$oFS = new self($path,true);
				if($this->__is_trash){
					$oFS->isTrash();
				}
				$tempo=$oFS->getInfoFromId();
				//Fichier/dossier actif oui ou non-------------------------------------------
				if($dbh->query("select actif from TTS_File_System where id=".$tempo['id']." and actif='".($this->__is_trash ? "false" : "true")."'")->fetch())
					$fsystem[$obj["id"]] = $oFS->getInfoFromId();
				//-----------------------------------------------------------------------------
				if(is_dir(utf8_decode($info_dossier["path"]."/".$element))){
					$oFS = new self($info_dossier["path"]."/".$element,true);
					if($this->__is_trash) $oFS->isTrash();
					$temposys=$oFS->getContentAllFolder();
					$fsystem=array_merge($fsystem,$temposys);
				}
			}
		}
		//------------------------------------------------------------------------------------
		
		closedir($dir);
		
		return $fsystem;
	}
	
	public function getContentAllFolderSystem(){
	
		// set connection ---------------------------------------------------------
		$connection = Doctrine_Manager::getInstance()->getConnection('ged');
		$dbh = $connection->getDbh();
		// ------------------------------------------------------------------------
	
		$fsystem= array();
	
		//recupere info dossier a partir son ID -----------------------------------------------
		$info_dossier = $this->getInfoFromId();
		$dir = opendir($info_dossier["path"]);
		//------------------------------------------------------------------------------------
	
		//parcourir les fichiers/dossiers ----------------------------------------------------
		while($element = readdir($dir)){
				
			if($element != '.' && $element != '..'){
				$path = $info_dossier["path"]."/".$element;
				$obj = $this->getObject($path);
				$oFS = new self($path,true);
				if($this->__is_trash){
					$oFS->isTrash();
				}
				$tempo=$oFS->getInfoFromId();
				//Fichier/dossier actif oui ou non-------------------------------------------
				$fsystem[$obj["id"]] = $oFS->getInfoFromId();
				//-----------------------------------------------------------------------------
				if(is_dir(utf8_decode($info_dossier["path"]."/".$element))){
					$oFS = new self($info_dossier["path"]."/".$element,true);
					if($this->__is_trash){
						$oFS->isTrash();
					}
					$temposys=$oFS->getContentAllFolder();
					$fsystem=array_merge($fsystem,$temposys);
				}
			}
		}
		//------------------------------------------------------------------------------------
	
		closedir($dir);
		return $fsystem;
	}
	
	public function getFolder(){
		
		//return les Dossiers de dossier parant-------------------------------
		$system = $this->getContentFolder();
		foreach ($system as $id=>$tempoarray){
			if($tempoarray["type"] != "d"){
				unset($system[$id]);
			}
		}
		return $system;
		//--------------------------------------------------------------------
	}
	
	public function getFolderSystem(){
	
		//return les Dossiers de dossier parant-------------------------------
		$system = $this->getContentFolderSystem();
		foreach ($system as $id=>$tempoarray){
			if($tempoarray["type"] != "d"){
				unset($system[$id]);
			}
		}
		return $system;
		//--------------------------------------------------------------------
	}
	
	public function getInfo(){
		
		$info = $this->getInfoFromId();
		
		// set connection ---------------------------------------------------------
		$connection = Doctrine_Manager::getInstance()->getConnection('ged');
		$dbh = $connection->getDbh();
		// ------------------------------------------------------------------------
		
		$data = $dbh->query("
				select t.id as tid,titre,id_createur,description,version,u.nom+' '+u.prenom as createur,email,tel 
				from (select $this->__id_fsystem as fid) tempo
				left outer join TTS_File_System t on t.id = tempo.fid
				left outer join TTS_Utilisateur u on u.id=t.id_createur")->fetch();
		
		if(!$data) $data = array();
		
		$info_dossier = array_merge($data,$info);
		return $info_dossier;
		
	}

	public function getRecap(){
		
		$Nbrsystem = count($this->getContentFolder());
		$Nbrdossier = count($this->getFolder());
		$Nbrfichier = $Nbrsystem-$Nbrdossier;
		$recap = array("dossier"=> $Nbrdossier,"fichier"=> $Nbrfichier,"total"=>$Nbrsystem);
		return $recap;
		
	}

	public function getOccupiedSpace(){
	
		// set connection ---------------------------------------------------------
		$connection = Doctrine_Manager::getInstance()->getConnection('ged');
		$dbh = $connection->getDbh();
		// ------------------------------------------------------------------------
		
		$data = $dbh->query("select * from TTS_File_System where id=$this->__id_fsystem ")->fetch();
		
		//var_dump($data["taille_max"]);die;
		if($data!=null)
			$max=$data["taille_max"];
		else
			$max=89843;
		$info = $this->getInfoFromId();
		$occupied = $max ? $info["taille"] / $max : 0;
		return $occupied;
		
	}
	
	private function getObject($fs,$path_exact = true){
		
		//si le path n'est pas exact (lien sans ID) ---------------------------------
		if(!$path_exact){
			$fs = str_replace(self::$RACINE,"",$fs);
			$all_fs = explode("/",$fs);
			$path = "";
			foreach($all_fs as $k=>$each){ // parcourir dossier par dossier
				if(!$path) $path = $each;
				$oFS = new self($path,true);
				if($this->__is_trash){
					$oFS->isTrash();
				}
				$list_fs = $oFS->getContentFolder(); //recuperer tous les sous dossier/fichier
				$found = false;
				foreach($list_fs as $each_fs){
					if(isset($all_fs[$k+1])){
						if($each_fs["name"] == $all_fs[$k+1]){ //verfier si le nom du fichier est identique au dossier/fichier fils
							$path = $each_fs["path"];
							$found = true;
						}
					}
				}
				if(!$found && !empty($list_fs) && isset($all_fs[$k+1])) die("Fichier/Dossier (".$all_fs[$k+1].") introuvable!");
			}
			$fs = $path;
			if($fs) $this->__path_fsystem = $fs; //mise a jour le path de l'objet
		}
		//---------------------------------------------------------------------------
		
		//algorithme pour recuperer les ID et les noms sans ID ---------------------
		$base_name = basename($fs);
		$last_point = strrpos($base_name, ".");
		if($last_point){
			
			$res_name = substr($base_name, 0,$last_point);
			if(!is_dir(utf8_decode($fs)) && !is_dir($fs)){
				$tmp_name = $res_name;
				$before_last_point = strrpos($tmp_name, ".");
				$tmp_name = substr($tmp_name, 0,$before_last_point);
				$ext = substr($base_name,$last_point,strlen($base_name));
				$res_name = $tmp_name.$ext;
				$id = substr($base_name,$before_last_point+1,$last_point-$before_last_point-1);
			}else{
				$id = substr($base_name,$last_point+1,strlen($base_name));
			}
			$res_object = array('id'=> $id, 'name'=> $res_name);
		}else $res_object = array('id'=> 0, 'name'=> $base_name);
		//---------------------------------------------------------------------------
		
		return $res_object;
		
	}
	
}
?>