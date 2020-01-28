<?php

/**
 * Common actions.
 *
 * @package    ERP
 * @subpackage Common
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommonActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  public function executeArticle(sfWebRequest $request)
  {
  
    // set connection ---------------------------------------------------------
    $dbh = Common::TTSConnect();
    $this->table = $request->getParameter("table") ? $request->getParameter("table") : "oTable";
    $this->mask = $request->getParameter("mask") ? $request->getParameter("mask") : "mask";
    // ------------------------------------------------------------------------
  
    //declare objet filter ----------------------------------------------------
    $this->oFilter = new Filter("tts_article_information","a","crm");
    // ------------------------------------------------------------------------
     
    // add field not exist in table -------------------------------------------
    $this->oFilter->addField('date_from');
    $this->oFilter->addField('date_to');
    // ------------------------------------------------------------------------
     
    // add filter query of field not exist in table ---------------------------
    $this->oFilter->addFilter("date_creation >= :date_from");
    $this->oFilter->addFilter("date_creation <= :date_to");
    
    $this->oFilter->setValue("actif", "true");
    // ------------------------------------------------------------------------
  

    $parameters = $request->getPostParameters();
    $on= "";
    if(isset($parameters['stock_affaire']) && $parameters['stock_affaire']){
      $this->stock_affaire = $parameters['stock_affaire'];
      $id_affaire = $parameters['stock_affaire'];
      $on =" and id_affaire = '$id_affaire'";
    }
    
    // get query filter -------------------------------------------------------
    $queryFilter = $this->oFilter->getFilter();
    // ------------------------------------------------------------------------
     
    // get data ---------------------------------------------------------------
    $this->frs = $dbh->query("select * from tts_fournisseur")->fetchAll();
    $this->actif = array("true"=>"Oui","false"=>"Non");
    // ------------------------------------------------------------------------
     
    // setup param of filter --------------------------------------------------
    $this->filter = $this->oFilter->setup();
    // ------------------------------------------------------------------------
  
    // set principal query ----------------------------------------------------
    //REPLACE(REPLACE(a.designation, CHAR(13), ' '), CHAR(10), ' ')
    if($_POST){
      $req = "
      select a.id, REPLACE(REPLACE(a.designation, CHAR(13), ' '), CHAR(10), ' ') as designation,  a.reference, 
      asf.code as code_sf, af.code as code_f,ifnull(pa_theorique,0) as pa,a.id as id_article
      from tts_article_information a
      left outer join par_tts_sousfamille_article asf on asf.id = a.id_sousfamille_article
      left outer join par_tts_famille_article af on af.id = a.id_famille_article   
    
      ";
      // left outer join tts_fournisseur_info_commerciale fc on fc.id_fournisseur = fi.id
      // left outer join par_tts_tauxchange tc on tc.id = fc.id_par_tauxchange
      //LEFT OUTER JOIN tts_stock_article sa ON sa.id_article = a.id $on  
      $req .= $queryFilter;
      $req = $this->oFilter->setupQuery($req);
      $this->data = $dbh->query($req)->fetchAll(PDO::FETCH_GROUP);
    }else $this->data = array();
    // ------------------------------------------------------------------------
  
    // close connection -------------------------------------------------------
    $connection->close();
     
  }
  
  public function executeSetDependanceChoice($request){
    $depend = !empty($_POST["d"]) ? $_POST["d"] : array();
    $add_where = !empty($_POST["where"]) ? $_POST["where"] : array();
    $all = !empty($_POST["all"]) ? $_POST["all"] : "";
    $add_query = !empty($_POST["add_query"]) ? $_POST["add_query"] : "";
    $data = array();
    if($request->getParameter('bd')) $bd = $request->getParameter('bd');
    else $bd = '';
    //echo json_encode($depend);die;
    if($depend) $data = $this->getDependanceChoice($depend,$add_where,$all,$add_query, $bd);
    return $this->renderText(json_encode($data));
  }
  
  public function executeGetResQuery($request){
    $query = !empty($_POST["q"]) ? $_POST["q"] : "";
    $query = utf8_decode($query);
    $dbh = Common::TTSConnect();
    $res = $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);
    //print_r(array_map(function($elem){ return array_map(function($elem2){ return htmlentities($elem2); },$elem); },$res));die;
    return $this->renderText(json_encode(array_map(function($elem){
      return array_map(function($elem2){
        return htmlentities($elem2);
      },$elem);
    },$res)));
  }
  
  public function getDependanceChoice($depend,$add_where,$all,$add_query, $bd){
  
    $tempDepend = $depend;
  
    $F = reset($depend);
    $E = array_pop($depend);
  
    $attr = explode(",",$E[2]);
    $tab = $E[0];
  
    foreach($attr as $k=>$c){
      $except_attr = preg_match("/\(.*\)/", $c);
      if(!$except_attr) $attr[$k] = $tab.".".$c;
      else $attr[$k] = $c;
    }
  
    //$attr = array_map(function($elem) use($tab) { return $tab.".".$elem; },$attr);
    $select = "SELECT DISTINCT ".join(",",$attr)." FROM $E[0]\n";
    //var_dump($F[3]);
    if($F[3] == "''"){
      if($all == 'false') $where = "WHERE t0.$F[1] = $F[3] \n";
      else $where = "";
    }else $where = "WHERE t0.$F[1] = $F[3] \n";
  
    if($all == 'true' || $all == 'false') $p_join = "inner join";
    else $p_join = $all;
  
    $join = "";
    $last_t = '';
    for($i=count($depend)-1; $i>=0; $i--) {
      $TB = $depend[$i];
      //print_r($TB);
      $D_TB = $tempDepend[$i+1];
      if($last_t) $t = $last_t;
      else $t = $D_TB[0];
      $except = preg_match("/\(.*\)/", $TB[2]);
      $nextT = !$except ? "t$i." : "";
      $join .= "$p_join $TB[0] as t$i on $t.$D_TB[1] = $nextT$TB[2]\n";
      $last_t = "t$i";
    }
  
    if($add_where){
      $where .= " AND ".join(" AND ",$add_where);
    }
  
    $query = "$select\n$join\n$where\n$add_query";
    //echo $query;die;
  
    if($bd == 'bd_web'){

        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh = $connection->getDbh();
    }
    else{
        $dbh = Common::TTSConnect();
    }
  
    $res = $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);
  
    /*$res = array_map(function($elem){
      return array_map('utf8_encode',$elem);
    },$res);*/
  
    return $res;
  
  }

  public function executeUpdateAttr(sfWebRequest $request){
  
    $table = $_POST["table"];
    $op = utf8_decode($_POST["op"]);
    $cond = $_POST["cond"];
  
    $dbh = Common::TTSConnect();
  
    $res = $dbh->query("UPDATE $table SET $op WHERE $cond");
  
    $connection->close();
  
    return $this->renderText("1");
  
  }

  public function executeSaveForm($request){
    var_dump($_POST); die;
    $table = $_POST["table"];
    $id = $_POST["id"] ? $_POST["id"] : '';
  
    $oForm = new Form($table,"id","crm");
  
    if($id) $oForm = $oForm->find('id',$id);
  
    $res = $oForm->save();
  
    if($res) return $this->renderText(1);
    return $this->renderText(0);
  
  }
  
  public function executeAutoComplete($request){
  
    if(ISSET($_GET["term"])) $param = addslashes($_GET["term"]);
    else $param = "";

    $param = str_replace(' ','',$param);
    $param = str_replace('.','',$param);
    
    $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
    $dbh_web = $connection->getDbh();
    
    $cond_firme = "";

    $code_commercial= $this->getUser()->getCode();
    
    if(!$this->getUser()->hasCredential('allfirme')):
        $cond_firme=" inner join affectation ev on concat('MA',ev.code_firme)  = f.code_firme and ev.courtier = '$code_commercial' ";
    endif;
    
    $resultats = $dbh_web->query("SELECT f.code_firme , concat(f.rs_comp,' ',ifnull(ville,'')) as firme from firmes f $cond_firme
        left outer join villes v on v.code = f.code_ville
        left outer join tts_firme_ajoute fa on  fa.code_firme=f.code_firme
          WHERE  (REPLACE(REPLACE(f.rs_comp,' ',''),'.','')  like '%$param%' or REPLACE(REPLACE(f.rs_abr,' ',''),'.','') like '%$param%' ) and ifnull(fa.valide,0)  in (0, 1 )
        
        group by f.code_firme , f.rs_comp  order by f.rs_comp asc limit 1000 ")->fetchAll();

    $json = array();
    foreach ($resultats as $row){
         $json[] = array('id'=>$row['code_firme'], 'text'=>$row['firme']);
    }

    echo json_encode($json);
  
  
  }
  
  
  //uniquement pour le module recouvrement
  public function executeAutoComplete2($request){
  
    if(ISSET($_GET["term"])) $param = addslashes($_GET["term"]);
    else $param = "";
  
    $param = str_replace(' ','',$param);
    $param = str_replace('.','',$param);
  
    $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
    $dbh_web = $connection->getDbh();
  
    $cond_firme = "";
  
    $code_commercial= $this->getUser()->getCode();
  
  
    $resultats = $dbh_web->query("SELECT f.code_firme , 
        
        
        concat(case when ifnull(f.rs_abr,'') = '' then f.rs_comp else f.rs_abr end ,' ',ifnull(ville,'')) as firme from 
        
        firmes f 
        left outer join villes v on v.code = f.code_ville
        inner join encaissement e on f.code_firme = concat('MA',e.cfir) 
        WHERE  (REPLACE(REPLACE(f.rs_comp,' ',''),'.','')  like '%$param%' or REPLACE(REPLACE(f.rs_abr,' ',''),'.','') like '%$param%' ) 
  
        group by f.code_firme , f.rs_comp  order by case when ifnull(f.rs_abr,'') = '' then f.rs_comp else f.rs_abr end  asc limit 1000 ")->fetchAll();
  
        $json = array();
        foreach ($resultats as $row){
        $json[] = array('id'=>$row['code_firme'], 'text'=>$row['firme']);
    }
  
    echo json_encode($json);
  
  
  }
  
  public function executeAutoCompleteRS($request){

    if(ISSET($_GET["term"])) $param = addslashes($_GET["term"]);
    else $param = "";
      //$param = addslashes($_GET["term"]);
  
      $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
      $dbh_web = $connection->getDbh();
  
          
      $resultats = $dbh_web->query("SELECT f.rs_comp , f.rs_comp as firme from firmes f  WHERE rs_comp like '%$param%' order by rs_comp asc limit 1000 ")->fetchAll();
  
      $json = array();
      foreach ($resultats as $row){
          $json[] = array('id'=>$row['rs_comp'], 'text'=>$row['firme']);
      }
  
      echo json_encode($json);
  
  
  }
  public function executeAutoCompleteVoie($request){

      if(ISSET($_GET["term"])) $param = addslashes($_GET["term"]);
      else $param = "";
      

      $cond = "";
      $code_ville = "";
      if(ISSET($_GET["ville"])){
        
        $code_ville =  $_GET["ville"] ;
        //$cond  = " and ((code_ville = '".addslashes($_GET["ville"])."'  and left(v.code_voie,1) in (0,1,2,3,4, 5, 6) ) Or (left(v.code_voie,1) not in (0,1,2,3,4, 5, 6)) ) " ;
        
        /*
        if(in_array(substr($_GET["ville"], 0, 1), array(0,1,2,3,4, 5, 6))  ){
          $cond  = " and code_ville = '".addslashes($_GET["ville"])."'" ;
        }
        else{
          $cond = "  and left(v.code_voie,1) not in (0,1,2,3,4, 5, 6) ";
        }
        */
        
      }
        
      $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
      $dbh_web = $connection->getDbh();

      if($code_ville){
        $villes = $dbh_web->query("select ville from villes where code = '$code_ville' ")->fetch();
        if(stristr($villes['ville'], 'casablanca') or stristr($villes['ville'], 'rabat')){
          $cond  = " and code_ville = '".addslashes($_GET["ville"])."'" ;
        }
        else{
          $cond = "  and left(v.code_voie,1) not in (0,1,2,3,4, 5, 6) ";
        }
      }
      
      
        
        $query = "select ifnull(v.code_voie,'99990') as code_voie,concat(ifnull(v.libelle,'$param'), case when left(v.code_voie,1) in (5,6) then ' - Rabat' else case when left(v.code_voie,1) in (0,1,2,3,4) then ' - Casablanca' else ' - Autre ville' end end)  as voie 
          from voie v 
          WHERE 
          (
            ( left(v.code_voie,1) in (0,1,2,3,4, 5, 6) and right(v.code_voie,1) not in (6,7,8) ) 
            Or 
            (left(v.code_voie,1) not in (0,1,2,3,4, 5, 6) ) 
            )
          and libelle like '%$param%' $cond
           order by libelle asc limit 100";
        //print_r($query);die;
      $resultats = $dbh_web->query($query)->fetchAll();
      
      
      $json = array();
      if(!$resultats){
          $resultats = array('0' => array('code_voie'=>'99990', 'voie' => $param));
      }
      
      foreach ($resultats as $row){
          $json[] = array('id'=>$row['code_voie'].'||'.$row['voie'], 'text'=>$row['voie']);
      }
  
      echo json_encode($json);
  

      $this->setTemplate("AutoComplete");
  }


  public function executeAutoCompleteRubrique($request){

      $param = addslashes($_GET["term"]);
        
      $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
  
      $resultats = $dbh_web->query("select r.Code_Rubrique,r.Lib_Rubrique as rubrique from rubriques r WHERE (Lib_Rubrique like '$param%' Or Lib_Rubrique like '% $param%')  order by Lib_Rubrique asc limit 100")->fetchAll();
      $json = array();
      foreach ($resultats as $row){
          $json[] = array('id'=>$row['Code_Rubrique'], 'text'=>$row['rubrique'].' - Code:'.$row['Code_Rubrique']);
      }
  
      echo json_encode($json);
  

      $this->setTemplate("AutoComplete");
  }

    public function executeAutoCompleteFonction($request){



        if(ISSET($_GET["fonction"])) {

            $code_fonction = $_GET["fonction"];

        }
        else{
            $code_fonction = '';
        }

        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();

        $resultats = $dbh_web->query("select `tri_famille`, code, concat(code,' ', case when ifnull(fonction, '' ) = '' then 'Autre' else fonction end ) as fonction, famille from fonction where ifnull(code,'') != '' AND `tri_famille`='$code_fonction' order by tri_famille, code")->fetchAll();
        $json = array();
        foreach ($resultats as $row){
            $json[] = array('id'=>$row['tri_famille'], 'code'=>$row['code'], 'fonction' => $row['fonction'] ,'famille' => $row['famille'] );
        }

        echo json_encode($json);


        $this->setTemplate("AutoComplete");
    }




    public function executeAutoCompleteProduit($request){

      $param = addslashes($_GET["term"]);
  
      $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
      $dbh_web = $connection->getDbh();
  
      $resultats = $dbh_web->query("select code_produit,lib_produit as produit from produits_kompass WHERE (lib_produit like '$param%' Or lib_produit like '% $param%') order by lib_produit asc limit 100")->fetchAll();
      $json = array();
      foreach ($resultats as $row){
          $json[] = array('id'=>$row['code_produit'], 'text'=>$row['produit']);
      }
  
      echo json_encode($json);

      $this->setTemplate("AutoComplete");
  
  }
  function executeFindContact(sfWebRequest $request)
  {
    $dbh = Common::TTSConnect();
    $parameters = $request->getPostParameters();
    $contact=$parameters["contact"];
    $code_firme=$parameters["code_firme"];
    $count=1;
    if(!strpos($contact, ' '))
      {
        $count = $dbh->query("SELECT  count(*) as cnt from tts_firme_contact f where f.code_contact = '$contact' and f.code_firme='$code_firme'")->fetch();
      }
      echo $count["cnt"];
  }
  function executeAjouterContact(sfWebRequest $request)
  {
    $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
    $dbh_web = $connection->getDbh();
    $this->oFormContact = new Form("personne", "id", "bd_web");
    $this->oFormdirigeant = new Form("lien_dirigeant", "id", "bd_web");
    $parameters = $request->getPostParameters();
    $code = Common::getCompteur('Firme', 'tts_compteur', 'crm');
    $this->oFormContact->setFixedValue('code_personne', $code);
    $this->oFormContact->setFixedValue('sex', $parameters["sex"]);
    $this->oFormContact->setFixedValue('civilite', $parameters["civilite"]);
    $this->oFormContact->setFixedValue('nom', $parameters["nom"]);
    $this->oFormContact->setFixedValue('prenom', $parameters["prenom"]);
    $res = $this->oFormContact->save();
    if($res){
      Common::validCompteur('Firme','tts_compteur','crm');
      $this->oFormdirigeant->setFixedValue('email', $parameters["email"]);
      $this->oFormdirigeant->setFixedValue('tel_1', $parameters["tel"]);
      $this->oFormdirigeant->setFixedValue('code_fonction', $parameters["code_fonction"]);
      $this->oFormdirigeant->setFixedValue('code_personne', $res["code_personne"]);
      $this->oFormdirigeant->setFixedValue('code_firme', $parameters["code_firme"]);
      $res2 = $this->oFormdirigeant->save();
      

      $login = $this->getUser()->getId();
      $this->oFormPersonne_ajout = new Form("tts_personne_ajout", "id", "bd_web");
      $this->oFormPersonne_ajout->setFixedValue("code_personne", $res["code_personne"]);
      $this->oFormPersonne_ajout->setFixedValue("id_utilisateur", $login);
      $this->oFormPersonne_ajout->setFixedValue("valide", 0);
      $this->oFormPersonne_ajout->isAjax();
      $this->oFormPersonne_ajout->save();
      
      myUser::ajout_historique_ligne("Personne",$parameters["code_firme"],$res["code_personne"],"","ajout d'une personne", $res["code_personne"], 'lien_dirigeant');
      echo $res["code_personne"];
    }
  }
}
