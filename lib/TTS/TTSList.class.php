<?php

header('Access-Control-Allow-Origin: *');
Class TTSList{
	
	public static $__query = array();
	public static $__options = array();
	
	public static function setQuery($lib,$query,$options = array()){
		self::$__query[$lib] = $query;
		self::$__options[$lib] = $options;
	}
	
	public static function getListBox($options){
		
		$query = $options["query"];
		preg_match("/\#\:(.*)\#/", $query, $match);
		if($match){
			$q = self::$__query[$match[1]];
			foreach($options as $k=>$c){
				self::$__options[$match[1]][$k] = $c;
			}
			$options = self::$__options[$match[1]];
		}else{
			$q = str_replace("&#039;", "'", $query);
		}
		
		$form = !empty($options["form"]) ? $options["form"] : null;
		$class = !empty($options["class"]) ? "class=\"".$options["class"]."\"" : null;
		$style = !empty($options["style"]) ? "style=\"".$options["style"]."\"" : null;
		$value = $options["value"];
		$libel = $options["libel"];
		$app = sfContext::getInstance()->getConfiguration()->getApplication();
		$db_default = strtolower($app);
		
		$db = !empty($options["db"]) ? $options["db"] : $db_default;
		$oForm = !empty($options["oForm"]) ? $options["oForm"] : null;
		$key = $options["key"];
		$add_slash = !empty($options["add_slash"]) ? $options["add_slash"] : null;
		$value_default = !empty($options["value_default"]) ? $options["value_default"] : null;
		$show_only = !empty($options["show_only"]) ? $options["show_only"] : null;
		$multiple = !empty($options["multiple"]) ? $options["multiple"] : null;
		$required = !empty($options["required"]) ? "required='required'" : null;
		
		// set connection ---------------------------------------------------------
	  	$connection = Doctrine_Manager::getInstance()->getConnection($db);
	  	$dbh = $connection->getDbh();
	  	// ------------------------------------------------------------------------
	  	$data = $dbh->query($q)->fetchAll(PDO::FETCH_ASSOC);
	  	//-------------------------------------------------------------------------
	  	if($form) {
	  		$list = "<select $class $style $required ".($form[$key])." $multiple>";
	  	}
	  	else {
	  		$list = "<select $class $style $required name =".$key." id =".$key." $multiple>";
	  	}
	  	if(!$multiple && !$show_only) $list .= "<option></option>";
	  	foreach($data as $row){
	  		if($add_slash) $row[$libel] = addslashes($row[$libel]);
	  		if($oForm) {
	  			$selected = ($value_default ? ($value_default == $row[$value] ? "selected" : "") : $oForm->getIsSelected($key,$row[$value]));
	  		}
	  		else{
	  			$selected = ($value_default && ($value_default == $row[$value])) ? "selected" : "";
	  		}
	  		if(!$show_only || ($show_only && $show_only == $row[$value])) $list .= "<option value=\"".($row[$value])."\" ".$selected.">".($row[$libel])."</option>";
	  	}
	  	$list .= "</select>";
	  	
	  	return $list;
	}
	
}

//set Query TTS List ---------------------------------------

TTSList::setQuery("Nature", "select * from par_tts_articlenature order by nature_article",array(
		"value" => "id",
		"libel" => "nature_article"
));

//*******************************************************************************

TTSList::setQuery("Gravite", "select * from par_tts_nc_gravite order by libelle",array(
		"value" => "id",
		"libel" => "libelle"
));
//*******************************************************************************

TTSList::setQuery("User", "select (nom+' '+prenom) as nomprenom,id from tts_utilisateur where actif=1 order by nom, prenom",array(
		"value" => "id",
		"libel" => "nomprenom"
));


//*******************************************************************************

TTSList::setQuery("Origine", "select * from par_tts_nc_origine order by libelle",array(
		"value" => "id",
		"libel" => "libelle"
));

//*******************************************************************************

TTSList::setQuery("OrigineNature", "select * from par_tts_nc_origine_Nature order by libelle",array(
		"value" => "id",
		"libel" => "libelle"
));

//*******************************************************************************

TTSList::setQuery("Banque", "select * from par_tts_banque order by banque",array(
		"value" => "id",
		"libel" => "banque"
));
//*******************************************************************************

TTSList::setQuery("BCA", "select * from tts_bca_information where actif='1' order by code_bca",array(
		"value" => "id_bca_information",
		"libel" => "code_bca"
));
//*******************************************************************************

TTSList::setQuery("Famille", "select * from par_tts_articlefamille order by code",array(
		"value" => "id",
		"libel" => "code"
));

