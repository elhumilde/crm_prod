<?php

/**
 * Historiqu actions.
 *
 * @package    ERP
 * @subpackage Historiqu
 * @author     TechTrend Solutions
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TracabiliteActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
 public function executeIndex(sfWebRequest $request)
  {
      // set connection ---------------------------------------------------------
	   $dbh = Common::TTSConnect();
	  // ------------------------------------------------------------------------
      	
      //declare objet filter ----------------------------------------------------
      $this->oFilter = new Filter("tts_tracabilite","t","crm");
      // ------------------------------------------------------------------------
      $this->oFilter->addField('date_from');
      $this->oFilter->addField('date_to');
      $this->oFilter->addField('id_utilisateur');
      // add filter query of field not exist in table ---------------------------
      $this->oFilter->addFilter("t.date >= :date_from");
      $this->oFilter->addFilter("t.date <= :date_to");
      $this->oFilter->addFilter("t.id_user = :id_utilisateur");
      // ------------------------------------------------------------------------
      // get query filter -------------------------------------------------------
      $queryFilter = $this->oFilter->getFilter();
      // ------------------------------------------------------------------------
      // setup param of filter --------------------------------------------------
      $this->filter = $this->oFilter->setup();
      
      if($_POST) {
            $req ="select t.*,concat(u.prenom,' ',u.nom) as fullname from tts_tracabilite t 
                    inner join tts_utilisateur u on u.id=t.id_user ";
        
        $req .= $queryFilter . " order by t.id desc limit 3000";
        $this->datas = $dbh->query($req)->fetchAll();

        $login = $this->getUser()->getId();
        Common::setTracabilite("Tracabilite", '', "Consulter Tracabilite modification", $login, "crm");
      }
        else
          $this->datas = array();
  }

  public function executeValide(sfWebRequest $request)
  {
    $dbh = Common::TTSConnect();
    // ------------------------------------------------------------------------
    $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
    $dbh_web = $connection->getDbh();
    $msg = "";
    
    $db = $connection->getOptions();
    $dsn = $db['dsn'];
    preg_match("/;dbname=(.+)/",$dsn,$base_web);
    $db_name = $base_web[1];
    $act = $request->getParameter('act');
    $raison = $request->getParameter('raison');
    $commentaire_rejet = addslashes($request->getParameter('commentaire_rejet'));
    $login = $this->getUser()->getId();
    
    $infos_user_connecte = $dbh->query("select u.email,concat(u.nom, ' ', u.prenom) as utilisateur from tts_utilisateur u where u.id = $login ")->fetch();
    
    
    if($act){
        //get parameter -----------------------------------------------------------
        $id = $request->getParameter('id');
        $ligne = $request->getParameter('ligne');
        //------------------------------------------------------------------------//
        
        $req="update $ligne set valide=$act,commentaire_rejet='$commentaire_rejet', date_validation=CURRENT_DATE,validateur=$login".
            (!$raison ? " " : ", raison_rejet='$raison' "). " where id = '$id'";
        $dbh_web->query($req);
        if($act==2)
          $libelle_raison = $dbh->query("select libelle from par_tts_raison where id = $raison")->fetch();
        if($ligne=="tts_firme_ajoute")
        {
            $firme_ajout = $dbh_web->query("select code_firme,rs_comp,id_utilisateur from $ligne where id=$id")->fetch();
            $dbh_web->query("update tts_historique_modification set valide=$act,commentaire_rejet='$commentaire_rejet', date_validation=CURRENT_DATE,validateur=$login where code_firme = '".$firme_ajout["code_firme"]."'");
            if($act==1){
              $pers_valide = $dbh_web->query("select ld.code_personne from lien_dirigeant ld 
                inner join tts_firme_ajoute fa on fa.code_firme=ld.code_firme where fa.id='$id'")->fetchAll();
              foreach ($pers_valide as $pers) {
                $dbh_web->query("update tts_personne_ajout set valide=$act,commentaire_rejet='$commentaire_rejet,date_validation=CURRENT_DATE,validateur=$login where code_personne = '".$pers["code_personne"]."'");
              }
              
            }
            
            if($act==2 && $firme_ajout && $firme_ajout["id_utilisateur"]){
              $infos_user = $dbh->query("select u.email,concat(u.nom, ' ', u.prenom) as utilisateur from tts_utilisateur u where u.id = $login or u.id=".$firme_ajout["id_utilisateur"])->fetchAll();
              $msg = " Rejet de la firme " . $firme_ajout['rs_comp']."<br>
                                Bonjour,<br>
               La firme '<b>".$firme_ajout['rs_comp']."</b> <br>
               a &eacute;t&eacute; rejet&eacute; par Mr/Mme ".$infos_user_connecte["utilisateur"]." le ".date("d/m/Y")." pour raison de ".$libelle_raison["libelle"]." <br>
               voici le commentaire de rejet ".$commentaire_rejet."<br>		
              <b>code firme  </b> : <br/>". str_replace("\n", "<br/>", $firme_ajout['code_firme']) . " <br>
                         
                              Cordialement <br>
                         
                                 ****************************
                                 <p>Mail Automatique envoy&eacute; par le serveur EDICOM</p>
                         ";
              $subject="Rejet de la firme " . $firme_ajout['rs_comp'];
            }
            
        }
        elseif($ligne=="tts_personne_ajout")
        {
            $personne_ajout = $dbh_web->query("select l.code_personne,l.id_utilisateur,concat(p.nom, ' ', p.prenom) as personne from $ligne l
              left outer join personne p on p.code_personne=l.code_personne where l.id=$id")->fetch();
            $dbh_web->query("update tts_historique_modification  set valide=$act, commentaire_rejet='$commentaire_rejet', date_validation=CURRENT_DATE,validateur=$login where (code_element = '".$personne_ajout["code_personne"]."'  Or ( new_value = '".$personne_ajout["code_personne"]."'  and champ = 'personne' and type_modification like '%ajout%'  ) )");
            if($act==2 && $personne_ajout && $personne_ajout["id_utilisateur"]){
              $infos_user = $dbh->query("select u.email,concat(u.nom, ' ', u.prenom) as utilisateur from tts_utilisateur u where u.id = $login or u.id=".$personne_ajout["id_utilisateur"])->fetchAll();
              $msg = " Rejet de la personne". $personne_ajout['personne']."<br>
                               
                                 Bonjour,<br>
                           Le diregeant '<b>".$personne_ajout['personne']."<b> <b>
                           a &eacute;t&eacute; rejet&eacute; par Mr/Mme ".$infos_user_connecte["utilisateur"]." le ".date("d/m/Y")." pour raison de <b>".$libelle_raison["libelle"]."</b> <br>
                           voici le commentaire de rejet ".$commentaire_rejet."<br>
                           <b>code personne  </b> : <br/>". $personne_ajout['code_personne'] . " <br>
                         
                              Cordialement <br>
                         
                                 ****************************
                                 <p>Mail Automatique envoy&eacute; par le serveur EDICOM</p>
                         ";
              
              $subject="Rejet de la personne " . $personne_ajout['personne'];
              $dbh_web->query("delete from lien_dirigeant where code_personne='".$personne_ajout["code_personne"]."'");
              
            }
        }
        Common::setTracabilite($ligne, $id, "validation d'une ".$ligne, $login, "crm");
        
        if ($act == 2 && $msg) {
				if (isset ( $infos_user [0] ['email'] )) {
					$emails = array($infos_user [0] ['email']  );
					if(isset ( $infos_user [1] ['email'] )){
						array_push($emails , $infos_user [1] ['email'] ) ;  
					}
					$res_email = $this->getUser ()->EnvoyerEmail ( $msg, $subject, $emails );
					/*$res_email = Common::envmail ( array (
							"from" => "testenvoi452@gmail.com",
							"to" => array (
									$infos_user [0] ['email'] 
							),
							"cc" => array (
									$infos_user [1] ['email'] 
							),
							"fromName" => "CRM EDICOM",
							"subject" => $subject,
							"host" => "smtp.gmail.com",
							"port" => "465",
							"secure" => "SSL",
							"message" => $msg 
					), "testenvoi452@gmail.com", "techtrend" );
					*/
					if (! $res_email)
						return $this->renderText ( json_encode ( "une erreur est survenue au niveau d'envoi d'email ! veuillez contacter votre administrateur !" ) );
				} else {
					return $this->renderText ( json_encode ( "une erreur est survenue au niveau d'envoi d'email ! les emails des personnes concernees ne sont pas parametres !" ) );
				}
			}
        
        die;
    }
    //declare objet filter ----------------------------------------------------
    $this->oFilterPersonne = new Filter("tts_utilisateur","u","crm");
    $this->oFilterPersonne->addField('annonceur');
    if($this->oFilterPersonne->getValue("annonceur")){
    	$annonceur = $this->oFilterPersonne->getValue("annonceur");
    	$this->oFilterPersonne->andWhere("ifnull(annonceur,2) = $annonceur");
    	
    }
    
    // get query filter -------------------------------------------------------
    $queryFilter = $this->oFilterPersonne->getFilter();
    // ------------------------------------------------------------------------
    // setup param of filter --------------------------------------------------
    $this->filterPersonne = $this->oFilterPersonne->setup();
    
    $this->firmes = $dbh->query("
                     select f.id, fi.id as id_firme,f.code_firme, f.rs_comp,s.libelle as service, ifnull(annonceur,2) as annonceur, f.date_creation as date, f.valide , concat(u.nom, ' ', u.prenom) as utilisateur
                     from $db_name.tts_firme_ajoute f
                    inner join $db_name.firmes fi on fi.code_firme = f.code_firme
                    left outer join tts_utilisateur u on u.id = f.id_utilisateur
                    left outer join par_tts_service s on s.id = u.id_service  ".
                    (!$queryFilter ? " WHERE 1=1 " : $queryFilter." "). " and ifnull(f.valide,0)=0")->fetchAll();

    $this->personnes = $dbh->query("
                    select pa.id as pa_id,d.id,p.code_personne,p.nom,p.prenom,s.libelle as service, ifnull(annonceur,2) as annonceur , fonc.fonction,d.tel_1,hist.date_modification,s.  libelle as service,
        d.email, d.code_firme, fi.rs_comp, fi.id as id_firme, concat(u.nom, ' ', u.prenom) as utilisateur
        from $db_name.tts_personne_ajout pa 
        left outer join tts_utilisateur u on u.id = pa.id_utilisateur 
        left outer join par_tts_service s on s.id = u.id_service 
        inner join $db_name.personne p on pa.code_personne=p.code_personne
        inner join $db_name.lien_dirigeant d on d.code_personne = p.code_personne 
        left outer join $db_name.civilite c on c.code=p.civilite
        left outer join $db_name.fonction fonc on fonc.code=d.code_fonction
        left outer join $db_name.tts_historique_modification hist on hist.new_value=p.code_personne and  champ='Personne' and type_modification like 'ajout%'
        inner join $db_name.firmes fi on fi.code_firme=d.code_firme ".
        (!$queryFilter ? " WHERE 1=1 " : $queryFilter." "). " and ifnull(pa.valide,0) = 0 ")->fetchAll();
    
    $this->historiques_firme = $dbh->query("
                    select h.id, h.code_firme,fi.id as id_firme,  fi.rs_comp as firme,s.libelle as service, ifnull(annonceur,2) as annonceur , h.old_value, h.new_value, h.champ, h.type_modification, h.date_modification, h.valide, concat(u.nom, ' ',u.prenom) as fullname, f.valide as valide_firme 
                    from $db_name.tts_historique_modification h
                    inner join tts_utilisateur u on u.id=h.id_utilisateur 
                    left outer join par_tts_service s on s.id = u.id_service 
                    left outer join $db_name.tts_firme_ajoute f on f.code_firme=h.code_firme 
                    left outer join $db_name.firmes fi on fi.code_firme=h.code_firme ".
                    (!$queryFilter ? " WHERE 1=1 " : $queryFilter." "). " and ifnull(h.valide,0)=0 and ifnull(f.valide,1)=1 ")->fetchAll();

  }

  public function executeValidation(sfWebRequest $request)
  {
    $dbh = Common::TTSConnect();
    // ------------------------------------------------------------------------
    $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
    $dbh_web = $connection->getDbh();
    
    $db = $connection->getOptions();
    $dsn = $db['dsn'];
    preg_match("/;dbname=(.+)/",$dsn,$base_web);
    $db_name = $base_web[1];
    $act = $request->getParameter('act');
    $raison = $request->getParameter('raison');
    //declare objet filter ----------------------------------------------------
    $this->oFilterPersonne = new Filter("tts_utilisateur","u","crm");

    $this->oFilterPersonne->addField('raison');
    $this->oFilterPersonne->addField('validation');
    $this->oFilterPersonne->addField('date_from');
    $this->oFilterPersonne->addField('date_to');
    $this->oFilterPersonne->addField('annonceur');

    // add filter query of field not exist in table ---------------------------
    $this->oFilterPersonne->addFilter("t.date_validation >= :date_from");
    $this->oFilterPersonne->addFilter("t.date_validation <= :date_to");
    $this->oFilterPersonne->addFilter("t.raison_rejet = :raison");
    $this->oFilterPersonne->addFilter("t.valide = :validation");
    if($this->oFilterPersonne->getValue("annonceur")){
    	$annonceur = $this->oFilterPersonne->getValue("annonceur");
    	$this->oFilterPersonne->andWhere("ifnull(annonceur,2) = $annonceur");
    	
    }

    // get query filter -------------------------------------------------------
    $queryFilter = $this->oFilterPersonne->getFilter();

    // setup param of filter --------------------------------------------------
    $this->filterPersonne = $this->oFilterPersonne->setup();
    $this->firmes = array();
    $this->personnes = array();
    $this->historiques_firme = array();
    
    if($_POST){
    	$this->firmes = $dbh->query ( "
    			select t.id, fi.id as id_firme,t.code_firme, t.rs_comp,s.libelle as service, t.date_creation as date, t.valide , concat(u.nom, ' ', u.prenom) as utilisateur,concat(v.nom, ' ', v.prenom) as validateur, t.valide as valide_firme,t.date_validation ,r.libelle as raison,t.commentaire_rejet
    			from $db_name.tts_firme_ajoute t
    			inner join $db_name.firmes fi on fi.code_firme = t.code_firme
    			left outer join tts_utilisateur u on u.id = t.id_utilisateur
    			inner join tts_utilisateur v on v.id = t.validateur
    			left outer join par_tts_raison r on r.id=t.raison_rejet
    			left outer join par_tts_service s on s.id = u.id_service " . (! $queryFilter ? " WHERE 1=1 " : $queryFilter . " ") )->fetchAll ();
			$this->personnes = $dbh->query ( "
    					select t.id as pa_id, t.valide, d.id,p.code_personne, p.nom, p.prenom, 
			             d.code_firme, fi.id as id_firme, fi.rs_comp, concat(u.nom, ' ', u.prenom) as utilisateur,
			             concat(v.nom, ' ', v.prenom) as validateur, t.valide as valide_firme,
			             t.date_validation ,r.libelle as raison,t.commentaire_rejet
    					from $db_name.tts_personne_ajout t
    					left outer join tts_utilisateur u on u.id = t.id_utilisateur
    					inner join tts_utilisateur v on v.id = t.validateur
    					left outer join par_tts_raison r on r.id=t.raison_rejet
    					left outer join par_tts_service s on s.id = u.id_service
    					inner join $db_name.personne p on t.code_personne=p.code_personne
    					inner join $db_name.lien_dirigeant d on d.code_personne = p.code_personne
    					left outer join $db_name.civilite c on c.code=p.civilite
    					left outer  join $db_name.fonction fonc on fonc.code=d.code_fonction
    					inner join $db_name.firmes fi on fi.code_firme=d.code_firme " . (! $queryFilter ? " WHERE 1=1 " : $queryFilter . " ") )->fetchAll ();
			$this->historiques_firme = $dbh->query ( "
    					select t.id, t.validateur, t.code_firme,fi.id as id_firme,  fi.rs_comp, t.old_value, t.new_value, t.champ, t.type_modification, t.date_modification, t.valide, concat(u.nom, ' ',u.prenom) as utilisateur,concat(v.nom, ' ', v.prenom) as validateur, t.valide as valide_firme,t.date_validation ,r.libelle as raison,t.commentaire_rejet
    					from $db_name.tts_historique_modification t
    					left outer join tts_utilisateur u on u.id = t.id_utilisateur
    					inner join tts_utilisateur v on v.id=t.validateur
    					left outer join par_tts_raison r on r.id=t.raison_rejet
    					left outer join $db_name.tts_firme_ajoute f on f.code_firme=t.code_firme
    					left outer join $db_name.firmes fi on fi.code_firme=t.code_firme " . (! $queryFilter ? " WHERE 1=1 " : $queryFilter . " ") )->fetchAll ();
    }
    
  }

  public function executeDerniereAction(sfWebRequest $request)
  {
      // set connection ---------------------------------------------------------
      $dbh = Common::TTSConnect();
      // ------------------------------------------------------------------------
       
      //declare objet filter ----------------------------------------------------
      $this->oFilter = new Filter("tts_tracabilite","t","crm");
      // ------------------------------------------------------------------------
      // get query filter -------------------------------------------------------
      $queryFilter = $this->oFilter->getFilter();
      // ------------------------------------------------------------------------
      // setup param of filter --------------------------------------------------
      $this->filter = $this->oFilter->setup();
      // ------------------------------------------------------------------------
      // set principal query ----------------------------------------------------
  
      
           $req ="
               select * from (
               select concat(u.prenom,' ',u.nom) as fullname , (select max(id) from tts_tracabilite t where u.id=t.id_user ) as max
               from tts_utilisateur u)aff
               left outer join tts_tracabilite t on t.id = aff.max
               
               ";
  
          
          $this->datas = $dbh->query($req)->fetchAll();
  
          $login = $this->getUser()->getId();
          Common::setTracabilite("Tracabilite", '', "Consulter Tracabilite modification", $login, "crm");
      
  }
  public function executeNombreConnexion(sfWebRequest $request)
  {
      // set connection ---------------------------------------------------------
      $dbh = Common::TTSConnect();
      // ------------------------------------------------------------------------
       
      //declare objet filter ----------------------------------------------------
      $this->oFilter = new Filter("tts_tracabilite","t","crm");
      // ------------------------------------------------------------------------
      $this->oFilter->addField('date_from');
      $this->oFilter->addField('date_to');
      // add filter query of field not exist in table ---------------------------
      $this->oFilter->addFilter("date_connexion >= :date_from");
      $this->oFilter->addFilter("date_connexion <= :date_to");
      $date_from = $this->oFilter->getValue('date_from');
      $date_from = Common::convert_date($date_from,'Y-m-d');
      $date_to = $this->oFilter->getValue('date_to');
      $date_to = Common::convert_date($date_to,'Y-m-d');
      
      // ------------------------------------------------------------------------
      // get query filter -------------------------------------------------------
      $queryFilter = $this->oFilter->getFilter();
      // ------------------------------------------------------------------------
      // setup param of filter --------------------------------------------------
      $this->filter = $this->oFilter->setup();
      // ------------------------------------------------------------------------
      // set principal query ----------------------------------------------------
  
      if($_POST) {
          $condition=!$queryFilter ? " WHERE 1=1 " : $queryFilter;
          $req ="select * from (select
                (select count(t.id) from tts_historique_connexion t $condition
                  and t.login=u.login and resultat = '1') as nbr,
                (select count(t.id) from tts_tracabilite t where t.date >= '$date_from' and t.date <= '$date_to'
                  and t.id_user=u.id ) as nbr_action,
                 concat(u.prenom,' ',u.nom) as fullname
                 from tts_utilisateur u )aff where nbr > 0 ";
  
          $this->datas = $dbh->query($req)->fetchAll();
  
          $login = $this->getUser()->getId();
          Common::setTracabilite("Tracabilite", '', "Consulter Tracabilite modification", $login, "crm");
      }
      else
          $this->datas = array();
  }
}
