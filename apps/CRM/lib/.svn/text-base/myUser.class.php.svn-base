<?php

class myUser extends sfBasicSecurityUser
{
    public function getId(){
        return $this->getAttribute('id',null,'CRMUser');
    }
    public function getCode(){
        return $this->getAttribute('code',null,'CRMUser');
    }
    public function getIds_user_affecte(){
        $dbh = Common::TTSConnect();
        $id_user=$this->getId();
        $result = $id_user;
        $id_user_affectes = $dbh->query("select ua.id_utilisateur_affecte from tts_utilisateur_affecte ua where ua.id_utilisateur=$id_user")->fetchAll();
        foreach($id_user_affectes as $id_user_affecte){
             $result .= " , ". $id_user_affecte["id_utilisateur_affecte"];
        }
        return $result;
    }
    public function getCodes_user_affecte(){
        $dbh = Common::TTSConnect();
        $id_user=$this->getId();
        $result = "'".$this->getCode()."'";
        $id_user_affectes = $dbh->query("select u.code_commercial from tts_utilisateur_affecte ua
                inner join tts_utilisateur u on u.id=ua.id_utilisateur_affecte and ua.id_utilisateur=$id_user and ifnull(u.code_commercial,'') != '' ")->fetchAll();
        foreach($id_user_affectes as $id_user_affecte){
             $result .= " , '". $id_user_affecte["code_commercial"]."'";
        }
        return $result;
    }
    

    public function getAlerte(){

        // set connection ---------------------------------------------------------
        $dbh = Common::TTSConnect();
        
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
        // ------------------------------------------------------------------------
        $resultat_query = myUser::getQuerieAlerte();
        $this->resultat = array();
        foreach ($resultat_query as $k => $each) {
            if($each['bd'] == 'crm') $db = $dbh;
            else $db = $dbh_web;
            $res = $db->query("select $each[op] from ($each[query]) t")->fetch();
            
            if ($res[0]) {
                $this->resultat[$k]["result"]  =  $res[0];
                $this->resultat[$k]["libelle"] =  $resultat_query[$k]["libelle"];
                $this->resultat[$k]["class"]   =  $resultat_query[$k]["class"];
                $this->count += $res[0];
            }
        }
        
       
        return $this->resultat;
    
    }
    

    public function getQuerieAlerte(){

        $id_user=$this->getUser()->getId();

        $code_commercial = $this->getUser()->getCode();

        $ids_users_affecte=$this->getUser()->getIds_user_affecte();
        $codes_users_affecte=$this->getUser()->getCodes_user_affecte();

        $cond_opp = "";
        $cond_courtier= "";
        $cond_utilisateur= "";
        $cond_createur= "";
        $cond_createur_recouvrement = "";
        $heure_actuel = date('Hm')   ;

        if(!$this->getUser()->hasCredential('allalerte')){
           $cond_opp = "and u.id in ($ids_users_affecte) ";
           $cond_courtier = "and crt.code in ($codes_users_affecte) ";
           $cond_utilisateur= "and id_utilisateur in ($ids_users_affecte) ";
           $cond_createur= "and id_createur in ($ids_users_affecte) ";
           $cond_createur_recouvrement= "and operateur in ($codes_users_affecte) ";
        }

        $queries["opportunite_retard"] = array(
            "libelle" => "Opportunite(s) en retard",
            "query" => " select  f.id , f.code_firme as 'Code Firme', f.rs_comp as Firme, op.date_echeance as 'Date Echeance',op.objet as Objet, 
                       os.statut as Statut, ot.type as Type, concat(u.prenom,' ',u.nom) as Commercial
                       from tts_opportunite op 
                       inner join par_tts_opportunite_statut os on os.id = op.id_statut_opportunite
                       left outer join par_tts_opportunite_type ot on ot.id = op.id_type_opportunite
                       inner join tts_utilisateur u on u.code_commercial = op.code_commercial
                       left outer join tts_firmes f ON f.code_firme = op.code_firme 
                       where op.date_echeance < current_timestamp $cond_opp and (os.statut like '%cours%' Or os.statut like '%Devis%' )" ,
            "op" => "count(*)",
            "type" => "Tache",
            "class" => " icon-copy",
            "bd" => "crm"
            );

        $date_fin= date('Y-m-d', strtotime("+60 days"));

        $queries["fin_mise_en_ligne"] = array(
            "libelle" => "Fin(s) de mise en ligne",
            "query" => "select f.id , f.code_firme as 'Code Firme', f.rs_comp as 'Raison Sociale', bc.num_bc as 'Numero ordre', dbc.date_fin as 'Date Fin', concat(ifnull(produit_papier,''),' ', ifnull(produit_internet,'')) as produit, sup.support as 'Support', s.societe as 'Societe'
                from detail_bc dbc 
                inner join bon_commande bc on bc.num_bc = dbc.num_bc 
                left outer join support sup on sup.code=bc.support and sup.societe=bc.societe
                inner join courtier crt on crt.code= bc.courtier $cond_courtier 
                inner join firmes f ON f.code_firme = concat('MA',bc.code_firme )
                left outer join societes s on s.code = bc.societe 
                where dbc.date_fin BETWEEN NOW() and '$date_fin' 
               ",
            "op" => "count(*)",
            "type" => "Tache",
            "class" => " icon-envelop",
            "bd" => "bd_web"
        );


        $date_debut_alerte_paiement= date('Y-m-d', strtotime("-30 days"));
        $date_trois_apres= date('Y-m-d', strtotime("+3 days"));
        $date_deux_apres= date('Y-m-d', strtotime("+2 days"));
        $date_fin_alerte_paiement= date('Y-m-d', strtotime("-90 days"));
        $queries["rappel_recouvrement"] = array(
            "libelle" => " Client(s) a relancer pour paiement",
            "query" => "select  f.id , f.code_firme as 'Code Firme', f.rs_comp as Firme, bc.num_bc as 'Numero ordre', bc.date_bc, bc.mt_ttc , bc.reglem_ttc, date_prev
            from bon_commande bc
            left outer join bon_commande_prev bcp on bcp.num_bc = bc.num_bc and bcp.code_firme  = bc.code_firme 
            inner join courtier crt on crt.code= bc.courtier $cond_courtier
            inner join firmes f ON f.code_firme = concat('MA',bc.code_firme )
            where bcp.date_prev BETWEEN '$date_fin_alerte_paiement' and '$date_debut_alerte_paiement' and bc.mt_ttc > bc.reglem_ttc
            ",
            "op" => "count(*)",
            "type" => "Tache",
            "class" => " icon-envelop",
            "bd" => "bd_web"
        );
        $queries["cr__visite_a_renseigner"] = array(
            "libelle" => " Compte(s) rendu de visites a renseigner",
            "query" => "select f.id , f.code_firme as 'Code Firme', f.rs_comp as Firme, v.date_visite as 'Date visite'
            from tts_visites_planifiees v
            inner join tts_firmes f ON f.code_firme = v.code_firme
            where v.date_visite BETWEEN $date_debut_alerte_paiement and NOW() and realise=0 $cond_utilisateur
            ",
            "op" => "count(*)",
            "type" => "Tache",
            "class" => " icon-address-book",
            "bd" => "crm"
        );

        $queries["cr__visite_prevu"] = array(
            "libelle" => " visites prévus est dans 3 jours",
            "query" => "select  f.id ,f.code_firme as 'Code Firme', f.rs_comp as Firme, v.date_visite as 'Date visite'
            from tts_visites_planifiees v
            inner join tts_firmes f ON f.code_firme = v.code_firme
            where v.date_visite BETWEEN  NOW() and '$date_trois_apres' $cond_utilisateur
            ",
            "op" => "count(*)",
            "type" => "Tache",
            "class" => " icon-calendar",
            "bd" => "crm"
        );
        $queries["visite_recouvrement_prevu"] = array(
            "libelle" => " visites recouvrement prévue dans 2 jours",
            "query" => "select  f.id ,f.code_firme as 'Code Firme', f.rs_comp as Firme, v.date_visite as 'Date visite', date_prochaine_visite
            from visite_recouvrement v
            inner join firmes f ON f.code_firme = concat('MA',v.code_firme )
            where v.date_prochaine_visite BETWEEN  NOW() and '$date_deux_apres'  $cond_createur_recouvrement
            ",
            "op" => "count(*)",
            "type" => "Tache",
            "class" => " icon-calendar",
            "bd" => "bd_web"
        );
        $queries["appel_recouvrement_prevu"] = array(
            "libelle" => " appels recouvrement prévue dans 2 jours",
            "query" => "select f.id , f.code_firme as 'Code Firme', f.rs_comp as Firme, v.date_appel as 'Date Appel', date_rappel
            from appel_recouvrement v
            inner join firmes f ON f.code_firme = concat('MA',v.code_firme )
            where v.date_rappel BETWEEN  NOW() and '$date_deux_apres'  $cond_createur_recouvrement
            ",
            "op" => "count(*)",
            "type" => "Tache",
            "class" => " icon-calendar",
            "bd" => "bd_web"
        );
        $queries["appel_televente_prevu"] = array(
            "libelle" => " appels televente prévue dans 2 heures",
            "query" => "select f.id , f.code_firme as 'Code Firme', f.rs_comp as Firme, v.date_appel as 'Date Appel', date_rappel
            from appel_televente v
            inner join firmes f ON f.code_firme = concat('MA',v.code_firme )
            where v.date_rappel =  NOW() and cast(appel_heure_rappel as  UNSIGNED ) between  cast('$heure_actuel' as UNSIGNED ) and cast('$heure_actuel' as UNSIGNED )+200  $cond_createur_recouvrement
            ",
            "op" => "count(*)",
            "type" => "Tache",
            "class" => " icon-calendar",
            "bd" => "bd_web"
        );
        $queries["cr__opportunite_prevu"] = array(
            "libelle" => " opportunités arrivent dans 3 jours",
            "query" => "select  f.id ,f.code_firme as 'Code Firme', f.rs_comp as Firme, op.date_echeance as 'Date echeance', concat(u.prenom,' ',u.nom) as Commercial
            from tts_opportunite op
            inner join tts_firmes f ON f.code_firme = op.code_firme
            inner join tts_utilisateur u on u.code_commercial = op.code_commercial
            where op.date_echeance BETWEEN NOW() and '$date_trois_apres' $cond_opp
            ",
            "op" => "count(*)",
            "type" => "Tache",
            "class" => " icon-brain",
            "bd" => "crm"
        );

        $queries["firme_ajoute"] = array(
            "libelle" => " Nouvelle(s) Firme(s) ",
            "query" => "select code, date 
            from tts_tracabilite t 
            where operation like '%Ajouter firme%' and id_user = $id_user
            ",
            "op" => "count(*)",
                "type" => "Tache",
                "class" => " icon-address-book",
            "bd" => "crm"
            );


        $queries["reclamation_a_traiter"] = array(
            "libelle" => " Reclamation(s) a traiter",
            "query" => "select f.id , f.code_firme as 'Code Firme', f.rs_comp as Firme, r.date_reclamation as Date, r.objet as Objet
            from tts_reclamation r
            inner join tts_firmes f ON f.code_firme = r.code_firme
            where ifnull(is_resolue,0) != 1  $cond_createur
            ",
            "op" => "count(*)",
                "type" => "Tache",
                "class" => " icon-address-book",
                "bd" => "crm"
            );


        if ($this->getUser()->hasCredential('alerte_reclamation_cloturee')) {
            $date_fin_alerte_reclamation_traitees = date('Y-m-d', strtotime("-30 days"));
            $queries["reclamation_cloturee"] = array(
                "libelle" => " Reclamation(s) cloturees",
                "query" => "select f.id , f.code_firme as 'Code Firme', f.rs_comp as Firme, r.date_reclamation as Date, r.objet as Objet
                from tts_reclamation r
                inner join tts_firmes f ON f.code_firme = r.code_firme
                where ifnull(is_resolue,0) = 1 and  date_resolution BETWEEN '$date_fin_alerte_reclamation_traitees' and NOW()
                ",
                    "op" => "count(*)",
                    "type" => "Tache",
                    "class" => " icon-address-book",
                    "bd" => "crm"
                );
        }
            return $queries;
    }
    function ajout_historique_ligne($ligne,$code_firme,$new_value,$old_value = null,$type_modification, $code_element = "", $table = "")
    {
        
        //traitement des valeurs nulles:
        if($new_value === null) $new_value = "";
        if($old_value === null) $old_value = "";
        
        // set connection ---------------------------------------------------------
        $dbh = Common::TTSConnect();
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
        // ------------------------------------------------------------------------
        $id_user = $this->getUser()->getId();
        $this->code_commercial = $this->getUser()->getCode();
        
        if ($code_firme) {
            $valide = $dbh_web->query("select ifnull(valide,0) as valide from tts_firme_ajoute where code_firme = '$code_firme'")->fetch();
            
            $this->oFormMouvement = new Form("tts_historique_modification", "id", "bd_web");
            $this->oFormMouvement->setFixedValue("id_utilisateur", $id_user);
            if ($ligne == 'tp_40' or $ligne == 'code_voie' or $ligne == 'comp_voie' or $ligne == 'num_voie' or $ligne == 'comp_num_voie' or $ligne == 'code_ville' or $ligne == 'code_quart' or $ligne == 'rs_comp'){
                $this->oFormMouvement->setFixedValue("valide", 0);
            }
            elseif($valide && $valide['valide'] == 0){
                $this->oFormMouvement->setFixedValue("valide", 0);
            }
            elseif ($type_modification == "modification des informations des personnes" Or $type_modification == "modification des informations des dirigeants" Or $type_modification == "ajout d'une personne") {
                $valide_personne = $dbh_web->query("select ifnull(valide,0) as valide from tts_personne_ajout where code_personne = '$code_element'")->fetch();
                if($valide_personne && $valide_personne['valide'] == 0){
                    $this->oFormMouvement->setFixedValue("valide", 0);
                }
                else{
                    $this->oFormMouvement->setFixedValue("valide", 1);
                }
            }
            else{
                $this->oFormMouvement->setFixedValue("valide", 1);
            }
            $this->oFormMouvement->setFixedValue("code_firme", $code_firme);
            $this->oFormMouvement->setFixedValue("champ", $ligne);
            $this->oFormMouvement->setFixedValue("type_modification", $type_modification);
            $this->oFormMouvement->setValue("old_value", $old_value);
            $this->oFormMouvement->setValue("new_value", $new_value);
            if($this->getUser()->hasCredential('modif_ajout_valide'))
            {
                $this->oFormMouvement->setFixedValue("valide", 1);
                $this->oFormMouvement->setFixedValue("date_validation", date("d/m/Y"));
                $this->oFormMouvement->setFixedValue("validateur", $id_user);
            }
            if ($code_element) {
                $this->oFormMouvement->setValue("code_element", $code_element);
            }
            if ($table) {
                $this->oFormMouvement->setValue("table_bd", $table);
            }
            $this->oFormMouvement->setFixedValue('date_modification', date("d/m/Y"));
            // setup param of form ----------------------------------------------------
            $this->form = $this->oFormMouvement->setup();
            // save data of form ------------------------------------------------------
            $this->oFormMouvement->save(true);
            
            Common::setTracabilite("Firmes", $code_firme, $type_modification . " " . $ligne, $id_user, "crm");
        }
        
    }
    public function EnvoyerEmail($message,$subject, $emails) {
        $destinataire = "";
        foreach ( $emails as $emails_t ) {
            $destinataire .= " " . $emails_t . " ,";
        }
        
        $destinataire = substr ( $destinataire, 0, - 1 );
        
        $headers = 'From: moderation.crm@gmail.com' . "\r\n";
        $headers .= "X-Mailer: PHP " . phpversion () . "\n";
        $headers .= "X-Priority: 1 \n";
        $headers .= "Mime-Version: 1.0\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n";
        $headers .= "Content-type: text/html; charset= utf-8\n";
        $headers .= "Date:" . date ( "D, d M Y h:s:i" ) . " +0200\n";
        
        $res = mail ( $destinataire, $subject, $message, $headers );
        return $res;
    }
    
}