//*******************************************************************************

TTSList::setQuery("Depot", "select * from par_tts_depot order by depot",array(
		"value" => "id",
		"libel" => "depot"
));

//*******************************************************************************

TTSList::setQuery("Zone", "select * from par_tts_zone order by zone",array(
		"value" => "id",
		"libel" => "zone"
));

//*******************************************************************************

TTSList::setQuery("Motif", "select * from par_tts_sortie_stock_motif order by motif",array(
		"value" => "id",
		"libel" => "motif"
));

//*******************************************************************************

TTSList::setQuery("Projet", "select * from tts_projet order by code_projet",array(
		"value" => "code_projet",
		"libel" => "code_projet"
));

//*******************************************************************************

TTSList::setQuery("StatutProjet", "select * from par_tts_projet_statut order by statut",array(
		"value" => "statut",
		"libel" => "statut"
));

//*******************************************************************************

TTSList::setQuery("TypeProjet", "select * from par_tts_projet_type order by type",array(
		"value" => "type",
		"libel" => "type"
));


//*******************************************************************************

TTSList::setQuery("Client", "select * from tts_client_information order by societe",array(
		"value" => "id",
		"libel" => "societe"
));

//*******************************************************************************

TTSList::setQuery("Fournisseur", "select * from tts_fournisseur_information order by designation_societe",array(
		"value" => "id",
		"libel" => "designation_societe"
));

//*******************************************************************************

TTSList::setQuery("Fournisseur_Etranger", "select * from tts_fournisseur_information where is_etranger = '1' order by designation_societe",array(
		"value" => "id",
		"libel" => "designation_societe"
));

//*******************************************************************************

TTSList::setQuery("Prestataire", "select * from par_tts_prestataire",array(
		"value" => "id",
		"libel" => "prestataire"
));

//*******************************************************************************

TTSList::setQuery("TVA", "select * from par_tts_tva order by tva",array(
		"value" => "id",
		"libel" => "tva"
));

//*******************************************************************************

TTSList::setQuery("Devise", "select * from par_tts_tauxchange order by libelle",array(
		"value" => "id",
		"libel" => "libelle"
));

//*******************************************************************************

TTSList::setQuery("Mode_Paiement", "select * from par_tts_mode_paiement order by mode_paiement",array(
		"value" => "id",
		"libel" => "mode_paiement"
));

//*******************************************************************************

TTSList::setQuery("Mode_Transport", "select * from par_tts_mode_transport order by mode_transport",array(
		"value" => "id",
		"libel" => "mode_transport"
));

//*******************************************************************************

TTSList::setQuery("Regime", "select * from par_tts_regime order by regime",array(
		"value" => "id",
		"libel" => "regime"
));

//*******************************************************************************

TTSList::setQuery("Bureau_Douane", "select * from par_tts_bureau_douane order by bureau",array(
		"value" => "id",
		"libel" => "bureau"
));

//*******************************************************************************

TTSList::setQuery("Douane_Mode_Reglement", "select * from par_tts_douane_mode_reglement order by mode_reglement",array(
		"value" => "id",
		"libel" => "mode_reglement"
));

//*******************************************************************************

TTSList::setQuery("Banque_Douane", "select * from par_tts_douane_banque order by banque",array(
		"value" => "id",
		"libel" => "banque"
));

//*******************************************************************************

TTSList::setQuery("incoterm", "select * from par_tts_incoterm order by incoterm",array(
		"value" => "id",
		"libel" => "incoterm"
));

//*******************************************************************************



TTSList::setQuery("Lieu_Livraison", "select * from par_tts_lieu_livraison order by lieu_livraison",array(
		"value" => "id",
		"libel" => "lieu_livraison"
));

//*******************************************************************************

TTSList::setQuery("Garantie", "select * from par_tts_garantie order by delai",array(
		"value" => "id",
		"libel" => "delai"
));

//*******************************************************************************

TTSList::setQuery("boolData", "select 1 as k, 'Oui' as c UNION select 0, 'Non'",
		array(
				"value" => "k",
				"libel" => "c"
		));

//*******************************************************************************
		
TTSList::setQuery("climatise", "select 1 as k, 'Climatis&eacute;' as c UNION select 0, 'Ordinaire'",
array(
				"value" => "k",
				"libel" => "c"
));

//*******************************************************************************


TTSList::setQuery("type_vente", "select * from par_tts_type_vente order by type_vente",
		array(
				"value" => "id",
				"libel" => "type_vente"
		));



//*******************************************************************************

