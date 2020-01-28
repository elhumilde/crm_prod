<?php

/**
 * dashboard actions.
 *
 * @package    symfony
 * @subpackage dashboard
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dashboardActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $dbh = Common::TTSConnect();
      
      $id_user= $this->getUser()->getId();
      $nbr_visite= $dbh->query("SELECT count(vr.id) as nbr_visite FROM `tts_visites_realisees` vr  WHERE vr.id_utilisateur=$id_user and year(`date_visite`) =year( CURDATE())")->fetch();
      $this->nbr_visite=$nbr_visite['nbr_visite'];
      $this->nbr_op = $dbh->query("SELECT count(op.id) as all_op,sum(case when id_statut_opportunite=3 then 1 else 0 end) as gagne  FROM `tts_opportunite` op where op.id_createur=$id_user and year(`date_creation`) =year( CURDATE())")->fetch();
      $this->count_op_type= $dbh->query("select count(op.id) as count_op_type,t_op.type as type from tts_opportunite op left join par_tts_opportunite_type t_op on op.id_type_opportunite=t_op.id where op.id_createur=$id_user group by op.id_type_opportunite")->fetchAll();
      
      $montant = $dbh->query("select ifnull(sum(o.montant_probable),0) as montant from tts_opportunite o where o.id_statut_opportunite=3 and o.id_createur=$id_user and year(`date_creation`) =year( CURDATE())")->fetch();
      $this->montant = $montant['montant'];
      for ($i=1; $i <=12 ; $i++) { 
        $all_opp_mois[$i] = $dbh->query("SELECT count(op.id) as all_opp_mois  FROM `tts_opportunite` op  where op.id_createur=$id_user and  year(op.date_creation) =year( CURDATE()) and month(op.date_creation) =$i")->fetch();
        $opp_gagne_mois[$i] = $dbh->query("SELECT count(op.id) as opp_gagne_mois  FROM `tts_opportunite` op  where  op.id_createur=$id_user and  year(op.date_creation) =year( CURDATE()) and month(op.date_creation) =$i and id_statut_opportunite=3")->fetch();
      }
      $this->all_opp_mois=$all_opp_mois;
      $this->opp_gagne_mois=$opp_gagne_mois;
  }
}
