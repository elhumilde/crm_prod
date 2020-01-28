<?php

/**
 * Reporting actions.
 *
 * @package    symfony
 * @subpackage Reporting
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReportingActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    // set connection ---------------------------------------------------------
    $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        // ------------------------------------------------------------------------
        $login = $this->getUser()->getId();
        
    // ------------------------------------------------------------------------

    //declare objet filter ----------------------------------------------------
    $this->oFilter = new Filter("bon_commande","bc","bd_web");
    
    $this->oFilter->addField('date_from');
    $this->oFilter->addField('date_to');
    $this->oFilter->addField('code_produit');
    
    $this->oFilter->addFilter("bc.date_bc >= :date_from");
    $this->oFilter->addFilter("bc.date_bc <= :date_to");
    $this->oFilter->addFilter("bcd.code_produit = :code_produit");
    
    // get query filter -------------------------------------------------------
    $queryFilter = $this->oFilter->getFilter();
    // ------------------------------------------------------------------------
    // setup param of filter --------------------------------------------------
    $this->filter = $this->oFilter->setup();
    
    if ($_POST) {
            
            $req = "
        select  ifnull(crt.nom_courtier, 'NA') as commercial, sum(prix_ht)*1.2 mt_ttc,  sum(prix_ht) as mt_ht , year(date_bc) as annee , month(date_bc)  as mois from 
        bon_commande bc
        inner join detail_bc bcd on bcd.num_bc = bc.num_bc 
            left outer join courtier crt on ifnull(crt.code, '') = ifnull(bc.courtier, '') 
        $queryFilter
            group by year(date_bc) , month(date_bc), crt.nom_courtier  ";
            
            $this->data = $dbh_web->query($req)->fetchAll();
            Common::setTracabilite("Reporting", "", "Reporting par commercial", $login, "crm");
            
        } 
    else {
        $this->data = array();
    }
  }
  
  public function executeRenouvellementCommande(sfWebRequest $request)
  {
      // set connection ---------------------------------------------------------
      $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
      $dbh_web = $connection->getDbh();
      // ------------------------------------------------------------------------
      $login = $this->getUser()->getId();
  
      // ------------------------------------------------------------------------
  
      //declare objet filter ----------------------------------------------------
      $this->oFilter = new Filter("bon_commande","bc","bd_web");
  
      $this->oFilter->addField('date_from');
      $this->oFilter->addField('date_to');
  
      $this->oFilter->addField('date_fin_from');
      $this->oFilter->addField('date_fin_to');
      $this->oFilter->addField('code_produit');

      $this->oFilter->addFilter("bc.date_bc >= :date_from");
      $this->oFilter->addFilter("bc.date_bc <= :date_to");
      $this->oFilter->addFilter("bcd.date_fin >= :date_fin_from");
      $this->oFilter->addFilter("bcd.date_fin <= :date_fin_to");
      $this->oFilter->addFilter("bcd.code_produit = :code_produit");
  
      $this->code_commercial= $this->getUser()->getCode();
      $codes_users_affecte=$this->getUser()->getCodes_user_affecte();
      
      if(!$this->getUser()->hasCredential('allbc')){
      
          $this->oFilter->andWhere(" u.id != '1' ");
          
          $firme_cond=" AND ifnull(bc.courtier, '') in ($codes_users_affecte) ";
      }
      
      // get query filter -------------------------------------------------------
      $queryFilter = $this->oFilter->getFilter();
      // ------------------------------------------------------------------------
      // setup param of filter --------------------------------------------------
      $this->filter = $this->oFilter->setup();
  
      if ($_POST) {
  
          $req = "
          select  rs_comp, ifnull(crt.nom_courtier, 'NA') as commercial,  prix_ht as mt_ht , date_bc , date_fin, mt_ttc as mt_bc_ttc, reglem_ttc, code_produit,
          ifnull((select sum(dr.mt_ttc) from detail_reglement dr where dr.code_firme = bc.code_firme and dr.num_bc = bc.num_bc and date_encais is not null ),0) as mt_encaisse from
          bon_commande bc
          inner join detail_bc bcd on bcd.num_bc = bc.num_bc
          left outer join courtier crt on ifnull(crt.code, '') = ifnull(bc.courtier, '')
          left outer join firmes f on f.code_firme = concat('MA', bc.code_firme) 
          $queryFilter  
          limit 10000
          ";
          $this->data = $dbh_web->query($req)->fetchAll();
          Common::setTracabilite("Reporting", "", "Suivi Renouvellement Commande", $login, "crm");
  
      }
          else {
          $this->data = array();
  }
          }
  
  
  public function executeEvolutionClient(sfWebRequest $request)
  {
      // set connection ---------------------------------------------------------
      $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
      $dbh_web = $connection->getDbh();
      // ------------------------------------------------------------------------
      $login = $this->getUser()->getId();
      
      $annee_actuelle = date('Y');
      $annee1 = $annee_actuelle - 1;
      $annee2 = $annee_actuelle - 2;
      $annee3 = $annee_actuelle - 3;
      $annee4 = $annee_actuelle - 4;
      // ------------------------------------------------------------------------
  
      //declare objet filter ----------------------------------------------------
      $this->oFilter = new Filter("bon_commande","bc","bd_web");
  
      

      // add filter query of field not exist in table ---------------------------
     
    $this->oFilter->addField('code_produit');
    $this->oFilter->andWhere("year(date_bc) >= $annee4");
      $this->oFilter->andWhere("prix_ht > 0");

      $this->oFilter->addFilter("bcd.code_produit = :code_produit");
      
      // get query filter -------------------------------------------------------
      $queryFilter = $this->oFilter->getFilter();
      // ------------------------------------------------------------------------
      // setup param of filter --------------------------------------------------
      $this->filter = $this->oFilter->setup();
  
      
      
      if($_POST){
            
          $req = "
          select rs_comp, max(if(annee = '$annee4' , mt_ht, 0) ) as N4 ,max(if(annee = '$annee3' , mt_ht, 0) ) as N3 ,
           max(if(annee = '$annee2' , mt_ht, 0) ) as N2,max(if(annee = '$annee1' , mt_ht, 0) ) as N1 , 
           max(if(annee = '$annee_actuelle' , mt_ht, 0) ) as N from ( 
            select rs_comp, sum(prix_ht) as mt_ht , year(date_bc) as annee from bon_commande bc 
            
        inner join detail_bc bcd on bcd.num_bc = bc.num_bc 
            left outer join firmes f on f.code_firme = concat('MA', bc.code_firme) 
            $queryFilter
            group by rs_comp, year(date_bc) 
       ) aff group by rs_comp
      ";
          $this->data = $dbh_web->query($req)->fetchAll();
          Common::setTracabilite("Reporting", "", "Reporting par client", $login, "crm");
           
      }
      else {
          $this->data = array();
      }
  }
  
  public function executeActiviteCommerciale(sfWebRequest $request)
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
      $this->oFilter = new Filter("bon_commande","bc","bd_web");
      
      $this->oFilter->addField('date_from');
      $this->oFilter->addField('date_to');
      $this->oFilter->addField('id_service');
      $this->oFilter->addField('id_groupe');
      $this->oFilter->addField('actif');
      $this->oFilter->addField('id_user');
      
      $this->oFilter->addField('date_fin_from');
      $this->oFilter->addField('date_fin_to');
      $this->oFilter->addField('code_produit');
      
      $this->oFilter->addFilter("bc.date_bc >= :date_from");
      $this->oFilter->addFilter("bc.date_bc <= :date_to");
      $this->oFilter->addFilter("bcd.code_produit = :code_produit");
      

      $this->oFilter->setValue("actif",1);
      
      $date_from = $this->oFilter->getValue('date_from');
      $date_from = Common::convert_date($date_from,'Y-m-d');
      $date_to = $this->oFilter->getValue('date_to');
      $date_to = Common::convert_date($date_to,'Y-m-d');

      $act = $request->getParameter('act');

      
      $this->code_commercial= $this->getUser()->getCode();
     
      $codes_users_affecte=$this->getUser()->getCodes_user_affecte();
      $id_users_affecte=$this->getUser()->getIds_user_affecte();
    $this->ids_users_affecte=$id_users_affecte;
      
      $cond_comm = "";
      if(!$this->getUser()->hasCredential('allactivitecommercialereporting')){
          $cond_comm=" AND ifnull(u.id, '') in ($id_users_affecte) ";
      }


      $actif= $this->oFilter->getValue('actif'); 
      $cond_actif = "";
      if(isset($actif)){
          if($actif==1){
            $cond_actif=" and u.actif=$actif ";
          }
          elseif($actif==2){

            $cond_actif=" and u.actif=0 ";
          }
      }

      $id_user= $this->oFilter->getValue('id_user');
      $cond_user = "";
      if($id_user){
          $cond_user=" and u.id=$id_user ";
      }
      
      $cond_service = "";
      $id_service = $this->oFilter->getData("id_service");
      if($id_service){
          $cond_service = " and id_service = '$id_service' ";
      }
      $id_groupe = $this->oFilter->getData("id_groupe");
      if($id_groupe){
        $cond_service .= " and id_groupe = '$id_groupe' ";
      }
      // ------------------------------------------------------------------------
      // get query filter -------------------------------------------------------
      $queryFilter = $this->oFilter->getFilter();
      // ------------------------------------------------------------------------
      // setup param of filter --------------------------------------------------
      $this->filter = $this->oFilter->setup();
      // ------------------------------------------------------------------------
      // set principal query ----------------------------------------------------
  

      //$date_recherche= date('Y-m-d', strtotime("-540 days"));
      
      if($_POST Or ($act && $act == 'detail_rem_prospect')) {
        
          $dbh_web->query("DROP temporary TABLE IF EXISTS temp_evenement");
          $dbh_web->query("CREATE temporary TABLE IF NOT EXISTS temp_evenement AS (select ev.code_firme, ev.courtier, societe from affectation ev group by  ev.code_firme, ev.courtier, societe)
          ");
          
          $dbh_web->query("DROP temporary TABLE IF EXISTS temp_reporting");
          $dbh_web->query("CREATE temporary TABLE IF NOT EXISTS temp_reporting AS (select concat('MA',ev.code_firme) as code_firme,bc.date_bc as date_bc,
               bc.num_bc as num_bc,ifnull( bc.mt_ttc,0) as mt_ht, ev.courtier, ev.societe, bc.support 
              from
                temp_evenement ev
                left outer join bon_commande bc on bc.code_firme = ev.code_firme and year(bc.date_bc) >= year(CURRENT_TIMESTAMP)-1  and bc.societe = ev.societe
              where ifnull( bc.mt_ttc,0) = 0      
          )
          ");
          
          
         
          
      }
      
      if($act)
      {
        $cond_groupe = "";
         
        $courtier = $request->getParameter('courtier');
        $date_from = Common::convert_date($request->getParameter('date_from'),'Y-m-d');
        $date_to = Common::convert_date($request->getParameter('date_to'),'Y-m-d');
        $id_user = $request->getParameter('id_user');
      $id_groupe = $request->getParameter('id_groupe');
      if($id_groupe) {
        $cond_groupe = " and u.id_groupe = $id_groupe ";
      }
      }
      if($_POST) {

          $req ="select concat (u.nom,' ',u.prenom) as  nom_courtier,u.id as id_user, u.actif,
            (select count(*) from $db_name.tts_opportunite o where o.code_commercial = u.code_commercial
             and o.date_creation >= '$date_from' and o.date_creation <= '$date_to'
            ) as nb_opp,
            (select count(t.id) from $db_name.tts_tracabilite t where t.date >= '$date_from' and t.date <= '$date_to'
                              and t.id_user=u.id ) as nbr_action,
            (select count(t.id) from $db_name. tts_visites_realisees t where t.date_visite >= '$date_from' and t.date_visite <= '$date_to'
                              and t.id_utilisateur=u.id ) as nbr_visite,


            (select count(a.id) from appel_televente a where a.date_appel >= '$date_from' and a.date_appel <= '$date_to'
                              and  a.operateur = ifnull(u.code_commercial, u.code_commande) ) as nbr_appel,

            (select count(t.id) from $db_name. tts_visites_planifiees t where t.date_visite >= '$date_from' and t.date_visite <= '$date_to'
                              and t.id_utilisateur=u.id ) as nbr_visite_p,
            (select count(t.id) from tts_historique_modification t where t.date_modification >= '$date_from' and t.date_modification <= '$date_to'
                              and t.id_utilisateur=u.id ) as nbr_modification,
            (select count(*) from $db_name.tts_reclamation where id_createur = u.id 
            and date_creation >= '$date_from' and date_creation <= '$date_to'
            ) as nb_reclamation,
            
            (select count(*) from $db_name.tts_decouverte where id_createur = u.id 
            and date_creation >= '$date_from' and date_creation <= '$date_to'
            ) as nb_decouverte,
            
            (select count(*)  from tts_firme_ajoute t
            inner join firmes f on f.code_firme = t.code_firme
            where t.id_utilisateur = u.id 
            and t.date_creation >= '$date_from' and t.date_creation <= '$date_to'
            ) as nb_creation,
            (select sum(r.mt_ttc)  from detail_reglement r inner join bon_commande bc on bc.num_bc = r.num_bc 
             where bc.courtier = ifnull(u.code_commande,u.code_commercial) and r.date_reg >= '$date_from'
                   and r.date_reg <= '$date_to'
                   ) as mt_regl,  
            (select sum(bcd.prix_ht)  from bon_commande bc inner join detail_bc bcd on bcd.num_bc = bc.num_bc 
                    $queryFilter and  bc.courtier = ifnull(u.code_commande,u.code_commercial) 
                   ) as mt_ht,  
            (select sum(prix_ht)  from bon_commande bc inner join detail_bc bcd on bcd.num_bc = bc.num_bc 
            left outer join bon_commande bc2 on bc2.code_firme = bc.code_firme and bc2.date_bc < bc.date_bc
                    $queryFilter and bc.courtier = ifnull(u.code_commande,u.code_commercial) and bc2.num_bc is null 
                   ) as mt_ht_nc
            ,  (select count(distinct bc.num_bc)  from bon_commande bc inner join detail_bc bcd on bcd.num_bc = bc.num_bc 
                    $queryFilter and bc.courtier = ifnull(u.code_commande,u.code_commercial) 
                   ) as nb_bc,  
                (select count(distinct bc.code_firme)  from bon_commande bc inner join detail_bc bcd on bcd.num_bc = bc.num_bc 
                $queryFilter and bc.courtier = ifnull(u.code_commande,u.code_commercial) 
               ) as nb_firme_bc,  
            (select count(distinct bc.num_bc)   from bon_commande bc inner join detail_bc bcd on bcd.num_bc = bc.num_bc 
            left outer join bon_commande bc2 on bc2.code_firme = bc.code_firme and bc2.date_bc < bc.date_bc
                    $queryFilter and bc.courtier = ifnull(u.code_commande,u.code_commercial) and bc2.num_bc is null 
                   ) as nb_bc_nc,
               (select count(t.id)
        + ifnull((select count(a.id) from appel_televente a where a.date_appel >= '$date_from' and a.date_appel <= '$date_to'
                              and  a.operateur = ifnull(u.code_commercial, u.code_commande) 
              and a.resultat in ('PINT','CH', 'CESS', 'DEJA C', 'DOUBLON', 'FAUX N', 'HCib', 'INJ', 'PAS N', 'REAL', 'SUS')
                ),0)
                from $db_name.tts_visites_realisees t where t.date_visite >= '$date_from' and t.date_visite <= '$date_to'
                              and t.id_utilisateur=u.id and id_resultat_visite in (1, 3) )
        
                 as nb_fiche_rendues,
                   
            (select  count(distinct r3.code_firme) from temp_reporting r3
                left outer join $db_name.tts_visites_realisees vr on vr.code_firme = r3.code_firme and year(vr.date_visite) = year(CURRENT_TIMESTAMP)
                left outer join appel_televente a on a.code_firme = SUBSTRING(r3.code_firme,3) and a.date_appel >= '$date_from' and a.date_appel <= '$date_to'
                where  r3.mt_ht = 0 and vr.id is null  and a.id is null and r3.courtier =  ifnull(u.code_commande,u.code_commercial)  ) as rem_pros,
                ifnull(u.code_commande,u.code_commercial)  as code
             from  $db_name.tts_utilisateur u 
                     
           where 1 = 1  $cond_comm $cond_service $cond_user $cond_actif
            ";


          $this->datas = $dbh_web->query($req)->fetchAll();
          $login = $this->getUser()->getId();



          Common::setTracabilite("Repoting", '', "Consulter Reporting Activite Commerciale", $login, "crm");
      }
      elseif($act == 'detail_rem'){
        $req ="select  f.id, f.code_firme, rs_comp, CONVERT(mt_ht2, SIGNED INTEGER) as 'Montant N-1', date_bc as 'Date', (select max(date_fin) from detail_bc d where d.num_bc = r.num_bc) as 'Date Fin' , f.id as id_firme,
                (select count(id) from $db_name.tts_commentaire c where c.code_firme = f.code_firme and year(c.date_creation) >= year(current_timestamp) ) as 'Commentaire' from temp_reporting r
                inner join firmes f on f.code_firme = concat('MA',r.code_firme)
                inner join $db_name.tts_utilisateur u on r.courtier =  ifnull(u.code_commande,u.code_commercial)
                where mt_ht = 0 and mt_ht2 > 0 $cond_comm $cond_groupe ";
        if($courtier){
          $req .= "  and courtier = '$courtier' ";
        }
        $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
        $this->setTemplate("Detail");
      }
      elseif($act == 'visite_p'){
          $req ="select t.id,".($id_user ? " " : " concat(u.prenom,' ',u.nom) as commercial, "). " f.code_firme, f.rs_comp,f.id as id_firme,t.date_visite,t.heure_visite,tv.libelle 
                from $db_name. tts_visites_planifiees t 
                 inner join firmes f on f.code_firme = t.code_firme
                 inner join $db_name.tts_utilisateur u on u.id = t.id_utilisateur
                 left join $db_name.par_tts_type_visite tv on tv.id = t.id_type_visite
                 where 
                        t.date_visite >= '".$date_from."' and 
                        t.date_visite <= '".$date_to."'  $cond_comm $cond_groupe  ";
          if($id_user){
            $req .= " and t.id_utilisateur=$id_user ";
          }
          $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
          $this->setTemplate("Detail");
      }
      elseif($act == 'visite_r'){
          $req ="select t.id,".($id_user ? " " : " concat(u.prenom,' ',u.nom) as commercial, "). " f.code_firme, f.rs_comp,f.id as id_firme,t.date_visite,t.heure_visite,tv.libelle , rv.resultat 
          from $db_name. tts_visites_realisees t
          inner join firmes f on f.code_firme = t.code_firme
          inner join $db_name.tts_utilisateur u on u.id = t.id_utilisateur
        left outer join $db_name.par_tts_visite_resultat rv on rv.id = id_resultat_visite
          left join $db_name.par_tts_type_visite tv on tv.id = t.id_type_visite
          where ";
          $req .= "
                t.date_visite >= '".$date_from."' and 
                t.date_visite <= '".$date_to."'  $cond_comm $cond_groupe  ";

          if($id_user){
            $req .= "   and  u.id=$id_user ";
          }
          
          $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
          $this->setTemplate("Detail");
      }

      elseif($act == 'appel_r'){
          $req ="select a.id,".($id_user ? " " : " concat(u.prenom,' ',u.nom) as commercial, "). " f.code_firme, f.rs_comp,f.id as id_firme, a.date_appel, rtv.libelle , date_rappel
          from  appel_televente a
          inner join firmes f on f.code_firme = concat('MA',a.code_firme)
          inner join $db_name.tts_utilisateur u on a.operateur = ifnull(u.code_commercial, u.code_commande) 
          left join  resultat_televentes rtv on rtv.code= a.resultat
          where ";
          $req .= "
                a.date_appel >= '".$date_from."' and 
                a.date_appel <= '".$date_to."'  $cond_comm $cond_groupe  ";

          if($id_user){
            $req .= "   and  u.id=$id_user ";
          }
          
          $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
          $this->setTemplate("Detail");
      }

      elseif($act == "nb_fiche_rendues"){
          $req = "select t.id,".($id_user ? " " : " concat(u.prenom,' ',u.nom) as commercial, "). " f.code_firme, f.rs_comp,f.id as id_firme,t.date_visite,t.heure_visite,tv.libelle, rv.resultat 
          from $db_name. tts_visites_realisees t
          inner join firmes f on f.code_firme = t.code_firme
          inner join $db_name.tts_utilisateur u on u.id = t.id_utilisateur
          left join $db_name.par_tts_type_visite tv on tv.id = t.id_type_visite
          left outer join $db_name.par_tts_visite_resultat rv on rv.id = id_resultat_visite
          where  id_resultat_visite in (1, 2, 3 , 4)  and
          t.date_visite >= '" . $date_from . "' and
          t.date_visite <= '" . $date_to . "'  $cond_comm $cond_groupe ";
          if($id_user){
            $req .= " and u.id=$id_user ";
          }
          
          $req .= "
          union
          select a.id,".($id_user ? " " : " concat(u.prenom,' ',u.nom) as commercial, "). " f.code_firme, f.rs_comp,f.id as id_firme,a.date_appel,'' ,'', a.resultat
          from appel_televente a 
          inner join firmes f on f.code_firme = concat('MA',a.code_firme)
          inner join $db_name.tts_utilisateur u on a.operateur= u.code_commercial
           where a.date_appel >= '$date_from' and a.date_appel <= '$date_to'
                              and  a.operateur = ifnull(u.code_commercial, u.code_commande) 
              and a.resultat in ('PINT','CH', 'CESS', 'DEJA C', 'DOUBLON', 'FAUX N', 'HCib', 'INJ', 'PAS N', 'REAL', 'SUS')
              
          ";
          
          if($id_user){
            $req .= " and u.id=$id_user ";
          }
          
      $this->detail = $dbh_web->query ( $req )->fetchAll ( PDO::FETCH_ASSOC );
      $this->setTemplate ( "Detail" );
      }
      elseif($act == 'nb_opp'){
          
          $req ="select ".($id_user ? " " : " concat(u.prenom,' ',u.nom) as commercial, "). "f.code_firme, f.rs_comp,f.id as id_firme,op.code, op.date_creation,op.date_echeance,op.objet, 
            os.statut as statut_name, ot.type as type_name
            FROM $db_name.tts_opportunite op
            inner join $db_name.par_tts_opportunite_statut os on os.id = op.id_statut_opportunite
            left outer join $db_name.par_tts_opportunite_type ot on ot.id = op.id_type_opportunite
            left outer join firmes f ON f.code_firme = op.code_firme 
            left outer join $db_name.tts_utilisateur u ON u.code_commercial = op.code_commercial
            where op.date_creation >= '".$date_from."' 
                  and op.date_creation <= '".$date_to."' $cond_comm $cond_groupe ";
          if($id_user){
            $req .= " and u.id=$id_user ";
          }
          $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
          $this->setTemplate("Detail");
      }
      elseif($act == 'nbr_action'){
          
          $req ="select ".($id_user ? " " : " concat(u.prenom,' ',u.nom) as commercial, "). "t.operation,t.module,t.code,t.date,t.heure,t.adresse_ip,concat(u.prenom,' ',u.nom) as fullname 
                  from $db_name.tts_tracabilite t
                  inner join $db_name.tts_utilisateur u on u.id=t.id_user 
                where t.date >= '$date_from' and t.date <= '$date_to'  $cond_comm $cond_groupe ";
          if($id_user){
            $req .= " and u.id=$id_user ";
          }
          $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
          $this->setTemplate("Detail");
      }
      elseif($act == 'nbr_modification'){
      
          $req ="select ".($id_user ? " " : " concat(u.prenom,' ',u.nom) as commercial, "). "h.code_firme, champ, type_modification, old_value, new_value, 
                        fi.rs_comp,fi.id as id_firme
                    from tts_historique_modification h 
                    inner join $db_name.tts_utilisateur u on u.id=h.id_utilisateur 
                    inner join firmes fi on fi.code_firme = h.code_firme
          where h.date_modification >= '".$date_from."'
          and h.date_modification <= '".$date_to."'  $cond_comm $cond_groupe ";
          if($id_user){
            $req .= " and u.id=$id_user ";
          }
          $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
                $this->setTemplate("Detail");
      }
      elseif($act == 'nb_creation'){
          $req ="select ".($id_user ? " " : " concat(u.prenom,' ',u.nom) as commercial, "). "t.code_firme, f.rs_comp,f.id as id_firme, concat(u.prenom,' ',u.nom) as utilisateur
          from tts_firme_ajoute t
          inner join $db_name.tts_utilisateur u on u.id=t.id_utilisateur
          inner join firmes f on f.code_firme = t.code_firme
          where t.date_creation >= '".$date_from."'
          and t.date_creation <= '".$date_to."'  $cond_comm $cond_groupe ";
          if($id_user){
            $req .= " and u.id=$id_user ";
          }
          $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
              $this->setTemplate("Detail");
      }
      elseif($act == 'nb_reclamation'){
          $req ="select ".($id_user ? " " : " concat(u.prenom,' ',u.nom) as commercial, "). "r.code,r.date_reclamation,f.rs_comp,f.code_firme,f.id as id_firme,s.libelle as service,r.objet
          from $db_name.tts_reclamation r 
          inner join $db_name.tts_utilisateur u on u.id=r.id_createur
          left outer JOIN $db_name.par_tts_service s ON r.id_service = s.id
        left outer JOIN firmes f ON r.code_firme = f.code_firme
          where r.date_creation >= '".$date_from."'
          and r.date_creation <= '".$date_to."'  $cond_comm $cond_groupe ";
          if($id_user){
            $req .= " and u.id=$id_user ";
          }
          $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
          $this->setTemplate("Detail");
      }
      elseif($act == 'nb_decouverte'){
          $req ="select d.id,".($id_user ? " " : " concat(u.prenom,' ',u.nom) as commercial, "). "d.code_firme, f.rs_comp,f.id as id_firme,d.date_creation,
                d.activite,d.description,d.clients,d.travail,
                d.developper,CONCAT( u.nom,' ', u.prenom ) AS createur
            FROM $db_name.tts_decouverte d
            left outer JOIN firmes f ON d.code_firme = f.code_firme
            left outer join $db_name.tts_utilisateur u on d.id_createur= u.id 
                where d.date_creation >= '".$date_from."'
                and d.date_creation <= '".$date_to."' $cond_comm $cond_groupe ";
          if($id_user){
            $req .= " and u.id=$id_user ";
          }
          $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
          $this->setTemplate("Detail");
      }
      elseif($act == 'nb_bc_nc' Or $act == 'mt_ht_nc'){
          $req ="
              select ".($id_user ? " " : " concat(u.prenom,' ',u.nom) as commercial, "). "bc.num_bc, bc.mt_ttc, bc.reglem_ttc,supp.support,s.societe, fi.rs_comp,fi.id as id_firme
                from bon_commande bc 
                left outer join bon_commande bc2 on bc2.code_firme = bc.code_firme and bc2.date_bc < bc.date_bc
                left outer join societes s on bc.societe= s.id
                left outer join support supp on bc.support= supp.id
                left outer join firmes fi on fi.code_firme = concat('MA', bc.code_firme)
                left outer join $db_name.tts_utilisateur u on bc.courtier= ifnull(u.code_commande,u.code_commercial) 
                where bc2.num_bc is null 
                and bc.date_bc >= '".$date_from."'
                and bc.date_bc <= '".$date_to."'  $cond_comm $cond_groupe ";
          if($id_user){
            $req .= " and u.id=$id_user ";
          }
          $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
          $this->setTemplate("Detail");
      }

      elseif($act == 'nb_bc'){
          $req ="select ".($id_user ? " " : " concat(u.prenom,' ',u.nom) as commercial, "). "bc.num_bc, bc.mt_ttc, bc.reglem_ttc,supp.support,s.societe , fi.rs_comp ,fi.id as id_firme
                from bon_commande bc 
                left outer join societes s on bc.societe= s.id
                left outer join support supp on bc.support= supp.id
                left outer join firmes fi on fi.code_firme = concat('MA', bc.code_firme)
                left outer join $db_name.tts_utilisateur u on bc.courtier= ifnull(u.code_commande,u.code_commercial)
                where bc.date_bc >= '".$date_from."'
                and bc.date_bc <= '".$date_to."' $cond_comm $cond_groupe ";
          if($id_user){
            $req .= " and u.id=$id_user ";
          }
          
          $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
          $this->setTemplate("Detail");
      }
      elseif($act == 'detail_rem_prospect'){
        $req ="select  f.id as id_firme,".($courtier ? " " : " r3.courtier , "). " r3.code_firme, rs_comp as Firme, fr.tel as Tel, max(r.lib_rubrique) as Rubrique, v.ville, ar.arrondissement,fichier.code,
                (select max(date_bc) from bon_commande bc where concat('MA',bc.code_firme) = f.code_firme and bc.societe = r3.societe) as Dernier_BC,
                (select count(id) from $db_name.tts_commentaire c where c.code_firme = f.code_firme and year(c.date_creation) >= year(current_timestamp)) as 'Commentaire', f.id as id_firme
                from temp_reporting r3
                left outer join $db_name.tts_visites_realisees vr on vr.code_firme = r3.code_firme and year(vr.date_visite) = year(CURRENT_TIMESTAMP)
                inner join firmes f on f.code_firme = r3.code_firme
                left outer join lien_rubrique_telecontact lr on lr.code_firme = f.code_firme
                left outer join rubriques r on r.code_rubrique = lr.code_rubrique
                left outer join lien_telephone fr on fr.code_firme = f.code_firme
                left outer join villes v on v.code = f.code_ville
                left outer join arrondissements ar on ar.code = f.code_arr
                left outer join fichier fichier on fichier.code = f.code_fichier
                left outer join appel_televente a on a.code_firme = SUBSTRING(r3.code_firme,3) and a.date_appel >= '$date_from' and a.date_appel <= '$date_to'
                left outer join $db_name.tts_utilisateur u on r3.courtier= ifnull(u.code_commande,u.code_commercial)
                where   r3.mt_ht = 0 and vr.id is null and a.id is null  $cond_comm $cond_groupe ";




        if($courtier){
          $req .= " and r3.courtier = '$courtier' ";
        }
        $req .= " group by f.id, r3.code_firme, rs_comp, v.ville, ar.arrondissement";

        $this->detail = $dbh_web->query($req)->fetchAll(PDO::FETCH_ASSOC);
        $this->setTemplate("Detail");
      }

      elseif($act == 'detail_commentaire'){

          $code_firme = $request->getParameter('code_firme');
          $req ="SELECT r.code_firme,r.date_creation, r.commentaire, CONCAT( u.nom,' ', u.prenom ) AS createur, c.firme, c.id as id_firme
            FROM tts_commentaire r
            left outer JOIN tts_firmes c ON r.code_firme = c.code_firme
            left outer join tts_utilisateur u on r.id_createur= u.id 
                where r.code_firme = '$code_firme' $cond_comm $cond_groupe ";
          $this->detail = $dbh_crm->query($req)->fetchAll(PDO::FETCH_ASSOC);
          $this->setTemplate("Detail");
      }
      else
        $this->datas = array();

      /*echo $req;
      die('ici');*/
  }
  
  
  

  public function executeSuivirem(sfWebRequest $request)
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
    $this->oFilter = new Filter("bon_commande","bc","bd_web");
  
    $this->oFilter->addField('id_service');
    $this->oFilter->addField('id_groupe');
  
  
    
    $act = $request->getParameter('act');
    if($act)
    {
      $courtier = $request->getParameter('courtier');
      $id_user = $request->getParameter('id_user');
    }
    $this->code_commercial= $this->getUser()->getCode();
    $codes_users_affecte=$this->getUser()->getCodes_user_affecte();
  
    $cond_comm = "";
    if(!$this->getUser()->hasCredential('allactivitecommercialereporting')){
      $cond_comm=" AND ifnull(u.code_commande,u.code_commercial) in ($codes_users_affecte) ";
    }

    $cond_service = "";
    $id_service = $this->oFilter->getData("id_service");
    $this->id_service = $id_service;
    if($id_service){
      $cond_service = " and id_service = '$id_service' ";
    }

    $cond_groupe = "";
    $id_groupe = $this->oFilter->getData("id_groupe");
    $this->id_groupe = $id_groupe;
    if($id_groupe){
      $cond_groupe = " and id_groupe = '$id_groupe' ";
    }

    $cond_societe = "";
    $societe = $this->oFilter->getData("societe");
    $this->societe = $societe;
    if($societe){
      $cond_societe = "and bc2.societe = '$societe' ";
    }
    

    $cond_support = "";
    $support = $this->oFilter->getData("support");
    if($support){
      $cond_support = " and bc2.support = '$support' ";
    }
    // ------------------------------------------------------------------------
    // get query filter -------------------------------------------------------
    $queryFilter = $this->oFilter->getFilter();
    // ------------------------------------------------------------------------
    // setup param of filter --------------------------------------------------
    $this->filter = $this->oFilter->setup();
    // ------------------------------------------------------------------------
    // set principal query ----------------------------------------------------
  
    

      $today= date('Y-m-d');
    //$today = date("Y-m-d",mktime(0,0,0,date("m"),date("d"),date("Y")-1));
    $date_30 = date("Y-m-d", strtotime("-30 days", strtotime($today)));
    $date_60 = date("Y-m-d", strtotime("-60 days", strtotime($today)));
    $date_90 = date("Y-m-d", strtotime("-90 days", strtotime($today)));
    

    $date_30b = date("Y-m-d", strtotime("+30 days", strtotime($today)));
    $date_60b = date("Y-m-d", strtotime("+60 days", strtotime($today)));
    $date_90b = date("Y-m-d", strtotime("+90 days", strtotime($today)));

    if($_POST Or $act) {
      $dbh_web->query("DROP temporary TABLE IF EXISTS temp_commande2");
      $dbh_web->query("CREATE temporary TABLE IF NOT EXISTS temp_commande2 AS
             (select bc.code_firme, bc.courtier, bc.societe, bc.support, bc.date_bc,  bc.num_bc, mt_ttc, 
             ifnull(sum(prix_ht) ,0) mt_ht,
            ifnull( max(date_fin) ,DATE_ADD(bc.date_bc, INTERVAL 1 YEAR)) as date_fin
             from bon_commande bc
      inner join detail_bc bcd on bcd.num_bc = bc.num_bc
          where year(date_bc) >= year(CURRENT_TIMESTAMP)-2 
          group by bc.code_firme, bc.courtier, bc.societe, bc.support, bc.date_bc,  bc.num_bc, mt_ttc
          )
            ");
       
      $dbh_web->query("DROP temporary TABLE IF EXISTS temp_evenement");
      $dbh_web->query("CREATE temporary TABLE IF NOT EXISTS temp_evenement AS (select ev.code_firme, ev.courtier, societe from affectation ev group by  ev.code_firme, ev.courtier, societe)
          ");
      
      $dbh_web->query("DROP temporary TABLE IF EXISTS temp_reporting2");
      $dbh_web->query("CREATE temporary TABLE IF NOT EXISTS temp_reporting2 AS (select ev.code_firme,bc2.date_bc as date_bc,
               bc2.num_bc as num_bc, bc2.date_fin as date_fin,
              bc2.mt_ht as mt_ht2, ev.courtier, ev.societe, bc2.support
      
              from
                temp_evenement ev
                inner join temp_commande2 bc2 on bc2.code_firme = ev.code_firme and year(bc2.date_fin) = year(CURRENT_TIMESTAMP)  and bc2.societe = ev.societe
                left outer join bon_commande bc on bc.code_firme = ev.code_firme and bc.date_bc > bc2.date_bc and bc.societe = ev.societe and bc.support = bc2.support
             where bc.num_bc is null and bc2.mt_ttc > 0 $cond_societe $cond_support         
        )
          ");
      
      $dbh_web->query("DROP temporary TABLE IF EXISTS temp_reporting3");
      $dbh_web->query("CREATE temporary TABLE IF NOT EXISTS temp_reporting3 AS (select * from temp_reporting2)
          ");
      
      
      

    
    }
    
    if ($_POST) {
      
      $req = "select ifnull(concat (u.nom,' ',u.prenom),'') as  nom_courtier,u.id as id_user, u.actif,
      
      
      
      aff.courtier  as code, rem_client, rem_client_30 , rem_client_60, rem_client_90, nb_rem_client, nb_rem_client_30 , nb_rem_client_60, nb_rem_client_90
      from  
      (select courtier, sum(mt_ht2) as rem_client ,
      sum(case when date_fin >= '$date_30' and date_fin < '$today' then mt_ht2 else 0 end ) as rem_client_30 ,
      sum(case when date_fin >= '$date_60' and date_fin < '$date_30' then mt_ht2 else 0 end ) as rem_client_60 ,
      sum(case when date_fin >= '$date_90' and date_fin < '$date_60' then mt_ht2 else 0 end ) as rem_client_90 ,
      count(mt_ht2) as nb_rem_client ,
      sum(case when date_fin >= '$date_30' and date_fin < '$today' then 1 else 0 end ) as nb_rem_client_30 ,
      sum(case when date_fin >= '$date_60' and date_fin < '$date_30' then 1 else 0 end ) as nb_rem_client_60 ,
      sum(case when date_fin >= '$date_90' and date_fin < '$date_60' then 1 else 0 end ) as nb_rem_client_90 
      from temp_reporting2 t
      where date_fin >= '$date_90' and date_fin < '$today'
      group by courtier
      ) aff 
      left outer join  $db_name.tts_utilisateur u on aff.courtier =  ifnull(u.code_commande,u.code_commercial) 
      
      where 1 = 1  $cond_comm $cond_service $cond_groupe
      ";
      $this->datas = $dbh_web->query ( $req )->fetchAll ();
      
      
      $req2 = "select ifnull(concat (u.nom,' ',u.prenom),'') as  nom_courtier,u.id as id_user, u.actif,
      
      
      
      aff.courtier  as code, rem_client, rem_client_30 , rem_client_60, rem_client_90, nb_rem_client, nb_rem_client_30 , nb_rem_client_60, nb_rem_client_90
      from
      (select courtier, sum(mt_ht2) as rem_client ,
      sum(case when date_fin < '$date_30b' and date_fin >= '$today' then mt_ht2 else 0 end ) as rem_client_30 ,
      sum(case when date_fin < '$date_60b' and date_fin >= '$date_30b' then mt_ht2 else 0 end ) as rem_client_60 ,
      sum(case when date_fin < '$date_90b' and date_fin >= '$date_60b' then mt_ht2 else 0 end ) as rem_client_90 ,
      count(mt_ht2) as nb_rem_client ,
      sum(case when date_fin < '$date_30b' and date_fin >= '$today' then 1 else 0 end ) as nb_rem_client_30 ,
      sum(case when date_fin < '$date_60b' and date_fin >= '$date_30b' then 1 else 0 end ) as nb_rem_client_60 ,
      sum(case when date_fin < '$date_90b' and date_fin >= '$date_60b' then 1 else 0 end ) as nb_rem_client_90
      from temp_reporting3 t
      where date_fin < '$date_90b' and date_fin >= '$today'
      group by courtier
      ) aff
      left outer join  $db_name.tts_utilisateur u on aff.courtier =  ifnull(u.code_commande,u.code_commercial)
      
      where 1 = 1  $cond_comm $cond_service $cond_groupe
      ";
      
      $this->datas2 = $dbh_web->query ( $req2 )->fetchAll ();
      
      
      
      $login = $this->getUser ()->getId ();
      Common::setTracabilite ( "Repoting", '', "Consulter Reporting Rem CLient", $login, "crm" );
    } elseif ($act) {

      $cond_date = "";
      if($act == 'detail_rem_30'){
        $cond_date = " and date_fin >= '$date_30' and date_fin < '$today'";
      }
      if($act == 'detail_rem'){
        $cond_date = " and date_fin >= '$date_90' and date_fin < '$today'";
      }
      if($act == 'detail_rem_60'){
        $cond_date = " and date_fin >= '$date_60' and date_fin < '$date_30'";
      }
      if($act == 'detail_rem_90'){
        $cond_date = " and date_fin >= '$date_90' and date_fin < '$date_60'";
      }
      if($act == 'detail_rem_30b'){
        $cond_date = " and date_fin < '$date_30b' and date_fin >= '$today'";
      }
      if($act == 'detail_rem_60b'){
        $cond_date = " and date_fin < '$date_60b' and date_fin >= '$date_30b'";
      }
      if($act == 'detail_rem_90b'){
        $cond_date = " and date_fin < '$date_90b' and date_fin >= '$date_60b'";
      }
      if($act == 'detail_remb'){
        $cond_date = " and date_fin < '$date_90b' and date_fin >= '$today'";
      }
     $req = "select  t.code_firme, t.date_bc, t.num_bc, t.mt_ht2 as Montant_HT, societe, support, fi.rs_comp,fi.id as id_firme, date_fin ,
        (select count(id) from $db_name.tts_commentaire c where c.code_firme = fi.code_firme and year(c.date_creation) >= year(current_timestamp) ) as 'Commentaire',
         ifnull(u.code_commande,u.code_commercial) as code
        from temp_reporting2 t
      left outer join firmes fi on fi.code_firme = concat('MA', t.code_firme) 
      
      left outer join  $db_name.tts_utilisateur u on t.courtier =  ifnull(u.code_commande,u.code_commercial) 
      
      where 1 = 1  $cond_comm $cond_service $cond_groupe ";

      if($courtier){
          $req .= " and courtier = '$courtier' ";
        }
      $req .= " $cond_date ";
      
      $this->detail = $dbh_web-> query ( $req )->fetchAll ( PDO::FETCH_ASSOC );
      
      $this->setTemplate ( "Detail" );
    } else{
      $this->datas = array ();
      $this->datas2 = array ();
    }
      
  }
  
}
    