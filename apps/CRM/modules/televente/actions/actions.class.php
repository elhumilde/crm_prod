<?php

/**
 * televente actions.
 *
 * @package    symfony
 * @subpackage televente
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class televenteActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request
	 *        	A request object
	 */
	public function executeIndex(sfWebRequest $request) {


		// set connection ---------------------------------------------------------
		$dbh = Common::TTSConnect ();
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
		// ------------------------------------------------------------------------
		
		$connection2 = Doctrine_Manager::getInstance()->getConnection('crm');
	  	$db = $connection2->getOptions();
	  	
	  	$dsn = $db['dsn'];
        preg_match("/;dbname=(.+)/",$dsn,$base_web);
        $db_name = $base_web[1];
        $this->db_name = $db_name;

        $today = date('Y-m-d');

        $app_jr = $request->getParameter("app_jr");
	  	$num_compagne = $request->getParameter("num_compagne");
        

		//declare objet filter ----------------------------------------------------

	  	if($app_jr Or $num_compagne ){
	  		$this->oFilter = new Filter("firmes", "f", "bd_web");
	  	}
	  	else{
			$this->oFilter2 = new Filter("compagne", "c", "bd_web");
		}
		// ------------------------------------------------------------------------

		
		if($app_jr Or $num_compagne ){
			$this->oFilter->addField('resultat_televente');
			$this->oFilter->addField('code_firme2');
			$this->oFilter->addField('code_commercial');


			$this->oFilter->addFilter("tv.code = :resultat_televente");
		}
		else{
    		$this->oFilter2->setValue('actif','1');
		}	


		$this->id_user= $this->getUser()->getId();
		$code_commercial= $this->getUser()->getCode();
		$join_firme = "";
		$cond_firme="  ";

		


		if(!$this->getUser()->hasCredential('alltelevente')){
			$join_firme=" and u.id = $this->id_user  ";
		}
        

		$code_firme= "";
		$code_firme2 = "";
		$activite = "";

		if($app_jr Or $num_compagne ){
    		$code_firme=$this->oFilter->getData('code_firme');
    		$code_firme2=$this->oFilter->getData('code_firme2');
    		$code_commercial=$this->oFilter->getData('code_commercial');
    		$activite=$this->oFilter->getData('tp_40');
    	}
    	else{
    		$actif=$this->oFilter2->getData('actif');
    		
    		if($actif == 1){
    			$this->oFilter2->andWhere(" (date_cloture>='$today' or date_cloture is null) ");
    		}
    		elseif($actif == 2){
    			$this->oFilter2->andWhere(" (date_cloture <'$today' and  date_cloture is not null) ");
    		}
    	}

    	if($code_firme){
			$cond_firme .= " and f.code_firme like '%$code_firme%' ";
			$firme_array = $dbh->query("select f.firme from tts_firmes f where f.code_firme='$code_firme'")->fetch();
			$this->firme=$firme_array["firme"];
		}

		$cond_commercial = "";
		if($code_commercial){
			$cond_commercial .= " and ev.courtier = '$code_commercial' ";
		}
		$cond_activite = "";
		if($activite){
			$cond_activite .= " and f.tp_40 like '%$activite%' ";
		}

    	
		if($code_firme2){
			$cond_firme .= " and f.code_firme like '%$code_firme2%' ";
		}
		
		if($app_jr Or $num_compagne ){
			$queryFilter = $this->oFilter->getFilter();
			// setup param of filter --------------------------------------------------
			$this->filter = $this->oFilter->setup();
		
		}
		else{
			$queryFilter2 = $this->oFilter2->getFilter();
			$this->filter2 = $this->oFilter2->setup();
		}
			
		
		// ------------------------------------------------------------------------
		
		// set principal query ----------------------------------------------------
		if($num_compagne )
		{



			$req = "select * from (SELECT distinct  f.id,f.code_firme,f.rs_comp,f.tp_40, $num_compagne as num_compagne, commercial,
					#(select t.tel from lien_telephone t where  t.code_firme=f.code_firme limit 1) as tel, 

					ifnull((select rtv.libelle from appel_televente tv 
					inner join resultat_televentes rtv on rtv.code= tv.resultat 
					where  tv.code_firme = f.code_firmeaffectation and tv.num_compagne = $num_compagne and  resultat!='' order by tv.date_appel desc limit 1),'Non appelee') as res ,

					ifnull((select tv.resultat from appel_televente tv 
					where  tv.code_firme = f.code_firmeaffectation and tv.num_compagne = $num_compagne and  resultat!='' order by tv.date_appel desc limit 1),'Non appelee') as code_res ,
					
					
					ifnull((select tv.date_appel from appel_televente tv 
					where tv.code_firme = f.code_firmeaffectation  and tv.num_compagne = $num_compagne and  resultat!='' order by tv.date_appel desc limit 1),'') as date_appel ,

					ifnull((select tv.date_rappel from appel_televente tv 
					where tv.code_firme = f.code_firmeaffectation  and tv.num_compagne = $num_compagne and  resultat!='' order by tv.date_appel desc limit 1),'') as date_rappel ,
					
					
					ifnull((select count(tv.id) from appel_televente tv 
					where tv.code_firme = f.code_firmeaffectation and tv.num_compagne = $num_compagne
					and resultat!=''),0) as nb_appel

					from (
					select f.* , ev.courtier , ev.societe, ev.support, ev.code_firme as code_firmeaffectation, u.nom as commercial
					FROM firmes f
					inner join affectation ev on concat('MA',ev.code_firme) = f.code_firme  
					inner join $db_name.tts_utilisateur u on  ifnull(u.code_commercial,u.code_commande) =  ev.courtier
					inner join compagne c on c.num_compagne  = ev.num_compagne and c.societe = ev.societe 
					where  ev.num_compagne=$num_compagne AND ev.cloture=0
					$join_firme 
					 $cond_firme
					 $cond_commercial
					 $cond_activite
					limit 1000 ) f ) aff 
				";


			Common::setTracabilite("televente", '', "Recherche Televente", $this->id_user, "crm");
			$this->data = $dbh_web->query($req)->fetchAll();
		}
		elseif($app_jr){
			$req = "select * from (SELECT distinct  f.id,f.code_firme,f.rs_comp,f.tp_40, num_compagne, appel_heure_rappel, contact  , 
					#(select t.tel from lien_telephone t where  t.code_firme=f.code_firme limit 1) as tel, 
					commercial,

					ifnull((select rtv.libelle from appel_televente tv 
					inner join resultat_televentes rtv on rtv.code= tv.resultat 
					where  tv.code_firme = f.code_firmeaffectation and  resultat!='' order by tv.date_appel desc limit 1),'Non appelee') as res ,

					ifnull((select tv.date_appel from appel_televente tv 
					where tv.code_firme = f.code_firmeaffectation   and  resultat!='' order by tv.date_appel desc limit 1),'') as date_appel ,

					ifnull((select count(tv.id) from appel_televente tv 
					where tv.code_firme = f.code_firmeaffectation  and resultat!=''),0) as nb_appel

					from (
					select f.* , ev.courtier , ev.societe, ev.support, ev.code_firme as code_firmeaffectation, app2.num_compagne, u.nom as commercial, app2.appel_heure_rappel, app2.contact
					FROM firmes f
					inner join affectation ev on concat('MA',ev.code_firme) = f.code_firme  
					inner join $db_name.tts_utilisateur u on  ifnull(u.code_commercial,u.code_commande) =  ev.courtier
					inner join appel_televente app2 on app2.date_rappel = DATE(current_timestamp) and app2.code_firme = ev.code_firme and app2.operateur =  ev.courtier 
					where 1=1  
					$join_firme 
					$cond_firme
					$cond_activite
					limit 1000 ) f) aff where res !='PINT' and  res != 'CH'
				";
				//print_r($req);die;
			
			Common::setTracabilite("televente", '', "Recherche Televente", $this->id_user, "crm");
			$this->data = $dbh_web->query($req)->fetchAll();

			$this->setTemplate("index2");
		}
		else{
			// afficher la liste des campagnes
			 if($_POST){
/*$reg=  "select * from (select distinct c.id, c.num_compagne, c.date_cloture, c.libelle, s.support, c.edition,
					ifnull((select count(distinct code_firme) from affectation a where a.num_compagne = c.num_compagne and  a.cloture =0 ),0) as nombre
				 from compagne c 
				 left outer join support s on s.code = c.support and s.societe = c.societe
				 $queryFilter2
				 )aff
				 where nombre > 0";
echo$reg;
die();*/


				 	$this->compagne = $dbh_web->query("select * from (select distinct c.id, c.num_compagne, c.date_cloture, c.libelle, s.support, c.edition,
					ifnull((select count(distinct code_firme) from affectation a where a.num_compagne = c.num_compagne and  a.cloture =0 ),0) as nombre
				 from compagne c 
				 left outer join support s on s.code = c.support and s.societe = c.societe
				 $queryFilter2
				 )aff
				 where nombre > 0
				  ")->fetchAll();




			}
			else{
				$this->compagne = array();
			}	 	
			// template spécifique
			$this->setTemplate("compagne");
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
			SELECT f.id,f.code_firme,f.rs_comp,f.tp_40,t.tel,vi.ville,v.libelle as voie, f.zone_geo, nature, f.comp_voie, f.comp_num_voie, f.num_voie,f.lib_voie as voie,   arr.arrondissement,q.quartier,tel.tel,status  FROM firmes f 
			left outer join lien_telephone t on t.code_firme=f.code_firme 
			left outer join villes vi on vi.code=f.code_ville 
            left outer join natures n on  n.code=f.code_nature 
            left outer join statuts s on  s.code=f.code_statut 
            left outer join voie v on v.code_voie = f.code_voie
            left join arrondissements arr on arr.code=f.code_arr
        	left join quartiers q on q.code=f.code_quart
        	left join lien_telephone tel on tel.code_firme=f.code_firme
			where f.id=$id	
		";
		$this->televente = $dbh_web->query($req)->fetch();
		$code_firme = $this->televente['code_firme'];
		


		$this->societes = $dbh_web->query("select ev.societe from affectation ev 
    			      inner join $db_name.tts_utilisateur u on u.id = $login and  ifnull(u.code_commercial,u.code_commande) =  ev.courtier
    			      where concat('MA',ev.code_firme)  = '$code_firme' ")->fetch();
		
		$this->societe = "3";
		if($this->societes){
			$this->societe = $this->societes['societe'];
		}
		



		$this->oFormAppel = new Form("appel_televente", "id", "bd_web");
		$this->oFormAppel ->setValue("societe", $this->societe);
		if($this->societe == 3) {
			$this->support = 2;
		}
		elseif($this->societe == 1) {
			$this->support = 3;
			
		}

        $this->formAppel = $this->oFormAppel->setup();
		if ($act == "addAppel") {
            $this->oFormAppel->setFixedValue("date_appel", date("d/m/Y"));
            $this->oFormAppel->setFixedValue("code_firme",substr($this->televente["code_firme"],2) );
			$this->oFormAppel->setFixedValue("appel_heure_rappel",str_replace(":","",$this->oFormAppel->getData("appel_heure_rappel")) );
            $this->oFormAppel->setFixedValue("operateur",$this->code_commercial );
            $this->oFormAppel->isAjax();
            $res_appel = $this->oFormAppel->save();
            if(ISSET($_POST["id_etape"]) && is_array($_POST["id_etape"])){
            	foreach ($_POST["id_etape"] as $id_etape) {
            		$dbh_web->query("insert into appel_televente_etape( id_appel, id_etape) values(".$res_appel['id'].",".$id_etape.")");
            	}
            }
            elseif(ISSET($_POST["id_etape"]) && $_POST["id_etape"]){
            	$id_etape = $_POST["id_etape"];
            	$dbh_web->query("insert into appel_televente_etape( id_appel, id_etape) values(".$res_appel['id'].",".$id_etape.")");
            }
            
            Common::setTracabilite("Televente", $res_appel['id'], "Ajout Appel Televente", $login, "crm");
            if ($res_appel) {
            	$appel = $dbh_web->query("SELECT date_appel,date_rappel,appel_heure_rappel,contact,observation,resultat,montant_devis,lien_e_contact,r.edition,supp.support,
            			s.societe,r.contact,r.fonction, concat(u.prenom,' ',u.nom) as responsable,
				(select GROUP_CONCAT(et.libelle) from appel_televente_etape ate
				left outer join $db_name .par_etape_vente et on et.id=ate.id_etape where ate.id_appel=r.id) as etapes  FROM appel_televente r
					left outer join $db_name.tts_utilisateur u on ifnull(u.code_commercial, '') = ifnull(r.operateur, '')
					left outer join societes s on ifnull(s.code, '') = ifnull(r.societe, '')
			left outer join support supp on ifnull(supp.code, '') = ifnull(r.support, '') and ifnull(supp.societe,'') =   ifnull(r.societe,'')
					where r.id=".$res_appel["id"])->fetch();
                $result = array(
                    $appel["contact"],
                    $appel["fonction"],
					$appel["observation"],
					$appel["date_appel"],
					$appel["date_rappel"],
					substr($appel["appel_heure_rappel"], 0,2).":".substr($appel["appel_heure_rappel"], 2),
					$appel["resultat"],
					$appel["montant_devis"],
					$appel["lien_e_contact"],
					$appel["etapes"],
                	'',
                    'id'=>$res_appel['id']
                );
                return $this->renderText(json_encode(array_map(function ($elem){return $elem;}, $result)));
            }
        }
        elseif ($act == "deleteAppel") {
            $id_ligne= $request->getParameter('id');     
            $del = $dbh->query("delete from appel_televente where id = $id_ligne");            
          return $this->renderText($id_ligne);
        }
		$this->appel = $dbh_web->query("SELECT distinct r.id,date_appel,date_rappel,montant_devis,contact,observation,resultat,r.edition,supp.support,
				s.societe,r.contact,r.fonction,
				(select GROUP_CONCAT(et.libelle) from appel_televente_etape ate
				left outer join $db_name .par_etape_vente et on et.id=ate.id_etape where ate.id_appel=r.id) as etapes FROM appel_televente r
			left outer join societes s on ifnull(s.code, '') = ifnull(r.societe, '')
			left outer join support supp on ifnull(supp.code, '') = ifnull(r.support, '') and ifnull(supp.societe, '') = ifnull(r.societe, '')
			where concat('MA',code_firme) ='".$this->televente["code_firme"]."' and year(date_appel) >= year(current_timestamp)-1 order by date_appel desc")->fetchAll();

		$this->visite = $dbh_web->query("SELECT date_visite,heure_visite,date_prochainev,code_contact,resultat,res.resultat  FROM $db_name.tts_visites_realisees r
		
			left outer join $db_name .par_tts_visite_resultat res on res.id = r.id_resultat_visite
			where code_firme ='".$this->televente["code_firme"]."' and year(date_visite) >= year(current_timestamp)-1 order by date_visite desc")->fetchAll();

		$this->bcs= $dbh_web->query("SELECT bc.num_bc, bcd.prix_ht as mtht, bc.date_bc,  bc.mt_ttc, bc.reglem_ttc, supp.support, s.societe FROM bon_commande bc 
			inner join detail_bc bcd on bcd.num_bc = bc.num_bc  and bcd.code_firme = bc.code_firme 
			left outer join societes s on ifnull(s.code, '') = ifnull(bc.societe, '')
			left outer join support supp on ifnull(supp.code, '') = ifnull(bc.support, '') and ifnull(supp.societe, '') = ifnull(bc.societe, '')

		where concat('MA',bc.code_firme) ='".$this->televente["code_firme"]."' 
			")->fetchAll();
		$this->decouverte= $dbh_web->query("
			SELECT d.id,d.code_firme,d.date_creation,d.description,
		CONCAT( u.nom,' ', u.prenom ) AS createur,activite,clients,developper,travail
		FROM $db_name.tts_decouverte d
		left outer join $db_name.tts_utilisateur u on d.id_createur= u.id
		where d.code_firme='".$this->televente["code_firme"]."'")->fetchAll();
		
		$this->historique_paiement = $dbh_web->query("SELECT  'encaissement' as type,reg.num_reglem as code,reg.date_reg as date,CONCAT_WS(' ',sup.support,' ',reg.edition, ' ', mode_reglem ) as objet,
				'responsable' as responsable,concat('MA',reg.code_firme) as code_firme,FORMAT(mt_ttc,0,'fr_FR') as resultat FROM detail_reglement reg
            left outer join support sup on ifnull(sup.code, '')=ifnull(reg.support, '') and ifnull(sup.societe, '')=ifnull(reg.societe, '') 
            where  concat('MA',reg.code_firme) = '".$this->televente["code_firme"]."' and year(date_reg) >= year(current_timestamp)-1   ")->fetchAll();
		
		Common::setTracabilite("Televente", $id, "Consulter Televente", $login, "crm");
		
	}
	public function executeSuivitelevente(sfWebRequest $request)
	  {
	    // set connection ---------------------------------------------------------
	    $connection_crm = Doctrine_Manager::getInstance()->getConnection('crm');
	    $dbh_crm = $connection_crm->getDbh();
	    $connection= Doctrine_Manager::getInstance()->getConnection('bd_web');
          $dbh_edicm = $connection->getDbh();
	    $db = $connection->getOptions();
	    $dsn = $db['dsn'];
	    preg_match("/;dbname=(.+)/",$dsn,$base_web);
	    $db_name = $base_web[1];
	  	$this->oFilter = new Filter("tts_utilisateur","u","crm");

	  	$act = $request->getParameter('act');

	  	$login = $this->getUser()->getId();
	  	
		// ------------------------------------------------------------------------
		// add field not exist in table -------------------------------------------
		$this->oFilter->addField('date_from');
		$this->oFilter->addField('date_to');
		$date_from=Common::convert_date($this->oFilter->getValue("date_from"),'Y-m-d');
		$date_to=Common::convert_date($this->oFilter->getValue("date_to"),'Y-m-d');
		$code_commercial=$this->oFilter->getValue("code_commercial");
		$id_groupe=$this->oFilter->getValue("id_groupe");

		$queryFilter = $this->oFilter->getFilter();
		$this->filter = $this->oFilter->setup();
		if ($_POST) {
			$this->datas = $dbh_crm->query ( "	

									select count(aff.appel) as nbr_appel, sum(nbr_devis) as nbr_devis, sum(nbr_bc) as nbr_bc, sum(nbr_cloture) as nbr_cloture, 
									u.id, concat(ifnull(u.prenom,aff.operateur),' ',ifnull(u.nom,'')) as agent, u.code_commercial,
	

                                ifnull((SELECT count(*) FROM  $db_name.`affectation` WHERE  `courtier` = aff.operateur AND cloture =0  AND num_compagne !=0),0) as rem,

                				ifnull(( select count(distinct(code_firme)) from  $db_name.appel_televente a2 
									where a2.operateur =  aff.operateur
										" . ($date_from ? " and a2.date_appel>='$date_from' " : " ") . ($date_to ? " and a2.date_appel<='$date_to' " : " ") . "
                					 ),0) as nbr_appel_unique ,
					
									ifnull(( select count(distinct(a3.id)) from  $db_name.appel_televente a3 
									inner join $db_name.appel_televente_etape ae on ae.id_appel = a3.id and ae.id_etape in (3,4)
									where 
										a3.operateur =  aff.operateur
										" . ($date_from ? " and a3.date_appel>='$date_from' " : " ") . ($date_to ? " and a3.date_appel<='$date_to' " : " ") . "
                					 ),0) as nbr_argumente
									
									from (
										SELECT a.id,  1 as appel, a.operateur, a.date_appel,a.resultat , code_firme
										, case when  a.resultat = 'PROP' then 1 else 0 end as nbr_devis
										, case when  a.resultat = 'REAL' then 1 else 0 end as nbr_bc
										, case when 
										a.resultat in ('PINT','CH', 'CESS', 'DEJA C', 'DOUBLON', 'FAUX N', 'HCib', 'INJ', 'PAS N', 'REAL', 'SUS')
										then 1 else 0 end as nbr_cloture
										from $db_name.appel_televente a
										where 1 = 1 
										" . ($date_from ? " and a.date_appel>='$date_from' " : " ") . ($date_to ? " and a.date_appel<='$date_to' " : " ") . "
									) aff
									left outer join  tts_utilisateur u on aff.operateur= u.code_commercial
									where 1=1 " . 
										($code_commercial ? "and u.code_commercial='$code_commercial' " : " "). 
										($id_groupe ? " and id_groupe=$id_groupe "  : " ").
										"
										group by u.id, u.prenom, u.nom,  u.code_commercial
										" )->fetchAll ( PDO::FETCH_ASSOC );
		}
		elseif($act){

		    if (($act == "rem")){

                $code_commercial = $request->getParameter('code_commercial');

                $req =  "	

								select * from (SELECT distinct  f.id,f.code_firme,f.rs_comp,f.tp_40, commercial,compa,
					(select t.tel from lien_telephone t where  t.code_firme=f.code_firme limit 1) as tel, 

					ifnull((select rtv.libelle from appel_televente tv 
					inner join resultat_televentes rtv on rtv.code= tv.resultat 
					where  tv.code_firme = f.code_firmeaffectation and resultat!='' order by tv.date_appel desc limit 1),'Non appelee') as res ,

					ifnull((select tv.resultat from appel_televente tv 
					where  tv.code_firme = f.code_firmeaffectation and  resultat!='' order by tv.date_appel desc limit 1),'Non appelee') as code_res ,
					
					
					ifnull((select tv.date_appel from appel_televente tv 
					where tv.code_firme = f.code_firmeaffectation  and resultat!='' order by tv.date_appel desc limit 1),'') as date_appel ,

					ifnull((select tv.date_rappel from appel_televente tv 
					where tv.code_firme = f.code_firmeaffectation  and  resultat!='' order by tv.date_appel desc limit 1),'') as date_rappel ,
					
					
					ifnull((select count(tv.id) from appel_televente tv 
					where tv.code_firme = f.code_firmeaffectation 
					and resultat!=''),0) as nb_appel

					from (
					select f.* , ev.courtier , ev.societe, ev.support, ev.code_firme as code_firmeaffectation, u.nom as commercial,c.libelle as compa FROM affectation ev inner join firmes f on concat('MA',ev.code_firme) = f.code_firme inner join CRM_EDICOM.tts_utilisateur u on ifnull(u.code_commercial,u.code_commande) = ev.courtier LEFT join compagne c on ev.num_compagne = c.num_compagne where ev.cloture=0 and ev.courtier='$code_commercial' AND ev.num_compagne !=0 ) f 
			        ) aff	";


                $this->data = $dbh_edicm->query($req)->fetchAll();

                $this->setTemplate ( "Rem" );


            }
		    else{
			$date_from = Common::convert_date($request->getParameter('date_from'),'Y-m-d');
			$date_to = Common::convert_date($request->getParameter('date_to'),'Y-m-d');
			$id_user = $request->getParameter('id_user');
			$id_groupe = $request->getParameter('id_groupe');
			
			$req = "select a.id, f.code_firme, f.id as id_firme, concat(ifnull(u.prenom,a.operateur),' ',ifnull(u.nom,'')) as agent, f.rs_comp as firme, a.date_appel,a.resultat, montant_devis  from $db_name.appel_televente a
				left outer join  tts_utilisateur u on a.operateur= u.code_commercial
				left outer join $db_name.firmes f on f.code_firme = concat('MA',a.code_firme)
				where 1 = 1 " 
						. ($date_from ? " and a.date_appel>='$date_from' " : " ") 
						. ($date_to ? " and a.date_appel<='$date_to' " : " ") 
						. ($id_groupe ? " and id_groupe=$id_groupe "  : " ")
						. ($id_user ? " and u.id=$id_user "  : " ")
						;
			
			$cond = "";
			if($act == "nbr_devis"){
				$cond = " and a.resultat = 'PROP' ";
			}

			elseif($act == "nbr_bc"){
				$cond = " and a.resultat = 'REAL' ";
			}
			elseif($act == "nbr_cloture"){
				$cond = " and a.resultat in ('PINT','CH', 'CESS', 'DEJA C', 'DOUBLON', 'FAUX N', 'HCib', 'INJ', 'PAS N', 'REAL', 'SUS')
										";
			}

			elseif($act == "nbr_argumente"){
				$cond = " and exists (select ae.id from $db_name.appel_televente_etape ae where ae.id_appel = a.id and ae.id_etape in (3,4))
										";
			}
			
			$this->detail = $dbh_crm-> query ( $req.$cond )->fetchAll ( PDO::FETCH_ASSOC );
			
			$this->setTemplate ( "Detail" );
            }
		}

		else
			$this->datas = array ();
		Common::setTracabilite("Reporting", '', "Consulter Suivi Televente", $login, "crm");
		
	  }

	  
}
