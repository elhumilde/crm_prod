<?php

/**
 * Firme actions.
 *
 * @package    ERP
 * @subpackage Firme
 * @author     TechTrend Solutions
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FirmeActions extends sfActions
{

    /**
     * Executes index action
     *
     * @param sfRequest $request
     *            A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        // set connection ---------------------------------------------------------
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        // ------------------------------------------------------------------------

        // declare objet filter ----------------------------------------------------
        $this->oFilter = new Filter("firmes", "f", "bd_web");
        // ------------------------------------------------------------------------
        $this->code_commercial = $this->getUser()->getCode();
        // add field not exist in table -------------------------------------------
        // ------------------------------------------------------------------------
        $this->oFilter->addField('num_tel');
        $this->oFilter->addField('code_personne');
        $this->oFilter->addField('nom');
        $this->oFilter->addField('prenom');
        $this->oFilter->addField('nom_firme');


        // add filter query of field not exist in table ---------------------------


        $num_tel = addslashes($this->oFilter->getData("num_tel"));
        $num_tel = str_replace(' ','',$num_tel);
        $num_tel = str_replace('.','',$num_tel);
        $code_personne = addslashes($this->oFilter->getData("code_personne"));
        $code_personne = str_replace(' ','',$code_personne);
        $code_personne_ma = 'MA'.$code_personne;
        $nom = addslashes($this->oFilter->getData("nom"));
        $nom = str_replace(' ','',$nom);
        $prenom = addslashes($this->oFilter->getData("prenom"));
        $prenom = str_replace(' ','',$prenom);
        $nom_firme = addslashes($this->oFilter->getData("nom_firme"));
        $nom_firme = str_replace('.','',$nom_firme);

        if($num_tel != null and strlen($num_tel) > 8){
            $this->oFilter->andWhere(" f.code_firme in (select l.code_firme from lien_telephone l where REPLACE(REPLACE(l.tel,' ',''),'.','')='$num_tel'
                union 
                select l.code_firme from lien_portable l where REPLACE(REPLACE(l.portable,' ',''),'.','')='$num_tel'
                union
                select d.code_firme from lien_dirigeant d where REPLACE(REPLACE(d.tel_1,' ',''),'.','')='$num_tel'

        )");
        }

        $cond = "";
        if($code_personne != null){
            $cond .= " REPLACE(p.code_personne,' ','') = '$code_personne_ma' ";
            //$this->oFilter->andWhere(" REPLACE(REPLACE(p.nom,' ',''),'.','')  like '%$nom%' ");
        }
        if($nom != null){
            $cond .= " REPLACE(p.nom,' ','') = '$nom' ";
            //$this->oFilter->andWhere(" REPLACE(REPLACE(p.nom,' ',''),'.','')  like '%$nom%' ");
        }
        if($nom != null and $prenom != null){
            $cond .= " and ";
        }
        if($prenom != null){
            $cond .= " REPLACE(p.prenom,' ','') = '$prenom' ";
            //$this->oFilter->andWhere(" REPLACE(REPLACE(p.prenom,' ',''),'.','')  like '%$prenom%' ");
        }
        if($cond){
            $this->oFilter->andWhere(" f.code_firme in (select code_firme from lien_dirigeant l 
                    inner join personne p on p.code_personne=l.code_personne
                    where $cond ) ");
        }

        $this->oFilter->andWhere(" ifnull(fa.valide,0)  in (0, 1 )");


        if($nom_firme != null and strlen($nom_firme) >= 3){

            $nom_firme_array = explode(' ',$nom_firme);
            foreach ($nom_firme_array as $nom_firme_expl){
                $this->oFilter->andWhere(" (REPLACE(f.rs_comp,'.','')  like '%$nom_firme_expl%'
                        or REPLACE(f.rs_comp,'.','')  like '$nom_firme_expl%'
                        or ifnull(REPLACE(f.rs_abr,'.','') ,'') like '%$nom_firme_expl%') ");
            }


        }


//         if($nom_firme != null and strlen($nom_firme) >= 3){
//             $this->oFilter->andWhere(" (REPLACE(REPLACE(rs_comp,' ',''),'.','')  = '$nom_firme'
//                 or ifnull(REPLACE(REPLACE(rs_abr,' ',''),'.','') ,'') = '$nom_firme' ) ");
//         }
        // ------------------------------------------------------------------------
        // get query filter -------------------------------------------------------
        $queryFilter = $this->oFilter->getFilter();
        // ------------------------------------------------------------------------
        // setup param of filter --------------------------------------------------
        $this->filter = $this->oFilter->setup();

        // ------------------------------------------------------------------------
        // set principal query ----------------------------------------------------
        $req = "
            select f.id, f.code_firme, v.ville, f.zone_geo as code_zone, f.rs_abr, f.rs_comp, nature from firmes f 
                left outer join villes v on v.code=f.code_ville 
                left outer join  tts_firme_ajoute fa on  fa.code_firme=f.code_firme 
                left outer join  natures n on  n.code=f.code_nature 
                ";

        $req .= $queryFilter . "  limit 1000";

        if ($_POST && $queryFilter) {
            $this->datas = $dbh_web->query($req)->fetchAll();

            $login = $this->getUser()->getId();
            Common::setTracabilite("Firmes", $nom_firme." ".$prenom." ".$nom." ".$num_tel, "Recherche firme", $login, "crm");

        } elseif($_POST){
            $this->datas = array();
            $this->getUser()->setFlash('error', 'Veuillez affiner votre recherche !');

            $this->redirect("Firme/index");
        }
        else {
            $this->datas = array();
        }
        //print_r($req);die;
    }
    public function executeAjouter(sfWebRequest $request)
    {
        // set connection ---------------------------------------------------------
        $dbh = Common::TTSConnect();
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();

        // ------------------------------------------------------------------------
        // get parameter -----------------------------------------------------------
        $id = $request->getParameter('id');
        $act = $request->getParameter('act');
        $nom_firme = $request->getParameter('nom_firme');
        $this->id = $id;
        $this->nom_firme = $nom_firme;
        $this->user_id = $this->getUser()->getId();
        $login = $this->user_id;
        $this->code_commercial = $this->getUser()->getCode();
        // ------------------------------------------------------------------------
        // declare objet Form -----------------------------------------------------
        $this->oFormAjout = new Form("tts_firme_ajoute", "id", "bd_web");
        $this->oForm = new Form("firmes", "id", "bd_web");
        if ($id) {
            $this->oFormAjout = $this->oFormAjout->find('id', $id);
            $this->oForm = $this->oForm->find('id', $id);

        }

        $new_tel='';
        if($act=="verifier_unicite"){
            $nom_firme = addslashes($request->getParameter("nom_firme"));

            if ($request->getParameter('lien_telephone_tel') == "") {
                return $this->renderText(2);

            }

            if ($request->getParameter('firmes_code_forme_jur') == "") {
                return $this->renderText(2);

            }
            if ($request->getParameter('firmes_num_voie') == "") {
                return $this->renderText(2);

            }
            if ($request->getParameter('firmes_code_voie') == "") {
                return $this->renderText(2);

            }
            if ($request->getParameter('firmes_code_ville') == "") {
                return $this->renderText(2);

            }
            if ($request->getParameter('lien_rubrique_telecontact_code_rubrique') == "") {
                return $this->renderText(2);

            }

            if ($request->getParameter('firmes_tp_40') == "") {
                return $this->renderText(2);
            }

            $code_firme = $dbh_web->query("select code_firme from firmes where rs_comp = '$nom_firme'")->fetch();

            if($code_firme){
                return $this->renderText(1);
            }
            else return $this->renderText(0);

        }

        // set value par default of field ------------------------------------------
        if (! $id) {
            $this->oFormAjout->setFixedValue('date_creation', date("d/m/Y"));
            $code = Common::getCompteur('Firme', 'tts_compteur', 'crm');
            $this->oFormAjout->setFixedValue('code_firme', $code);
            if($this->getUser()->hasCredential('modif_ajout_valide'))
            {
                $this->oFormAjout->setFixedValue("valide", 1);
                $this->oFormAjout->setFixedValue("date_validation", date("d/m/Y"));
                $this->oFormAjout->setFixedValue("validateur", $login);
            }
            else $this->oFormAjout->setFixedValue('valide', 0);
            $this->oFormAjout->setFixedValue("id_utilisateur", $login);
            // set value par default of field firmes db_web------------------------------------------
            $this->oForm->setFixedValue('date_creation', date("d/m/Y"));
            $this->oForm->setFixedValue('code_firme', $code);
        }
        if ($_POST) {
            // set value par default of field firmes db_web------------------------------------------
            $rs_comp = $_POST['tts_firme_ajoute']['rs_comp'];
            $voies = $_POST['firmes']['code_voie'];
            $valeur = explode('||', $voies);

            $this->oForm->setFixedValue('code_voie', $valeur['0']);
            $this->oForm->setFixedValue('lib_voie', $valeur['1']);
            $voie = $dbh_web->query("select code_ville,code_arrondis as code_arr,code_quartier as code_quart,code_zone as zone_geo from voie  where code_voie = '".$valeur['0']."'")->fetch(PDO::FETCH_ASSOC);
            if($voie['code_ville']) $this->oForm->setFixedValue('code_ville', $voie['code_ville']);
            if($voie['code_quart']) $this->oForm->setFixedValue('code_quart', $voie['code_quart']);
            if($voie['code_arr']) $this->oForm->setFixedValue('code_arr', $voie['code_arr']);
            if($voie['zone_geo']) $this->oForm->setFixedValue('zone_geo', $voie['zone_geo']);
            $this->oForm->setValue('rs_comp', $rs_comp);
            $this->oForm->setFixedValue('maj_n', "3");
            $this->oForm->setFixedValue('maj_k', "3");
            $login = $this->user_id;
            Common::setTracabilite("Firmes", $rs_comp, "Ajouter firme", $login, "crm");
        }

        // setup param of form ----------------------------------------------------
        $this->formAjout = $this->oFormAjout->setup();
        $this->form = $this->oForm->setup();

        $this->oFormLien_email = new Form("lien_email", "id", "bd_web");
        $this->formLien_email = $this->oFormLien_email->setup();
        $this->oFormLien_telephone= new Form("lien_telephone", "id", "bd_web");
        $this->formLien_telephone = $this->oFormLien_telephone->setup();

        $this->oFormLien_rubrique = new Form("lien_rubrique_telecontact", "code_rubrique", "bd_web");
        $this->formLien_rubrique = $this->oFormLien_rubrique->setup();
        $this->oFormLien_rubrique_internet = new Form("lien_rubrique_internet", "code_rubrique", "bd_web");
        $this->formLien_rubrique_internet = $this->oFormLien_rubrique_internet->setup();

        $doublon = $dbh_web->query("select id,code_firme from firmes where code_firme='$code'")->fetch();

        if(!$doublon){

            // save data of form ------------------------------------------------------
            $re = $this->oFormAjout->save();
            $res = $this->oForm->save();


            if ($res) {
                // ---------------------------------------------------------------
                if (! $id) {
                    Common::validCompteur('Firme', 'tts_compteur', 'crm');
                    //initialisation des Email

                    $this->oFormLien_email->setFixedValue("code_firme", $res['code_firme']);
                    $this->oFormLien_email->setFixedValue("num_ordre", "1");
                    $res_email = $this->oFormLien_email->save();
                    //initialisation des Telephone
                    $num_tel = $this->espacement_tel($this->oFormLien_telephone->getData("tel"));
                    $this->oFormLien_telephone->setFixedValue('tel', $num_tel);
                    $this->oFormLien_telephone->setFixedValue("code_firme", $res['code_firme']);
                    $this->oFormLien_telephone->setFixedValue("num_ordre", "1");
                    $res_web = $this->oFormLien_telephone->save();

                    $this->oFormLien_rubrique->setFixedValue("code_firme", $res['code_firme']);
                    $this->oFormLien_rubrique->setFixedValue("editable", "+");
                    $res_web = $this->oFormLien_rubrique->save();

                    $this->oFormLien_rubrique_internet->setFixedValue("code_firme", $res['code_firme']);
                    $this->oFormLien_rubrique_internet->setFixedValue("code_rubrique", $this->oFormLien_rubrique->getData('code_rubrique'));
                    $this->oFormLien_rubrique_internet->setFixedValue("editable", "+");
                    $res_web = $this->oFormLien_rubrique_internet->save();

                    $this->oFormEvenement = new Form("affectation", "id", "bd_web");
                    $this->oFormEvenement->setFixedValue('date_evennement', date("d/m/Y"));
                    $this->oFormEvenement->setFixedValue('service', "Affectations");
                    $this->oFormEvenement->setFixedValue('societe', "3");
                    $this->oFormEvenement->setFixedValue('code_firme', str_replace('MA', '' , $res["code_firme"]));
                    $this->oFormEvenement->setFixedValue('courtier', $this->code_commercial);
                    $resEven = $this->oFormEvenement->save();
                    if(is_numeric($this->code_commercial)){
                        myUser::ajout_historique_ligne("Affectation",$res["code_firme"],$this->code_commercial,"","ajout d'une affectation",$resEven['id'], 'affectation' );
                    }
                    $this->getUser()->setFlash('success', 'la firme a &eacute;t&eacute; ajout&eacute;e avec succ&egrave;s !');
                } else {
                    $this->getUser()->setFlash('success', 'la firme a &eacute;t&eacute; modifi&eacute;e avec succ&egrave;s !');
                }
                $this->redirect("ConsulterFirme", array(
                    "id" => $res['id']
                ));
            }
        }
        else {
            $this->redirect("ConsulterFirme", array(
                "id" => $doublon['id']
            ));
        }
    }

    private function espacement_tel($num_tel)
    {

        $new_tel='';
        $num_tel = str_replace('-', '', $num_tel);
        $num_tel = str_replace('.', '', $num_tel);
        $num_tel = str_replace(' ', '', $num_tel);
        for($i=0;$i<10;$i+=2){
            if($i>0 and ($i%2==0)){
                $new_tel .= ' '.substr($num_tel,$i,1);
            }
            else{
                $new_tel .= substr($num_tel,$i,1);
            }
            $new_tel .=substr($num_tel,$i+1,1);

        }
        return $new_tel;
    }

    public function executeDetailsolde(sfWebRequest $request)
    {
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        $code_firme = $request->getParameter("code_firme");
        $this->impaye= $dbh_web->query("
                
                select nfact,  enc.cfir as code_firme, ttc, mtrg, solde from encaissement enc where concat('MA',enc.cfir) ='".$code_firme."' and ifnull(cloture,0)=0
                 ")->fetchAll();
    }

    public function executeConsulter(sfWebRequest $request)
    {

        $debut = microtime(true);
        // set connection ---------------------------------------------------------
        $this->firme_mere_id = "";
        // ------------------------------------------------------------------------
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        $connection2 = Doctrine_Manager::getInstance()->getConnection('crm');
        $dbh = $connection2->getDbh();
        $db = $connection2->getOptions();
        $dsn = $db['dsn'];

        preg_match("/;dbname=(.+)/",$dsn,$base_web);
        $db_name = $base_web[1];
        $this->db_name = $db_name;
        // get parameter -----------------------------------------------------------
        $id = $request->getParameter('id');
        $act = $request->getParameter("act");
        $this->num_compagne = $request->getParameter("num_compagne");
        $this->id = $id;
        $login = $this->getUser()->getId();
        $this->code_commercial = $this->getUser()->getCode();

        $codes_users_affecte=$this->getUser()->getCodes_user_affecte();

        $this->login = $login;
        $this->firme_mere = "";
        // ------------------------------------------------------------------------
        // declare objet Form -----------------------------------------------------
        $this->oForm = new Form("firmes", "id", "bd_web");
        $this->valide = "";
        if ($id && !$act) {
            $this->oForm = $this->oForm->find('id', $id);
            $valide = $dbh_web->query("select ifnull(fa.valide,0) as valide,fa.id from tts_firme_ajoute fa inner join firmes f on f.code_firme=fa.code_firme and f.id=$id")->fetch();
            if($valide){
                if($valide['valide'] == 0) $this->valide="En attente de validation";
                elseif($valide['valide'] == 2) {
                    $this->fa_id=$valide['id'];
                    $this->valide="Rejetée";
                }
            }
        }
        // ------------------------------------------------------------------------
        // get data ---------------------------------------------------------------

        if($act){
            $code_firme = $request->getParameter('code_firme');
            $this->code_firme = $code_firme;
            if($act=="addActMarque")
            {
                $code_marque = $request->getParameter('code_marque');
                $this->code_marque = $code_marque;
            }
        }
        else{
            $query_fonctions = "select code, concat(code,' ', case when ifnull(fonction, '' ) = '' then 'Autre' else fonction end ) as fonction, famille  from fonction where ifnull(code,'') != '' order by tri_famille, code";
            $this->fonctions = $dbh_web->query($query_fonctions)->fetchAll();

            $query_fonctions_dir = "select `tri_famille`, famille from fonction where ifnull(code,'') != '' GROUP by `famille` order by tri_famille, code";
            $this->fonctions_dir = $dbh_web->query($query_fonctions_dir)->fetchAll();


            $code_firme = $dbh_web->query("select code_firme, code_firme_mere from firmes where id = '$id'")->fetch();
            $this->code_firme = $code_firme["code_firme"];
            $code_firme_mere = $code_firme["code_firme_mere"];

            if($code_firme_mere){
                $firme_mere = $dbh_web->query("select rs_comp,id from firmes where code_firme = '$code_firme_mere' ")->fetch();
                $this->firme_mere = $firme_mere['rs_comp'];
                $this->firme_mere_id = $firme_mere['id'];
            }
        }

        $code_firme_simplifie = str_replace("MA", "",$this->code_firme);


        // affectation de la firme
        $affecte_telecontact_array = $dbh_web->query("SELECT  crt.nom_courtier as responsable, e.courtier as code from   affectation e
                left outer join courtier crt on ifnull(crt.code, '') = ifnull(e.courtier, '')
                where e.code_firme = '$code_firme_simplifie' and societe = '3'   order by date_evennement desc ")->fetch();
        $this->affecte_telecontact = $affecte_telecontact_array ? $affecte_telecontact_array['responsable'] : '';
        $this->code_affecte_telecontact = $affecte_telecontact_array ? $affecte_telecontact_array['code'] : '';


        $affecte_kompass_array = $dbh_web->query("SELECT  crt.nom_courtier as responsable, e.courtier as code from   affectation e
                left outer join courtier crt on ifnull(crt.code, '') = ifnull(e.courtier, '')
                where e.code_firme = '$code_firme_simplifie' and societe = '1'   order by date_evennement desc ")->fetch();
        $this->affecte_kompass = $affecte_kompass_array ? $affecte_kompass_array['responsable']: '';
        $this->code_affecte_kompass = $affecte_kompass_array ? $affecte_kompass_array['code']: '';

        $this->modif_ligne = 0;

        $this->consult_historique = 0;
        $this->consult_detail = 0;

        if ($this->code_commercial == $this->code_affecte_kompass  ||$this->code_commercial == $this->code_affecte_telecontact  || $this->getUser()->hasCredential('modifierallfirme')){
            $this->modif_ligne = 1;

        }

        $date_creation_array = $dbh_web->query("select date_creation from firmes where code_firme = '$this->code_firme' and DATE_ADD(date_creation, INTERVAL 30 DAY) >= current_timestamp ")->fetch();
        $verif_date_creation = $date_creation_array ? true : false ;

        if($this->code_affecte_kompass == null and $this->code_affecte_telecontact == null and $verif_date_creation){
            $this->modif_ligne = 1;
            $this->consult_detail = 1;
        }


        if ($this->code_commercial == $this->code_affecte_kompass  ||$this->code_commercial == $this->code_affecte_telecontact || $this->getUser()->hasCredential('allfirme')
            Or stristr($codes_users_affecte,"'".$this->code_affecte_kompass."'")  Or stristr($codes_users_affecte,"'".$this->code_affecte_telecontact."'") ){
            $this->consult_historique = 1;
            $this->consult_detail = 1;
        }


        if(!$act){


            //         $is_commercial = $dbh_web->query("select  count(courtier) as is_commercial from  evenement WHERE service = 'Affectations'
            //             and courtier = '$this->code_commercial' and concat('MA',code_firme)  = '$this->code_firme' ")->fetch();


            $this->data = $dbh_web->query("select s.status as statut,n.nature as nature,v.ville as ville,lib_voie as voie,fich.fichier,
                                        vrc.ville as ville_rc,vbp.ville as ville_bp,fj.forme_jur,b.banque,
                                        arr.arrondissement,q.quartier from firmes f 
                                         left join statuts s on s.code=f.code_statut
                                         left join natures n on n.code=f.code_nature
                                         left join banques b on b.code=f.chef_file_banque
                                         left join arrondissements arr on arr.code=f.code_arr
                                         left join quartiers q on q.code=f.code_quart
                                         left join villes v on v.code=f.code_ville
                                         left join villes vrc on vrc.code=f.code_ville_rc
                                         left join villes vbp on vbp.code=f.code_ville_bp
                                         left join formes_juridiques fj on fj.code=f.code_forme_jur
                                         left join fichier fich on fich.code=f.code_fichier
                                         where f.id = '$id' 
                                         ")->fetch();


            // Statistiques
            $this->mt_ttc_kompass = $dbh_web->query("SELECT concat(cast(mt_ttc as SIGNED), ' Edition ', edition) as mt_bc FROM bon_commande
                                             where code_firme ='".$code_firme_simplifie."' and societe=1 and mt_ttc != 0 order by date_bc desc ")->fetch(pdo::FETCH_ASSOC | pdo::FETCH_COLUMN);
            $this->mt_ttc_telecontact = $dbh_web->query("SELECT concat(cast(mt_ttc as SIGNED), ' Edition ', edition)  as mt_bc FROM bon_commande
                                             where code_firme ='".$code_firme_simplifie."' and societe=3 and mt_ttc != 0  order by date_bc desc ")->fetch(pdo::FETCH_ASSOC | pdo::FETCH_COLUMN);

            $this->signataire = $dbh_web->query("SELECT signataire  FROM bon_commande
                                             where code_firme ='".$code_firme_simplifie."'  and mt_ttc != 0  order by date_bc desc ")->fetch(pdo::FETCH_ASSOC | pdo::FETCH_COLUMN);

            $this->solde= $dbh_web->query("select sum(solde) from encaissement enc where enc.cfir ='".$code_firme_simplifie."' and ifnull(cloture,0)=0")->fetch(pdo::FETCH_ASSOC | pdo::FETCH_COLUMN);

            $this->nb_televente = $dbh_web->query("SELECT count(*) FROM evenement where service='televente'
                                             and code_firme ='".$code_firme_simplifie."' and year(date_evennement) = year(current_timestamp)")->fetch(pdo::FETCH_ASSOC | pdo::FETCH_COLUMN);

            $this->nb_appel_recouvrement = $dbh_web->query("SELECT count(*) FROM appel_recouvrement where code_firme ='".$code_firme_simplifie."' and year(date_appel) = year(current_timestamp)")->fetch(pdo::FETCH_ASSOC | pdo::FETCH_COLUMN);

            $this->dernier_commentaire = $dbh->query("SELECT commentaire FROM tts_commentaire where code_firme ='".$this->code_firme."'  order by id desc limit 1")->fetch(pdo::FETCH_ASSOC | pdo::FETCH_COLUMN);





            $this->dirigeants = $dbh_web->query("select d.id,p.code_personne,p.nom,p.prenom,fonc.fonction,group_concat(fonc2.fonction,' , ') as fonction2, c.civilite,d.tel_1,d.tel_2,d.email,d.fax,d.comp_fonct,d.class_actif,d.class_passif from lien_dirigeant d 
            inner join personne p on d.code_personne = p.code_personne 
            left outer join civilite c on c.code=p.civilite
            left outer  join fonction fonc on fonc.code=d.code_fonction
            left outer join lien_dirigeant_sec sec on sec.code_personne =  d.code_personne and  sec.code_firme =  d.code_firme
            left outer  join fonction fonc2 on fonc2.code=sec.code_fonction
                where d.code_firme='$this->code_firme'
    group by d.id,p.code_personne,p.nom,p.prenom,fonc.fonction, c.civilite,d.tel_1,d.tel_2,d.email,d.fax,d.comp_fonct,d.class_actif,d.class_passif
                    
                    ")->fetchAll();


            $this->certifications = $dbh_web->query("SELECT  `id`, `CODE_FIRME`, `CERTIFICATION`, `AUT_CERTIFICATION`, `CERT_EXPIRATION`, `NUM_CERTIFICATION`, `DESCRIPTIF_EXPIRATION`, `PRODUIT` FROM `firme_certif` WHERE `CODE_FIRME`='$this->code_firme'")->fetchAll();

            /*
             * $this->dirigeants_sec = $dbh_web->query("select d.id,p.code_personne,p.nom,p.prenom,fonc.fonction,c.civilite
                    from lien_dirigeant_sec d
                    inner join personne p on d.code_personne = p.code_personne
                    left outer join civilite c on c.code=p.civilite
                    left outer  join fonction fonc on fonc.code=d.code_fonction
                    where d.code_firme='$this->code_firme' ")->fetchAll();

             */

            $this->televentes = $dbh_web->query("SELECT distinct r.id,date_appel,date_rappel,montant_devis,appel_heure_rappel,lien_e_contact,contact,observation,rtv.libelle as resultat,r.edition,supp.support,
                    s.societe,r.contact,r.fonction,
                    (select GROUP_CONCAT(et.libelle) from appel_televente_etape ate
                    left outer join $db_name.par_etape_vente et on et.id=ate.id_etape where ate.id_appel=r.id) as etapes FROM appel_televente r
                    left outer join resultat_televentes rtv on rtv.code= r.resultat 
                left outer join societes s on ifnull(s.code, '') = ifnull(r.societe, '')
                left outer join support supp on ifnull(supp.code, '') = ifnull(r.support, '') and ifnull(supp.societe, '') = ifnull(r.societe, '')
                where code_firme ='$code_firme_simplifie' and year(date_appel) >= year(current_timestamp)-1 order by date_appel desc")->fetchAll();
            $this->societes = $dbh_web->query("select ev.societe from affectation ev 
                          inner join $db_name.tts_utilisateur u on u.id = $login and  ifnull(u.code_commercial,u.code_commande) =  ev.courtier
                          where ev.code_firme  = '$code_firme_simplifie' ")->fetch();


            $this->lien_produit = $dbh_web->query("select l.id,p.lib_produit, export, import,fda from produits_kompass p 
            inner join lien_produits_kompass l on l.code_produit = p.code_produit and l.code_firme='$this->code_firme'")->fetchAll();

            $this->pays_export = $dbh_web->query("select p.pays, pe.id  from  pays_export pe 
            inner join pays p on p.code_pays = pe.code_pays
            where code_firme = '$code_firme_simplifie'")->fetchAll();

            $this->lien_rubrique = $dbh_web->query("select l.id,r.Lib_Rubrique,l.editable from rubriques r
            inner join lien_rubrique_telecontact l on l.Code_Rubrique = r.Code_Rubrique and l.code_firme='$this->code_firme'")->fetchAll();
            $this->lien_rubrique_internet = $dbh_web->query("select l.id,r.Lib_Rubrique,l.editable from rubriques r
            inner join lien_rubrique_internet l on l.Code_Rubrique = r.Code_Rubrique and l.code_firme='$this->code_firme'")->fetchAll();

            $this->prestations = $dbh_web->query("SELECT p.id, p.prestation, p.code_firme, r.Code_Rubrique, Lib_Rubrique as rubrique_ran FROM firme_prestation p join rubriques r on p.rubrique_id = r.Code_Rubrique WHERE p.code_firme ='$this->code_firme'")->fetchAll();
            /*var_dump($this->prestations);die('ii');*/

            $this->lien_marque = $dbh_web->query("select l.id,p.pays,m.nom_marque,m.description from marque m 
                left outer join pays p on p.code_pays = m.code_pays
            inner join lien_marque l on l.code_marque = m.code_marque and l.code_firme='$this->code_firme'")->fetchAll();




            $this->lien_email = $dbh_web->query("select e.id,e.email, num_ordre from lien_email e where e.code_firme='$this->code_firme' order by num_ordre")->fetchAll();
            $this->lien_fax = $dbh_web->query("select l.id,l.fax from lien_fax l where l.code_firme='$this->code_firme' order by num_ordre ")->fetchAll();
            $this->lien_portable = $dbh_web->query("select l.id,l.portable from lien_portable l where l.code_firme='$this->code_firme' order by num_ordre ")->fetchAll();
            $this->lien_telephone = $dbh_web->query("select l.id,l.tel from lien_telephone l where l.code_firme='$this->code_firme' order by num_ordre ")->fetchAll();
            $this->lien_web = $dbh_web->query("select l.id,l.web from lien_web l where l.code_firme='$this->code_firme' order by num_ordre ")->fetchAll();
            $this->fonction = $dbh_web->query("select code as id, fonction as fonction from fonction")->fetchALL(PDO::FETCH_GROUP | PDO::FETCH_COLUMN);
            $this->fonction = array_map(function($elem){
                return $elem[0];
            },$this->fonction);

            $this->civilite = $dbh_web->query("select code as id, civilite from civilite")->fetchALL(PDO::FETCH_GROUP | PDO::FETCH_COLUMN);
            $this->civilite = array_map(function($elem){
                return $elem[0];
            },$this->civilite);
            $this->pays = $dbh_web->query("select code_pays as id, pays from pays")->fetchALL(PDO::FETCH_GROUP | PDO::FETCH_COLUMN);
            $this->pays = array_map(function($elem){
                return utf8_encode($elem[0]);
            },$this->pays);
            $this->rubrique_ran = $dbh_web->query("select   Code_Rubrique as id, Lib_Rubrique from rubriques limit 5")->fetchALL(PDO::FETCH_GROUP | PDO::FETCH_COLUMN);
            $this->rubrique_ran = array_map(function($elem){
                return $elem[0];
            },$this->rubrique_ran);

        }

        $this->societe = "3";
        if($this->societes){
            $this->societe = $this->societes['societe'];
        }

        $this->oFormTelevente = new Form("appel_televente", "id", "bd_web");
        $this->oFormTelevente ->setValue("num_compagne", $this->num_compagne );
        $this->oFormTelevente ->setValue("societe", $this->societe);
        $this->formTelevente = $this->oFormTelevente->setup();
        if($this->societe == 3) {
            $this->support = 2;
        }
        elseif($this->societe == 1) {
            $this->support = 3;

        }

        // ------------------------------------------------------------------------
        // operation ---------------------------------------------------------------
        // ------------------------------------------------------------------------
        // set value par default of field ------------------------------------------

        // ------------------------------------------------------------------------
        // set options of field ----------------------------------------------------
        // ------------------------------------------------------------------------
        // validation ------------------------------------------------------------
        // ------------------------------------------------------------------------
        // setup param of form ----------------------------------------------------
        $this->form = $this->oForm->setup();
        // ------------------------------------------------------------------------
        // setup param of form ligne----------------------------------------------------
        $this->oFormPersonne = new Form("personne", "code_personne", "bd_web");

        $this->formPersonne = $this->oFormPersonne->setup();

        $this->oFormLien_dirigeant = new Form("lien_dirigeant", "code_personne", "bd_web");
        $this->formLien_dirigeant = $this->oFormLien_dirigeant->setup();

        $this->oFormLien_rubrique = new Form("lien_rubrique_telecontact", "code_rubrique", "bd_web");
        $this->formLien_rubrique = $this->oFormLien_rubrique->setup();

        $this->oFormLien_rubrique_internet = new Form("lien_rubrique_internet", "code_rubrique", "bd_web");
        $this->formLien_rubrique_internet = $this->oFormLien_rubrique_internet->setup();

        $this->oFormPrestation = new Form("firme_prestation", "id", "bd_web");
        $this->formPrestation = $this->oFormPrestation->setup();

        $this->oFormLien_produit = new Form("lien_produits_kompass", "code_produit", "bd_web");
        $this->formLien_produit = $this->oFormLien_produit->setup();

        $this->oFormMarque = new Form("marque", "code_marque", "bd_web");

        $this->formMarque = $this->oFormMarque->setup();

        $this->oFormCertif = new Form("firme_certif", "id", "bd_web");
        $this->formCertif = $this->oFormCertif->setup();


        $this->oFormLien_marque = new Form("lien_marque", "code_marque", "bd_web");
        $this->formLien_marque = $this->oFormLien_marque->setup();

        $this->oFormActMarque = new Form("act_marque", "id", "bd_web");
        $this->formActMarque  = $this->oFormActMarque->setup();

        $this->oFormLien_email = new Form("lien_email", "id", "bd_web");
        $this->formLien_email = $this->oFormLien_email->setup();

        $this->oFormLien_fax = new Form("lien_fax", "id", "bd_web");
        $this->formLien_fax = $this->oFormLien_fax->setup();

        $this->oFormLien_portable = new Form("lien_portable", "id", "bd_web");
        $this->formLien_portable = $this->oFormLien_portable->setup();

        $this->oFormLien_telephone= new Form("lien_telephone", "id", "bd_web");
        $this->formLien_telephone = $this->oFormLien_telephone->setup();

        $this->oFormLien_web = new Form("lien_web", "id", "bd_web");
        $this->formLien_web = $this->oFormLien_web->setup();
        // ------------------------------------------------------------------------
        // ------------------------------------------------------------------------
        // save data ----------------------------------------------------------------

        if ($act == "addDirigeant" && $this->modif_ligne) {
            $code_personne="";
            if(isset($_POST["ligne"])){
                $civilite = $dbh_web->query("select c.civilite,p.nom,p.prenom from personne p
                    inner join civilite c on c.code=p.civilite
                    where code_personne = '" . $_POST["ligne"]."'")->fetch();
                $nom=$civilite["nom"];
                $prenom=$civilite["prenom"];
                $code_personne=$_POST["ligne"];
            }
            else
            {
                $code_personne = Common::getCompteur('Firme','tts_compteur','crm');
                $this->oFormPersonne->setFixedValue("code_personne", $code_personne);
                $this->oFormPersonne->isAjax();
                $res = $this->oFormPersonne->save();
                $nom=$res["nom"];
                $prenom=$res["prenom"];
                // ajout personne_ajout
                $this->oFormPersonne_ajout = new Form("tts_personne_ajout", "id", "bd_web");
                $this->oFormPersonne_ajout->setFixedValue("code_personne", $code_personne);
                if($this->getUser()->hasCredential('modif_ajout_valide'))
                {
                    $this->oFormPersonne_ajout->setFixedValue("valide", 1);
                    $this->oFormPersonne_ajout->setFixedValue("date_validation", date("d/m/Y"));
                    $this->oFormPersonne_ajout->setFixedValue("validateur", $login);
                }
                else
                    $this->oFormPersonne_ajout->setFixedValue("valide", 0);
                $this->oFormPersonne_ajout->setFixedValue("id_utilisateur", $login);
                $this->oFormPersonne_ajout->isAjax();
                $this->oFormPersonne_ajout->save();
                Common::validCompteur('Firme','tts_compteur','crm');
                if(!empty($res['civilite']))
                    $civilite = $dbh_web->query("select civilite from civilite where code = " . $res['civilite'])->fetch();
                else
                    $civilite["civilite"]="";
            }


            // ajout du lien dirigeant
            $this->oFormLien_dirigeant->setFixedValue("code_personne", $code_personne);
            $this->oFormLien_dirigeant->setFixedValue("code_firme", $code_firme);
            $this->oFormLien_dirigeant->isAjax();
            $res_dirigeant = $this->oFormLien_dirigeant->save();

            if(!empty($res_dirigeant['code_fonction']))
                $fonction = $dbh_web->query("select fonction from fonction where code = " . $res_dirigeant['code_fonction'])->fetch();
            else
                $fonction["fonction"]="";
            if ($code_personne) {
                myUser::ajout_historique_ligne("Personne",$code_firme,$code_personne,"","ajout d'une personne",$code_personne, 'lien_dirigeant');
                $result = array(
                    $civilite["civilite"],
                    $nom,
                    $prenom,
                    $fonction["fonction"],
                    $_POST["lien_dirigeant"]["comp_fonct"],
                    $_POST["lien_dirigeant"]["email"],
                    $_POST["lien_dirigeant"]["tel_1"],
                    $_POST["lien_dirigeant"]["tel_2"],
                    $_POST["lien_dirigeant"]["fax"],
                    $_POST["lien_dirigeant"]["class_actif"],
                    $_POST["lien_dirigeant"]["class_passif"],
                    '',
                    'id'=>$res_dirigeant['id']
                );
                return $this->renderText(json_encode(array_map(function ($elem){return $elem;}, $result)));
            }
        }
        elseif($act == "updatePersonne" && $this->modif_ligne){
            $id_ligne = $request->getParameter('id');
            $col="";
            $old_value=""; $new_value="";
            $code_firme="";
            if(isset($_POST["lien_dirigeant"])):
                $col=key($_POST["lien_dirigeant"]);
                $new_value = $_POST["lien_dirigeant"][$col];
                $old_value = $dbh_web->query("select l.$col from lien_dirigeant l where l.id = $id_ligne")->fetch();
                $this->oFormLien_dirigeant->find('id',$id_ligne);
                $this->oFormLien_dirigeant->isAjax();
                $res = $this->oFormLien_dirigeant->save();
                $code_firme=$res["code_firme"];

                if($new_value!=$old_value) myUser::ajout_historique_ligne($col,$code_firme,$new_value,$old_value[$col],"modification des informations des dirigeants", $res["code_personne"], 'lien_dirigeant');

                return $this->renderText(array_shift($_POST["lien_dirigeant"]));
            elseif(isset($_POST["personne"])):
                $col=key($_POST["personne"]);
                $personne = $dbh_web->query("select p.id,p.$col,l.code_firme from personne p
                        left join lien_dirigeant l on l.code_personne=p.code_personne 
                        where l.id = $id_ligne ")->fetch();
                $code_firme=$personne["code_firme"];
                $old_value=$personne[$col];
                $new_value = $_POST["personne"][$col];
                $this->oFormPersonne->find('id',$personne["id"]);
                $this->oFormPersonne->isAjax();
                $res = $this->oFormPersonne->save();
                if($new_value!=$old_value) myUser::ajout_historique_ligne($col,$code_firme,$new_value,$old_value,"modification des informations des personnes", $res["code_personne"], 'personne');
                return $this->renderText(array_shift($_POST["personne"]));

            endif;

        }
        elseif ($act == "verifirepersonne") {
            $parameters = $request->getPostParameters();
            $nom = addslashes($parameters["nom"]);
            $prenom = addslashes($parameters["prenom"]);
            $this->Verifierpersonne($nom,$prenom);

        }
        elseif ($act == "addRubrique" && $this->modif_ligne) {
            // ajout du lien Rubrique
            $this->oFormLien_rubrique->setFixedValue("code_firme", $code_firme);
            $this->oFormLien_rubrique->setFixedValue("editable", "+");
            $this->oFormLien_rubrique->isAjax();
            $res_rubrique = $this->oFormLien_rubrique->save();
            $new_rubrique = $dbh_web->query("select r.lib_rubrique, r.Code_Rubrique, l.editable,l.id from rubriques r
                inner join lien_rubrique_telecontact l on l.Code_Rubrique = r.Code_Rubrique and l.code_rubrique = ".$res_rubrique["code_rubrique"]." and l.code_firme='".$code_firme."'")->fetch();
            myUser::ajout_historique_ligne("Rubrique",$code_firme,$new_rubrique["Code_Rubrique"],"","ajout d'une rubrique", $new_rubrique["Code_Rubrique"], 'lien_rubrique_telecontact');
            $result = array($new_rubrique["lib_rubrique"],$new_rubrique["editable"], 'id' => $res_rubrique["id"]);
            return $this->renderText(json_encode(array_map(function ($elem)
            { return $elem;}, $result)));
        }
        elseif ($act == "updateRubrique" && $this->modif_ligne) {
            // ajout du lien Rubrique
            $id_ligne= $request->getParameter('id');
            $col=key($_POST["lien_rubrique_telecontact"]);
            $old_rubrique = $dbh_web->query("select $col from lien_rubrique_telecontact  where id = $id_ligne")->fetch();
            $this->oFormLien_rubrique->find('id',$id_ligne);
            $this->oFormLien_rubrique->isAjax();
            $res_rubrique = $this->oFormLien_rubrique->save();
            $new_rubrique = $dbh_web->query("select $col,Code_Rubrique from lien_rubrique_telecontact l where l.id = $id_ligne")->fetch();
            if($new_rubrique[$col]!=$old_rubrique[$col])
                myUser::ajout_historique_ligne("Rubrique",$res_rubrique["code_firme"],$new_rubrique[$col],$old_rubrique[$col],"modification d'une rubrique", $new_rubrique["Code_Rubrique"], 'lien_rubrique_telecontact');
            $result = array($_POST["lien_rubrique_telecontact"][$col]);
            return $this->renderText(array_shift($result));
        }
        elseif ($act == "addRubrique_internet" && $this->modif_ligne) {
            // ajout du lien Rubrique
            $this->oFormLien_rubrique_internet->setFixedValue("code_firme", $code_firme);
            $this->oFormLien_rubrique_internet->setFixedValue("editable", "+");
            $this->oFormLien_rubrique_internet->isAjax();
            $res_rubrique_internet = $this->oFormLien_rubrique_internet->save();
            $new_rubrique_internet = $dbh_web->query("select r.lib_rubrique, r.Code_Rubrique, l.editable,l.id from rubriques r
                inner join lien_rubrique_internet l on l.Code_Rubrique = r.Code_Rubrique and l.code_rubrique = ".$res_rubrique_internet["code_rubrique"]." and l.code_firme='".$code_firme."'")->fetch();
            myUser::ajout_historique_ligne("Rubrique",$code_firme,$new_rubrique_internet["Code_Rubrique"],"","ajout d'une rubrique internet", $new_rubrique_internet["Code_Rubrique"], 'lien_rubrique_telecontact');
            $result = array($new_rubrique_internet["lib_rubrique"],$new_rubrique_internet["editable"], 'id' => $res_rubrique_internet["id"]);
            return $this->renderText(json_encode(array_map(function ($elem)
            { return $elem;}, $result)));
        }
        elseif ($act == "updateRubrique_internet" && $this->modif_ligne) {
            // ajout du lien Rubrique
            $id_ligne= $request->getParameter('id');
            $col=key($_POST["lien_rubrique_internet"]);
            $old_rubrique_internet = $dbh_web->query("select $col from lien_rubrique_internet  where id = $id_ligne")->fetch();
            $this->oFormLien_rubrique_internet->find('id',$id_ligne);
            $this->oFormLien_rubrique_internet->isAjax();
            $res_rubrique_internet = $this->oFormLien_rubrique_internet->save();
            $new_rubrique_internet = $dbh_web->query("select $col,Code_Rubrique from lien_rubrique_internet l where l.id = $id_ligne")->fetch();
            if($new_rubrique_internet[$col]!=$old_rubrique_internet[$col])
                myUser::ajout_historique_ligne("Rubrique",$res_rubrique_internet["code_firme"],$new_rubrique_internet[$col],$old_rubrique_internet[$col],"modification d'une rubrique internet", $new_rubrique_internet["Code_Rubrique"], 'lien_rubrique_internet');
            $result = array($_POST["lien_rubrique_internet"][$col]);
            return $this->renderText(array_shift($result));
        }
        elseif ($act == "addProduit" && $this->modif_ligne) {
            // ajout du lien Produit

            $this->oFormLien_produit->setFixedValue("code_firme", $code_firme);
            $this->oFormLien_produit->isAjax();
            $res_produit = $this->oFormLien_produit->save();
            $new_produit = $dbh_web->query("select p.lib_produit, p.code_produit, export, import from produits_kompass p
                inner join lien_produits_kompass l on l.code_produit = p.code_produit and l.id = ".$res_produit["id"])->fetch();

            myUser::ajout_historique_ligne("Produit",$code_firme,$new_produit["code_produit"],"","ajout d'un produit",$new_produit["code_produit"], 'lien_produits_kompass' );
            $result = array($new_produit["lib_produit"],$this->oFormLien_produit->getData('export'),$this->oFormLien_produit->getData('import'),$this->oFormLien_produit->getData('fda'), 'id' => $res_produit["id"]);
            return $this->renderText(json_encode(array_map(function ($elem)
            {
                return $elem;
            }, $result)));
        }
        elseif ($act == "updateProduit" && $this->modif_ligne) {
            // ajout du lien Rubrique
            $id_ligne= $request->getParameter('id');
            $col=key($_POST["lien_produits_kompass"]);
            $old_produit = $dbh_web->query("select l.code_produit,ifnull(l.$col, '') as $col  from lien_produits_kompass l where l.id = $id_ligne")->fetch();

            $this->oFormLien_produit->find('id',$id_ligne);
            $this->oFormLien_produit->isAjax();
            $res_produit = $this->oFormLien_produit->save();
            if($_POST["lien_produits_kompass"][$col]!=$old_produit[$col])
                myUser::ajout_historique_ligne(
                    $col,
                    $res_produit["code_firme"],
                    $_POST["lien_produits_kompass"][$col],
                    $old_produit[$col],
                    "modification d'un produit",
                    $old_produit["code_produit"],
                    'lien_produits_kompass');
            return $this->renderText(array_shift($_POST["lien_produits_kompass"]));
        }
        elseif ($act == "addMarque" && $this->modif_ligne) {
            $code_marque="";
            if(isset($_POST["ligne"])){
                $code_marque=$_POST["ligne"];
            }
            else
            {
                // ajout du lien Produit
                $code_marque = Common::getCompteur('Marque','tts_compteur','crm');
                $this->oFormMarque->setFixedValue("code_marque", $code_marque);
                $this->oFormMarque->isAjax();
                $res_marque = $this->oFormMarque->save();
                Common::validCompteur('Marque','tts_compteur','crm');

                $this->oFormMarque_ajout = new Form("tts_marque_ajout", "id", "bd_web");
                $this->oFormMarque_ajout->setFixedValue("code_marque", $res_marque["code_marque"]);
                $this->oFormMarque_ajout->setFixedValue("id_utilisateur", $login);
                $this->oFormMarque_ajout->isAjax();
                $this->oFormMarque_ajout->save();
            }

            if($code_marque){
                $this->oFormLien_marque->setFixedValue("code_marque", $code_marque);
                $this->oFormLien_marque->setFixedValue("code_firme", $code_firme);
                $this->oFormLien_marque->isAjax();
                $res_marque = $this->oFormLien_marque->save();
            }
            $new_marque = $dbh_web->query("select m.nom_marque,p.pays, m.code_marque,m.description from marque m
                left outer join pays p on p.code_pays = m.code_pays
                inner join lien_marque l on l.code_marque = m.code_marque and l.id = ".$res_marque["id"])->fetch();
            myUser::ajout_historique_ligne("Marque",$code_firme,$new_marque["code_marque"],"","ajout d'une marque", $new_marque["code_marque"], 'lien_marque');
            $result = array($new_marque["nom_marque"],$new_marque["pays"],$new_marque["description"], 'id' => $res_marque["id"]);
            return $this->renderText(json_encode(array_map(function ($elem)
            {
                return $elem;
            }, $result)));
        }


        elseif ($act == "updateMarque" && $this->modif_ligne) {
            // Modification du lien Marque
            $col=key($_POST["lien_marque"]);

            $id_ligne= $request->getParameter('id');
            $id_ligne  = str_replace('div_sort_','',$id_ligne);
            $old_marque = $dbh_web->query("select m.$col,m.id,p.pays from marque m 
                inner join lien_marque l on l.code_marque=m.code_marque and l.id = $id_ligne
                inner join pays p on p.code_pays=m.code_pays")->fetch();

            $this->oFormMarque->find('id',$old_marque["id"]);
            $this->oFormMarque->setFixedValue("code_pays", $_POST["lien_marque"][$col]);
            $this->oFormMarque->isAjax();
            $res_marque = $this->oFormMarque->save();
            $new_marque = $dbh_web->query("select m.$col,l.code_firme,p.pays from marque m 
                inner join lien_marque l on l.code_marque=m.code_marque and l.id = $id_ligne
                left outer join pays p on p.code_pays=m.code_pays")->fetch();
            if($new_marque[$col]!=$old_marque[$col])
                myUser::ajout_historique_ligne("pays",$new_marque["code_firme"],$new_marque["pays"],$old_marque["pays"],"modification d'une marque",$old_marque["pays"], 'lien_marque');
            return $this->renderText(array_shift($_POST["lien_marque"]));
        }
        elseif ($act == "addActMarque" && $this->modif_ligne) {

            if($code_marque){
                $this->oFormActMarque->setFixedValue("code_marque", $code_marque);
                $this->oFormActMarque->setFixedValue("code_firme", $code_firme);
                $this->oFormActMarque->isAjax();
                $res_act_marque = $this->oFormActMarque->save();
            }
            $new_act_marque = $dbh_web->query("select act.id,act.exportateur,act.importateur,act.fda,pr.lib_produit, m.code_marque, m.nom_marque,m.description from act_marque act
                left outer join produits_kompass pr on pr.code_produit = pr.code_produit
                left outer join marque m on m.code_marque = act.code_marque
                where act.id = ".$res_act_marque["id"])->fetch();
            myUser::ajout_historique_ligne("Act Marque",$code_firme,$new_act_marque["lib_produit"],"","ajout d'une act marque", $new_act_marque["id"], 'act_marque');
            $result = array($new_act_marque["nom_marque"],$new_act_marque["lib_produit"],$new_act_marque["exportateur"],$new_act_marque["importateur"],$new_act_marque["fda"], 'id' => $res_act_marque["id"]);
            return $this->renderText(json_encode(array_map(function ($elem)
            {
                return $elem;
            }, $result)));
        }
        elseif ($act == "updateActMarque" && $this->modif_ligne) {
            // Modification du lien Marque
            $col=key($_POST["act_marque"]);
            $id_ligne= $request->getParameter('id');
            $id_ligne  = str_replace('div_sort_','',$id_ligne);
            $old_act_marque = $dbh_web->query("select m.$col from act_marque m where m.id=$id_ligne")->fetch();

            $this->oFormActMarque->find('id',$id_ligne);
            $this->oFormActMarque->setFixedValue("$col", $_POST["act_marque"][$col]);
            $this->oFormActMarque->isAjax();
            $res_marque = $this->oFormActMarque->save();
            $new_act_marque = $dbh_web->query("select m.$col from act_marque m where m.id=$id_ligne")->fetch();
            if($new_act_marque[$col]!=$old_act_marque[$col])
                myUser::ajout_historique_ligne("Act marque",$code_firme,$new_act_marque[$col],$old_act_marque[$col],"modification d'une act marque",$old_act_marque[$col], 'Act_marque');
            return $this->renderText(array_shift($_POST["act_marque"]));
        }
        elseif ($act == "verifiremarque") {
            $parameters = $request->getPostParameters();
            $nom_marque = addslashes($parameters["nom_marque"]);
            $this->Verifiermarque($nom_marque);

        }
        elseif ($act == "getActMarque") {
            $parameters = $request->getPostParameters();
            $id_lien_marque = $parameters["id_lien_marque"];
            $this->getActMarque($id_lien_marque);

        }

        elseif ($act == "addPrestation" && $this->modif_ligne) {
            $code_prestation="";
            if(isset($_POST["ligne"])){
                $code_prestation=$_POST["ligne"];
            }
            else
            {
                // ajout une prestation
                $this->oFormPrestation->setFixedValue("code_firme", $code_firme);
                $this->oFormPrestation->isAjax();
                $res_prestation = $this->oFormPrestation->save();
            }

            $new_prestation = $dbh_web->query("select * from firme_prestation where id = ".$res_prestation["id"])->fetch();
            $Lib_Rubrique = $dbh_web->query("select Lib_Rubrique from rubriques where Code_Rubrique =".$new_prestation["rubrique_id"])->fetch();
            myUser::ajout_historique_ligne("Prestation",$code_firme,$new_prestation["prestation"],"","ajout d'une prestation", $new_prestation["prestation"], 'firme_prestation');
            $result = array($new_prestation["prestation"],$Lib_Rubrique["Lib_Rubrique"],'id' =>$res_prestation["id"],$new_prestation["rubrique_id"]);

            /*var_dump($result);die('ici');*/

            return $this->renderText(json_encode(array_map(function ($elem)
            {
                return $elem;
            }, $result)));


        }

        elseif($act == "updatePrestation" && $this->modif_ligne){


            $id_ligne = $request->getParameter('id');

            if(isset($_POST["firme_prestation"])):

                $col=key($_POST["firme_prestation"]);
                //    $this->oFormPrestation->setFixedValue("code_firme", $code_firme);
                $old_prestation = $dbh_web->query("select $col from firme_prestation  where id = $id_ligne")->fetch();
                $this->oFormPrestation->find('id',$id_ligne);

                $this->oFormPrestation->isAjax();
                $res = $this->oFormPrestation->save();

                $new_prestation = $dbh_web->query("select $col,prestation from firme_prestation p where p.id = $id_ligne")->fetch();
                if($new_prestation[$col]!=$old_prestation[$col])
                    myUser::ajout_historique_ligne("Prestation",$res["code_firme"],$new_prestation[$col],$old_prestation[$col],"modification d'une prestation", $new_prestation["prestation"], 'firme_prestation');


                $result = array($_POST["firme_prestation"][$col]);

                return $this->renderText(array_shift($result));

            endif;

        }
        elseif ($act == "deletePrestation" && $this->modif_ligne) {

            $id_ligne= $request->getParameter('id');

            $del = $dbh_web->query("delete from firme_prestation where id = $id_ligne");

            return $this->renderText($id_ligne);
        }

        elseif ($act == "addCertif" && $this->modif_ligne) {
            $code_certif="";
            if(isset($_POST["ligne"])){
                $code_certif=$_POST["ligne"];
            }
            else
            {
                // ajout une certif
                $this->oFormCertif->setFixedValue("code_firme", $code_firme);
                $this->oFormCertif->isAjax();
                $res_certif = $this->oFormCertif->save();
            }
            if($code_certif){
                $this->oFormLien_marque->setFixedValue("code_certif", $code_certif);
                $this->oFormLien_marque->setFixedValue("code_firme", $code_firme);
                $this->oFormLien_marque->isAjax();
                $res_marque = $this->oFormLien_marque->save();
            }
               $new_certif = $dbh_web->query("select * from firme_certif where id = ".$res_certif["id"])->fetch();

               $result = array($new_certif["AUT_CERTIFICATION"],$new_certif["CERTIFICATION"],$new_certif["CERT_EXPIRATION"],$new_certif["NUM_CERTIFICATION"],$new_certif["PRODUIT"],'id' =>$res_certif["id"]);
            return $this->renderText(json_encode(array_map(function ($elem)
            {
                return $elem;
            }, $result)));
        }
        elseif($act == "updateCertif" && $this->modif_ligne){


            $id_ligne = $request->getParameter('id');

            if(isset($_POST["firme_certif"])):

                  $col=key($_POST["firme_certif"]);
            //    $this->oFormCertif->setFixedValue("code_firme", $code_firme);
                  $this->oFormCertif->find('id',$id_ligne);

                  $this->oFormCertif->isAjax();
                  $res = $this->oFormCertif->save();



                return $this->renderText(array_shift($_POST["firme_certif"]));

            endif;

        }

        elseif ($act == "delete_certif" && $this->modif_ligne) {

            $id_ligne= $request->getParameter('id');

            $del = $dbh_web->query("delete from firme_certif where id = $id_ligne");

            return $this->renderText($id_ligne);
        }

        elseif ($act == "addEmail" && $this->modif_ligne) {
            // ajout du lien Email
            $this->oFormLien_email->setFixedValue("code_firme", $code_firme);
            $this->oFormLien_email->isAjax();
            $num_ordre = $dbh_web->query("select max(num_ordre) as max from lien_email e where code_firme = '$code_firme' ")->fetch();
            $this->oFormLien_email->setFixedValue("num_ordre", $num_ordre['max']+1);
            $res_email = $this->oFormLien_email->save();
            $new_email = $dbh_web->query("select e.email, num_ordre from lien_email e where e.id = ".$res_email["id"])->fetch();
            myUser::ajout_historique_ligne("Email",$code_firme,$new_email["email"],"","ajout d'un email", $new_email["email"], 'lien_email');
            $result = array('', $new_email["email"],'id' => 'div_sort_'.$res_email["id"]);
            return $this->renderText(json_encode(array_map(function ($elem)
            { return $elem;}, $result)));
        }
        elseif ($act == "updateEmail" && $this->modif_ligne) {
            // Modification du lien Email

            $col=key($_POST["lien_email"]);
            $id_ligne= $request->getParameter('id');
            $id_ligne  = str_replace('div_sort_','',$id_ligne);
            $old_email = $dbh_web->query("select l.$col from lien_email l where l.id = $id_ligne")->fetch();
            $this->oFormLien_email->find('id',$id_ligne);
            $this->oFormLien_email->isAjax();
            $res_email = $this->oFormLien_email->save();
            $new_email = $dbh_web->query("select l.$col from lien_email l where l.id = $id_ligne")->fetch();
            if($new_email[0]!=$old_email[0])
                myUser::ajout_historique_ligne($col,$res_email["code_firme"],$new_email[0],$old_email[0],"modification d'un email",$old_email[0], 'lien_email');
            return $this->renderText(array_shift($_POST["lien_email"]));
        }
        elseif ($act == "delete_lien" && $this->modif_ligne) {

            $id_ligne= $request->getParameter('id');
            $id_ligne_new  = str_replace('div_sort_','',$id_ligne);
            $table = $request->getParameter("table_lien");
            $col = $request->getParameter("col");
            $old_value = $dbh_web->query("select l.$col as col from $table l where l.id = $id_ligne_new")->fetch();

            $del = $dbh_web->query("delete from $table where id = $id_ligne_new");
            myUser::ajout_historique_ligne($table,$code_firme,$old_value['col'],$old_value['col'],"suppression d un ".$table, $old_value['col'], $table);

            return $this->renderText($id_ligne);
        }
        elseif ($act == "addFax" && $this->modif_ligne) {
            // ajout du lien Fax
            $this->oFormLien_fax->setFixedValue("code_firme", $code_firme);
            $num_ordre = $dbh_web->query("select max(num_ordre) as max from lien_fax e where code_firme = '$code_firme' ")->fetch();

            $this->oFormLien_fax->setFixedValue("num_ordre", $num_ordre['max']+1);
            $this->oFormLien_fax->isAjax();
            $res_fax = $this->oFormLien_fax->save();
            $new_fax = $dbh_web->query("select l.fax from lien_fax l where l.id = ".$res_fax["id"])->fetch();
            myUser::ajout_historique_ligne("Fax",$code_firme,$new_fax["fax"],"","ajout d'un fax", $new_fax["fax"], 'lien_fax');
            $result = array('',$new_fax["fax"], 'id' =>  'div_sort_'.$res_fax["id"]);
            return $this->renderText(json_encode(array_map(function ($elem)
            { return $elem;}, $result)));
        }
        elseif ($act == "updateFax" && $this->modif_ligne) {
            // Modification du lien Fax
            $id_ligne= $request->getParameter('id');
            $id_ligne  = str_replace('div_sort_','',$id_ligne);
            $old_fax = $dbh_web->query("select l.fax from lien_fax l where l.id = $id_ligne")->fetch();
            $this->oFormLien_fax->find('id',$id_ligne);
            $this->oFormLien_fax->isAjax();
            $res_fax = $this->oFormLien_fax->save();
            $new_fax = $dbh_web->query("select l.fax from lien_fax l where l.id = $id_ligne")->fetch();
            if($new_fax["fax"]!=$old_fax["fax"])
                myUser::ajout_historique_ligne("Fax",$res_fax["code_firme"],$new_fax["fax"],$old_fax["fax"],"modification d'un fax", $old_fax["fax"], 'lien_fax');
            return $this->renderText(array_shift($_POST["lien_fax"]));
        }
        elseif ($act == "addWeb" && $this->modif_ligne) {
            // ajout du lien Web
            $this->oFormLien_web->setFixedValue("code_firme", $code_firme);
            $num_ordre = $dbh_web->query("select max(num_ordre) as max from lien_web e where code_firme = '$code_firme' ")->fetch();

            $this->oFormLien_web->setFixedValue("num_ordre", $num_ordre['max']+1);
            $this->oFormLien_web->isAjax();
            $res_web = $this->oFormLien_web->save();
            $new_web = $dbh_web->query("select l.web from lien_web l where l.id = ".$res_web["id"])->fetch();
            myUser::ajout_historique_ligne("Web",$code_firme,$new_web["web"],"","ajout d'un web", $new_web["web"],'lien_web' );
            $result = array('',$new_web["web"], 'id' => 'div_sort_'.$res_web["id"]);
            return $this->renderText(json_encode(array_map(function ($elem)
            { return $elem;}, $result)));
        }
        elseif ($act == "updateWeb" && $this->modif_ligne) {
            // Modification du lien Web
            $id_ligne= $request->getParameter('id');
            $id_ligne  = str_replace('div_sort_','',$id_ligne);
            $old_web = $dbh_web->query("select l.web from lien_web l where l.id = $id_ligne")->fetch();
            $this->oFormLien_web->find('id',$id_ligne);
            $this->oFormLien_web->isAjax();
            $res_web = $this->oFormLien_web->save();
            $new_web = $dbh_web->query("select l.web from lien_web l where l.id = $id_ligne")->fetch();
            if($new_web["web"]!=$old_web["web"])
                myUser::ajout_historique_ligne("Web",$res_web["code_firme"],$new_web["web"],$old_web["web"],"modification d'un web", $old_web["web"],'lien_web');
            return $this->renderText(array_shift($_POST["lien_web"]));
        }
        elseif ($act == "addPortable" && $this->modif_ligne) {
            // ajout du lien Portable
            $this->oFormLien_portable->setFixedValue("code_firme", $code_firme);
            $num_ordre = $dbh_web->query("select max(num_ordre) as max from lien_portable e where code_firme = '$code_firme' ")->fetch();

            $this->oFormLien_portable->setFixedValue("num_ordre", $num_ordre['max']+1);
            $this->oFormLien_portable->isAjax();
            $res_portable = $this->oFormLien_portable->save();
            $new_portable = $dbh_web->query("select l.portable from lien_portable l where l.id = ".$res_portable["id"])->fetch();
            myUser::ajout_historique_ligne("Portable",$code_firme,$new_portable["portable"],"","ajout d'un portable", $new_portable["portable"], 'lien_portable');
            $result = array('',$new_portable["portable"], 'id' => 'div_sort_'.$res_portable["id"]);
            return $this->renderText(json_encode(array_map(function ($elem)
            { return $elem;}, $result)));
        }
        elseif ($act == "updatePortable" && $this->modif_ligne) {
            // Modification du lien Portable
            $id_ligne= $request->getParameter('id');
            $id_ligne  = str_replace('div_sort_','',$id_ligne);
            $old_portable = $dbh_web->query("select l.portable from lien_portable l where l.id = $id_ligne")->fetch();
            $this->oFormLien_portable->find('id',$id_ligne);
            $this->oFormLien_portable->isAjax();
            $res_portable = $this->oFormLien_portable->save();
            $new_portable = $dbh_web->query("select l.portable from lien_portable l where l.id = $id_ligne")->fetch();
            if($new_portable["portable"]!=$old_portable["portable"])
                myUser::ajout_historique_ligne("Portable",$res_portable["code_firme"],$new_portable["portable"],$old_portable["portable"],"modification d'un portable", $old_portable["portable"], 'lien_portable');
            return $this->renderText(array_shift($_POST["lien_portable"]));
        }
        elseif ($act == "addTelephone" && $this->modif_ligne) {
            // ajout du lien Telephone
            $this->oFormLien_telephone->setFixedValue("code_firme", $code_firme);
            $num_ordre = $dbh_web->query("select max(num_ordre) as max from lien_telephone e where code_firme = '$code_firme' ")->fetch();

            $this->oFormLien_telephone->setFixedValue("num_ordre", $num_ordre['max']+1);
            $this->oFormLien_telephone->isAjax();
            $res_telephone = $this->oFormLien_telephone->save();
            $new_telephone = $dbh_web->query("select l.tel from lien_telephone l where l.id = ".$res_telephone["id"])->fetch();
            myUser::ajout_historique_ligne("Telephone",$code_firme,$new_telephone["tel"],"","ajout d'un telephone", $new_telephone["tel"], 'lien_telephone');
            $result = array('',$new_telephone["tel"], 'id' => 'div_sort_'.$res_telephone["id"]);
            return $this->renderText(json_encode(array_map(function ($elem)
            { return $elem;}, $result)));
        }
        elseif ($act == "updateTelephone" && $this->modif_ligne) {
            // Modification du lien Telephone
            $id_ligne= $request->getParameter('id');
            $id_ligne  = str_replace('div_sort_','',$id_ligne);
            $old_telephone = $dbh_web->query("select l.tel from lien_telephone l where l.id = $id_ligne")->fetch();
            $this->oFormLien_telephone->find('id',$id_ligne);
            $this->oFormLien_telephone->isAjax();
            $res_telephone = $this->oFormLien_telephone->save();
            $new_telephone = $dbh_web->query("select l.tel from lien_telephone l where l.id = $id_ligne")->fetch();
            if($new_telephone["tel"]!=$old_telephone["tel"])
                myUser::ajout_historique_ligne("Telephone",$res_telephone["code_firme"],$new_telephone["tel"],$old_telephone["tel"],"modification d'un telephone", $old_telephone["tel"], 'lien_telephone');
            return $this->renderText(array_shift($_POST["lien_telephone"]));
        }


        Common::setTracabilite("Firmes", $this->code_firme, "Consulter Firme", $login, "crm");
    }

    private function Verifierpersonne($nom, $prenom)
    {
        // set connection ---------------------------------------------------------
        session_write_close();

        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        $db = $connection->getOptions();
        $dsn = $db['dsn'];
        preg_match("/;dbname=(.+)/",$dsn,$base_web);
        $db_name = $base_web[1];

        $this->personne = array();
        // ------------------------------------------------------------------------

        if (isset($_POST)) {

            if($prenom){
                $this->verfier = $dbh_web->query("select p.id, p.code_personne, p.nom, p.prenom, fi.code_firme, fi.rs_comp, v.ville, f.fonction from personne p
                
                        left outer join lien_dirigeant lp on lp.code_personne = p.code_personne
                        left outer join firmes fi on fi.code_firme = lp.code_firme
                        left outer join villes v on fi.code_ville = v.code
                        left outer join fonction f on f.code = lp.code_fonction
                        where (nom = '$nom' and prenom = '$prenom') Or (prenom = '$nom' and nom = '$prenom')  ")->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
                $this->verfier = $dbh_web->query("select p.id, p.code_personne, p.nom, p.prenom, fi.code_firme, fi.rs_comp, v.ville, f.fonction from personne p
                
                        left outer join lien_dirigeant lp on lp.code_personne = p.code_personne
                        left outer join firmes fi on fi.code_firme = lp.code_firme
                        left outer join villes v on fi.code_ville = v.code
                        left outer join fonction f on f.code = lp.code_fonction
                        where (nom like '%$nom%' ) Or (prenom like '%$nom%')  ")->fetchAll(PDO::FETCH_ASSOC);
            }

        }
        $this->setTemplate('Verifierpersonne');
    }


    private function Verifiermarque($nom_marque)
    {
        // set connection ---------------------------------------------------------
        session_write_close();

        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        $db = $connection->getOptions();
        $dsn = $db['dsn'];
        preg_match("/;dbname=(.+)/",$dsn,$base_web);
        $db_name = $base_web[1];

        $this->personne = array();
        // ------------------------------------------------------------------------
        if (isset($_POST)) {
            $this->verfier = $dbh_web->query("select m.id,m.code_marque,m.nom_marque,m.description , lm.code_firme, fi.rs_comp
                from marque m 
                inner join lien_marque lm on lm.code_marque = m.code_marque
                inner join firmes fi on fi.code_firme = lm.code_firme
                where nom_marque like '$nom_marque%'")->fetchAll(PDO::FETCH_ASSOC);
        }
        $this->setTemplate('Verifiermarque');
    }
    private function getActMarque($id_lien_marque)
    {
        // set connection ---------------------------------------------------------
        session_write_close();

        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        $db = $connection->getOptions();
        $dsn = $db['dsn'];
        preg_match("/;dbname=(.+)/",$dsn,$base_web);
        $db_name = $base_web[1];

        $this->act_marque = array();
        // ------------------------------------------------------------------------

        $this->info_marque = $dbh_web->query("select code_marque, code_firme
            from lien_marque lm 
            where id = '$id_lien_marque'")->fetch();

        $this->act_marque = $dbh_web->query("select act.id,pr.lib_produit,pr.code_produit,act.code_marque,act.code_firme,act.exportateur,act.importateur,act.fda,m.nom_marque 
            from marque m 
            inner join lien_marque lm on lm.code_marque = m.code_marque
            inner join act_marque act on act.code_marque = m.code_marque and act.code_firme=lm.code_firme
            inner join produits_kompass pr on pr.code_produit = act.code_produit
            where lm.id = '$id_lien_marque'")->fetchAll(PDO::FETCH_ASSOC);
        $this->oFormActMarque = new Form("act_marque", "id", "bd_web");
        $this->formActMarque  = $this->oFormActMarque->setup();
        $this->setTemplate('GetActMarque');
    }
    public function executeHistorique($request)
    {
        // set connection ---------------------------------------------------------
        $dbh = Common::TTSConnect();
        session_write_close();

        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        $db = $connection->getOptions();
        $dsn = $db['dsn'];
        preg_match("/;dbname=(.+)/",$dsn,$base_web);
        $db_name = $base_web[1];

        $this->histo = array();
        // ------------------------------------------------------------------------
        $code_firme = $request->getParameter("code_firme");
        $parameters = $request->getPostParameters();
        if (isset($_POST)) {
            $id_user = $this->getUser()->getId();
            $cond = "";
            if (isset($parameters['Mouvement'])) {
                if (count($parameters['Mouvement']) != 0) {
                    $cond .= " AND type IN (";
                    foreach ($parameters['Mouvement'] as $mouvement):
                        if($this->getUser()->hasCredential('consulterhistorique'.$mouvement)){
                            $cond .= "'" . $mouvement . "',";
                            if($mouvement == "appel_recouvrement"){
                                $cond .= "'appel_recouvrement', 'commentaire_recouvrement', 'visite_recouvrement',";
                            }
                        }
                    endforeach;
                    $cond =substr($cond, 0, -1). ")";
                }
            }
            else{
                $cond .= " AND type IN (";
                $mouvements = array('production','miseenligne','miseajour','reclamation','affectation','encaissement','rdv','televente','marketingdirect','sav','bc','facture','backofficesiteweb','visiteeffectuees', 'impaye','opportunite', 'decouverte','commentaire','appel_recouvrement', 'appel_televente', 'visite_recouvrement', 'maj_firme', 'salon');
                foreach ($mouvements as $mouvement):
                    if($this->getUser()->hasCredential('consulterhistorique'.$mouvement)) :
                        $cond .= "'" . $mouvement . "',";
                    endif;
                endforeach;
                $cond .= " 'commentaire_recouvrement','reclamation')";
            }
            if (isset($parameters['dateFrom']) && $parameters['dateFrom']) {
                $datefrom = Common::convert_date($parameters['dateFrom'], 'Y-m-d');

                $cond .= " and date >= '$datefrom' ";
            }
            if (isset($parameters['dateTo']) && $parameters['dateTo']) {
                $dateto = Common::convert_date($parameters['dateTo'], 'Y-m-d');
                $cond .= " and date  <= '$dateto' ";
            }
            $this->code_commercial = $this->getUser()->getCode();
            $join = "";
            if (! $this->getUser()->hasCredential('consulterhistoriqueallfirme')) {

                $is_commercial = $dbh->query("select  count(courtier) as is_commercial from  $db_name.affectation WHERE concat('MA',code_firme)  = '$code_firme' 
                        and (courtier = '$this->code_commercial'  or  courtier in 
                        (select u.code_commercial from tts_utilisateur_affecte ua
                        inner join tts_utilisateur u on u.id=ua.id_utilisateur_affecte and ua.id_utilisateur=$id_user)
                        )
                        
                        ")->fetch();
                if (!$is_commercial["is_commercial"]){
                    return;
                }
            }
            $condition = "where 1=1 $cond";
            $historique_firme = $this->getVueHistorique($code_firme, $condition);

            $req = "
            select  t.*
            from    ($historique_firme) t
            ";

            $this->histo = $dbh->query($req)->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function executeDetailbc($request)
    {
        // set connection ---------------------------------------------------------
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        // ------------------------------------------------------------------------

        $num_bc = $request->getParameter("num_bc");
        $this->bc = $dbh_web->query("select bc.*,f.rs_comp,crt.nom_courtier as responsable,s.societe as nom_societe,
                                    sup.support as nom_support, bcp.date_prev  from bon_commande bc
                                    left outer join firmes f on concat('MA',bc.code_firme)=f.code_firme 
                                    left outer join courtier crt on crt.code=bc.courtier
                                    left outer join societes s on s.code=bc.societe
                                    left outer join bon_commande_prev bcp on bcp.num_bc = bc.num_bc
                                    left outer join support sup on sup.code=bc.support and sup.societe=bc.societe
                                     where bc.num_bc = $num_bc")->fetch(PDO::FETCH_ASSOC);

        $this->detail_bc = $dbh_web->query("select b.*, ifnull(r.lib_rubrique, lib_produit) as libelle_emplacement
                                        from detail_bc b
                                        left outer join produits_kompass k on k.code_produit = b.emplcement
                                        left outer join rubriques r on r.code_rubrique = b.emplcement
                                        where b.num_bc = $num_bc")->fetchAll(PDO::FETCH_ASSOC);

        $this->detail_reglement = $dbh_web->query("
                SELECT   reg.num_reglem as code, reg.date_reg as date, CONCAT_WS(' ',sup.support,' ',reg.edition, ' ', mode_reglem ) as objet,
                'responsable' as responsable,  FORMAT(mt_ttc,0,'fr_FR') as resultat FROM detail_reglement reg
                left outer join support sup on ifnull(sup.code, '')=ifnull(reg.support, '') and ifnull(sup.societe, '')=ifnull(reg.societe, '') 
                where reg.num_bc = $num_bc

            ")->fetchAll(PDO::FETCH_ASSOC);


    }
    public function executeDetailproduction($request)
    {
        // set connection ---------------------------------------------------------
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        // ------------------------------------------------------------------------

        $num_bc = $request->getParameter("num_bc");
        $this->production = $dbh_web->query("select p.*,f.rs_comp,o.nom_courtier as responsable from production p
                                    left outer join firmes f on p.code_firme=f.code_firme
                                    left outer join courtier o on o.code=p.operateur
                                     where p.num_bc = $num_bc")->fetch(PDO::FETCH_ASSOC);
        $this->detail_production  = $dbh_web->query("select r.*,s.societe as nom_societe,sup.support as nom_support from detail_reglement r
                                        left outer join societes s on s.code=r.societe
                                        left outer join support sup on sup.code=r.support and sup.societe=r.societe
                                        where r.num_bc = $num_bc")->fetchAll(PDO::FETCH_ASSOC);

    }
    public function executeModifier($request)
    {
        // set connection ---------------------------------------------------------
        $dbh = Common::TTSConnect();

        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();

        // ------------------------------------------------------------------------
        $id_user = $this->getUser()->getId();
        $id_firme = $request->getParameter("id_firme");
        $this->code_commercial = $this->getUser()->getCode();
        $code_firme = $dbh_web->query("select code_firme, date_creation from firmes where id = '$id_firme'")->fetch();
        $this->code_firme = $code_firme["code_firme"];
        $this->date_creation = $code_firme["date_creation"];

        $this->is_commercial  = $dbh_web->query("select  count(courtier) as is_commercial from  affectation WHERE courtier = '$this->code_commercial' and concat('MA',code_firme)  = '$this->code_firme' ")->fetch();


        if ($this->is_commercial["is_commercial"] || $this->getUser()->hasCredential('modifierallfirme') || $this->date_creation == date('d/m/Y')) {

            $parameters = $request->getPostParameters();
            $parameters["new_value"]=str_replace("%and%","&", $parameters["new_value"]);
            //addslashes en cas d?apostrophe

            if($parameters["champ"]=="latitude" or $parameters["champ"]=="longitude")
            {
                $parameters["new_value"] = preg_replace("/[^0-9.-]/", "", $parameters["new_value"]);
                if($parameters["new_value"] == ""){
                    $parameters["new_value"] = " ";
                }
            }
            $firme = $dbh_web->query("select " . $parameters['champ'] . ",code_firme,date_creation, lib_voie from firmes where id = '$id_firme'")->fetch();
            if ($firme[$parameters['champ']] != $parameters['new_value']) {
                // declare objet Form -----------------------------------------------------
                $this->oForm = new Form("firmes", "id", "bd_web");
                $this->oForm = $this->oForm->find('id', $id_firme);
                // set value par default of field ------------------------------------------
                if($parameters['champ'] == 'code_voie'){
                    $parameters["new_value"]=addslashes($parameters["new_value"]);
                    $valeur = explode('||' , $parameters['new_value']);

                    $voie = $dbh_web->query("select ifnull(code_ville , '') as code_ville , ifnull(code_arrondis,'') as code_arr, ifnull(code_quartier,'') as code_quart, ifnull(code_zone,'') as zone_geo from voie  where code_voie = '".$valeur['0']."'")->fetch(PDO::FETCH_ASSOC);

                    $voie_firme = $dbh_web->query("select ifnull(code_ville,'') as code_ville, ifnull(code_arr,'')  as code_arr, ifnull(code_quart,'') as code_quart, ifnull(zone_geo,'') as zone_geo from firmes where id = '$id_firme'")->fetch(PDO::FETCH_ASSOC);

                    foreach ($voie_firme as $key => $value) {

                        if($voie_firme[$key]!=$voie[$key]){
                            
                            if( substr( $valeur['0'], 0, 1) === "7" || substr( $valeur['0'], 0, 1) === "9" )
                            {

                                /*$this->oForm->setFixedValue($key, $voie[$key]);*/

                            }
        
                           else{

                                $this->oForm->setFixedValue($key, $voie[$key]);

                            }

                            if($this->getUser()->hasCredential('modif_ajout_valide'))
                            {
                                $query_historique = "INSERT INTO tts_historique_modification (code_firme, old_value, new_value,
             
                                    champ, type_modification, id_utilisateur, date_modification, table_bd, code_element, valide, date_validation, validateur) VALUES (
                                    '".$firme['code_firme']."', '".$voie_firme[$key]."', '".$voie[$key]."' ,
                                                                    '$key', '".$parameters['type_modification']."',     $id_user,  '".date("Y-m-d")."', 'firmes',
                                                 '".$firme['code_firme']."', 1, current_timestamp, $id_user
                                    )";
                            }
                            else{
                                $query_historique = "INSERT INTO tts_historique_modification (code_firme, old_value, new_value, 
                            
                                    champ, type_modification, id_utilisateur, date_modification, table_bd, code_element) VALUES (
                                    '".$firme['code_firme']."', '".$voie_firme[$key]."', '".$voie[$key]."' , 
                                        '$key', '".$parameters['type_modification']."',     $id_user,  '".date("Y-m-d")."', 'firmes',
                                                 '".$firme['code_firme']."'
                                    )";
                            }
                            $dbh_web->query($query_historique);

                        }
                    }
                    $this->oForm->setFixedValue('code_voie', $valeur['0']);

                    $ville = $valeur['1'];
                    $ville = str_replace(' - Casablanca', '', $ville);
                    $ville = str_replace(' - Autre ville', '', $ville);
                    $ville = str_replace(' - Rabat', '', $ville);
                    $this->oForm->setFixedValue('lib_voie', $ville);
                    $parameters['new_value'] = $valeur['0'];
                    $this->form = $this->oForm->setup();
                    $res = $this->oForm->save();



                    if($this->getUser()->hasCredential('modif_ajout_valide'))
                    {
                        $query_historique = "INSERT INTO tts_historique_modification (code_firme, old_value, new_value,
                                    champ, type_modification, id_utilisateur, date_modification, table_bd, code_element, valide, date_validation, validateur) VALUES (
                                    '".$firme['code_firme']."', '".$firme['lib_voie']."', '".$ville."' ,
                                                        'lib_voie', '".$parameters['type_modification']."',     $id_user,  '".date("Y-m-d")."', 'firmes',
                                                 '".$firme['code_firme']."', 1, current_timestamp, $id_user
                                    )";

                    }
                    else{
                        $query_historique = "INSERT INTO tts_historique_modification (code_firme, old_value, new_value,
                                    champ, type_modification, id_utilisateur, date_modification, table_bd, code_element) VALUES (
                                    '".$firme['code_firme']."', '".$firme['lib_voie']."', '".$ville."' ,
                                                        'lib_voie', '".$parameters['type_modification']."',     $id_user,  '".date("Y-m-d")."', 'firmes',
                                                 '".$firme['code_firme']."'
                                    )";

                    }

                    $dbh_web->query($query_historique);

                }
                else{
                    $this->oForm->setFixedValue($parameters['champ'], $parameters['new_value']);
                }
                if($parameters['new_value']=='0')
                    $dbh_web->query("update firmes set ".$parameters['champ']."='".$parameters['new_value']."' where code_firme = '".$firme['code_firme']."'");
                else
                {
                    // setup param of form ----------------------------------------------------
                    $this->form = $this->oForm->setup();
                    // save data of form ------------------------------------------------------
                    $res = $this->oForm->save();
                }
                // Insert mouvement-------------------------------
                $type_champ = $dbh->query("SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS 
                    WHERE TABLE_NAME = 'firmes' AND COLUMN_NAME = '".$parameters['champ']."'")->fetch();
                if($type_champ['DATA_TYPE']=='int')
                    $parameters['new_value']=(int)$parameters['new_value'];

                myUser::ajout_historique_ligne($parameters['champ'],$firme['code_firme'],$parameters['new_value'],$firme[$parameters['champ']],$parameters['type_modification'], $firme['code_firme'], 'firmes');

            }
        }
    }


    private function getVueHistorique($code_firme, $cond){
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        $db = $connection->getOptions();
        $dsn = $db['dsn'];
        preg_match("/;dbname=(.+)/",$dsn,$base_web);
        $db_name = $base_web[1];

        $requete = "SELECT * from (select  'opportunite' as type ,o.code as code,o.date_creation as date,o.objet as objet,concat(u.prenom,' ',u.nom) as responsable,o.code_firme as code_firme,s.statut as resultat FROM tts_opportunite o
            left outer join par_tts_opportunite_statut s on ifnull(s.id, '')=ifnull(o.id_statut_opportunite, '')
            left outer join tts_utilisateur u on u.code_commercial = o.code_commercial
            where o.code_firme = '$code_firme' ) aff1 $cond
            UNION
            select * from (SELECT  'reclamation' as type,r.code as code,r.date_creation as date,r.objet as objet,concat(u.prenom,' ',u.nom) as responsable,r.code_firme as code_firme,case when is_resolue = 1 then 'fermee' else 'ouverte' end as resultat FROM tts_reclamation r
            left outer join par_tts_type_reclamation t on ifnull(t.id, '')=ifnull(r.id_type_reclamation, '')
            left outer join tts_utilisateur u on u.id = r.id_createur
            where r.code_firme = '$code_firme' )aff2 $cond
            UNION
            select * from (SELECT  'visiteeffectuees' as type,vr.id as code,vr.date_visite as date,tvr.libelle as objet,concat(u.prenom,' ',u.nom) as responsable,vr.code_firme as code_firme, t.libelle as resultat FROM tts_visites_realisees vr inner join par_tts_type_visite tvr on vr.id_type_visite = tvr.id
            left outer join par_tts_type_visite t on ifnull(t.id, '')=ifnull(vr.id_type_visite, '')
            left outer join tts_utilisateur u on u.id = vr.id_utilisateur
            where vr.code_firme = '$code_firme') aff2 $cond
            UNION 
            select * from (SELECT  'decouverte' as type,d.id as code,d.date_creation as date,
            d.activite as objet,CONCAT( u.nom,' ', u.prenom ) as responsable,d.code_firme as code_firme,
            '' as resultat FROM tts_decouverte d
            left outer join tts_utilisateur u on d.id_createur= u.id
            where   d.code_firme = '$code_firme') aff11 $cond
            UNION
            select * from (SELECT  'commentaire' as type,r.id as code,r.date_creation as date,
            r.commentaire as objet,CONCAT( u.nom,' ', u.prenom ) as responsable,r.code_firme as code_firme,
            '' as resultat FROM tts_commentaire r
            left outer join tts_utilisateur u on r.id_createur= u.id
            where   r.code_firme = '$code_firme') aff11 $cond
            UNION
            select * from (SELECT  'commentaire_recouvrement' as type,r.id as code,r.date_creation as date,
            r.commentaire as objet,CONCAT( u.nom,' ', u.prenom ) as responsable,r.code_firme as code_firme,
            '' as resultat FROM tts_commentaire r
            inner join tts_utilisateur u on r.id_createur= u.id
            where   r.code_firme = '$code_firme' and u.id_service = '7' ) aff11 $cond
            UNION
            select * from (SELECT  'affectation' as type,e.code_firme as code,e.date_evennement as date,CONCAT_WS(' ',sup.support,' ',e.edition) as objet,crt.nom_courtier as responsable,concat('MA',e.code_firme) as code_firme,res.libelle as resultat FROM $db_name.evenement e
            left outer join $db_name.support sup on ifnull(sup.code, '')=ifnull(e.support, '') and ifnull(sup.societe, '')=ifnull(e.societe, '')
            left outer join $db_name.resultat_affectations res on ifnull(res.code,'')=ifnull(e.resultat, '')
            left outer join $db_name.courtier crt on ifnull(crt.code, '') = ifnull(e.courtier, '')
            where service='Affectations' and concat('MA',e.code_firme) = '$code_firme') aff3 $cond
            UNION
            select * from (SELECT  'encaissement' as type,e.code_firme as code,e.date_evennement as date,CONCAT_WS(' ',sup.support,' ',e.edition) as objet,crt.nom_courtier as responsable,concat('MA',e.code_firme) as code_firme,res.libelle as resultat FROM $db_name.evenement e
            left outer join $db_name.support sup on ifnull(sup.code, '')=ifnull(e.support, '') and ifnull(sup.societe, '')=ifnull(e.societe, '')
            left outer join $db_name.resultat_encaissements res on ifnull(res.code,'')=ifnull(e.resultat, '')
            left outer join $db_name.courtier crt on ifnull(crt.code, '') = ifnull(e.courtier, '')
            where service='Encaissement'  and concat('MA',e.code_firme) = '$code_firme') aff4 $cond
            UNION
            select * from (SELECT  'rdv' as type,e.code_firme as code,e.date_evennement as date,CONCAT_WS(' ',sup.support,' ',e.edition) as objet,crt.nom_courtier as responsable,concat('MA',e.code_firme) as code_firme,res.libelle as resultat FROM $db_name.evenement e
            left outer join $db_name.support sup on ifnull(sup.code=e.support, '') and ifnull(sup.societe=e.societe, '')
            left outer join $db_name.resultat_rdv res on ifnull(res.code, '')=ifnull(e.resultat, '')
            left outer join $db_name.courtier crt on ifnull(crt.code, '') = ifnull(e.courtier, '')
            where service='rdv'  and concat('MA',e.code_firme) = '$code_firme') aff5 $cond
            UNION
            select * from (SELECT  'televente' as type,e.code_firme as code,e.date_evennement as date,CONCAT_WS(' ',sup.support,' ',e.edition) as objet,crt.nom_courtier as responsable,concat('MA',e.code_firme) as code_firme,res.libelle as resultat FROM $db_name.evenement e
            left outer join $db_name.support sup on ifnull(sup.code, '')=ifnull(e.support, '') and ifnull(sup.societe, '')=ifnull(e.societe, '')
            left outer join $db_name.resultat_televentes res on ifnull(res.code,'')=ifnull(e.resultat, '')
            left outer join $db_name.courtier crt on ifnull(crt.code, '') = ifnull(e.courtier, '')
            where service='televente'  and concat('MA',e.code_firme) = '$code_firme') aff6 $cond
            UNION
            select * from (SELECT  'bc' as type,c.num_bc as code,c.date_bc as date,CONCAT_WS(' ',sup.support,' ',c.edition,' ',(case when avocat = 1 then 'Avocat' else '' end)) as objet,crt.nom_courtier as responsable,concat('MA',c.code_firme) as code_firme,FORMAT(mt_ttc,0,'fr_FR') as resultat FROM $db_name.bon_commande c
            left outer join $db_name.support sup on ifnull(sup.code, '')=ifnull(c.support, '') and ifnull(sup.societe, '')=ifnull(c.societe, '')
            left outer join $db_name.courtier crt on ifnull(crt.code, '') = ifnull(c.courtier, '') 
            where  concat('MA',c.code_firme) = '$code_firme') aff7 $cond
            UNION
            select * from (SELECT  'production' as type,p.num_bc as code,p.date_operateur as date,CONCAT_WS(' ',sup.support,' ',p.edition) as objet,crt.nom_courtier as responsable,concat('MA',p.code_firme) as code_firme,p.resultat_bat as resultat FROM $db_name.production p
            left outer join $db_name.support sup on ifnull(sup.code, '')=ifnull(p.support, '') and ifnull(sup.societe, '')=ifnull(p.societe, '')
            left outer join $db_name.courtier crt on ifnull(crt.code, '') = ifnull(p.operateur, '') 
            where  concat('MA',p.code_firme) = '$code_firme') aff8 $cond
            UNION
            select * from (SELECT  'encaissement' as type,reg.num_reglem as code,reg.date_encais as date,CONCAT_WS(' ',sup.support,' ',reg.edition, ' ', mode_reglem ) as objet,'responsable' as responsable,concat('MA',reg.code_firme) as code_firme,FORMAT(mt_ttc,0,'fr_FR') as resultat FROM $db_name.detail_reglement reg
            left outer join $db_name.support sup on ifnull(sup.code, '')=ifnull(reg.support, '') and ifnull(sup.societe, '')=ifnull(reg.societe, '') 
            where  concat('MA',reg.code_firme) = '$code_firme') aff9 $cond
            
            UNION
            select * from (SELECT  'impaye' as type,imp.num_reglem as code,imp.date_impaye as date,CONCAT_WS(' ',sup.support,' ',imp.edition, ' ', mode_reglem) as objet,'responsable' as responsable,concat('MA',imp.code_firme) as code_firme,FORMAT(mt_ttc,0,'fr_FR') as resultat FROM $db_name.detail_reglement imp
            left outer join $db_name.support sup on ifnull(sup.code, '')=ifnull(imp.support, '') and ifnull(sup.societe, '')=ifnull(imp.societe, '')
            where ifnull(impaye,0) !='0' and ifnull(impaye,0) !='' and  concat('MA',imp.code_firme) = '$code_firme') aff10 $cond
            
            UNION
            select * from (SELECT  'impaye' as type,e.code_firme as code,e.date_evennement as date,CONCAT_WS(' ',sup.support,' ',e.edition) as objet,crt.nom_courtier as responsable,concat('MA',e.code_firme) as code_firme,concat(res.libelle,' ', dossier) as resultat FROM $db_name.evenement e
            left outer join $db_name.support sup on ifnull(sup.code, '')=ifnull(e.support, '') and ifnull(sup.societe, '')=ifnull(e.societe, '')
            left outer join $db_name.resultat_televentes res on ifnull(res.code,'')=ifnull(e.resultat, '')
            left outer join $db_name.courtier crt on ifnull(crt.code, '') = ifnull(e.courtier, '')
            where service like 'impay%'  and concat('MA',e.code_firme) = '$code_firme') aff6 $cond
            
            UNION
            select * from (SELECT  'appel_recouvrement' as type,'' as code,d.date_appel as date,
            CONCAT_WS(' ',contact,' ',sup.support,' ', fonction, ' Num BC:', d.num_bc) as objet, crt.nom_courtier as responsable, concat('MA',d.code_firme)  as code_firme,
            concat(resultat,' ', observation) as resultat  FROM $db_name.appel_recouvrement d
            left outer join $db_name.support sup on ifnull(sup.code, '')=ifnull(d.support, '') and ifnull(sup.societe, '')=ifnull(d.societe, '')
            left outer join $db_name.courtier crt on ifnull(crt.code, '') = ifnull(d.operateur, '')
            where  concat('MA', d.code_firme) = '$code_firme') aff12 $cond
            UNION
            select * from (SELECT  'appel_televente' as type,'' as code,d.date_appel as date,
            CONCAT_WS(' ',contact,' ',sup.support,' ', fonction) as objet, crt.nom_courtier as responsable, concat('MA',d.code_firme)  as code_firme,
            concat(resultat,' ', observation) as resultat  FROM $db_name.appel_televente d
            left outer join $db_name.support sup on ifnull(sup.code, '')=ifnull(d.support, '') and ifnull(sup.societe, '')=ifnull(d.societe, '')
            left outer join $db_name.courtier crt on ifnull(crt.code, '') = ifnull(d.operateur, '')
            where  concat('MA', d.code_firme) = '$code_firme') aff12 $cond
            UNION
            select * from (SELECT  'visite_recouvrement' as type,'' as code,d.date_visite as date,
            CONCAT_WS(' ',contact,' ',sup.support, ' ', fonction, ' Num BC:', d.num_bc) as objet, crt.nom_courtier as responsable, concat('MA',d.code_firme)  as code_firme,
            concat(resultat,' ', observation) as resultat  FROM $db_name.visite_recouvrement d
            left outer join $db_name.support sup on ifnull(sup.code, '')=ifnull(d.support, '') and ifnull(sup.societe, '')=ifnull(d.societe, '')
            left outer join $db_name.courtier crt on ifnull(crt.code, '') = ifnull(d.operateur, '')
            where   concat('MA',d.code_firme) = '$code_firme') aff13 $cond
            UNION
            select * from (SELECT  'maj_firme' as type,'' as code,d.date_info as date,
            CONCAT_WS(' ',support,' ', origine_info) as objet, crt.nom_courtier as responsable, concat('MA',d.code_firme)  as code_firme,
            type as resultat  FROM $db_name.maj_firme d
            left outer join $db_name.courtier crt on ifnull(crt.code, '') = ifnull(d.operateur, '')
            where   d.code_firme = '$code_firme') aff14 $cond
            UNION
            select * from (SELECT  'salon' as type,'' as code, date(concat(annee,'-01-01')) as date,
            nom_salon as objet, '' as responsable, d.code_firme  as code_firme,
            case when exposant = 1 then 'Exposant' else case when visiteur = 1 then 'Visiteur' else '' end end as resultat  FROM $db_name.salon d
            where   d.code_firme = '$code_firme') aff15 $cond
            
            ";
        return $requete;
    }

    public function executeSupprimer(sfWebRequest $request)
    {
        // set connection ---------------------------------------------------------
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        //get parametrs------------------------------------------------------
        $code_firme = $request->getParameter('code_firme');

        if($code_firme){
            try {
                $dbh_web->query("delete from lien_dirigeant where code_firme='$code_firme'");
                $dbh_web->query("delete from lien_email where code_firme='$code_firme'");
                $dbh_web->query("delete from lien_fax where code_firme='$code_firme'");
                $dbh_web->query("delete from lien_marque where code_firme='$code_firme'");
                $dbh_web->query("delete from lien_portable where code_firme='$code_firme'");
                $dbh_web->query("delete from lien_produits_kompass where code_firme='$code_firme'");
                $dbh_web->query("delete from lien_rubrique_internet where code_firme='$code_firme'");
                $dbh_web->query("delete from lien_rubrique_telecontact where code_firme='$code_firme'");
                $dbh_web->query("delete from lien_telephone where code_firme='$code_firme'");

                $dbh_web->query("delete from firmes where code_firme = '$code_firme' ");
                myUser::ajout_historique_ligne('Firme',$code_firme,'','',"suppression d'une firme", $code_firme, "Firmes" );
                Common::setTracabilite("Firmes", $code_firme, "supprimer Firme", $login, "crm");
                $this->getUser()->setFlash('error','la firme a bien &eacute;t&eacute; supprim&eacute;e');
            }catch( Exception $e ){
                $this->getUser()->setFlash('error','une erreur est survenue au niveau de la suppression! veuillez contacter votre administrateur !');

            }
        }

        $this->redirect("Firme/index");
    }

    public function executeUpdateOrdre(sfWebRequest $request)
    {
        sfConfig::set('sf_escaping_strategy', false);
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        $id = "";
        $login = $this->getUser()->getId();
        $div_sorts = $_POST['div_sort'];
        $tab = $_POST['table'];
        foreach( $div_sorts as $order => $id_tb){
            $id = $id_tb;
            $dbh_web->query("
                update $tab set num_ordre = '$order'+1
                where  id = '$id_tb' ");
        }
        $code_firme = $dbh_web->query("select code_firme from $tab where id = $id")->fetch();

        myUser::ajout_historique_ligne('num_ordre',$code_firme['code_firme'],'','',"modification ordre ".$tab, $code_firme['code_firme'], $tab );

        return $this->renderText("1");
    }

}

