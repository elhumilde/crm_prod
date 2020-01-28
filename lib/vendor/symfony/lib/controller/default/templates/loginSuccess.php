<?php decorate_with(dirname(__FILE__).'/defaultLayout.php') ?>

<div class="sfTMessageContainer sfTLock"> 
  <?php echo image_tag('/sf/sf_default/images/icons/lock48.png', array('alt' => 'login required', 'class' => 'sfTMessageIcon', 'size' => '48x48')) ?>
  <div class="sfTMessageWrap">
    <h1>Connexion obligatoire</h1>
    <h5>Cette page est s&eacute;curis&eacute;</h5>
  </div>
</div>
<dl class="sfTMessageInfo">
  <dt>Comment y acceder ?</dt>
  <dd>Vous devez vous connecter avec votre login et mot de passe</dd>
  <dt>Cliquer sur un des liens ci-dessous</dt>
  <dd>
    <ul class="sfTIconList">
      <li class="sfTLinkMessage"><?php echo link_to('Page de connection', sfConfig::get('sf_login_module').'/'.sfConfig::get('sf_login_action')) ?></li>
      <li class="sfTLinkMessage"><a href="javascript:history.go(-1)">retour a la page pr&eacute;c&eacute;dente</a></li>
    </ul>
  </dd>
</dl>