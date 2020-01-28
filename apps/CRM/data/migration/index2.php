<html>
<head></head>
<body>

<?php




$Migr = new CMigration("","TTS_Habilitation_action");
$Migr->notDuplicate();
$Migr->fill(array(
		

    array("module" => "Suivi","action" => "consulterhistoriqueallfirme","description" => "Consulter Historique de toutes les firmes"),
    array("module" => "Tracabilite","action" => "tracabilite","description" => "Consulter l historique des actions des utilisateurs"),
    array("module" => "Tracabilite","action" => "nombreconnexiontracabilite","description" => "Nombre de connexion par utilisateur"),
    array("module" => "Tracabilite","action" => "derniereactiontracabilite","description" => "Date et heure de derniere activite"),
    array("module" => "Suivi","action" => "allbc","description" => "Voir tous les Bons de commande"),
    array("module" => "Reporting","action" => "renouvellementcommandereporting","description" => "Consulter le Reporting Renouvellement commande"),
    array("module" => "Reporting","action" => "activitecommercialereporting","description" => "Consulter le Reporting d activite commerciale"),
    array("module" => "Reporting","action" => "allactivitecommercialereporting","description" => "Consulter le Reporting d activite commerciale de tous les commerciaux"),
    array("module" => "Alerte","action" => "alerte_reclamation_cloturee","description" => "Consulter les alertes sur les reclamations cloturees"),
    array("module" => "Objectif","action" => "objectif","description" => "Suivi des objectifs"),
    array("module" => "Reporting","action" => "suiviremreporting","description" => "Consulter le Reporting Suivi rem client"),
    array("module" => "Objectif","action" => "allobjectif","description" => "Consulter le suivi des objectifs de tous les commerciaux"),
    array("module" => "Firme","action" => "modif_ajout_valide","description" => "validation automatique des ajouts et modifs de la base"),
    array("module" => "Suivi","action" => "validationtracabilite","description" => "Consulter les rejets et les validation"),
	array("module" => "Recouvrement","action" => "recouvrement","description" => "Consulter les encaissements"),
    array("module" => "Recouvrement","action" => "consulterrecouvrement","description" => "Consulter le detail des encaissements"),
    
    array("module" => "Recouvrement","action" => "suiviagentrecouvrement","description" => "Suivi du recouvrement par agent"),
    array("module" => "Recouvrement","action" => "suiviresultatrecouvrement","description" => "Suivi du recouvrement par resultat"),
    array("module" => "Recouvrement","action" => "planningplanning_recouvrement","description" => "Consulter le planning de recouvrement"),
	array("module" => "Suivi","action" => "allencaissement","description" => "Consulter tous les encaissements"),
    array("module" => "Recouvrement","action" => "detailrecouvrement","description" => "Consulter le detail des reportings"),
    array("module" => "Televente","action" => "televente","description" => "Gestion de la televente"),
    array("module" => "Televente","action" => "consultertelevente","description" => "Consulter le detail des televentes"),
    array("module" => "Televente","action" => "planningplanning_televente","description" => "Consulter le planning de televente"),
    array("module" => "Televente","action" => "suiviteleventetelevente","description" => "Suivi de la televente"),
    array("module" => "Suivi","action" => "alltelevente","description" => "Consulter toute la televente"),

));




$Migr = new CMigration("","par_tts_visite_resultat");
$Migr->notDuplicate();
$Migr->fill(array(


    array("resultat" => "Pas intéressé"),
    array("resultat" => "Déjà client"),
    array("resultat" => "Cessation"),
    array("resultat" => "BC signé"),
    array("resultat" => "Intéressé - devis à envoyer "),
    array("resultat" => "Intéressé - A relancer plus tard"),
    array("resultat" => "Intéressé - Accord de principe "),
    

));

$Migr = new CMigration("","par_etape_vente");
$Migr->notDuplicate();
$Migr->fill(array(

    array("libelle" => "Prise de contact"),
    array("libelle" => "Presentation support"),
    array("libelle" => "Decouverte"),
    array("libelle" => "Proposition")
    
));

$Migr = new CMigration("","tts_objectif");
$Migr->notDuplicate();
$Migr->fill(array(


    array("type" => "Objectif Financier","objectif"=>"cmd_nc_nb"),
    array("type" => "Objectif Financier","objectif"=>"cmd_nc_mt"),
    array("type" => "Objectif Financier","objectif"=>"cmd_rc_nb"),
    array("type" => "Objectif Financier","objectif"=>"cmd_rc_mt"),
    array("type" => "Objectif Financier","objectif"=>"cmd_rct_nb"),
    array("type" => "Objectif Financier","objectif"=>"cmd_rct_mt"),
    array("type" => "Objectif Financier","objectif"=>"cmd_taux_nb"),
    array("type" => "Objectif Financier","objectif"=>"Nb firme enrichie"),
    array("type" => "Objectif Financier","objectif"=>""),
    array("type" => "Objectif Financier","objectif"=>"Nb_adresse email"),
    array("type" => "Objectif Financier","objectif"=>"nb_gsm"),
    array("type" => "Enrichissement données","objectif"=>"nb_creation"),
    array("type" => "Utilisation du CRM","objectif"=>"nb_visite_appel"),
    array("type" => "Utilisation du CRM","objectif"=>"oppo_sys"),
    array("type" => "Utilisation du CRM","objectif"=>"hist_firme_visite_appel"),
    array("type" => "Utilisation du CRM","objectif"=>"reclamation"),
    array("type" => "Utilisation du CRM","objectif"=>"nb_firme_com"),


));

$Migr = new CMigration("","par_tts_raison");
$Migr->notDuplicate();
$Migr->fill(array(


    array("libelle" => "Doublon"),
    array("libelle" => "Manque informations"),
    array("libelle" => "Informations erronees"),
    

));

?>
</body>
</html>