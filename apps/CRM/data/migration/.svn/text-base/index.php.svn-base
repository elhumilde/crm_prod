<html>
<head></head>
<body>

<?php


$Migr = new CMigration("","tts_utilisateur");
$Migr->notDuplicate();
$Migr->fill(array(
array("login" => "admin","nom" => "admin","prenom" => "admin","email" => "","pwd"=>"202cb962ac59075b964b07152d234b70","actif" => "1")
));

$Migr = new CMigration("","TTS_Compteur");
$Migr->notDuplicate();
$Migr->fill(array(
		array("compteur" => "OPP","n"=>"1",  "prefixe" => "OP/:y:","longueur" => "4","description" => "Compteur des Opportunites"),
		array("compteur" => "Reclamation","n"=>"1",  "prefixe" => "REC","longueur" => "7","description" => "Compteur des Reclamations"),
		array("compteur" => "Firme","n"=>"9000000",  "prefixe" => "MA","longueur" => "7","description" => "Compteur des personnes"),
        array("compteur" => "Marque","n"=>"9000000",  "prefixe" => "","longueur" => "7","description" => "Compteur des marques"),
		));


$Migr = new CMigration("","par_tts_opportunite_statut");
$Migr->notDuplicate();
$Migr->fill(array(
		array("statut" => "Encours"),
		array("statut" => "Devis envoyé"),
		array("statut" => "Gagné"),
		array("statut" => "Perdu"),
		array("statut" => "Annulé"),
));

