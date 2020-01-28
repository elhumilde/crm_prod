<?php

/**
 * Historiqu actions.
 *
 * @package    ERP
 * @subpackage Historiqu
 * @author     TechTrend Solutions
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class HistoriqueActions extends sfActions
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
	   $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
	   $dbh_web = $connection->getDbh();
	   $db = $connection->getOptions();
	   $dsn = $db['dsn'];
	   preg_match("/;dbname=(.+)/",$dsn,$base_web);
	   $db_name = $base_web[1];
	   $act = $request->getParameter('act');
      //declare objet filter ----------------------------------------------------
      $this->oFilter = new Filter("tts_historique_modification","aff","bd_web");
      // ------------------------------------------------------------------------
      
      // add field not exist in table -------------------------------------------
      // ------------------------------------------------------------------------
      $this->oFilter->addField('firme');
      $this->oFilter->addField('id_user');
      $this->oFilter->addField('id_service');
      $this->oFilter->addField('date_from');
      $this->oFilter->addField('date_to');
      // add filter query of field not exist in table ---------------------------
      $this->oFilter->addFilter("date_modification >= :date_from");
      $this->oFilter->addFilter("date_modification <= :date_to");
      $this->oFilter->addFilter("id_service = :id_service");
      
      $firme = addslashes($this->oFilter->getValue("firme"));
      if($firme){
          $this->oFilter->andWhere("firme like '%$firme%'");
      }
      
      $this->oFilter->addFilter("id_utilisateur  = ':id_user'");
      // ------------------------------------------------------------------------
      // get query filter -------------------------------------------------------
      $queryFilter = $this->oFilter->getFilter();
      // ------------------------------------------------------------------------
      // setup param of filter --------------------------------------------------
      $this->filter = $this->oFilter->setup();
        // ------------------------------------------------------------------------
        // set principal query ----------------------------------------------------
      if($_POST) {
            $req ="select * from (select h.id, h.code_firme, champ, type_modification, old_value, new_value, date_modification, h.id_utilisateur , concat(u.prenom,' ',u.nom) as fullname, fi.firme, fi.id as id_firme, id_service 
                    from $db_name.tts_historique_modification h 
                    inner join tts_utilisateur u on u.id=h.id_utilisateur 
                    left outer join tts_firmes fi on fi.code_firme = h.code_firme 
                    union select f.id, f.code_firme, 'Firmes' as champ, 'ajout firme' type_modification, '' as old_value, f.code_firme as new_value, f.date_creation, f.id_utilisateur, concat(u.prenom,' ',u.nom) as fullname, fi.firme,fi.id as id_firme, id_service 
                    from $db_name.tts_firme_ajoute f 
                    left outer join tts_utilisateur u on u.id=$db_name.f.id_utilisateur 
                    left outer join tts_firmes fi on fi.code_firme = f.code_firme ) aff
            ";
        
        $req .=  " $queryFilter order by aff.date_modification desc, aff.id desc limit 1000";
        
        $this->datas = $dbh->query($req)->fetchAll();

        $login = $this->getUser()->getId();
        Common::setTracabilite("Historique", '', "Consulter Historique modification", $login, "crm");
      }
      elseif($act) {

          $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
          $dbh_web = $connection->getDbh();
          $table = $request->getParameter('table');
          $code = $request->getParameter('code');
          
          $select = "";
          switch ($table) {
              case "Personne":
                  $table="personne";
                  $champ="code_personne";
                  break;
              case "Marque":
                  $table="marque";
                  $champ="code_marque";
                  break;
              case "Rubrique":
                  $table="lien_rubrique_telecontact";
                  $champ="code_rubrique";
                  break;
              case "Produit":
                  $champ="code_produit";
                  $table="produits_kompass";
                  break;
              case "Portable":
                  $champ="portable";
                  $table="lien_portable";
                  break;
              case "Telephone":
                  $champ="tel";
                  $table="lien_tel";
                  break;
              case "Fax":
                  $champ="fax";
                  $table="lien_fax";
                  break;
              case "Web":
                  $champ="web";
                  $table="lien_web";
                  break;
              case "Firmes":
                  $champ="code_firme";
                  $select = " code_firme, rs_comp ";
                  $table="firmes";
                  break;
              case "Email":
                  $champ="email";
                  $table="lien_email";
                  break;
              default:
                  echo "default";
          }
          if(!$select) $select = " * ";
          $this->detail = $dbh_web->query("select $select from $table where $champ='$code' limit 1")->fetchAll(PDO::FETCH_ASSOC);
          $this->setTemplate("Detail");
      }
        else
          {$this->datas = array();}
  }

    
}
