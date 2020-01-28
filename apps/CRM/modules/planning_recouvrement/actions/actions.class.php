<?php

/**
 * planning_recouvrement actions.
 *
 * @package    symfony
 * @subpackage planning_recouvrement
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class planning_recouvrementActions extends sfActions
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
	  	$this->mois = $request->getParameter('mois') ? intval($request->getParameter('mois')) : date('m');
	  	$this->annee = $request->getParameter('annee') ? intval($request->getParameter('annee')) : date('Y');
	  	$this->dateeee = array();
	  	$this->ids_users_affecte=$this->getUser()->getIds_user_affecte();
	  	$condition_date = " and month(d.date_rappel) = '$this->mois' and year(d.date_rappel) = '$this->annee'";
	  	$condition_date_visite = " and month(d.date_prochaine_visite) = '$this->mois' and year(d.date_prochaine_visite) = '$this->annee'";
	  	$cond_user = " ";
	  	if($request->getParameter('operateur'))
	  		$this->operateur = $request->getParameter('operateur');
	  		if($this->operateur){
	  			$cond_user = " and d.operateur= '$this->operateur' ";
	  		}

	  	if(!$this->getUser()->hasCredential('allencaissement')){
	  
	  		$cond_user=" AND  u.id in ($this->ids_users_affecte)";
	  	}
	  
	  	if($this->id_user_selectionne) {
	  		$cond_user = " and u.id = $this->id_user_selectionne";
	  	}
	  
	  
	  	$req="
	  			
	  	select aff.* from (SELECT  'appel_recouvrement' as type, d.date_rappel as date,f.rs_comp as firme , d.num_bc , (select id from $db_name.encaissement en where en.NORD = d.num_bc order by d.date_appel desc LIMIT 1) as id_encai 
	  	FROM $db_name.appel_recouvrement d
	  	left outer join $db_name.firmes f on concat('MA', d.code_firme) = f.code_firme
        left outer join tts_utilisateur u on ifnull(u.code_commercial, '') = ifnull(d.operateur, '')
        left outer join $db_name.appel_recouvrement d2 on d2.date_appel > d.date_appel and d2.code_firme = d.code_firme
	  	where d2.id is null  $condition_date  $cond_user 
		group by d.date_rappel ,f.rs_comp , d.num_bc) aff
		inner join $db_name.encaissement e on e.id = aff.id_encai and ifnull(e.solde,0) > 0 and ifnull(e.cloture,0) = 0
	  	order by date";
	  	$this->appels = $dbh->query($req)->fetchAll();
	  	
	  	$req="

	  	select aff.* from (SELECT  'visite_recouvrement' as type,'' as code,d.date_prochaine_visite as date,f.rs_comp as firme , d.num_bc , (select id from $db_name.encaissement en where en.NORD = d.num_bc order by d.date_visite desc LIMIT 1) as id_encai 
            FROM $db_name.visite_recouvrement d
            left outer join $db_name.firmes f on concat('MA', d.code_firme) = f.code_firme
        	left outer join tts_utilisateur u on ifnull(u.code_commercial, '') = ifnull(d.operateur, '')
        	left outer join $db_name.visite_recouvrement d2  on d2.date_visite > d.date_visite and d2.code_firme = d.code_firme
	  		where d2.id is null $condition_date_visite $cond_user 
	  		group by d.date_prochaine_visite ,f.rs_comp  , d.num_bc) aff
			inner join $db_name.encaissement e on e.id = aff.id_encai and ifnull(e.solde,0) > 0 and ifnull(e.cloture,0) = 0
		  	order by date";
	  	
	  	$this->visites = $dbh->query($req)->fetchAll();
	  	
	  	if($_POST Or $_GET){
	  		Common::setTracabilite("Planning Recouvrement", "", "Consulter Calendrier", $this->id_user, "crm");
	  	}
	  
	  	$connection->close();
	  }
}
