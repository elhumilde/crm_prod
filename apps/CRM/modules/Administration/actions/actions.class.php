<?php

/**
 * Administration actions.
 *
 * @package    ERP
 * @subpackage Administration
 * @author     TechTrend Solutions
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdministrationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
public function executeUtilisateurs(sfWebRequest $request)
	{
		// set connection ---------------------------------------------------------
		$dbh = Common::TTSConnect();
		Form::$AUTH_ZERO = true;
		// ----------------------
		 
		//declare objet filter ----------------------------------------------------
		$this->oFilter = new Filter("tts_utilisateur","u", "crm");
		// ------------------------------------------------------------------------
		$login = $this->getUser()->getId();
		// add field not exist in table -------------------------------------------
		// ------------------------------------------------------------------------
	
		// add filter query of field not exist in table ---------------------------
		if($login != "1"){
		  $this->oFilter->andWhere(" u.id != '1' ");
		    
		}

		//$this->oFilter->andWhere(" u.actif = '1' ");
		// get query filter -------------------------------------------------------
		$queryFilter = $this->oFilter->getFilter();
		// ------------------------------------------------------------------------
		
		// get data ---------------------------------------------------------------
		// ------------------------------------------------------------------------
	
		//operation ---------------------------------------------------------------
	
		// setup param of filter --------------------------------------------------
		$this->filter = $this->oFilter->setup();
		// ------------------------------------------------------------------------
		 
		// set principal query ----------------------------------------------------
	
		$req = " select u.id, nom, prenom, login, email, GROUP_CONCAT( p.profil  SEPARATOR ' - ' ) as profil , s.libelle as service from tts_utilisateur u
		    left outer join tts_habilitation_utilisateur hu on hu.id_utilisateur = u.id 
		    left outer join tts_habilitation_profil p on p.id = hu.id_habilitation_profil 
		    left outer join par_tts_service s on s.id = u.id_service ";
		$req .= $queryFilter;
		$req .= " group by u.id, nom, prenom, login, email ";
		$this->data = $dbh->query($req)->fetchAll();

		Common::setTracabilite("Administration", '', "Recherche utilisateur", $login, "crm");
		 
	}
	
	
 public function executeIndex(sfWebRequest $request)
  {
  	
  }
  
  
  public function executeAjouterUser(sfWebRequest $request)
  {
    	
  	$dbh = Common::TTSConnect();
  	Form::$AUTH_ZERO = true;
  
  	// ------------------------------------------------------------------------
  
  	//get parameter -----------------------------------------------------------
  	$id = $request->getParameter('id');
  	$this->id = $id;
  	$act = $request->getParameter('act');
  	$login = $this->getUser()->getId();
  	// ------------------------------------------------------------------------
  	// declare objet Form -----------------------------------------------------
  	$this->oForm = new Form("tts_utilisateur","id", "crm");
  	$this->oFormHU = new Form("tts_habilitation_utilisateur","id", "crm");
  	$this->oFormHU->isArray();
  	$this->oFormUA = new Form("tts_utilisateur_affecte","id", "crm");
  	$this->oFormUA->isArray();
  	if($id) {
  		$this->oForm = $this->oForm->find('id',$id);
  	    $this->oFormHU->setFKey(array('id_utilisateur'), array($id));
  	    $this->oFormUA->setFKey(array('id_utilisateur'), array($id));
  	}
  	// ------------------------------------------------------------------------
  
  	// get data ---------------------------------------------------------------
  	$this->actif = array("1"=>"Oui","0"=>"Non");
  	
  	

  	if($login != "1"){
  	   $this->profil = $dbh->query("select * from tts_habilitation_profil order by profil")->fetchAll();
  	     
  	
  	}
  	else {
  	    $this->profil = $dbh->query("select * from tts_habilitation_profil  order by profil")->fetchAll();
  	     
  	}

  	$this->users = $dbh->query("select  ifnull(libelle,'NA') as service, u.id, concat(nom,' ', prenom) as user from tts_utilisateur u
  	    left outer join  par_tts_service s on s.id = u.id_service order by libelle, nom, prenom")->fetchAll(PDO::FETCH_GROUP);

  	
  	if($id) {
  	    $this->profil_user = $dbh->query("select id_habilitation_profil from tts_habilitation_utilisateur where id_utilisateur = '$id'")->fetchAll(PDO::FETCH_COLUMN);
  	    $this->utilisateurs_aff = $dbh->query("select id_utilisateur_affecte from tts_utilisateur_affecte where id_utilisateur= $id ")->fetchAll(PDO::FETCH_COLUMN);

  	}
  	else{
  	    $this->profil_user = array();
  	    $this->utilisateurs_aff = array();
  	}
  	
  	    
  	// ------------------------------------------------------------------------
  
  	//operation ---------------------------------------------------------------
  	// ------------------------------------------------------------------------
  
  	//set value par default of field ------------------------------------------
  if(!$id){

        $pass = $this->oForm->getData("pwd");
  		if($pass) $this->oForm->setFixedValue('pwd',md5($pass));
  		$this->oForm->setFixedValue('actif',1);
  		$this->oForm->setFixedValue('date_creation',date("d/m/Y"));
  	}
  	if(!empty($_POST)){
  		$this->oForm->setFixedValue('date_modif',date("d/m/Y"));
  	}


  	// ------------------------------------------------------------------------

  	// ------------------------------------------------------------------------
  	
  	//set options of field ----------------------------------------------------

  	$this->oFormHU->setOption('id_habilitation_profil', array("required"=>false));
  	$this->oFormUA->setOption('id_utilisateur_affecte', array("required"=>false));
  	// ------------------------------------------------------------------------
  	// ------------------------------------------------------------------------
  
  	//validation ------------------------------------------------------------
  
  	// ------------------------------------------------------------------------
  
  	// setup param of form ----------------------------------------------------
  	$this->form = $this->oForm->setup();
  	$this->formHU = $this->oFormHU->setup();
  	$this->formUA = $this->oFormUA->setup();
  	// ------------------------------------------------------------------------

  	// save data of form ------------------------------------------------------
  $res = $this->oForm->save();
  	if($res){
  	    
  	    if(!$id){
  	    
  	        Common::setTracabilite("Administration", $res['id'], "Ajout utilisateur", $login, "crm");
  	        $this->getUser()->setFlash('success','L\'utilisateur a &eacute;t&eacute; ajout&eacute; avec succ&egrave;s !');
  	    }else{
  	        if($_POST["newpwd"]){
  	            $newpassword = md5($_POST["newpwd"]);
      	        $dbh->query("Update tts_utilisateur set pwd='$newpassword' where id='$id'");
      	        Common::setTracabilite("Administration", $res['id'], "Modification de son mot de passe", $login, "crm");
  	        }
  	        
  	        Common::setTracabilite("Administration", $res['id'], "Modification Utilisateur", $login, "crm");
  	        $this->getUser()->setFlash('success','L\'utilisateur a &eacute;t&eacute; modifi&eacute; avec succ&egrave;s !');
  	    }
  	    
  		$this->oFormHU->addGlobalField('id_utilisateur', $res["id"]);
  		$this->oFormUA->addGlobalField('id_utilisateur', $res["id"]);
  		$id = $res['id'];
      	$dbh->query("delete from tts_habilitation_utilisateur where id_utilisateur = '$id'");
      	
      	$dbh->query("delete from tts_utilisateur_affecte where id_utilisateur = '$id'");
      	foreach($this->oFormHU->getData("id_habilitation_profil") as $k=>$c){
      	    $dbh->query("INSERT INTO tts_habilitation_utilisateur(
      	        id_utilisateur, id_habilitation_profil) VALUES ( '$id','$c');
      	        ");
      	}
      	
      	
      	foreach($this->oFormUA->getData("id_utilisateur_affecte") as $k=>$c){
      	    $dbh->query("INSERT INTO tts_utilisateur_affecte(
      	        id_utilisateur, id_utilisateur_affecte) VALUES ( '$id','$c');
      	        ");
      	}

      	
  		
  			
  		$this->redirect("AjouterUser",array("id" => $res['id']));
  	}

  }

  public function executeAjouterProfil(sfWebRequest $request)
  {
  	// set connection ---------------------------------------------------------
  	  	
  	$dbh = Common::TTSConnect();
  	Form::$AUTH_ZERO = true;
  
  	// ------------------------------------------------------------------------
  	 
  	//get parameter -----------------------------------------------------------
  	$id = $request->getParameter('id');
  	$this->id = $id;
  	$login = $this->getUser()->getId();
  	/// $this->login = $login;*/
  	// ------------------------------------------------------------------------
  	 
  	// declare objet Form -----------------------------------------------------
  	$this->oForm = new Form("tts_habilitation_profil","id", "crm");
  	$this->oFormH = new Form("tts_habilitation","id", "crm");
  	$this->oFormH->isArray();
  	
  	$this->all_actions_profil = $dbh->query("select ha.module, ha.id, ha.description, ifnull(h.id,'0') as selected
  	    from tts_habilitation_action ha
  	    left outer join tts_habilitation h on h.id_habilitation_action = ha.id and h.id_habilitation_profil = '$id'
  	    order by module, description
  	    ")->fetchAll(PDO::FETCH_GROUP);
  	
  	if($id) {
  		$this->oForm = $this->oForm->find('id',$id);
  		$this->oFormH->setFKey(array("id_habilitation_profil"), array($id));

  		    

  		    $this->h_profil = $dbh->query("select id_habilitation_action from tts_habilitation where id_habilitation_profil = '$id'")->fetchAll(PDO::FETCH_COLUMN);
  		    $this->utilisateurs = $dbh->query("select u.id, nom, prenom from tts_utilisateur u inner join tts_habilitation_utilisateur h
  		  									on h.id_utilisateur = u.id 	where u.actif = 1 and h.id_habilitation_profil = '$id'")->fetchAll();
  	}
  	else{
  	    $this->actions_profil = array();
  	    $this->h_profil  = array();
  	    $this->utilisateurs = array();
  	}
  	// ------------------------------------------------------------------------
  	 
  	// get data ---------------------------------------------------------------
  	
  									
  	// setup param of form ----------------------------------------------------
  	$this->form = $this->oForm->setup();
  	$this->formH = $this->oFormH->setup();
  	// ------------------------------------------------------------------------
  									 
  	// save data of form ------------------------------------------------------
  	$res = $this->oForm->save();
  	if ($res) {
            $this->oFormH->addGlobalField('id_habilitation_profil', $res["id"]);
            
            if (! $id) {
                Common::setTracabilite("Administration", $res['id'], "Ajout Profil", $login, "crm");
                $this->getUser()->setFlash('success', 'Le Profil a &eacute;t&eacute; ajout&eacute; avec succ&egrave;s !');
            } else {
                Common::setTracabilite("Administration", $res['id'], "Modification Profil", $login, "crm");
                $this->getUser()->setFlash('success', 'Le Profil a &eacute;t&eacute; modifi&eacute; avec succ&egrave;s !');
            }
            
            $id = $res['id'];
            $dbh->query("delete from  tts_habilitation where id_habilitation_profil = '$id'");
            
            foreach ($this->oFormH->getData("id_habilitation_action") as $k => $c) {
                $dbh->query("INSERT INTO tts_habilitation(
  	        id_habilitation_profil, id_habilitation_action) VALUES ( '$id','$c');
  	        ");
            }
            
            $this->redirect("AjouterProfil", array(
                "id" => $res['id']
            ));
        }
    }
  
  
  public function executeProfil(sfWebRequest $request)
  {
  	// set connection ---------------------------------------------------------
  	$connection = Doctrine_Manager::getInstance()->getConnection('crm');
  	$dbh = $connection->getDbh();
  	// ------------------------------------------------------------------------
  	 
  	//declare objet filter ----------------------------------------------------
  	$this->oFilter = new Filter("tts_habilitation_profil","h", "crm");
  	// ------------------------------------------------------------------------
  	$login = $this->getUser()->getId();
  	// add field not exist in table -------------------------------------------
  	// ------------------------------------------------------------------------
  	 
  	// add filter query of field not exist in table ---------------------------
  	// ------------------------------------------------------------------------
  	 
  	// get data ---------------------------------------------------------------
  	// ------------------------------------------------------------------------
  	 
  	// setup param of filter --------------------------------------------------
  	$this->filter = $this->oFilter->setup();
  	// ------------------------------------------------------------------------
  	 
  	// set principal query ----------------------------------------------------
  	 
  	$req = "
  	select h.id, h.profil, h.description, count(distinct u.id) as nb
  	from tts_habilitation_profil h
  	left outer join tts_habilitation_utilisateur hu on h.id = hu.id_habilitation_profil    
  	left outer join tts_utilisateur u on u.id = hu.id_utilisateur and u.actif = 1   
  	group by h.id, h.profil, h.description
  	";
  	
  	$this->data = $dbh->query($req)->fetchAll();

  	Common::setTracabilite("Administration", '', "Rechercher Profil", $login, "crm");
  }

  public function supprimer($dossierTempo){
  	$handle=opendir($dossierTempo);
  	while (false !== ($fichier = readdir($handle))) {
  		if (($fichier != ".") && ($fichier != "..")) {
  			unlink($dossierTempo.$fichier);
  		}
  	}
  }

  
  public function executeInitialiser(sfWebRequest $request)
  {
  	// set connection ---------------------------------------------------------
  	$connection = Doctrine_Manager::getInstance()->getConnection('crm');
  	$dbh = $connection->getDbh();
  	Form::$AUTH_ZERO = true;
  	// ------------------------------------------------------------------------
  
  	//get parameter -----------------------------------------------------------
  	$id = $request->getParameter('id');
  	$this->id = $id;
  	$login = $this->getUser()->getId();
  	$this->login = $login;
  	 
  	// ------------------------------------------------------------------------
  	 
  
  	// Initialisation du mot de passe ---------------------------------------------------------------
  
  	$dbh->query("Update tts_utilisateur set pwd='202cb962ac59075b964b07152d234b70' where id='$id'");
  	 
  	// -----------------------Traçabilité------------------------
  	$id_user = $this->getUser()->getId();
  	$this->getUser()->setFlash('success','Le Mot de passe a &eacute;t&eacute; initialis&eacute; avec succ&egrave;s !');

  	Common::setTracabilite("Administration", $id, "Initialiser mot de passe", $login, "crm");
  	$this->redirect("AjouterUser",array("id"=>$id));
  
  	// ------------------------------------------------------------------------
  
  	// close connection -------------------------------------------------------
  	$connection->close();
  }
  
  public function executeMonProfil(sfWebRequest $request)
  {
     	// set connection ---------------------------------------------------------
      $connection = Doctrine_Manager::getInstance()->getConnection('crm');
      $dbh= $connection->getDbh();
      // ------------------------------------------------------------------------
      $login = $this->getUser()->getId();
      $this->login = $login;
      // Get Data----------------------------------------------------------------
      $this->result = $dbh->query("select * from tts_utilisateur where id= '$login'")->fetch();
       
      // declare objet Form -----------------------------------------------------
      $this->oForm = new Form("tts_utilisateur","id","crm");
      // ------------------------------------------------------------------------
       
      $this->oForm = $this->oForm->find('id',$login);
      // get data ---------------------------------------------------------------
      if(!empty($_POST)){
          if(md5($_POST["oldpwd"])==$this->oForm->getData("pwd")){
              if($_POST["newpwd"]==$_POST["Confirmpwd"]){
                  $newpassword = md5($_POST["newpwd"]);
                  $dbh->query("Update tts_utilisateur set pwd='$newpassword' where id='$login'");
  				  Common::setTracabilite("Administration", $login, "Modification de son mot de passe", $login, "crm");
                  $this->getUser()->setFlash('success','Votre Mot de passe a &eacute;t&eacute; modifi&eacute; avec succ&egrave;s !');
              }else{
                  $this->getUser()->setFlash('error','Op&eacute;ration &eacute;chou&eacute;e la confirmation de Votre Mot de Passe est  Incorrect');
              }
          }else{
              $this->getUser()->setFlash('error','Op&eacute;ration &eacute;chou&eacute;e l\'ancien Mot de passe que vous avez saisi est Incorrect');
          }
          $this->redirect("MonProfil");
      }
  }

    public function executeCouleur(sfWebRequest $request)
    {
        // set connection ---------------------------------------------------------
        $connection = Doctrine_Manager::getInstance()->getConnection('crm');
        $dbh = $connection->getDbh();
        // ------------------------------------------------------------------------
        $login = $this->getUser()->getId();
        $this->login = $login;
        // Get Data----------------------------------------------------------------

        $act = $request->getParameter('act');
        
        // declare objet Form -----------------------------------------------------
        $this->oForm = new Form("tts_utilisateur", "id", "crm");
        // ------------------------------------------------------------------------
        
        $this->oForm = $this->oForm->find('id', $login);
        
        // ------------------------------------------------------------------------
        
        // setup param of form ----------------------------------------------------
        $this->form = $this->oForm->setup();
        
        // ------------------------------------------------------------------------
        if($act == "reinitialiser"){
            $dbh->query("update tts_utilisateur set couleur_menu = NULL, couleur_header = NULL, couleur_body = NULL where id = '$login'");
            $this->getUser()->setFlash('success', 'Vous devez vous reconnecter pour que vos modifications soient prises en compte!');
            $this->redirect("Couleur");
        }
        
        // save data of form ------------------------------------------------------
        $res = $this->oForm->save();
        if ($res) {
            $this->getUser()->setFlash('success', 'Vous devez vous reconnecter pour que vos modifications soient prises en compte!');
            
            $this->redirect("Couleur");
        }
    }
  
  
}
