<?php


class OpportuniteActions extends sfActions
{

	public function executeIndex(sfWebRequest $request)
	{
		// set connection ---------------------------------------------------------
		$dbh = Common::TTSConnect();
		// ------------------------------------------------------------------------
		 
		//declare objet filter ----------------------------------------------------
		$this->oFilter = new Filter("tts_opportunite","op","crm");
		// ------------------------------------------------------------------------
		 
		// add field not exist in table -------------------------------------------
		$this->oFilter->addField('date_opportunite_from');
		$this->oFilter->addField('date_opportunite_to');
		$this->oFilter->addField('statut_avance');
		// ------------------------------------------------------------------------

		// ------------------------------------------------------------------------
		$this->oFilter->setValue('statut_avance', '1');
		
		// add filter query of field not exist in table ---------------------------
		$this->oFilter->addFilter("op.date_creation >= :date_opportunite_from");
		$this->oFilter->addFilter("op.date_creation <= :date_opportunite_to");
		$this->oFilter->addFilter("op.id_statut_opportunite = :statut_avance");
		//$this->oFilter->setFieldArray("statut_avance");
		
		// get query filter -------------------------------------------------------
		$queryFilter = $this->oFilter->getFilter();
		// ------------------------------------------------------------------------

		// setup param of filter --------------------------------------------------
		$this->filter = $this->oFilter->setup();

		// -----------------------------------------------------

		$code_firme=$this->oFilter->getData('code_firme');
		if($code_firme){
		    $firme_array = $dbh->query("select f.firme from tts_firmes f where f.code_firme='$code_firme'")->fetch();
		    $this->firme=$firme_array["firme"];
		}
		// set principal query ----------------------------------------------------
		$this->id_user= $this->getUser()->getId();
		$this->code_commercial= $this->getUser()->getCode();
		$firme_cond="";
		$this->ids_users_affecte=$this->getUser()->getIds_user_affecte();
		$codes_users_affecte=$this->getUser()->getCodes_user_affecte();
	   if(!$this->getUser()->hasCredential('allopportunite')){
		 	
		 	$firme_cond=" AND ( op.id_createur in ($this->ids_users_affecte) Or 
		 						op.code_commercial in ($codes_users_affecte) )";
		}
		
		if(isset($_POST)){
			$req = "
			select f.*,op.code, op.id as id_op,op.date_creation,op.date_echeance,op.objet, 
			os.statut as statut_name, ot.type as type_name,concat(u.prenom,' ',u.nom) as commercial
			FROM tts_opportunite op
			inner join par_tts_opportunite_statut os on os.id = op.id_statut_opportunite
			left outer join par_tts_opportunite_type ot on ot.id = op.id_type_opportunite
			left outer join tts_firmes f ON f.code_firme = op.code_firme 
			left outer join tts_utilisateur u ON u.code_commercial = op.code_commercial ";
			$req .= (!$queryFilter ? " WHERE 1=1 " : $queryFilter." "). " $firme_cond  order by op.id desc";
			
			$this->data = $dbh->query($req)->fetchAll();

			Common::setTracabilite("Opportunite", '', "Recherche opportunites", $this->id_user, "crm");
			
		}else $this->data = array();
		// ------------------------------------------------------------------------

