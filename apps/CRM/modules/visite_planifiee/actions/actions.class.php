<?php

class visite_planifieeActions extends sfActions
{

	public function executeIndex(sfWebRequest $request)
	{
		$this->forward('default', 'module');
	}
	
	
	
	public function executeAjouter(sfWebRequest $request)
	{

		// set connection ---------------------------------------------------------
		$dbh = Common::TTSConnect();
		Form::$AUTH_ZERO = true;
		// ------------------------------------------------------------------------

		$this->IDU = $this->getUser()->getId();
		//get parameter -----------------------------------------------------------
		$id = $request->getParameter('id');
		$code_firme = $request->getParameter('code_firme');
		$this->code_firme = $code_firme;
		$this->id_user= $this->getUser()->getId();
		$this->code_commercial= $this->getUser()->getCode();
		$this->ids_users_affecte=$this->getUser()->getIds_user_affecte();
		if($id && !$this->getUser()->hasCredential('allvisite'))
		 {	
		 	$firmes = $dbh->query("select count(v.id) as cnt
			FROM tts_visites_planifiees v where v.id_utilisateur in ($this->ids_users_affecte) and v.id=$id")->fetchAll();
			if($firmes[0]['cnt']=='0') $this->redirect("Calendar");
		 }

		
		$this->date = $request->getParameter('date');
		$this->id = $id;

		// declare objet Form -----------------------------------------------------
		$this->oForm = new Form("tts_visites_planifiees","id", "crm");
		
		if($id) {
			$this->oForm = $this->oForm->find('id',$id);
			$code_firme=$this->oForm->getData('code_firme');
			$firme_array = $dbh->query("select f.firme,id as id_firme from tts_firmes f where f.code_firme='$code_firme'")->fetch();
			$this->firme=$firme_array["firme"];
			$this->id_firme=$firme_array["id_firme"];
		}

		if($this->date){
			$this->oForm->setValue("date_visite",Common::convert_date($this->date,"d/m/Y"));
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
		if(!$id){
			$this->oForm->setFixedValue('actif',1);
			$this->oForm->setValue('id_utilisateur',$this->id_user);
		}



		// setup param of form ----------------------------------------------------
		$this->form = $this->oForm->setup();
		// ------------------------------------------------------------------------
				
			// save data of form ------------------------------------------------------
			$res = $this->oForm->save();
			if($res){
				if(!$id){
					Common::setTracabilite("Visites", $res['id'], "Ajout visite planifiee", $this->id_user, "crm");
					$this->getUser()->setFlash('success','Visite r&eacute;alis&eacute;e avec succ&eacute;s !');
				}else{
					Common::setTracabilite("Visites", $res['id'], "Modification visite planifiee", $this->id_user, "crm");
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
			FROM tts_visites_planifiees v where v.id_utilisateur=$this->id_user and v.id=$id")->fetchAll();
			if($firmes[0]['cnt']=='0') $this->redirect("Calendar");
		 }
		try {
			$dbh->query("delete from tts_visites_planifiees where id='$id'");
			Common::setTracabilite("Visites", $id, "Suppression visite planifiee", $this->id_user, "crm");
			$this->getUser()->setFlash('error','La visite r&eacute;alis&eacute;e a bien &eacute;t&eacute; supprim&eacute;e');
		}catch( Exception $e ){
			$this->getUser()->setFlash('error','une erreur est survenue au niveau de la suppression! veuillez contacter votre administrateur !');
	
		}
		$this->redirect("visite_planifiee/calendar");
	}
	
}