$Migr = new CMigration("","TTS_Habilitation_action");
$Migr->notDuplicate();
$Migr->fill(array(
		
array("module" => "Reclamation","action" => "ajouterreclamation","description" => "Ajouter une reclamation"),
array("module" => "Reclamation","action" => "reclamation","description" => "Consulter les reclamations de mon portefeuille"),
//array("module" => "Reclamation","action" => "supprimerreclamation","description" => "Supprimer les reclamations"),
array("module" => "Reclamation","action" => "resoluerreclamation","description" => "Resoudre les reclamations"),
array("module" => "Decouverte","action" => "ajouterdecouverte","description" => "Ajouter une decouverte"),
array("module" => "Decouverte","action" => "decouverte","description" => "Consulter  les decouvertes de mon portefeuille"),
array("module" => "Commentaire","action" => "ajoutercommentaire","description" => "Ajouter un commentaire"),
array("module" => "Commentaire","action" => "commentaire","description" => "Consulter  les commentaires de mon portefeuille"),
array("module" => "Administration","action" => "profiladministration","description" => "Consulter  les Profils"),
array("module" => "Administration","action" => "ajouteruseradministration","description" => "Ajouter  les utilisateurs"),
array("module" => "Administration","action" => "ajouterprofiladministration","description" => "Ajouter  les Profils"),
array("module" => "Administration","action" => "utilisateursadministration","description" => "Consulter les utilisateurs"),
		
array("module" => "Parametrage","action" => "type_reclamation","description" => "Consulter les type_reclamation"),
array("module" => "Parametrage","action" => "ajoutertype_reclamation","description" => "Ajouter les type_reclamation"),

array("module" => "Opportunite","action" => "ajouteropportunite","description" => "Ajouter une opportunite"),
array("module" => "Opportunite","action" => "opportunite","description" => "Consulter les opportunites de mon portefeuille"),

array("module" => "Suivi","action" => "allopportunite","description" => "voir toutes les opportunites"),
array("module" => "Suivi","action" => "allvisite","description" => "voir toutes les visites"),
array("module" => "Suivi","action" => "allreclamation","description" => "voir toutes les reclamations"),
array("module" => "Suivi","action" => "allfirme","description" => "voir toutes les firmes"),
array("module" => "Suivi","action" => "alldecouverte","description" => "Consulter toutes les decouvertes"),
array("module" => "Suivi","action" => "allcommentaire","description" => "Consulter tous les commentaires"),
array("module" => "Suivi","action" => "modifierallfirme","description" => "modification de toutes les Firmes"),
array("module" => "Suivi","action" => "allalerte","description" => "voir toutes les alertes"),

array("module" => "PROSPECTION","action" => "visite_effectuee","description" => "Consultation de mes visites effectuees"),
array("module" => "PROSPECTION","action" => "ajoutervisite_effectuee","description" => "Ajout une visite effectuee"),
array("module" => "PROSPECTION","action" => "calendarvisite_effectuee","description" => "Consulter le calendrier des visites de mon portefeuille"),
array("module" => "PROSPECTION","action" => "ajoutervisite_planifiee","description" => "Ajout une visite planifiee"),
array("module" => "Parametrage","action" => "parametrage","description" => "Acceder aux Parametrages des tables"),
array("module" => "Parametrage","action" => "parametrageparametrage","description" => "Modifier les Parametrages des tables"),
    
array("module" => "Firme","action" => "firme","description" => "Rechercher les Firmes"),
array("module" => "Firme","action" => "ajouterfirme","description" => "Ajouter une Firme"),
array("module" => "Firme","action" => "consulterfirme","description" => "Consulter le detail d une Firme"),
array("module" => "Firme","action" => "historiquefirme","description" => "Consulter l onglet historique des Firmes"),
array("module" => "Firme","action" => "modifierfirme","description" => "Modifier une Firme de mon portefeuille"),
array("module" => "Firme","action" => "supprimerfirme","description" => "Supprimer une Firme"),
array("module" => "Firme","action" => "modifierdiregeantfirme","description" => "Modifier le nom, prenom et civilité"),
array("module" => "historique firme","action" => "detailbcfirme","description" => "Consulter detail BC"),
array("module" => "historique firme","action" => "detailproductionfirme","description" => "Consulter detail Production"), 
array("module" => "Administration","action" => "historique","description" => "historique modification des Firmes"),
       
array("module" => "historique firme","action" => "consulterhistoriqueproduction","description" => "Consulter Historique Production"),
array("module" => "historique firme","action" => "consulterhistoriquereclamation","description" => "Consulter Historique Réclamation"),
array("module" => "historique firme","action" => "consulterhistoriqueaffectation","description" => "Consulter Historique Affectation"),
array("module" => "historique firme","action" => "consulterhistoriqueencaissement","description" => "Consulter Historique Encaissement"),
array("module" => "historique firme","action" => "consulterhistoriquerdv","description" => "Consulter Historique Prises RDV"),
array("module" => "historique firme","action" => "consulterhistoriquetelevente","description" => "Consulter Historique Télévente"),
array("module" => "historique firme","action" => "consulterhistoriquesav","description" => "Consulter Historique SAV"),
array("module" => "historique firme","action" => "consulterhistoriquebc","description" => "Consulter Historique Bon de commande"),
array("module" => "historique firme","action" => "consulterhistoriquefacture","description" => "Consulter Historique Facture"),
array("module" => "historique firme","action" => "consulterhistoriquevisiteeffectuees","description" => "Consulter Historique Visites effectuées"),
array("module" => "historique firme","action" => "consulterhistoriqueopportunite","description" => "Consulter Historique Opporunités"),
array("module" => "historique firme","action" => "consulterhistoriqueimpaye","description" => "Consulter Historique Impayés"),
array("module" => "historique firme","action" => "consulterhistoriquedecouverte","description" => "Consulter Historique Découverte"),
array("module" => "historique firme","action" => "consulterhistoriquecommentaire","description" => "Consulter Historique Commentaire"),
array("module" => "historique firme","action" => "consulterhistoriqueappel_recouvrement","description" => "Consulter Historique Appel Recouvrement"),
array("module" => "historique firme","action" => "consulterhistoriqueappel_televente","description" => "Consulter Historique Appel Televente"),
array("module" => "historique firme","action" => "consulterhistoriquevisite_recouvrement","description" => "Consulter Historique Visite Recouvrement"),
array("module" => "historique firme","action" => "consulterhistoriquemaj_firme","description" => "Consulter Historique MaJ Firme"),
array("module" => "historique firme","action" => "consulterhistoriquesalon","description" => "Consulter Historique Salon"),
array("module" => "Suivi","action" => "validetracabilite","description" => "validation des modifications de la base"),

array("module" => "Reporting","action" => "reporting","description" => "Consulter le Reporting par commercial"),
array("module" => "Reporting","action" => "evolutionclientreporting","description" => "Consulter le Reporting par client"),

array("module" => "Firme","action" => "profil_restreint","description" => "Consultation restreinte des firmes"),
		

		));


