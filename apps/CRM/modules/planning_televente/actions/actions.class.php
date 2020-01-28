<?php

/**
 * planning_televente actions.
 *
 * @package    symfony
 * @subpackage planning_televente
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class planning_televenteActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
	  
	  public function executePlanning(sfWebRequest $request)
	  {
	  
	  	$connection = Doctrine_Manager::getInstance()->getConnection('crm');
	  	$dbh = $connection->getDbh();
	  	$connection2 = Doctrine_Manager::getInstance()->getConnection('bd_web');
	  	$dbh_web = $connection2->getDbh();
	  	$db = $connection2->getOptions();
	  	$dsn = $db['dsn'];
	  	preg_match("/;dbname=(.+)/",$dsn,$base_web);
	  	$db_name = $base_web[1];
	  	 
	  	 
	  	$this->id_user= $this->getUser()->getId();
	  	 
	  	$array_tts_visite_realise = $request->getParameter('tts_visites_realisees');
	  	$id_user_selectionne = $array_tts_visite_realise["id"];
	  	 
	  	$this->id_user_selectionne = intval($id_user_selectionne);
	  	$this->day = $request->getParameter('day') ? intval($request->getParameter('day')) : date('d');
	  	$this->mois = $request->getParameter('mois') ? intval($request->getParameter('mois')) : date('m');
	  	$this->annee = $request->getParameter('annee') ? intval($request->getParameter('annee')) : date('Y');
	  	$this->dateeee = array();
	  	$this->ids_users_affecte=$this->getUser()->getIds_user_affecte();
	  	$condition_date = " and month(d.date_rappel) = '$this->mois' and year(d.date_rappel) = '$this->annee'";
	  	$condition_date_appel = " month(d.date_appel) = '$this->mois' and year(d.date_appel) = '$this->annee'";
	  	$cond_operateur = " ";
	  	$cond_user_affecte = " ";
	  	if($request->getParameter('operateur'))
	  		$this->operateur = $request->getParameter('operateur');
	  		if($this->operateur){
	  			$cond_operateur = " and d.operateur= '$this->operateur' ";
	  		}

	  	if(!$this->getUser()->hasCredential('allencaissement')){
	  
	  		$cond_user_affecte =" AND  u.id in ($this->ids_users_affecte)";
	  	}
	  
	  	if($this->id_user_selectionne) {
	  		$cond_user_affecte = " and u.id = $this->id_user_selectionne";
	  	}
	  	
	  
	  	$req="
	  			
	  	select aff.* from (SELECT  f.id, 'appel_televente' as type, d.date_appel as date, f.rs_comp as firme,f.id as id_firme 
	  	FROM $db_name.appel_televente d
	  	left outer join $db_name.firmes f on concat('MA', d.code_firme) = f.code_firme
        left outer join tts_utilisateur u on ifnull(u.code_commercial, '') = ifnull(d.operateur, '')
	  	where   $condition_date_appel $cond_operateur $cond_user_affecte 
		group by f.id, d.date_appel ,f.rs_comp ) aff
	  	order by date";
	  	$this->appels_realise = $dbh->query($req)->fetchAll();
	  	$req="	
	  	select aff.* from (SELECT  f.id, 'appel_televente' as type, d.date_rappel as date,f.rs_comp as firme,f.id as id_firme , d.appel_heure_rappel
	  	FROM $db_name.appel_televente d
	  	left outer join $db_name.firmes f on concat('MA', d.code_firme) = f.code_firme
        left outer join tts_utilisateur u on ifnull(u.code_commercial, '') = ifnull(d.operateur, '')
        left outer join $db_name.appel_televente d2 on d2.date_appel > d.date_appel and d2.code_firme = d.code_firme
	  	where d2.id is null  $condition_date $cond_operateur $cond_user_affecte 
		group by f.id, d.date_rappel ,f.rs_comp, d.appel_heure_rappel ) aff
	  	order by date, appel_heure_rappel ";
	  	$this->appels_planifie = $dbh->query($req)->fetchAll();

	  	
	  	if($_POST Or $_GET){
	  		Common::setTracabilite("Planning televente", "", "Consulter Calendrier", $this->id_user, "crm");
	  	}
	  
	  	$connection->close();
	  }
}
