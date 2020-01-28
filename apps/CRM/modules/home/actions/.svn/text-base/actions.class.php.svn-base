<?php

/**
 * home actions.
 *
 * @package    ERP
 * @subpackage home
 * @author     TechTrend Solutions
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{

    /**
     * Executes index action
     *
     * @param sfRequest $request
     *            A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        $dbh = Common::TTSConnect();
        // Supprime l'état identifié de l'user
        $this->getUser()->setAuthenticated(false);
        // Supprime tous les accès de l'user
        $this->getUser()->clearCredentials();
        // Supprime les valeurs de la sessions que l'on a stocké
        $this->getUser()
            ->getAttributeHolder()
            ->remove('login');
        $this->getUser()
            ->getAttributeHolder()
            ->remove('id');
        $this->getUser()
            ->getAttributeHolder()
            ->remove('code');
        $this->getUser()
            ->getAttributeHolder()
            ->remove('secure');
        $this->getUser()->setAttribute('id', null, 'CRMUser');
        // Pour l'enregistrement de la page cible au niveau d'un input hidden
        $this->page_cible = $request->getParameter('p');
        if ($request->isMethod('Post')) {
            if (isset($_POST["captcha"])) {
                
                $code_session = $this->getUser()->getAttribute('code_captcha');
                $captcha = $_POST["captcha"];
                if ($captcha != $code_session) {
                    $this->getUser()->setFlash('error', 'Connection refus&eacute;e');
                    $this->redirect("homepage");
                }
            } else {
                $this->getUser()->setFlash('error', 'Connection refus&eacute;e');
                $this->redirect("Home");
            }
            $login = addslashes($request->getParameter('login'));
            $pass = $request->getParameter('pass');
            $pg = urldecode($request->getParameter('p'));
            $pg = $pg ? $pg : 'dashboard/index';
            
            $pass = md5($pass);
            $connection = Doctrine_Manager::getInstance()->getConnection('crm');
            $dbh = $connection->getDbh();
            $requete = $dbh->query("select  u.id, u.login, u.code_commercial
  				from tts_utilisateur u
  				where u.login = '$login' and u.actif = 1 and u.pwd =  '$pass' ")->fetch();
            
            if ($requete) {
                $this->getUser()->setAuthenticated(true);
                $this->getUser()->setAttribute("id", $requete['id'], 'CRMUser');
                $this->getUser()->setAttribute("login", $requete['login']);
                $this->getUser()->setAttribute("code", $requete['code_commercial'], 'CRMUser');
                $this->getUser()->setCulture('fr');
                
                $credentialsResults = $dbh->query("select lower(action)
  					from tts_habilitation_action ha
  					inner join tts_habilitation h on ha.id = h.id_Habilitation_Action
  					inner join tts_habilitation_profil hp on hp.id = h.id_habilitation_profil
  					inner join tts_habilitation_utilisateur hu on hu.id_Habilitation_Profil = hp.id
  					where hu.id_utilisateur = $requete[id]")->fetchAll(PDO::FETCH_COLUMN);
            $requete2 = $dbh->query("insert into tts_historique_connexion (login,date_connexion, resultat) values ('$login',CURRENT_TIMESTAMP, 1)");
                foreach ($credentialsResults as $key => $credential) {
                    $this->getUser()->addCredentials($credential);
                }
                
                $this->getUser()->addCredentials("monprofiladministration");
                $this->getUser()->addCredentials("couleuradministration");
                $this->getUser()->addCredentials("dashboard");
                $this->getUser()->addCredentials("detailalerte");
                $this->getUser()->addCredentials("alerte");
                $this->getUser()->addCredentials("detailsoldefirme");
                $this->getUser()->addCredentials("ajoutercontactcommon");
                $this->getUser()->addCredentials("findcontactcommon");
                $this->getUser()->addCredentials("updateordrefirme");
                
                $alertes=myUser::getAlerte($requete['id']?$requete['id']:'0');
                $this->getUser()->setAttribute("alertes", $alertes);
                
                
                
                // Redirection avec examination de la page cible
                if ($pg) {
                    Common::setTracabilite("Home", '', "Connexion", $requete['id'], "crm");
                    $this->redirect($pg);
                }
            } else {
                $requete2 = $dbh->query("insert into tts_historique_connexion (login,date_connexion, resultat) values ('$login',CURRENT_TIMESTAMP, 0)");
                $this->getUser()->setFlash('error', 'Connection refus&eacute;e');
                $this->getCaptcha();
            }
        
        } else {
            
            $this->getCaptcha();
        }

        $this->setLayout('homeLayout');
    }

    private function getCaptcha()
    {
        $code = rand(1000, 9999);
        $this->getUser()->setAttribute('code_captcha', $code);
        $_SESSION['code'] = $code;
        $im = imagecreatetruecolor(50, 24);
        $bg = imagecolorallocate($im, 22, 86, 165); // background color blue
        $fg = imagecolorallocate($im, 255, 255, 255); // text color white
        imagefill($im, 0, 0, $bg);
        imagestring($im, 5, 5, 5, $code, $fg);
        
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-type: image/jpg');
        // imagepng($im);
        // imagedestroy($im);
        imagejpeg($im, "images/Captcha/captcha.jpg");
    }
}
