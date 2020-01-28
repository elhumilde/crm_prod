<?php

/**
 * recouvrement actions.
 *
 * @package    symfony
 * @subpackage recouvrement
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class recouvrementActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request
     * A request object
     */
    public function executeIndex(sfWebRequest $request) {
        // set connection ---------------------------------------------------------
        $dbh = Common::TTSConnect ();
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        // ------------------------------------------------------------------------

        //declare objet filter ----------------------------------------------------
        $this->oFilter = new Filter("encaissement","e","bd_web");
        // ------------------------------------------------------------------------

        $connection2 = Doctrine_Manager::getInstance()->getConnection('crm');
        $db = $connection2->getOptions();
        $dsn = $db['dsn'];
        preg_match("/;dbname=(.+)/",$dsn,$base_web);
        $db_name = $base_web[1];
        $this->db_name = $db_name;
        // add field not exist in table -------------------------------------------
        $this->oFilter->addField('date_from');
        $this->oFilter->addField('date_to');

        $this->oFilter->addField('code_firme');
        $this->oFilter->addField('code_firme2');
        $this->oFilter->addField('code_ville');
        $this->oFilter->addField('code_quartier');
        $this->oFilter->addField('code_arrondissement');
        $this->oFilter->addField('zone_geo');
        $this->oFilter->addField('id_commercial');
        // ------------------------------------------------------------------------
        $this->oFilter->addFilter("bc.date_facture >= :date_from");
        $this->oFilter->addFilter("bc.date_facture <= :date_to");
        $this->oFilter->addFilter("f.code_ville = :code_ville");
        $this->oFilter->addFilter("f.code_quart = :code_quartier");
        $this->oFilter->addFilter("f.code_arrondissement = :code_arrondissement");
        $this->oFilter->addFilter("f.zone_geo = :zone_geo");
        $this->oFilter->addFilter("u2.id = :id_commercial");

        $this->oFilter->addFilter("concat('MA',e.cfir) = :code_firme");
        // get query filter -------------------------------------------------------

        $this->id_user= $this->getUser()->getId();
        $this->code_commercial= $this->getUser()->getCode();

        if(!$this->getUser()->hasCredential('allencaissement')){
            $this->oFilter->andWhere(" ifnull(e.CODE_TELEACTEUR,'') = '$this->code_commercial' ");
        }
        $this->oFilter->andWhere("  ifnull(cloture,0) = 0");
        $this->oFilter->andWhere("  ifnull(e.solde,0) > 0");
        $this->oFilter->andWhere("  e.dossier = 0");


        $code_firme=$this->oFilter->getData('code_firme');
        if($code_firme){
            $firme_array = $dbh->query("select f.firme from tts_firmes f where f.code_firme='$code_firme'")->fetch();
            $this->firme=$firme_array["firme"];
        }
        $code_firme2=$this->oFilter->getData('code_firme2');
        if($code_firme2){
            $code_firme2  = str_replace('MA', '', $code_firme2);
            $this->oFilter->andWhere(" e.cfir like '%$code_firme2%' ");
        }
        //operation ---------------------------------------------------------------


        $queryFilter = $this->oFilter->getFilter();
        // setup param of filter --------------------------------------------------
        $this->filter = $this->oFilter->setup();
        // ------------------------------------------------------------------------

        // set principal query ----------------------------------------------------

        if($_POST Or 1==1)
        {
            $req = "
			select max(e.id) as id , e.nste, so.societe, su.support,  e.tedi, e.nedi, e.nfact, e.ttc, e.solde, f.code_firme, f.rs_comp, f.rs_abr, f.nbr_appel, f.nbr_visite, vi.ville, 
            (select count(id) from impayes i where ifnull(cloture,0) = 0 and e.cfir=i.cfir) as cloture_imp,
             concat(u.prenom,' ',u.nom) as agent,bc.date_facture, bc.num_bc, datecr,
             
            case when datediff(current_timestamp, bc.date_facture) > 180 then 'CTX'
            when datediff(current_timestamp, bc.date_facture)  > 90 then 'Recouvrement'
            else 'Encaissement' end as type
             
			from encaissement e
			left outer join bon_commande bc on bc.societe = e.nste  and bc.num_bc = e.nord 
			inner join firmes f on f.code_firme = concat('MA',e.cfir) 
			left outer join villes vi on vi.code = f.code_ville 
			left outer join societes so on so.code = e.nste 
			left outer join support su on su.code = e.tedi 	and su.societe =   e.nste
			left join arrondissements arr on arr.code=f.code_arr
	        left join quartiers q on q.code=f.code_quart				
			left join $db_name.tts_utilisateur u on u.code_commercial=e.CODE_TELEACTEUR 	
        	left join $db_name.tts_utilisateur u2 on u2.code_commercial=e.crep			
			";

            $req .= $queryFilter;
            $req .= " group by e.nste, so.societe, su.support,  e.tedi, e.nedi, e.nfact, e.ttc, e.solde, f.code_firme, f.rs_comp,  vi.ville";
            //print_r($req);die;
            Common::setTracabilite("Recouvrement", '', "Recherche Encaissement", $this->id_user, "crm");
            $this->data = $dbh_web->query($req)->fetchAll();
        }
        else $this->data=array();

    }
    public function executeDetail(sfWebRequest $request) {
        // set connection ---------------------------------------------------------
        $dbh = Common::TTSConnect ();
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        // ------------------------------------------------------------------------

        //declare objet filter ----------------------------------------------------
        $this->oFilter = new Filter("encaissement","e","bd_web");
        // ------------------------------------------------------------------------

        $connection2 = Doctrine_Manager::getInstance()->getConnection('crm');
        $db = $connection2->getOptions();
        $dsn = $db['dsn'];
        preg_match("/;dbname=(.+)/",$dsn,$base_web);
        $db_name = $base_web[1];
        $this->db_name = $db_name;
        $agent= $request->getParameter('agent');
        $resultat= $request->getParameter('resultat');
        $date_from=Common::convert_date($request->getParameter('date_from'),'Y-m-d');
        $date_to=Common::convert_date($request->getParameter('date_to'),'Y-m-d');
        $select = "";
        $group_by= "";
        if(isset($agent)){
            $cond=" operateur= '$agent'";
            $select = ", concat(u.prenom,' ',u.nom)  as agent , max(resultat) as resultat  ";
            $group_by = ", u.prenom, u.nom ";
        }
        elseif(isset($resultat)){
            $cond=" resultat= '$resultat'";
            $select = ", max(concat(u.prenom,' ',u.nom))  as agent , resultat ";
            $group_by = ",resultat ";
        }

        $this->act = $request->getParameter('act');
        if($this->act =="appel"){
            $this->data = $dbh_web->query("SELECT f.code_firme,f.rs_comp,max(date_appel) as max_date $select FROM appel_recouvrement r
			inner join firmes f on f.code_firme = concat('MA',r.code_firme) 
			left join $db_name.tts_utilisateur u on u.code_commercial=r.operateur
			where $cond "
                . ($date_from ? " and date_appel>='$date_from' " : " ")
                . ($date_to ? " and date_appel<='$date_to' " : " ") .
                "group by f.code_firme, f.rs_comp $group_by")->fetchAll();

        }
        elseif ($this->act =="visite") {

            $this->data = $dbh_web->query("SELECT f.code_firme,f.rs_comp, max(date_visite) as max_date $select  FROM visite_recouvrement r
				inner join firmes f on f.code_firme = concat('MA',r.code_firme) 
				left join $db_name.tts_utilisateur u on u.code_commercial=r.operateur
				where $cond and year(date_visite) >= year(current_timestamp)-1 "
                . ($date_from ? " and date_visite>='$date_from' " : " ")
                . ($date_to ? " and date_visite<='$date_to' " : " ") .
                "group by f.code_firme,f.rs_comp $group_by  ")->fetchAll();
        }
    }
    public function executeConsulter(sfWebRequest $request) {
        // set connection ---------------------------------------------------------
        $dbh = Common::TTSConnect ();
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        $connection2 = Doctrine_Manager::getInstance()->getConnection('crm');
        $db = $connection2->getOptions();
        $dsn = $db['dsn'];
        preg_match("/;dbname=(.+)/",$dsn,$base_web);
        $db_name = $base_web[1];
        // ------------------------------------------------------------------------
        //get parameter -----------------------------------------------------------
        $id = $request->getParameter('id');
        $this->id = $id;
        $act = $request->getParameter("act");

        $this->code_commercial= $this->getUser()->getCode();

        $login = $this->getUser()->getId();

        $req = "
		select e.id,e.cfir, e.nord,e.NEDI, e.datecr, e.code_operation, e.code_teleacteur, e.nste, so.societe, 
		su.support,  e.tedi, e.nedi, e.nfact as facture, e.ttc, e.solde, f.code_firme, f.rs_comp,
		 v.libelle as voie, f.num_voie, vi.ville, f.comp_voie, f.comp_num_voie, f.num_voie,
		 concat(u.prenom,' ',u.nom) as resp,e.crep,e.NORD,bc.date_bc, bc.date_facture, zone_geo, signataire,
             
            case when datediff(current_timestamp, bc.date_facture) > 180 then 'CTX'
            when datediff(current_timestamp, bc.date_facture)  > 90 then 'Recouvrement'
            else 'Encaissement' end as type,
		 ifnull((select sum(solde) from (select distinct solde, enc.cfir from  encaissement enc where ifnull(cloture,0)=0)enc2  where enc2.cfir=e.cfir  ),0)
			+
		ifnull((SELECT sum(mtrec) FROM impayes i where i.cfir =e.cfir  and ifnull(cloture,0) = 0 ),0)	
		  as solde_client,vll.ville as ville,f.lib_voie as voie,   arr.arrondissement,q.quartier,tel.tel, /* Modifier le 04/02/2019 par rania malk */ portable.portable, /* Fin edit */fax.fax
		from encaissement e
		left outer join bon_commande bc on bc.societe = e.nste  and bc.num_bc = e.nord 
		inner join firmes f on f.code_firme = concat('MA',e.cfir) 
		left outer join voie v on v.code_voie = f.code_voie
		left outer join villes vi on vi.code = f.code_ville 
		left outer join societes so on so.code = e.nste 
		left outer join support su on su.code = e.tedi and su.societe =   e.nste 
		left join arrondissements arr on arr.code=f.code_arr
        left join quartiers q on q.code=f.code_quart	
        left join villes vll on vll.code=f.code_ville
        left join lien_fax fax on fax.code_firme=f.code_firme
        left join lien_telephone tel on tel.code_firme=f.code_firme
        /* Modifier le 04/02/2019 par rania malk */
        left join lien_portable portable on portable.code_firme=f.code_firme
         /* Fin edit */
        left join $db_name.tts_utilisateur u on u.code_commercial=e.crep
		where e.id=$id			
		";

        $this->recouvrement = $dbh_web->query($req)->fetch();

        /* Modifier le 04/02/2019 par rania malk */

        $code_firme = $this->recouvrement['cfir'];
        $code_firme_ma = 'MA'.$code_firme;
        $req_tel="SELECT * 
        FROM  `lien_telephone` 
        WHERE  `code_firme` LIKE  'MA".$code_firme."'";

        $this->recouvrement_tel = $dbh_web->query($req_tel)->fetchAll();

        /*print_r($this->recouvrement_tel);
        die('ici');*/

        /* Fin edit */


        $this->reglements = $dbh_web->query("select bc.num_bc, bc.montant, bc.date_prev from bon_commande_prev bc
				inner join encaissement e on bc.societe = e.nste  and bc.num_bc = e.nord 
				where e.id=$id	  ")->fetchAll();
        $this->oFormAppel = new Form("appel_recouvrement", "id", "bd_web");
        $this->formAppel = $this->oFormAppel->setup();
        if ($act == "addAppel") {
            $this->oFormAppel->setFixedValue("date_appel", date("d/m/Y"));
            $this->oFormAppel->setFixedValue("edition",$this->recouvrement["NEDI"] );
            $this->oFormAppel->setFixedValue("num_bc",$this->recouvrement["NORD"] );
            $this->oFormAppel->setFixedValue("societe",$this->recouvrement["nste"] );
            $this->oFormAppel->setFixedValue("support",$this->recouvrement["tedi"] );
            $this->oFormAppel->setFixedValue("code_firme",$this->recouvrement["cfir"] );
            $this->oFormAppel->setFixedValue("operateur",$this->code_commercial );
            $this->oFormAppel->isAjax();
            $res_appel = $this->oFormAppel->save();

            Common::setTracabilite("Recouvrement", $res_appel['id'], "Ajout Appel Recouvrement", $login, "crm");
            if ($res_appel) {
                /* Modifier le 06/12/2019 par rania malk */
                $r = "update firmes f set nbr_appel = ifnull(nbr_appel, 0) + 1 WHERE f.code_firme = '$code_firme_ma' ";
                $dbh_web->query($r);
                /* Fin edit */
                $appel = $dbh_web->query("SELECT date_appel,date_rappel,contact,num_bc,observation,resultat,r.edition,supp.support,
            			s.societe,r.contact,r.fonction, concat(u.prenom,' ',u.nom) as responsable  FROM appel_recouvrement r
					left outer join $db_name.tts_utilisateur u on ifnull(u.code_commercial, '') = ifnull(r.operateur, '')
					left outer join societes s on ifnull(s.code, '') = ifnull(r.societe, '')
			left outer join support supp on ifnull(supp.code, '') = ifnull(r.support, '') and ifnull(supp.societe,'') =   ifnull(r.societe,'')
					where r.id=".$res_appel["id"])->fetch();
                $result = array(
                    '',
                    $appel["num_bc"],
                    $appel["edition"],
                    $appel["societe"],
                    $appel["support"],
                    $appel["contact"],
                    $appel["fonction"],
                    $appel["observation"],
                    $appel["date_appel"],
                    $appel["date_rappel"],
                    $appel["resultat"],
                    '',
                    'id'=>$res_appel['id']
                );
                return $this->renderText(json_encode(array_map(function ($elem){return $elem;}, $result)));
            }
        }
        elseif ($act == "deleteAppel") {
            $id_ligne= $request->getParameter('id');
            $del = $dbh->query("delete from appel_recouvrement where id = $id_ligne");
            return $this->renderText($id_ligne);
        }
        $this->oFormVisite = new Form("visite_recouvrement", "id", "bd_web");
        $this->formVisite = $this->oFormVisite->setup();
        if ($act == "addVisite") {
            $login = $this->getUser()->getId();
            $this->oFormVisite->setFixedValue("date_visite", date("d/m/Y"));
            $this->oFormVisite->setFixedValue("edition",$this->recouvrement["NEDI"] );
            $this->oFormVisite->setFixedValue("num_bc",$this->recouvrement["NORD"] );
            $this->oFormVisite->setFixedValue("societe",$this->recouvrement["nste"] );
            $this->oFormVisite->setFixedValue("support",$this->recouvrement["tedi"] );
            $this->oFormVisite->setFixedValue("code_firme",$this->recouvrement["cfir"] );
            $this->oFormVisite->setFixedValue("operateur",$this->code_commercial );
            $this->oFormVisite->isAjax();
            $res_visite = $this->oFormVisite->save();
            Common::setTracabilite("Recouvrement", $res_visite['id'], "Ajout Visite Recouvrement", $login, "crm");


            if ($res_visite) {
                /* Modifier le 06/12/2019 par rania malk */
                $v = "update firmes f set nbr_visite = ifnull(nbr_visite, 0) + 1 WHERE f.code_firme = '$code_firme_ma' ";
                $dbh_web->query($v);
                /* Fin edit */
                $visite = $dbh_web->query("SELECT date_visite,date_prochaine_visite,contact,num_bc,r.edition,supp.support,s.societe,r.contact,r.fonction,observation,resultat, concat(u.prenom,' ',u.nom) as responsable  FROM visite_recouvrement r
					left outer join $db_name.tts_utilisateur u on ifnull(u.code_commercial, '') = ifnull(r.operateur, '')
					left outer join societes s on ifnull(s.code, '') = ifnull(r.societe, '')
					left outer join support supp on ifnull(supp.code, '') = ifnull(r.support, '') and ifnull(supp.societe, '') = ifnull(r.societe, '')
					where r.id=".$res_visite["id"])->fetch();
                $result = array(
                    '',
                    $visite["num_bc"],
                    $visite["edition"],
                    $visite["societe"],
                    $visite["support"],
                    $visite["contact"],
                    $visite["fonction"],
                    $visite["observation"],
                    $visite["date_visite"],
                    $visite["date_prochaine_visite"],
                    $visite["resultat"],
                    '',
                    'id'=>$res_visite['id']
                );
                return $this->renderText(json_encode(array_map(function ($elem){return $elem;}, $result)));
            }
        }
        elseif ($act == "deleteVisite") {
            $id_ligne= $request->getParameter('id');
            $del = $dbh->query("delete from visite_recouvrement where id = $id_ligne");
            return $this->renderText($id_ligne);
        }
        $this->appel = $dbh_web->query("SELECT distinct r.id,date_appel,date_rappel,contact,num_bc,observation,resultat,r.edition,supp.support,
				s.societe,r.contact,r.fonction,  i.dossier as dossier_impaye FROM appel_recouvrement r
			left outer join societes s on ifnull(s.code, '') = ifnull(r.societe, '')
			left outer join support supp on ifnull(supp.code, '') = ifnull(r.support, '') and ifnull(supp.societe, '') = ifnull(r.societe, '')
            left outer join impayes i on i.dossier = r.dossier
			where concat('MA',code_firme) ='".$this->recouvrement["code_firme"]."' and year(date_appel) >= year(current_timestamp)-1 order by date_appel desc")->fetchAll();

        $this->visite = $dbh_web->query("SELECT distinct date_visite,date_prochaine_visite,contact,num_bc,observation,resultat, r.edition,supp.support,
				s.societe,r.contact,r.fonction,observation,resultat, i.dossier as dossier_impaye  FROM visite_recouvrement r
			left outer join societes s on ifnull(s.code, '') = ifnull(r.societe, '')
			left outer join support supp on ifnull(supp.code, '') = ifnull(r.support, '') and ifnull(supp.societe, '') = ifnull(r.societe, '')
			left outer join impayes i on i.dossier = r.dossier
			where concat('MA',code_firme) ='".$this->recouvrement["code_firme"]."' and year(date_visite) >= year(current_timestamp)-1 order by date_visite desc")->fetchAll();

        $this->impaye= $dbh_web->query("SELECT dossier,	datecr,mtord,mtrec,natimpaye,cloture, nfact, dimp FROM impayes i where concat('MA',i.cfir) ='".$this->recouvrement["code_firme"]."'")->fetchAll();

        $this->releve= $dbh_web->query("
				select distinct nfact, concat(su.support,' Edition: ',enc.nedi) as libelle,  ttc, solde from encaissement enc 
				left outer join support su on su.code = enc.tedi and su.societe = enc.nste 
				where concat('MA',enc.cfir) ='".$this->recouvrement["code_firme"]."' and ifnull(cloture,0)=0
				
				Union
				
				select distinct nfact, concat('Impaye' ,' Echeance: ', ifnull(ECHFACT,''))  as libelle, mtord, mtrec
				 FROM impayes i where concat('MA',i.cfir) ='".$this->recouvrement["code_firme"]."'
				and ifnull(i.cloture,0)=0
				
				
				")->fetchAll();

        $this->historique_paiement = $dbh_web->query("SELECT  'encaissement' as type,reg.num_reglem as code,reg.date_reg as date,CONCAT_WS(' ',sup.support,' ',reg.edition, ' ', mode_reglem ) as objet,
				'responsable' as responsable,concat('MA',reg.code_firme) as code_firme,FORMAT(mt_ttc,0,'fr_FR') as resultat FROM detail_reglement reg
            left outer join support sup on ifnull(sup.code, '')=ifnull(reg.support, '') and ifnull(sup.societe, '')=ifnull(reg.societe, '') 
            where  concat('MA',reg.code_firme) = '".$this->recouvrement["code_firme"]."' and year(date_reg) >= year(current_timestamp)-1   ")->fetchAll();

        Common::setTracabilite("Recouvrement", $id, "Consulter Recouvrement", $login, "crm");

    }

    public function executeSuiviagent(sfWebRequest $request)
    {
        // set connection ---------------------------------------------------------
        $connection_crm = Doctrine_Manager::getInstance()->getConnection('crm');
        $dbh_crm = $connection_crm->getDbh();
        $connection= Doctrine_Manager::getInstance()->getConnection('bd_web');
        $db = $connection->getOptions();
        $dsn = $db['dsn'];
        preg_match("/;dbname=(.+)/",$dsn,$base_web);
        $db_name = $base_web[1];
        $this->oFilter = new Filter("tts_utilisateur","u","crm");


        $login = $this->getUser()->getId();

        // ------------------------------------------------------------------------
        // add field not exist in table -------------------------------------------
        $this->oFilter->addField('date_from');
        $this->oFilter->addField('date_to');
        $date_from=Common::convert_date($this->oFilter->getValue("date_from"),'Y-m-d');
        $date_to=Common::convert_date($this->oFilter->getValue("date_to"),'Y-m-d');
        $code_commercial=$this->oFilter->getValue("code_commercial");
        $queryFilter = $this->oFilter->getFilter();
        $this->filter = $this->oFilter->setup();
        if ($_POST) {
            $this->datas = $dbh_crm->query ( "select * from (select id,concat(u.prenom,' ',u.nom) as agent, u.code_commercial,
	                                        (select count(distinct (code_firme)) from $db_name.appel_recouvrement a where a.operateur=u.code_commercial " . ($date_from ? " and a.date_appel>='$date_from' " : " ") . ($date_to ? " and a.date_appel<='$date_to' " : " ") . ") as nbr_appel,
	                                        (select count(distinct (code_firme)) from $db_name.visite_recouvrement a where a.operateur=u.code_commercial " . ($date_from ? " and a.date_visite>='$date_from' " : " ") . ($date_to ? " and a.date_visite<='$date_to' " : " ") . ") as nbr_visite 
										from tts_utilisateur u " .
                ($code_commercial ? " where u.code_commercial='$code_commercial'" : " ")
                ." )aff where nbr_appel != 0 or nbr_visite != 0 " )->fetchAll ( PDO::FETCH_ASSOC );
        } else
            $this->datas = array ();
        Common::setTracabilite("Recouvrement", '', "Consulter Suivi Agent Recouvremet", $login, "crm");

    }

    public function executeSuiviresultat(sfWebRequest $request)
    {
        // ------------------------------------------------------------------------
        $connection_crm = Doctrine_Manager::getInstance()->getConnection('crm');
        $dbh_crm = $connection_crm->getDbh();
        $connection= Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        $db = $connection->getOptions();
        $dsn = $db['dsn'];
        preg_match("/;dbname=(.+)/",$dsn,$base_web);
        $db_name = $base_web[1];
        $this->oFilter = new Filter("tts_utilisateur","u","crm");

        $login = $this->getUser()->getId();
        // ------------------------------------------------------------------------
        // add field not exist in table -------------------------------------------
        $this->oFilter->addField('date_from');
        $this->oFilter->addField('date_to');
        $date_from=Common::convert_date($this->oFilter->getValue("date_from"),'Y-m-d');
        $date_to=Common::convert_date($this->oFilter->getValue("date_to"),'Y-m-d');

        $code_commercial=$this->oFilter->getValue("code_commercial");

        $queryFilter = $this->oFilter->getFilter();
        $this->filter = $this->oFilter->setup();
        if ($_POST) {
            $this->datas = $dbh_web->query ( "select id,r.libelle as resultat,r.code as id_resultat,
	                                        (select count(distinct (code_firme)) from appel_recouvrement a where a.resultat=r.code" . ($date_from ? " and a.date_appel>='$date_from' " : " ") . ($date_to ? " and a.date_appel<='$date_to' " : " ") . ($code_commercial ? " and a.operateur ='$code_commercial' " : " ") . ") as nbr_appel,
	                                        (select count(distinct (code_firme)) from visite_recouvrement v where v.resultat=r.code" . ($date_from ? " and v.date_visite>='$date_from' " : " ") . ($date_to ? " and v.date_visite<='$date_to' " : " ") . ($code_commercial ? " and v.operateur ='$code_commercial' " : " ") . ") as nbr_visite from resultat_encaissements r" )->fetchAll ( PDO::FETCH_ASSOC );
        } else
            $this->datas = array ();

        Common::setTracabilite("Recouvrement", '', "Consulter Suivi Resultat Recouvremet", $login, "crm");

    }


}