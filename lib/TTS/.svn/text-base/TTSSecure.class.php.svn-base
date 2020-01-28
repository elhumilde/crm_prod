<?php

header('Access-Control-Allow-Origin: *');
Class TTSSecure{
	
	private $__request,
			$__action,
			$__habilitation,
			$__nb_user,
			$__user;
	
	public function __construct($action){
		$this->__action = $action;
		$this->__request = $action->getRequest();
		$this->__user = $this->__action->getUser();
		
	}
	
	public function start(){
		

		$app = sfContext::getInstance()->getConfiguration()->getApplication();
		$module = $this->__request->getParameter('module');
		$action = $this->__request->getParameter('action');
		
		$nb_user_configure = $this->__user->getAttribute('nb_tts'.$app) ;

		$nb_user_reel = $this->__user->getAttribute('tts_nb'.$app) ;
		if($nb_user_configure && $nb_user_reel){
			if(l_e___($nb_user_reel) > l_e___($nb_user_configure)) {
				echo "Vous avez depassé le nombre d'utilisateur maximum";
			}
			
			
		}
  	
		$id = $this->__request->getParameter('id');
		if((strtolower($module) == "default") or (strtolower($module) == "common")  or (strtolower($module) == "warning")  or (strtolower($module) == "mail") or (strtolower($module) == "home" && $action == "index")or (strtolower($module) == "tableaubord" && $action == "index") ) return;
		if(strtolower($action) == "index" Or strtolower($action) == "consulter" Or strpos(strtolower($action), 'ajax') !== false ) $action = "";
		$habilitation = strtolower($action.$module);
		$has = $this->__user->hasCredential($habilitation);
		
		if($module == "Administration"){
			if($action == "AjouterUser"){
				$consult_module = $this->__user->hasCredential(strtolower("utilisateur".$module));
			}
			if($action == "AjouterProfil"){
				$consult_module = $this->__user->hasCredential(strtolower("Profil".$module));
			}
		}else{
			$consult_module = $this->__user->hasCredential(strtolower($module));
		}
		if(!$has){
			if(preg_match("/ajouter/",strtolower($action)) && $consult_module){
				if(empty($_POST) && !empty($id)){
					$has = true;
				}else{
					$has = false;
				}
			}
		}
		
 		if(!$has)
 		$this->__action->redirect("default/secure");
		
		
	}
	
	public function javascriptSecure(){
		
		$app = sfContext::getInstance()->getConfiguration()->getApplication();
		$db = strtolower($app);
		$connection = Doctrine_Manager::getInstance()->getConnection($db);
		$dbh = $connection->getDbh();
		$db = $connection->getOptions();
		$dsn = $db['dsn'];
		$this->__nb_user = 0;
		
		$this->__server = $dbh->getAttribute(PDO::ATTR_DRIVER_NAME);
		try{
			if($this->__server == "pgsql"){
				$this->__habilitation = $dbh->query("select lower(action) from tts.tts_habilitation_action")->fetchAll(PDO::FETCH_COLUMN);
		
			}else{
				$this->__habilitation = $dbh->query("select lower(action) from tts_habilitation_action")->fetchAll(PDO::FETCH_COLUMN);
				if($this->__user->getAttribute('nb_tts'.$app)){
					$this->user = $dbh->query("select count(*) as nb from tts_utilisateur where actif = 1")->fetch();
					$this->__nb_user = $this->user['nb'];
				}
			}
		} catch(Exception $e){
			$connection->close();
			$connection = Doctrine_Manager::getInstance()->getConnection($db);
			$dbh = $connection->getDbh();
			if($this->__server == "pgsql"){
				$this->__habilitation = $dbh->query("select lower(action) from tts.tts_habilitation_action")->fetchAll(PDO::FETCH_COLUMN);
		
			}else{
				$this->__habilitation = $dbh->query("select lower(action) from tts_habilitation_action")->fetchAll(PDO::FETCH_COLUMN);
			}
		}
		
		$js = "\n$(document).ready(function(){\n";
		foreach($this->__habilitation as $each){
			if(!$this->__user->hasCredential($each)){
				$js .= "$('[name=$each]').remove();\n";
			}
		}
		$js .= "\n});\n";
		

		if(!$this->__user->hasAttribute('tts_nb'.$app) && $this->__user->getAttribute('nb_tts'.$app)) $this->__user->setAttribute('tts_nb'.$app,encrypt($this->__nb_user));
		return $js;
	}
	
}