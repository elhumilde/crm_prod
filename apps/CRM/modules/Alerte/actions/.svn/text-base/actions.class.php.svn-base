<?php

/**
 * Alerte actions.
 *
 * @package    ERP
 * @subpackage Alerte
 * @author     TechTrend Solutions
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AlerteActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

    
    public function executeAjaxgetAlerte(sfWebRequest $request)
    {
	    $id_user = $this->getUser()->getId();
	    $alertes= myUser::getAlerte();
        $this->getUser()->setAttribute("alertes", $alertes);
	    return $this->renderText(json_encode($alertes));
    }
    public function executeDetail(sfWebRequest $request)
    {
        $dbh = Common::TTSConnect();
        $connection = Doctrine_Manager::getInstance()->getConnection('bd_web');
        $dbh_web = $connection->getDbh();
         
         
        
        $alerte = $request->getParameter('alerte');
        $id_user=$this->getUser()->getId();
        $query=myUser::getQuerieAlerte($id_user);
        $query_detail_array = $query[$alerte] ;
        $query_detail = $query_detail_array['query'];
        if($query_detail_array['bd'] == 'crm') $db = $dbh;
        else $db = $dbh_web;
        
        $this->detail = $db->query($query_detail)->fetchAll(PDO::FETCH_ASSOC);
	    
    }
}
