<?php

class visite_effectueeActions extends sfActions
{

	public function executeIndex(sfWebRequest $request)
	{
		$this->forward('default', 'module');
	}
	
	public function executeCalendar(sfWebRequest $request)
	{
	    $this->oFilter = new Filter("tts_visites_realisees","vr", "crm");
	    // ------------------------------------------------------------------------
	    	
	    // add field not exist in table -------------------------------------------
	    $this->oFilter->addField('code_firme');
	    // ------------------------------------------------------------------------
	    	
	    // ------------------------------------------------------------------------
	    	
	    // setup param of filter --------------------------------------------------
	    $this->filter = $this->oFilter->setup();
	    // ------------------------------------------------------------------------
		
	    $connection = Doctrine_Manager::getInstance()->getConnection('crm');
    	$dbh = $connection->getDbh();
    	$this->id_user= $this->getUser()->getId();
	    $this->id_resultat_visite = intval($request->getParameter('id_resultat_visite'));
	    
	    $array_tts_visite_realise = $request->getParameter('tts_visites_realisees');
	    $id_user_selectionne = $array_tts_visite_realise["id"];
	    
	    $this->id_user_selectionne = intval($id_user_selectionne);
	    $this->day = $request->getParameter('day') ? intval($request->getParameter('day')) : date('d');
	    $this->mois = $request->getParameter('mois') ? intval($request->getParameter('mois')) : date('m');
	    $this->annee = $request->getParameter('annee') ? intval($request->getParameter('annee')) : date('Y');
	    $this->dateeee = array();
	    $this->ids_users_affecte=$this->getUser()->getIds_user_affecte();
	    $condition_date = " and month(v.date_visite) = '$this->mois' and year(v.date_visite) = '$this->annee'";
	    $cond_resultat_visite = "";
	    $cond_user = "";
	    
		if($this->id_resultat_visite) {
			$cond_resultat_visite = " and t.id = $this->id_resultat_visite";
		}
		if(!$this->getUser()->hasCredential('allvisite')){
		    
		    $cond_user=" AND  v.id_utilisateur in ($this->ids_users_affecte)";
		}
		
		if($this->id_user_selectionne) {
		    $cond_user = " and v.id_utilisateur = $this->id_user_selectionne";
		}
		
		
		$req="
          select v.id, v.date_visite as date,v.heure_visite as heure,f.firme, t.resultat as resultat ,
		    v.id_resultat_visite from tts_visites_realisees v 
		    left outer join par_tts_visite_resultat t on v.id_resultat_visite = t.id 
		    left outer join tts_firmes f on v.code_firme = f.code_firme 
		    where 1=1 $condition_date $cond_resultat_visite $cond_user  order by date_visite, heure_visite ";
		$this->visitesR = $dbh->query($req)->fetchAll();
		$req="
		select v.id, v.date_visite as date,v.heure_visite as heure,f.firme  from tts_visites_planifiees v
		left outer join tts_firmes f on v.code_firme = f.code_firme
		left outer join par_tts_visite_resultat t on 1=2 
		where realise=0 $condition_date $cond_resultat_visite $cond_user order by date_visite, heure_visite";
		$this->visitesP = $dbh->query($req)->fetchAll();
		if($_POST Or $_GET){
		    Common::setTracabilite("Visites", "", "Consulter Calendrier", $this->id_user, "crm");
		}
		//var_dump($this->visitesP);die;

		$connection->close();
	}
	
