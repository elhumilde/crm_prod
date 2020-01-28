<?php

class decouverteActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		// set connection ---------------------------------------------------------
		$dbh = Common::TTSConnect();
		// ------------------------------------------------------------------------

		//declare objet filter ----------------------------------------------------
		$this->oFilter = new Filter("tts_decouverte","d","crm");
		// ------------------------------------------------------------------------
		// add field not exist in table -------------------------------------------
		$this->oFilter->addField('date_from');
		$this->oFilter->addField('date_to');
		$this->oFilter->addFilter("d.date_creation >= :date_from");
		$this->oFilter->addFilter("d.date_creation <= :date_to");
		
		// set principal query ----------------------------------------------------
		$this->id_user= $this->getUser()->getId();
		$this->code_commercial= $this->getUser()->getCode();
		
		if(!$this->getUser()->hasCredential('alldecouverte')){
		    $this->oFilter->andWhere(" d.id_createur=$this->id_user");
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
		SELECT d.id,d.code_firme,d.date_creation,
		CONCAT( u.nom,' ', u.prenom ) AS createur, c.firme
		FROM tts_decouverte d
		left outer JOIN tts_firmes c ON d.code_firme = c.code_firme
		left outer join tts_utilisateur u on d.id_createur= u.id ";
		$req .= $queryFilter ."  order by d.id desc";
		
				
		$this->data = $dbh->query($req)->fetchAll();

		Common::setTracabilite("Decouverte", '', "Recherche decouverte", $this->id_user, "crm");
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
		$code_firme = $request->getParameter('code_firme');
		$this->code_firme = $code_firme;
		
		
		$this->id_user= $this->getUser()->getId();
		$this->code_commercial= $this->getUser()->getCode();
		if($id && !$this->getUser()->hasCredential('alldecouverte'))
		 {
		 	
		 	$firmes = $dbh->query("select count(d.id) as cnt
			FROM tts_decouverte d where d.id_createur=$this->id_user and d.id=$id")->fetchAll();
			if($firmes[0]['cnt']=='0')
		 		$this->redirect("decouverte/Index");
		 }
		
		$login = $this->getUser()->getId();
		$this->login = $login;
		// declare objet Form -----------------------------------------------------
		$this->oForm = new Form("tts_decouverte","id","crm");



		if ($code_firme) {
		    $this->oForm->setValue('code_firme', $code_firme);
		    $rs_comp = $dbh->query("select f.rs_comp
		        FROM tts_firmes f where f.code_firme='$code_firme'")->fetchAll(PDO::FETCH_COLUMN);
		    $this->firme = $rs_comp[0];
		}
		
		
	   elseif($id) {
			$this->oForm = $this->oForm->find('id',$id);
		    $code_firme=$this->oForm->getData('code_firme');
		    $firme_array = $dbh->query("select f.firme from tts_firmes f where f.code_firme='$code_firme'")->fetch();
		    $this->firme=$firme_array["firme"];
		}
		

		// ------------------------------------------------------------------------
		// get data ---------------------------------------------------------------
		$createur = $id ? $this->oForm->getData("id_createur") : $login;
		$this->createur = $dbh->query("select concat(nom,' ',prenom) as createur from tts_utilisateur where id =$createur")->fetch(pdo::FETCH_ASSOC | pdo::FETCH_COLUMN);

		if(!$id) {
			$this->oForm->setFixedValue("date_creation",date('d/m/Y'));
			$this->oForm->setFixedValue("id_createur",$login);
		}
		// ------------------------------------------------------------------------

		// setup param of form ----------------------------------------------------
		$this->form = $this->oForm->setup();

		// ------------------------------------------------------------------------

		// save data of form ------------------------------------------------------


		$res = $this->oForm->save();
		if($res){

			if(!$id){
				Common::setTracabilite("Decouverte", $res['id'], "Ajout decouverte", $login, "crm");
  	            $this->getUser()->setFlash('success','La d&eacute;couverte a &eacute;t&eacute; ajout&eacute;e avec succ&egrave;s !');
			}else{
				Common::setTracabilite("Decouverte", $res['id'], "Modification decouverte", $login, "crm");
				$this->getUser()->setFlash('success','La d&eacute;couverte a &eacute;t&eacute; modifi&eacute;e avec succ&egrave;s !');
			}

			$this->redirect("Ajouterdecouverte",array("id" => $res['id']));
		}

		// ------------------------------------------------------------------------

		// close connection -------------------------------------------------------
		
	}

}