		// close connection -------------------------------------------------------
		
	}
	public function executeAjouter(sfWebRequest $request)
	{
		// set connection ---------------------------------------------------------
		$dbh = Common::TTSConnect();
		// ------------------------------------------------------------------------

		//get parameter -----------------------------------------------------------
		$id = $request->getParameter('id');
		$this->id = $id;
		$code_firme = $request->getParameter('code_firme');
		$this->code_firme = $code_firme;
		
		$code = $request->getParameter('code');
		$this->id_user= $this->getUser()->getId();
		$this->code_commercial = $this->getUser()->getCode();
		
		$this->ids_users_affecte=$this->getUser()->getIds_user_affecte();
		if($id && !$this->getUser()->hasCredential('allopportunite'))
		 {
		     $codes_users_affecte=$this->getUser()->getCodes_user_affecte();
		 	$firmes = $dbh->query("select count(op.id) as cnt
			FROM tts_opportunite op where (op.id_createur in ($this->ids_users_affecte) Or
		         op.code_commercial in ($codes_users_affecte) ) and op.id=$id")->fetchAll();
			if($firmes[0]['cnt']=='0')
		 		$this->redirect("Opportunite/Index");
		 }
		
		$login = $this->getUser()->getId();
		$this->login = $login;


		// ------------------------------------------------------------------------
		 
		// declare objet Form -----------------------------------------------------
		$this->oForm = new Form("tts_opportunite", "id","crm");
		if(!$request->getParameter('dupliquer'))
		{
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
			if ($code_firme) {
			    $this->oForm->setValue('code_firme', $code_firme);
			    $rs_comp = $dbh->query("select f.rs_comp
			        FROM tts_firmes f where f.code_firme='$code_firme'")->fetchAll(PDO::FETCH_COLUMN);
			    $this->firme = $rs_comp[0];
			}
		}
		if(!$id or $request->getParameter('dupliquer')){
			$code = Common::getCompteur('OPP','tts_compteur','crm');
			$this->oForm->setFixedValue('code',$code);
			$this->oForm->setFixedValue('date_creation',date("d/m/Y"));
			$this->oForm->setFixedValue('id_createur',$login);
			$this->oForm->setValue('code_commercial',$this->code_commercial);
			if($id && !$this->getUser()->hasCredential('allopportunite'))
			{
			     $this->oForm->setFixedValue('code_commercial',$this->code_commercial);
			}
			$this->oForm->setValue('id_statut_opportunite',"1");
		}

		 
		// ------------------------------------------------------------------------
		 
		//set options of field ----------------------------------------------------
		// ------------------------------------------------------------------------
		 
		//validation ------------------------------------------------------------
		 
		// ------------------------------------------------------------------------
		 
		// setup param of form ----------------------------------------------------
		$this->form = $this->oForm->setup();


		$res = $this->oForm->save();
		 
		if($res){

			if(!$id){
				Common::setTracabilite("Opportunite", $res['id'], "Ajout opportunite", $login, "crm");
				Common::validCompteur('OPP','tts_compteur','crm');
				$this->getUser()->setFlash('success','L\'opportunit&eacute; a &eacute;t&eacute; ajout&eacute;e avec succ&egrave;s !');
			}else{
				Common::setTracabilite("Opportunite", $res['id'], "Modification opportunite", $login, "crm");
				$this->getUser()->setFlash('success','L\'opportunit&eacute; a &eacute;t&eacute; modifi&eacute;e avec succ&egrave;s !');
			}
			 
			$this->redirect("Ajouter_Opportunite",array("id" => $res['id']));
		}
		 
		// ------------------------------------------------------------------------
		 
		// close connection -------------------------------------------------------
		
	}

	public function executeSupprimer(sfWebRequest $request)
	{
		// set connection ---------------------------------------------------------
		$dbh = Common::TTSConnect();
		Form::$AUTH_ZERO = true;
		//get parametrs------------------------------------------------------
		$id = $request->getParameter('id');
		$this->id_user= $this->getUser()->getId();
		$this->code_commercial = $this->getUser()->getCode();
		if($id && !$this->getUser()->hasCredential('allopportunite'))
		 {
		 	
		 	$firmes = $dbh->query("select count(op.id) as cnt
			FROM tts_opportunite op where (op.id_createur=$this->id_user Or op.code_commercial = '$this->code_commercial') and op.id=$id")->fetchAll();
			if($firmes[0]['cnt']=='0')
		 		$this->redirect("Opportunite/Index");
		 }
		try {
			$dbh->query("delete from tts_opportunite where id='$id'");
			$this->getUser()->setFlash('error','L\'opportunit&eacute; a bien &eacute;t&eacute; supprim&eacute;e');
		}catch( Exception $e ){
			$this->getUser()->setFlash('error','une erreur est survenue au niveau de la suppression! veuillez contacter votre administrateur !');
	
		}
		$this->redirect("Opportunite/Index");
	}
}