TTSList::setQuery("categorie", "select '1' as c UNION select '2' UNION select '3' UNION select '4' UNION select '5' UNION select '0'",
		array(
				"value" => "c",
				"libel" => "c"
		));

//*******************************************************************************

TTSList::setQuery("commercial", "select u.id,nom+' '+prenom as fullname from tts_utilisateur u 
										  inner join tts_utilisateur_fonction f on f.id = u.id_fonction and fonction = 'Commercial' order by nom, prenom",array(
		"value" => "id",
		"libel" => "fullname"
));

//*******************************************************************************

TTSList::setQuery("mois", "select * from (
							SELECT '1' as k, 'Janvier' as c UNION
							SELECT '2', '".utf8_decode('Février')."' UNION
							SELECT '3', 'Mars' UNION
							SELECT '4', 'Avril' UNION
							SELECT '5', 'Mai' UNION
							SELECT '6', 'Juin' UNION
							SELECT '7', 'Juillet' UNION
							SELECT '8', '".utf8_decode('Aôut')."' UNION
							SELECT '9', 'Septembre' UNION
							SELECT '10', 'Octobre' UNION
							SELECT '11', 'Novembre' UNION
							SELECT '12', 'Decembre') aff
						",array(
				"value" => "k",
				"libel" => "c"
		));

//*******************************************************************************

TTSList::setQuery("mouvement", "
		SELECT 'Devis' as k, 'Devis' as c UNION
		SELECT 'BC', 'Bon de Commandes' UNION
		SELECT 'BCA', 'Bon de Commandes Achats' UNION
		SELECT 'BL', 'Bon de Livraison' UNION
		SELECT 'BR', 'Bon de Retour' UNION
		SELECT 'BRC', 'Bon de Reception' UNION
		SELECT 'DI', 'Dossier Import' UNION
		SELECT 'ES', 'Entree Stock' UNION
		SELECT 'SS', 'Sortie Stock'
		",array(
				"value" => "k",
				"libel" => "c"
		));

//*******************************************************************************

TTSList::setQuery("semaine", "
		SELECT '1' as k, 'Lundi' as c UNION
		SELECT '2', 'Mardi' UNION
		SELECT '3', 'Mercredi' UNION
		SELECT '4', 'Jeudi' UNION
		SELECT '5', 'Vendredi' UNION
		SELECT '6', 'Samedi' UNION
		SELECT '7', 'Dimanche'
		",array(
				"value" => "k",
				"libel" => "c"
));

//*******************************************************************************

TTSList::setQuery("BC", "select code_bc from tts_bc_information where actif = '1' order by code_bc",array(
		"value" => "code_bc",
		"libel" => "code_bc"
));

//*******************************************************************************

TTSList::setQuery("BC_Encours", "select code_bc from tts_bc_information where actif = '1' and statut in ('Encours','Partiel')",array(
		"value" => "code_bc",
		"libel" => "code_bc"
));

//*******************************************************************************

TTSList::setQuery("Charge", "select '1' as k, 'A notre charge' as c UNION
						 select '0', 'A la charge du Client'",array(
		"value" => "k",
		"libel" => "c"
));

//*******************************************************************************

TTSList::setQuery("Type_Article", "select code from tts_type_article order by code",array(
		"value" => "code",
		"libel" => "code"
));

//*******************************************************************************

TTSList::setQuery("statut_bc", "select statut from par_tts_statut order by statut",array(
		"value" => "statut",
		"libel" => "statut"
));

//*******************************************************************************

TTSList::setQuery("statut_devis", "select statut from par_tts_statut_devis order by statut",array(
		"value" => "statut",
		"libel" => "statut"
));

//*******************************************************************************

TTSList::setQuery("Nb_Result", "select * from (select '10' as k, '10' as c
								UNION select '100' as k, '100' as c 
								UNION select '1000' as k, '1000' as c 
								UNION select '10000' as k, 'Tous' as c)aff 
		",array(
				"value" => "k",
				"libel" => "c"
		));

//*******************************************************************************

TTSList::setQuery("Facture_Acompte", "select code_facture from tts_facture_client where acompte = '1' and avoir = '0' order by code_facture",array(
		"value" => "code_facture",
		"libel" => "code_facture"
));

//*******************************************************************************

TTSList::setQuery("BR_non_facture", "select code_br from tts_br_entete where facture <> '1' order by code_br",array(
		"value" => "code_br",
		"libel" => "code_br"
));

//*******************************************************************************

TTSList::setQuery("type_objectif", "select * from par_tts_Type_objectif order by libelle",array(
		"value" => "id",
		"libel" => "libelle"
));