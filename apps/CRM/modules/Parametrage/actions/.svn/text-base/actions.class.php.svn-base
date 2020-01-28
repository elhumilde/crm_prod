<?php

/**
 * Parametrage actions.
 *
 * @package    ERP
 * @subpackage Parametrage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ParametrageActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
  	$this->table = $this->getTable();
  	
  }
  
  public function executeParametrage(sfWebRequest $request)
  {
  
  	// set connection ---------------------------------------------------------
  	$connection = Doctrine_Manager::getInstance()->getConnection('crm');
  	$dbh = $connection->getDbh();
  	// ------------------------------------------------------------------------
  	$this->id_user= $this->getUser()->getId();
  	
  	//get parameter -----------------------------------------------------------
  	$post = $_POST;
  	$allTable = $this->getTable();
  	$tab = $request->getParameter("table_parametrage");
  	$this->tab = $tab;
  	$act = $request->getParameter("act");
  	$id = $request->getParameter('id');
  	$this->dataFkey = array();
  	// ------------------------------------------------------------------------
  	
  	$this->table = $allTable[$tab];
  	$this->data = $dbh->query("select * from $tab")->fetchAll(PDO::FETCH_ASSOC);
  	if(!empty($this->table["FKey"])){
  		foreach($this->table["FKey"] as $k=>$c){
  			$this->dataFkey[$k] = $dbh->query("select id,$c[libelle] from $c[table]")->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_COLUMN);
  		}
  	}
  	$this->oForm = new Form("$tab","id","crm");
  	$this->form = $this->oForm->setup();
  	
  	$this->attr = $this->oForm->getAttribute();
  	$this->champs = array();
  	
   	foreach ($this->attr as $k=>$each){
   		if(substr($k, 0, strlen("id") ) == "id") continue;
   		 array_push($this->champs ,$k);
   	}
   	
  	foreach($this->attr as $k=>$c){
  		if($k == "id"){
  			unset($this->attr[$k]);
  		}
  	}
  	
  	if($act == 'addElem'){
  		$this->oForm->isAjax();
  		$res = $this->oForm->save();

  		Common::setTracabilite("Parametrage", $res['id'], "Parametrage de la table ".$tab , $this->id_user, "crm");

  		$arr = array();
  		foreach($this->attr as $k=>$c){
  			array_push($arr,
  					!empty($this->dataFkey[$k]) && $res[$k] ? $this->dataFkey[$k][$res[$k]][0] : $res[$k]
  			);
  		}
  		$arr['id'] = $res['id'];
  		return $this->renderText(json_encode(array_map(function($elem){ return $elem; },$arr)));	
  	  	}elseif($act == "update"){
  	  		$this->oForm->isAjax();
  		$id_ligne = $request->getParameter('id');
  		$this->oForm->find('id',$id_ligne);
  		$res = $this->oForm->save();
  		return $this->renderText(array_shift($_POST["$tab"]));
  	}
  	
  }
  
  private function getTable(){
  	
  	$table = array();
  	
  	$table["par_tts_civilite"] = array(
  		"libelle" => "Civilite"
  	);
  	$table["par_tts_service"] = array(
  		"libelle" => "Service"
  	);
  	$table["par_tts_type_reclamation"] = array(
      "libelle" => "Type Reclamation"
    );
    $table["par_tts_gravite_reclamation"] = array(
      "libelle" => "Gravite"
    );
    $table["par_tts_groupe"] = array(
      		"libelle" => "Groupe"
    );
    $table["par_tts_type_visite"] = array(
      "libelle" => "Type Visite"
    );
    $table["par_tts_opportunite_statut"] = array(
      "libelle" => "Statut Opportunite"
    );
    $table["par_tts_opportunite_type"] = array(
      "libelle" => "Type Opportunite"
    );
    $table["par_tts_visite_resultat"] = array(
      "libelle" => "Résultat Visite"
    );
    $table["par_tts_raison"] = array(
        "libelle" => "Raison de rejet"
    );
    $table["par_etape_vente"] = array(
        "libelle" => "Etape vente"
    );
  	return $table;
  	
  }
}