$Migr = new CMigration("","TTS_Habilitation_profil");
$Migr->notDuplicate();
$Migr->fill(array(
		array("profil" => "admin","description" => "Administrateur")
));


$Migr = new CMigration("","TTS_Habilitation_utilisateur");
$Migr->notDuplicate();
$Migr->fill(array(
		array("id_utilisateur" => "1","id_habilitation_profil" => "1")
));


$Migr = new CMigration("","TTS_Habilitation");
$Migr->notDuplicate();
$Migr->fill(array(
		array("id_habilitation_action" => "1","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "2","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "3","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "4","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "5","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "6","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "7","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "8","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "9","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "10","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "11","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "12","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "13","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "14","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "15","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "16","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "17","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "18","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "19","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "20","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "21","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "22","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "23","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "24","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "25","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "26","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "27","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "28","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "29","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "30","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "31","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "32","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "33","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "34","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "35","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "36","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "37","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "38","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "39","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "40","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "41","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "42","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "43","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "44","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "45","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "46","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "47","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "48","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "49","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "50","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "51","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "52","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "53","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "54","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "55","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "56","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "57","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "58","id_habilitation_profil" => "1"),
        array("id_habilitation_action" => "59","id_habilitation_profil" => "1"),
        array("id_habilitation_action" => "60","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "61","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "62","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "63","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "64","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "65","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "66","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "67","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "68","id_habilitation_profil" => "1"),
        array("id_habilitation_action" => "69","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "70","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "71","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "72","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "73","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "74","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "75","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "76","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "77","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "78","id_habilitation_profil" => "1"),
        array("id_habilitation_action" => "79","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "80","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "81","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "82","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "83","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "84","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "85","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "86","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "87","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "88","id_habilitation_profil" => "1"),
        array("id_habilitation_action" => "89","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "90","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "91","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "92","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "93","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "94","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "95","id_habilitation_profil" => "1"),
		array("id_habilitation_action" => "96","id_habilitation_profil" => "1")
));

$Migr = new CMigration("","par_tts_civilite");
$Migr->notDuplicate();
$Migr->fill(array(
		array("libelle" => "Monsieur"),
		array("libelle" => "Madame"),
		array("libelle" => "Mademoiselle")
));


$Migr = new CMigration("","Par_tts_type_visite");
$Migr->notDuplicate();
$Migr->fill(array(
		array("libelle" => "Prospection"),
		array("libelle" => "Suivi offre de Prix"),
		array("libelle" => "Suivi Commande"),
		array("libelle" => "Suivi Reclamation"),
		array("libelle" => "Recouvrement")

));



$Migr = new CMigration("","par_tts_type_reclamation");
$Migr->notDuplicate();
$Migr->fill(array(
		array("type_reclamation" => "Retard"),
		array("type_reclamation" => "Dysfonctionnement"),
		array("type_reclamation" => "Réactivité"),
		array("type_reclamation" => "Autre"),

));



$Migr = new CMigration("","par_tts_opportunite_type");
$Migr->notDuplicate();
$Migr->fill(array(
    array("type" => "Site web"),
    array("type_reclamation" => "Referencement"),
    array("type_reclamation" => "Base de donnees"),

));

$Migr = new CMigration("","par_tts_gravite_reclamation");
$Migr->notDuplicate();
$Migr->fill(array(
		array("libelle" => "Majeure"),
		array("libelle" => "Mineure"),
		array("libelle" => "Bloquante"),
));
?>
</body>
</html>