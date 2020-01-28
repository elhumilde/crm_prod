<?php

class ReclamationActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		// set connection ---------------------------------------------------------
		$dbh = Common::TTSConnect();
		// ------------------------------------------------------------------------

		//declare objet filter ----------------------------------------------------
		$this->oFilter = new Filter("tts_reclamation","r","crm");
		// ------------------------------------------------------------------------
		// add field not exist in table -------------------------------------------
		$this->oFilter->addField('date_from');
		$this->oFilter->addField('date_to');
		$this->oFilter->addField('is_resoluee');
		// ------------------------------------------------------------------------
		$this->oFilter->addFilter("r.date_reclamation >= :date_from");
		$this->oFilter->addFilter("r.date_reclamation <= :date_to");
		// add filter query of field not exist in table ---------------------------
		//$this->oFilter->andWhere("actif=1");
			
		// ------------------------------------------------------------------------

		// get query filter -------------------------------------------------------

		// get data ---------------------------------------------------------------
		// ------------------------------------------------------------------------
		$res = $this->oFilter->getData("is_resoluee");
		$resolue = "";
		if($res != null){
		    $this->oFilter->andWhere(" ifnull(r.is_resolue,0) = $res");
		}
		
		// set principal query ----------------------------------------------------
		$this->id_user= $this->getUser()->getId();
		$this->code_commercial= $this->getUser()->getCode();
		
		$firme_cond="";
		if(!$this->getUser()->hasCredential('allreclamation')){
		    $this->oFilter->andWhere(" r.id_createur=$this->id_user");
		}

		$queryFilter = $this->oFilter->getFilter();

		$code_firme=$this->oFilter->getData('code_firme');
		if($code_firme){
		    $firme_array = $dbh->query("select f.firme from tts_firmes f where f.code_firme='$code_firme'")->fetch();
		    $this->firme=$firme_array["firme"];
		}
		//operation ---------------------------------------------------------------
			
			
		// setup param of filter --------------------------------------------------
		$this->filter = $this->oFilter->setup();
		// ------------------------------------------------------------------------

		// set principal query ----------------------------------------------------

		
		$req = "
		SELECT r.id,r.code,r.date_reclamation,g.libelle,c.firme,
		CONCAT( u.nom,' ', u.prenom ) AS createur,CONCAT( cc.nom,' ', cc.prenom ) AS contact,
		r.description,r.objet,r.is_resolue,r.date_resolution,s.libelle as service
		FROM tts_reclamation r
		left outer JOIN par_tts_gravite_reclamation g ON r.id_gravite = g.id
		left outer JOIN par_tts_service s ON r.id_service = s.id
		left outer JOIN tts_firmes c ON r.code_firme = c.code_firme
		left outer JOIN tts_firme_contact cc ON cc.code_contact = r.code_contact
		left outer join tts_utilisateur u on r.id_createur= u.id 
		    ";

		$req .= $queryFilter.$resolue;
		$req .=   $firme_cond ;
		$req .= "  group by  r.id,r.code,r.date_reclamation,g.libelle,c.firme     , CONCAT( u.nom,' ', u.prenom ), CONCAT( cc.nom,' ', cc.prenom ) ,
		r.description,r.objet,r.is_resolue,r.date_resolution,s.libelle 
		order by r.id desc";

		Common::setTracabilite("Reclamation", '', "Recherche Reclamation", $this->id_user, "crm");
				
		$this->data = $dbh->query($req)->fetchAll();
	}

	public function executeAjouter(sfWebRequest $request)
	{
		// set connection ---------------------------------------------------------
		$dbh = Common::TTSConnect();
		Form::$AUTH_ZERO = true;
		// ------------------------------------------------------------------------

		//get parameter -----------------------------------------------------------
		$id = $request->getParameter('id');
		$this->id = $id;
		$code = $request->getParameter('code');
		$this->id_user= $this->getUser()->getId();
		$this->code_commercial= $this->getUser()->getCode();
		if($id && !$this->getUser()->hasCredential('allreclamation'))
		 {
		 	
		 	$firmes = $dbh->query("select count(r.id) as cnt
			FROM tts_reclamation r where r.id_createur=$this->id_user and r.id=$id")->fetchAll();
			if($firmes[0]['cnt']=='0')
		 		$this->redirect("Reclamation/Index");
		 }
		
		$login = $this->getUser()->getId();
		$this->login = $login;
		// declare objet Form -----------------------------------------------------
		$this->oForm = new Form("tts_reclamation","id","crm");


	    if($code)
		{
		    $this->oForm = $this->oForm->find('code',$code);

		}
		elseif($id) {
			$this->oForm = $this->oForm->find('id',$id);
			//$this->oFormHU->setFKey(array("id_opportunite"), array($id));
		}
		if($id || $code)
		{
		    $code_firme=$this->oForm->getData('code_firme');
		    $firme_array = $dbh->query("select f.firme from tts_firmes f where f.code_firme='$code_firme'")->fetch();
		    $this->firme=$firme_array["firme"];
		}

		// ------------------------------------------------------------------------
		// get data ---------------------------------------------------------------
		$createur = $id ? $this->oForm->getData("id_createur") : $login;
		$this->createur = $dbh->query("select concat(nom,' ',prenom) as createur from tts_utilisateur where id =$createur")->fetch(pdo::FETCH_ASSOC | pdo::FETCH_COLUMN);
		// ------------------------------------------------------------------------

		//operation ---------------------------------------------------------------


		// ------------------------------------------------------------------------

		//set value par default of field ------------------------------------------
		if(!$id){
			$code = Common::getCompteur('Reclamation','tts_compteur','crm');
		}
		if(!$id) {
			$this->oForm->setFixedValue("date_creation",date('d/m/Y'));
			$this->oForm->setFixedValue("code",$code);
			$this->oForm->setFixedValue("id_createur",$login);
		}
		// ------------------------------------------------------------------------

		//set options of field ----------------------------------------------------

		//validation ------------------------------------------------------------

		// ------------------------------------------------------------------------
		// ------------------------------------------------------------------------

		//validation ------------------------------------------------------------

		// ------------------------------------------------------------------------

		// setup param of form ----------------------------------------------------
		$this->form = $this->oForm->setup();

		// ------------------------------------------------------------------------

		// save data of form ------------------------------------------------------


		$res = $this->oForm->save();
		if($res){

			if(!$id){
				Common::setTracabilite("Reclamation", $res['id'], "Ajout reclamation", $login, "crm");
				Common::validCompteur('Reclamation','tts_compteur','crm');
				$this->getUser()->setFlash('success','La r&eacute;clamation a &eacute;t&eacute; ajout&eacute;e avec succ&egrave;s !');
			}else{
				Common::setTracabilite("Reclamation", $res['id'], "Modification reclamation", $login, "crm");
				$this->getUser()->setFlash('success','La r&eacute;clamation a &eacute;t&eacute; modifi&eacute;e avec succ&egrave;s !');
			}

			$this->redirect("AjouterReclamation",array("id" => $res['id']));
		}

		// ------------------------------------------------------------------------

		// close connection -------------------------------------------------------
		
	}

	public function executeResoluer(sfWebRequest $request)
	{
		// set connection ---------------------------------------------------------
		$dbh = Common::TTSConnect();
		// ------------------------------------------------------------------------
		$login = $this->getUser()->getId();
		
		//get parameter -----------------------------------------------------------
		$id = $request->getParameter('id');
		//------------------------------------------------------------------------//
		$dbh->query("update tts_reclamation set is_resolue=1 , date_resolution=CURRENT_DATE where id = '$id'");
			
		$this->getUser()->setFlash('success','La reclamation a &eacute;t&eacute; clotur&eacute;e avec succ&egrave;s !');
		Common::setTracabilite("Reclamation", $id, "cloturer reclamation", $login, "crm");
			
		$this->redirect("AjouterReclamation",array("id"=>$id));
	}

	public function executeSupprimer(sfWebRequest $request)
	{
		// set connection ---------------------------------------------------------
		$dbh = Common::TTSConnect();
		Form::$AUTH_ZERO = true;
		//get parametrs------------------------------------------------------
		$id = $request->getParameter('id');
		$this->id_user= $this->getUser()->getId();
		if($id && !$this->getUser()->hasCredential('allreclamation'))
		 {
		 	
		 	$firmes = $dbh->query("select count(r.id) as cnt
			FROM tts_reclamation r where r.id_createur=$this->id_user and r.id=$id")->fetchAll();
			if($firmes[0]['cnt']=='0')
		 		$this->redirect("Reclamation/Index");
		 }
		
		try {
			$dbh->query("delete from tts_reclamation where id='$id'");
			$this->getUser()->setFlash('error','La reclamation a bien &eacute;t&eacute; supprim&eacute;e');
		}catch( Exception $e ){
			$this->getUser()->setFlash('error','une erreur est survenue au niveau de la suppression! veuillez contacter votre administrateur !');
	
		}
		$this->redirect("Reclamation/Index");
	}
}