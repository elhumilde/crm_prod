<?php
header('Access-Control-Allow-Origin: *');
class TTSUpload{
	
	public static $EXT_DOC = array(".doc",".docx",".xls",".xlsx",".pdf",".csv");
	public static $EXT_IMG = array(".jpg",".gif",".jpeg",".png",".bmp");
	public static $EXT_MSG = array(".msg");
	
	private $__dir,
			$__file,
			$__max_size,
			$__ext;
	
	public function __construct($dir,$name = "0"){
		$this->__file = $_FILES[$name];
		$this->__dir = $dir;
		$this->__max_size = -1;
		$this->__ext = array();
	}
	
	public function setName($name){
		$extension = $this->getExtension();
		$this->__file["name"] = utf8_decode($name).$extension;
	}
	
	public function setExt($ext){
		$this->__ext = $ext;
	}
	
	public function setMaxSize($size){
		$this->__max_size = $size;
	}
	
	private function verifSize(){
		if($this->__max_size >= 0 && $this->__file["size"] >= $this->__max_size*1024){
			return "Vous avez depasse la taille maximale ($this->__max_size Mo) !";
		}
		return true;
	}
	
	private function getExtension(){
		return strrchr($this->__file['name'], '.');
	}
	
	private function verifExt(){
		$extension = strtolower($this->getExtension());
  		if(!empty($this->__ext) && !in_array($extension,$this->__ext)){
			return "Vous devez choisir un fichier (".join(",",$this->__ext).") !";
		}
		return true;
	}
	
	private function verifExist(){
		if(empty($this->__file['name'])){
			return "Vous devez choisir un fichier !";
		}
		return true;
	}
	
	private function rename(){
		return $this->__file['name'];
	}
	
	private function upload(){
		$new_name = $this->rename();
		if(move_uploaded_file($this->__file['tmp_name'], $this->__dir.$new_name)) return true;
		return "Erreur upload !";
	}
	
	public function execute(){
		if(!empty($_FILES)){
			if(($msg = $this->verifExist()) !== true) return $msg;
			if(($msg = $this->verifExt()) !== true) return $msg;
			if(($msg = $this->verifSize()) !== true) return $msg;
			if(($msg = $this->upload()) !== true) return $msg;
			return true;
		}
		return false;
	}
	
	
}