	public function executeAjouter(sfWebRequest $request)
	{

		// set connection ---------------------------------------------------------
		$dbh = Common::TTSConnect();
		Form::$AUTH_ZERO = true;
		// ------------------------------------------------------------------------
		$connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
		$this->IDU = $this->getUser()->getId();
		//get parameter -----------------------------------------------------------
		$id = $request->getParameter('id');
		$code_firme = $request->getParameter('code_firme');
		$this->code_firme = $code_firme;
		$id_visiteP = $request->getParameter('id_visiteP');
		$this->id_visiteP = $id_visiteP;
		$this->id_user= $this->getUser()->getId();
		$this->code_commercial= $this->getUser()->getCode();
		$this->ids_users_affecte=$this->getUser()->getIds_user_affecte();
		$this->v_planifiee = $dbh->query("select * from tts_visites_planifiees where actif='1' AND id='$id_visiteP'")->fetch();
		if($id && !$this->getUser()->hasCredential('allvisite'))
		 {
		 	$visite_secure = $dbh->query("select count(v.id) as cnt
        			FROM tts_visites_realisees v where v.id_utilisateur in ($this->ids_users_affecte) and v.id=$id")->fetch();
			if($visite_secure['cnt']=='0') $this->redirect("Calendar");
			
			
		 }
		 
		
		$this->date = $request->getParameter('date');
		$this->id = $id;

		// declare objet Form -----------------------------------------------------
		$this->oForm = new Form("tts_visites_realisees","id", "crm");
		$this->oFormOpp = new Form("tts_opportunite","id", "crm");
		$this->oForm_planifie = new Form("tts_visites_planifiees","id", "crm");
		$this->oFormContact = new Form("personne", "id", "bd_web");
		
		if($id) {
			$this->oForm = $this->oForm->find('id',$id);
			
			if($this->oForm->getData("nouv_opportunite")==1){
				$this->oFormOpp = $this->oFormOpp->find('id_visite',$id);
			}
			
		}
		
		if($id_visiteP || $id)
		{
			if($id) $code_firme=$this->oForm->getData('code_firme');
			elseif($id_visiteP) $code_firme=$this->v_planifiee["code_firme"];
			$firme_array = $dbh->query("select f.firme,id as id_firme from tts_firmes f where f.code_firme='$code_firme'")->fetch();
			$this->firme=$firme_array["firme"];
			$this->id_firme=$firme_array["id_firme"];
		}  
		
		
		
		if($this->date){
			$this->oForm->setValue("date_visite",Common::convert_date($this->date,"d/m/Y"));
		}
		if($id_visiteP && !$id){
			$this->oForm->setFixedValue("code_firme",$this->v_planifiee["code_firme"]);
			$this->oForm->setFixedValue("code_contact",$this->v_planifiee["code_contact"]);
			$this->oForm->setFixedValue("id_utilisateur",$this->v_planifiee["id_utilisateur"]);
			//$this->oForm->setFixedValue("id_type_visite",$this->v_planifiee["id_type_visite"]);
			$this->oForm->setFixedValue("date_visite",Common::convert_date($this->v_planifiee["date_visite"],"d/m/Y"));
			$this->oForm->setOption('code_firme',array("disabled" => "disabled"));
			$this->oForm->setOption('id_utilisateur',array("disabled" => "disabled"));
			$this->oForm->setOption('code_contact',array("disabled" => "disabled"));
		}
		if(!$id){
			$this->actuelUser = $dbh->query("select concat(nom,' ',prenom) as fullname from tts_utilisateur where id='$this->id_user'")->fetch();
		}else{
			$this->actuelUser = $dbh->query("select concat(nom,' ',prenom) as fullname from tts_utilisateur where id=".$this->oForm->getData("id_utilisateur"))->fetch();
		}
		if ($code_firme) {
		    $this->oForm->setValue('code_firme', $code_firme);
		    $rs_comp = $dbh->query("select f.rs_comp
		        FROM tts_firmes f where f.code_firme='$code_firme'")->fetchAll(PDO::FETCH_COLUMN);
		    $this->firme = $rs_comp[0];
		}
		// ------------------------------------------------------------------------
		$this->besoin = array("2"=>"Non","1"=>"Oui");
		$this->n_opp = array("2"=>"Non","1"=>"Oui");
		//set value par default of field ------------------------------------------
		$this->oFormOpp->setValue('id_statut_opportunite',"1");
		if(!$id){
			$this->oForm->setFixedValue('actif',1);
			$this->oForm->setValue('id_utilisateur',$this->id_user);
		}

		//operation ---------------------------------------------------------------
		if(!$id){
			$this->oForm->setValue("nouv_opportunite",'');
		}


		// setup param of form ----------------------------------------------------
		$this->form = $this->oForm->setup();
		$this->formOpp = $this->oFormOpp->setup();
		$this->form_planifie = $this->oForm_planifie->setup();
		$this->formContact = $this->oFormContact->setup();
		// ------------------------------------------------------------------------
			// save data of form ------------------------------------------------------
			$res = $this->oForm->save();
			$date_proch_visite = Common::convert_date ($res["date_prochainev"], 'd/m/Y' );
			if($res){				
			    if($date_proch_visite)
			    {
			        $this->oForm_planifie->setFixedValue("code_firme",$res["code_firme"]);
			    	//$this->oForm_planifie->setFixedValue("id_type_visite",$res["id_type_visite"]);
			    	$this->oForm_planifie->setFixedValue("code_contact",$res["code_contact"]);
			    	$this->oForm_planifie->setFixedValue('actif',1);
  					$this->oForm_planifie->setFixedValue("date_visite",$date_proch_visite);
			    	$this->oForm_planifie->setValue('id_utilisateur',$res["id_utilisateur"]);
			    	$this->oForm_planifie->setValue("date_creation",Common::convert_date($this->date,"d/m/Y"));
			    	$res3 = $this->oForm_planifie->save();
			    }
			    
				if(!$id){
					if($res["nouv_opportunite"]==1){
						$code = Common::getCompteur('OPP','tts_compteur','crm');
						$this->oFormOpp->setFixedValue("code_firme",$res["code_firme"]);
						$this->oFormOpp->setFixedValue("code_contact",$res["code_contact"]);
						$this->oFormOpp->setFixedValue("date_creation",date('d/m/Y'));
						$this->oFormOpp->setFixedValue("code_commercial",$this->code_commercial);
						$this->oFormOpp->setFixedValue("id_createur",$this->id_user);
						$this->oFormOpp->setFixedValue("code",$code);
						$this->oFormOpp->setFixedValue("id_statut_opportunite","1");
						$this->oFormOpp->setFixedValue("id_visite",$res["id"]);
						$res2 = $this->oFormOpp->save();
						Common::validCompteur('OPP','tts_compteur','crm');
						$this->oForm = new Form("tts_visites_realisees","id","crm");
						$this->oForm = $this->oForm->find('id',$res["id"]);
						$this->oForm->setFixedValue("id_opportunite",$res2["id"]);
						$res3 = $this->oForm->save();

					}
						
					Common::setTracabilite("Visites", $res['id'], "Ajout visite effectuee", $this->id_user, "crm");
					 
					$this->getUser()->setFlash('success','Visite r&eacute;alis&eacute;e avec succ&eacute;s !');
				}else{
					Common::setTracabilite("Visites", $res['id'], "Modification visite effectuee", $this->id_user, "crm");
					$this->getUser()->setFlash('success','Visite a &eacute;t&eacute; modifi&eacute;e avec succe&eacute;s !');
				}
				$dbh->query("update  tts_visites_planifiees  set realise='1' where id='$this->id_visiteP'");
				$this->redirect("Calendar");

			}


		// ------------------------------------------------------------------------

		// close connection -------------------------------------------------------
		 
	}

	function get_lundi_dimanche_from_week($week,$year)
	{
		if (strftime ( "%W", mktime ( 0, 0, 0, 01, 01, $year ) ) == 1) {
			$mon_mktime = mktime ( 0, 0, 0, 01, (01 + (($week - 1) * 7)), $year );
		} else {
			$mon_mktime = mktime ( 0, 0, 0, 01, (01 + (($week) * 7)), $year );
		}
		$decalage = 0;
		if (date ( "w", $mon_mktime ) == 0)
			$decalage = (6 * 60 * 60 * 24);
		
		if (date ( "w", $mon_mktime ) >= 1)
			$decalage = ((date ( "w", $mon_mktime ) - 1) * 60 * 60 * 24);
		
		$lundi = $mon_mktime - $decalage;
		$dimanche = $lundi + (6 * 60 * 60 * 24);
		
		return array (
				date ( "Y-m-d", $lundi ),
				date ( "Y-m-d", $dimanche ) 
		);
	}

	public function executeSupprimer(sfWebRequest $request)
	{
		// set connection ---------------------------------------------------------
		$dbh = Common::TTSConnect();
		Form::$AUTH_ZERO = true;
		//get parametrs------------------------------------------------------
		$id = $request->getParameter('id');
		$this->id_user= $this->getUser()->getId();
		if($id && !$this->getUser()->hasCredential('allvisite'))
		 {
		 	
		 	$firmes = $dbh->query("select count(v.id) as cnt
			FROM tts_visites_realisees v where v.id_utilisateur=$this->id_user and v.id=$id")->fetchAll();
			if($firmes[0]['cnt']=='0') $this->redirect("Calendar");
		 }
		try {
			$dbh->query("delete from tts_visites_realisees where id='$id'");
			$this->getUser()->setFlash('error','La visite r&eacute;alis&eacute;e a bien &eacute;t&eacute; supprim&eacute;e');
		}catch( Exception $e ){
			$this->getUser()->setFlash('error','une erreur est survenue au niveau de la suppression! veuillez contacter votre administrateur !');
	
		}
		$this->redirect("visite_effectuee/calendar");
	}
}