<?php

/**
 * Objectif actions.
 *
 * @package    symfony
 * @subpackage Objectif
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ObjectifActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
      // set connection ---------------------------------------------------------
      $connection_crm = Doctrine_Manager::getInstance()->getConnection('crm');
      $dbh_crm = $connection_crm->getDbh();
      $db = $connection_crm->getOptions();
      $dsn = $db['dsn'];
      preg_match("/;dbname=(.+)/",$dsn,$base_web);
      $db_name = $base_web[1];
      
      // ------------------------------------------------------------------------
      $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
      $dbh_web = $connection->getDbh();

      
      //declare objet filter ----------------------------------------------------
      $this->oFilter = new Filter("tts_utilisateur","u","crm");
      
      $this->oFilter->addField('date_from');
      $this->oFilter->addField('date_to');
      $this->oFilter->addField('societe');
      $this->oFilter->addField('support');
      
      
      $date_from = $this->oFilter->getValue('date_from');
      $date_from = Common::convert_date($date_from,'Y-m-d');
      $date_to = $this->oFilter->getValue('date_to');
      $societe = $this->oFilter->getValue('societe');
      $support = $this->oFilter->getValue('support');
      $date_to = Common::convert_date($date_to,'Y-m-d');

      $this->code_commercial= $this->getUser()->getCode();
      $this->codes_users_affecte=$this->getUser()->getCodes_user_affecte();
      
      
      
      if(!$this->getUser()->hasCredential('allobjectif')){
      	$this->oFilter->andWhere(" ifnull(u.code_commercial, '') in ($this->codes_users_affecte)  ");
      }
      
      $act = $request->getParameter('act');

      if($_POST){
      	$cond_societe = "";
      	if($societe) $cond_societe = " and bc.societe = '$societe'";
      	if($support) $cond_societe = " and bc.support = '$societe'";
      	
      	$dbh_web->query("DROP TABLE IF EXISTS temp_reporting_objectif");
      	$dbh_web->query("CREATE table  temp_reporting_objectif AS (
      			select bc.num_bc, sum(bcd.prix_ht) as mtht, bc.date_bc, bc.code_firme, bc.courtier ,  bc.mt_ttc, bc.reglem_ttc,bc.support, bc.societe
      			from bon_commande bc
      			inner join detail_bc bcd on bcd.num_bc = bc.num_bc  and bcd.code_firme = bc.code_firme
      			where bc.date_bc >= '$date_from' and bc.date_bc <= '$date_to' $cond_societe
      			group by bc.num_bc, bc.date_bc, bc.code_firme, bc.courtier ,  bc.mt_ttc, bc.reglem_ttc,bc.support, bc.societe
      	)
      	
      	
      			");
      	
      			$dbh_web->query("DROP TABLE IF EXISTS temp_commande2");
      			$dbh_web->query("CREATE or replace view  temp_commande2 AS
      			(select bc.code_firme, bc.courtier, bc.societe, bc.support, bc.date_bc,  bc.num_bc, mt_ttc,
      			 ifnull(sum(prix_ht),0) as mt_ht,
      			ifnull(max(date_fin) ,DATE_ADD(bc.date_bc, INTERVAL 1 YEAR)) as date_fin
      			 from bon_commande bc
      			inner join detail_bc bcd on bcd.num_bc = bc.num_bc
             where year(date_bc) >= year(CURRENT_TIMESTAMP)-2  $cond_societe
			group by bc.code_firme, bc.courtier, bc.societe, bc.support, bc.date_bc,  bc.num_bc, mt_ttc
				)
	          ");
    
      }
     
      
      if($act)
      {
        $id_user = $request->getParameter('id_user');
        $queries = $this->getQuerie($date_from,$date_to,$id_user);
        $req =$queries[$act]['select_detail'].$queries[$act]['req'].$queries[$act]['jointure_detail'].$queries[$act]['where'].$queries[$act]['group_by'];
        
        $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
          $this->setTemplate("Detail");
      }      
      // ------------------------------------------------------------------------
      // get query filter -------------------------------------------------------
      $queryFilter = $this->oFilter->getFilter();
      // ------------------------------------------------------------------------
      // setup param of filter --------------------------------------------------
      $this->filter = $this->oFilter->setup();
      if($_POST) {
          
      	$queries = $this->getQuerie($date_from,$date_to);
      	
          $req ="select concat (u.nom,' ',u.prenom) as  Commercial , u.id as id_user, u.actif as Actif, g.libelle as groupe ";
          
          foreach ($queries as $key => $query) {
          	$req .="\n, (".$query['select_objectif'].$query['req'].$query['where'] ." ) as $key ";
          }
          
          
        $req .=  " from  $db_name.tts_utilisateur u 
				  left outer join $db_name.par_tts_groupe g on g.id = u.id_groupe
          		$queryFilter";
          
          $this->datas = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
          $login = $this->getUser()->getId();
          Common::setTracabilite("Repoting", '', "Consulter suivi des objectifs", $login, "crm");
      }
      else
        $this->datas = array();


  }
  


  public function getQuerie($date_from,$date_to,$id_user = null){
    $connection_crm = Doctrine_Manager::getInstance()->getConnection('crm');
    $dbh_crm = $connection_crm->getDbh();
    $db = $connection_crm->getOptions();
    $dsn = $db['dsn'];
    preg_match("/;dbname=(.+)/",$dsn,$base_web);
    $db_name = $base_web[1];
  	$queries= array();
  	if(!$id_user):
      $id_user="u.id";
      $code_commercial="ifnull(u.code_commande,u.code_commercial)";
    else :
      $user=$dbh_crm->query("select ifnull(u.code_commande,u.code_commercial) as code_commercial from $db_name.tts_utilisateur u where id=$id_user")->fetch(PDO::FETCH_ASSOC);
      $code_commercial= "'".$user["code_commercial"]."'";
    endif;
    
  	$queries["nb_nc"]= array(
  		"req" => " from temp_reporting_objectif bc
				  left outer join bon_commande bc2 on bc2.code_firme = bc.code_firme and bc2.date_bc < bc.date_bc and bc2.societe = bc.societe and bc2.support = bc.support
	  	",
  		"where" => " where bc2.num_bc is null and bc.date_bc >= '$date_from' and bc.date_bc <= '$date_to' and bc.courtier =  $code_commercial ",	
  		"select_objectif" => "select count( bc.num_bc ) "	,
  		"select_detail" => "select rs_comp,fi.id as id_firme,bc.num_bc, bc.mt_ttc, bc.reglem_ttc,bc.support,bc.societe",	
  		"jointure_detail" => " left outer join firmes fi on fi.code_firme = concat('MA', bc.code_firme)",
      "group_by" => "",
  		"title" => "Nombre Commande NC"
  	);
  	  	


  	$queries["nb_ac"]= array(
  			"req" => " from temp_reporting_objectif bc
		  	",
  			"where" => " where
  			not exists (select bc2.num_bc from bon_commande bc2 where bc2.code_firme = bc.code_firme and year(bc2.date_bc) = year(bc.date_bc)-1  and bc2.societe = bc.societe  and bc2.support = bc.support)
  			and exists (select bc2.num_bc from bon_commande bc2 where bc2.code_firme = bc.code_firme and year(bc2.date_bc) < year(bc.date_bc)-1  and bc2.societe = bc.societe and bc2.support = bc.support)
  			and bc.date_bc >= '$date_from' and bc.date_bc <= '$date_to' and bc.courtier =  $code_commercial ",
  			"select_objectif" => "select count( bc.num_bc ) "	,
  			"select_detail" => "select rs_comp, fi.id as id_firme,bc.num_bc, bc.mt_ttc, bc.reglem_ttc,bc.support,bc.societe",
  			"jointure_detail" =>  "left outer join firmes fi on fi.code_firme = concat('MA', bc.code_firme)",
  			"group_by" => " group by bc.num_bc, bc.mt_ttc, bc.reglem_ttc,bc.support,bc.societe, rs_comp",
  			"title" => "Nombre Commande Rem Client"
  	);
  	
  	$queries["nb_client"]= array(
  			"req" => " from temp_reporting_objectif bc
		  	",
  			"where" => " where
  			exists (select bc2.num_bc from bon_commande bc2 where bc2.code_firme = bc.code_firme and year(bc2.date_bc) = year(bc.date_bc)-1  and bc2.societe = bc.societe  and bc2.support = bc.support)
  			and bc.date_bc >= '$date_from' and bc.date_bc <= '$date_to' and bc.courtier =  $code_commercial ",
  			"select_objectif" => "select count( bc.num_bc ) "	,
  			"select_detail" => "select rs_comp,fi.id as id_firme,bc.num_bc, bc.mt_ttc, bc.reglem_ttc,bc.support,bc.societe",
  			"jointure_detail" =>  "left outer join firmes fi on fi.code_firme = concat('MA', bc.code_firme)",
  			"group_by" => " group by bc.num_bc, bc.mt_ttc, bc.reglem_ttc,bc.support,bc.societe, rs_comp",
  			"title" => "Nombre Commande Rem Client"
  	);
  	
  	$queries["nb_client_a_temps"]= array(
  			"req" => " from temp_reporting_objectif bc
		  	",
  			"where" => " where
  			exists (select bc2.num_bc from temp_commande2 bc2 where bc2.code_firme = bc.code_firme and year(bc2.date_fin) = year(bc.date_bc) and month(bc2.date_fin) >= month(bc.date_bc)  and bc2.societe = bc.societe  and bc2.support = bc.support)
			and bc.date_bc >= '$date_from' and bc.date_bc <= '$date_to' and bc.courtier =  $code_commercial ",  			"select_objectif" => "select count( bc.num_bc ) "	,
  			"select_detail" => "select rs_comp, fi.id as id_firme,bc.num_bc, bc.mt_ttc, bc.reglem_ttc,bc.support,bc.societe,  bc.date_bc",
  			"jointure_detail" => "left outer join firmes fi on fi.code_firme = concat('MA', bc.code_firme)",
  			"group_by" => " group by bc.num_bc, bc.mt_ttc, bc.reglem_ttc,bc.support,bc.societe, rs_comp, bc.date_bc",
  			"title" => "Nombre Commande Rem Client à temps"
  	);
  	
  	$queries["mt_nc"]= array(
  			"req" => " from temp_reporting_objectif bc
		  	left outer join bon_commande bc2 on bc2.code_firme = bc.code_firme and bc2.date_bc < bc.date_bc  and bc2.societe = bc.societe  and bc2.support = bc.support
  			",
  			"where" => " where bc2.num_bc is null and bc.date_bc >= '$date_from' and bc.date_bc <= '$date_to' and bc.courtier =  $code_commercial ",
  			"select_objectif" => "select sum(bc.mtht) "	,
  			"select_detail" => "select rs_comp,fi.id as id_firme,bc.num_bc, bc.mt_ttc, bc.mtht, bc.reglem_ttc,bc.support,bc.societe",
  			"jointure_detail" => " left outer join firmes fi on fi.code_firme = concat('MA', bc.code_firme)",
        "group_by" => " group by bc.num_bc, bc.mt_ttc, bc.mtht, bc.reglem_ttc,bc.support,bc.societe, rs_comp",
  		"title" => "Montant Commande NC"
  	);
  	



  	$queries["mt_ac"]= array(
  			"req" => " from temp_reporting_objectif bc
		  	",
  			"where" => " where
  			not exists (select bc2.num_bc from bon_commande bc2 where bc2.code_firme = bc.code_firme and year(bc2.date_bc) = year(bc.date_bc)-1  and bc2.societe = bc.societe  and bc2.support = bc.support)
  			and exists (select bc2.num_bc from bon_commande bc2 where bc2.code_firme = bc.code_firme and year(bc2.date_bc) < year(bc.date_bc)-1  and bc2.societe = bc.societe and bc2.support = bc.support)
  			and bc.date_bc >= '$date_from' and bc.date_bc <= '$date_to' and bc.courtier =  $code_commercial ",
  			"select_objectif" => "select sum(bc.mtht)  "	,
  			"select_detail" => "select rs_comp,fi.id as id_firme,bc.num_bc, bc.mt_ttc, bc.reglem_ttc,bc.support,bc.societe",
  			"jointure_detail" =>  "left outer join firmes fi on fi.code_firme = concat('MA', bc.code_firme)",
  			"group_by" => " group by bc.num_bc, bc.mt_ttc, bc.reglem_ttc,bc.support,bc.societe, rs_comp",
  			"title" => "Nombre Commande Rem Client"
  	);
  	
  	$queries["mt_client"]= array(
  			"req" => " from temp_reporting_objectif bc
		  	",
  			"where" => " where 
  			exists (select bc2.num_bc from temp_commande2 bc2 where bc2.code_firme = bc.code_firme and year(bc2.date_fin) = year(bc.date_bc)  and bc2.societe = bc.societe  and bc2.support = bc.support)
  			and bc.date_bc >= '$date_from' and bc.date_bc <= '$date_to' and bc.courtier =  $code_commercial ",
  			"select_objectif" => "select sum(bc.mtht) "	,
  			"select_detail" => "select  rs_comp,fi.id as id_firme,bc.num_bc, bc.mt_ttc, bc.mtht, bc.reglem_ttc,bc.support,bc.societe",
  			"jointure_detail" => "left outer join firmes fi on fi.code_firme = concat('MA', bc.code_firme)",
  			"group_by" => "group by bc.num_bc, bc.mt_ttc, bc.mtht, bc.reglem_ttc,bc.support,bc.societe, rs_comp",
  				
  			"title" => "Montant Commande Rem Client"
  	);
  	

  	$queries["mt_client_a_temps"]= array(
  			"req" => " from temp_reporting_objectif bc
		  	",
  			"where" => " where
  			exists (select bc2.num_bc from temp_commande2 bc2 where bc2.code_firme = bc.code_firme and MONTH(bc2.date_fin) >= month(bc.date_bc)  and year(bc2.date_fin) = year(bc.date_bc)  and bc2.societe = bc.societe and bc2.support = bc.support)
  			and bc.date_bc >= '$date_from' and bc.date_bc <= '$date_to' and bc.courtier =  $code_commercial ",
  			"select_objectif" => "select sum(bc.mtht) "	,
  			"select_detail" => "select rs_comp,fi.id as id_firme,bc.num_bc, bc.mt_ttc, bc.mtht, bc.reglem_ttc,bc.support,bc.societe",
  			"jointure_detail" => "left outer join societes s on bc.societe= s.id
							  	left outer join support supp on bc.support= supp.id
							  	left outer join firmes fi on fi.code_firme = concat('MA', bc.code_firme)",
  			"group_by" => " group by bc.num_bc, bc.mt_ttc, bc.mtht, bc.reglem_ttc,bc.support,bc.societe, rs_comp",
  			"title" => "Montant Commande Rem Client  a temps"
  	);
    
    $queries["nb_firme_maj"]= array(
        "req" => " from tts_historique_modification h ",
      "where" => "  where h.date_modification >= '$date_from' and h.date_modification <= '$date_to' and h.id_utilisateur = $id_user", 
        "select_objectif" => "select count( distinct code_firme) " ,
        "select_detail" => "select h.code_firme, fi.rs_comp, h.type_modification, h.champ, 
                              h.old_value, h.new_value, h.date_modification,fi.id as id_firme",
        "jointure_detail" => "inner join firmes fi on fi.code_firme = h.code_firme",
        "group_by" => "  ",
        "title" => "Nb firme enrichie"
    );
    
    $queries["nb_email"]= array(
        "req" => " from tts_historique_modification h ",
        "where" => "  where h.date_modification >= '$date_from' and h.date_modification <= '$date_to' and h.id_utilisateur = $id_user and champ='email' and (type_modification like '%ajout%')", 
        "select_objectif" => "select count( code_firme) " ,
        "select_detail" => "select h.code_firme, fi.rs_comp, h.type_modification, h.champ, h.old_value, h.new_value, h.date_modification,fi.id as id_firme",
        "jointure_detail" => "inner join firmes fi on fi.code_firme = h.code_firme",
        "group_by" => "  ",
        "title" => " Nb adresse email"
    );
  	
    $queries["nb_gsm"]= array(
        "req" => " from tts_historique_modification h ",
    	"where" => "  where h.date_modification >= '$date_from' and h.date_modification <= '$date_to' and h.id_utilisateur = $id_user and (champ='Portable' or champ='tel_1') and type_modification like '%ajout%'",	
        "select_objectif" => "select count( code_firme) " ,
        "select_detail" => "select h.code_firme, fi.rs_comp, h.type_modification, h.champ, h.old_value, h.new_value, h.date_modification,fi.id as id_firme",
        "jointure_detail" => "inner join firmes fi on fi.code_firme = h.code_firme",
        "group_by" => "  ",
        "title" => " Nb GSM"
    );
    
    $queries["nb_creation"]= array(
        "req" => " from tts_firme_ajoute t ",
		"where" => " where t.date_creation>= '$date_from' and t.date_creation <= '$date_to' and t.id_utilisateur = $id_user",
        "select_objectif" => "select count(*) " ,
        "select_detail" => "select t.code_firme, f.rs_comp,f.id as id_firme",
        "jointure_detail" => " 
          inner join firmes f on f.code_firme = t.code_firme
          ",
        "group_by" => "",
        "title" => "NB création"
    );
    //echo $queries["nb_creation"]["select_detail"].$queries["nb_creation"]["req"].$queries["nb_creation"]["jointure_detail"].$queries["nb_creation"]["where"]; die;
    $queries["nb_visite"]= array(
        "req" => " from $db_name. tts_visites_realisees t",
    "where" => " where t.date_visite<= '$date_from' and t.date_visite <= '$date_to' and t.id_utilisateur = $id_user",
        "select_objectif" => "select count(t.id) " ,
        "select_detail" => "select t.id, f.code_firme, f.rs_comp,f.id as id_firme,t.date_visite,t.heure_visite,tv.libelle , rv.resultat",
        "jointure_detail" => " inner join firmes f on f.code_firme = t.code_firme
                                inner join $db_name.tts_utilisateur u on u.id = t.id_utilisateur
                                left outer join $db_name.par_tts_visite_resultat rv on rv.id = id_resultat_visite
                                left join $db_name.par_tts_type_visite tv on tv.id = t.id_type_visite",
        "group_by" => "",
        "title" => "Nombre de visites/ Appels"
    );


    $queries["nb_fiche_rendu"]= array(
    		"req" => " from $db_name. tts_visites_realisees t",
    		"where" => " where t.id_resultat_visite in (1, 3 ) and t.date_visite>= '$date_from' and t.date_visite <= '$date_to'  and t.id_utilisateur = $id_user",
    		"select_objectif" => "select count(t.id) " ,
    		"select_detail" => "select t.id, f.code_firme, f.rs_comp,t.date_visite,t.heure_visite,tv.libelle , rv.resultat,f.id as id_firme",
    		"jointure_detail" => " inner join firmes f on f.code_firme = t.code_firme
    		inner join $db_name.tts_utilisateur u on u.id = t.id_utilisateur
    		left outer join $db_name.par_tts_visite_resultat rv on rv.id = id_resultat_visite
    		left join $db_name.par_tts_type_visite tv on tv.id = t.id_type_visite",
    		"group_by" => "",
    		"title" => "Nombre de visites/ Appels"
    );
    
    $queries["nb_opp"]= array(
        "req" => " from $db_name.tts_opportunite op ",
    	"where" => " where op.date_creation >= '$date_from' and op.date_creation <= '$date_to' and op.code_commercial = $code_commercial",
        "select_objectif" => "select count(*) " ,
        "select_detail" => "select f.code_firme, f.rs_comp,op.code, op.date_creation, op.date_echeance, 
                             op.objet, os.statut as statut_name, ot.type as type_name,f.id as id_firme",
        "jointure_detail" => " inner join $db_name.par_tts_opportunite_statut os on os.id = op.id_statut_opportunite
                              left outer join $db_name.par_tts_opportunite_type ot on ot.id = op.id_type_opportunite
                              left outer join firmes f ON f.code_firme = op.code_firme ",
        "group_by" => "",
        "title" => "Opportunité sur système"
    );

    $queries["nb_com"]= array(
        "req" => " from $db_name.tts_commentaire cmt ",
        "where" => " where cmt.date_creation >= '$date_from' and cmt.date_creation <= '$date_to' and 
                    cmt.id_createur = $id_user",
        "select_objectif" => "select count(cmt.id) " ,
        "select_detail" => "select cmt.code_firme,c.rs_comp,cmt.commentaire,cmt.date_creation,c.id as id_firme",
        "jointure_detail" => " left outer JOIN firmes c ON cmt.code_firme = c.code_firme ",
        "group_by" => "",
        "title" => "NB firme avec commentaires"
    );

    $queries["nb_reclamation"]= array(
        "req" => " from $db_name.tts_reclamation r ",
		"where" => " where r.date_creation >= '$date_from' and r.date_creation <= '$date_to' and r.id_createur  = $id_user ",
        "select_objectif" => "select count(*) " ,
        "select_detail" => "select r.code,r.date_reclamation,f.rs_comp,f.code_firme,s.libelle as service,r.objet,f.id as id_firme",
        "jointure_detail" => " 
    						  left outer JOIN $db_name.par_tts_service s ON r.id_service = s.id
                              left outer JOIN firmes f ON r.code_firme = f.code_firme",
        "group_by" => "",
        "title" => "NB Reclamation"
    );
    
    $queries["nb_rglt_temps"]= array(
    		"req" => " from (select  bc.num_bc, bc.mt_ttc, bc.reglem_ttc, bc.code_firme, max(rg.date_reg) as date_reg, sum(rg.mt_ttc) as mt_regl,  date_prev, bc.courtier from bon_commande bc
	        left outer join bon_commande_prev bcp on bcp.num_bc = bc.num_bc and bcp.code_firme  = bc.code_firme 
            left outer join detail_reglement rg on rg.num_bc =  bc.num_bc and rg.code_firme  = bc.code_firme 
    		where  bc.mt_ttc <= bc.reglem_ttc
    		group by  bc.num_bc, bc.mt_ttc, bc.reglem_ttc, bc.code_firme,  date_prev, bc.courtier 
    		
    		) aff
    		",
    		"where" => " where  aff.mt_ttc <= aff.reglem_ttc and aff.date_reg >= '$date_from' and aff.date_reg <= '$date_to' and aff.courtier =  $code_commercial and date_reg <= date_prev ",
    		"select_objectif" => "select count(*) " ,
    		"select_detail" => "select  * ",
    		"jointure_detail" => " ",
    		"group_by" => "",
    		"title" => "NB Reclamation"
    );
    
    
  	return $queries;
  }
  
  
}
