<?php
// auto-generated by sfViewConfigHandler
// date: 2020/01/24 09:30:50
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html;charset=UTF-8', false);
  $response->addMeta('title', 'CRM EDICOM', false, false);
  $response->addMeta('description', 'CRM EDICOM', false, false);
  $response->addMeta('language', 'fr', false, false);

  $response->addStylesheet('theme_limitless/google.css', '', array ());
  $response->addStylesheet('theme_limitless/icons/icomoon/styles.css', '', array ());
  $response->addStylesheet('theme_limitless/bootstrap.css', '', array ());
  $response->addStylesheet('theme_limitless/core.css', '', array ());
  $response->addStylesheet('theme_limitless/components.css', '', array ());
  $response->addStylesheet('theme_limitless/colors.css', '', array ());
  $response->addStylesheet('theme_limitless/main.css', '', array ());
  $response->addStylesheet('theme_limitless/style.css', '', array ());
  $response->addJavascript('http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCGKzvMhYdksA_GltyggA7RftPYZW75gjw', '', array ());
  $response->addJavascript('theme_limitless/plugins/loaders/pace.min.js', '', array ());
  $response->addJavascript('theme_limitless/core/libraries/jquery.min.js', '', array ());
  $response->addJavascript('theme_limitless/core/libraries/jquery_ui/full.min.js', '', array ());
  $response->addJavascript('theme_limitless/core/libraries/bootstrap.min.js', '', array ());
  $response->addJavascript('theme_limitless/plugins/loaders/blockui.min.js', '', array ());
  $response->addJavascript('theme_limitless/plugins/forms/selects/select2.min.js', '', array ());
  $response->addJavascript('theme_limitless/plugins/forms/styling/uniform.min.js', '', array ());
  $response->addJavascript('theme_limitless/plugins/forms/validation/validate.min.js', '', array ());
  $response->addJavascript('theme_limitless/plugins/forms/mask/mask.js', '', array ());
  $response->addJavascript('theme_limitless/plugins/tables/datatables/datatables.min.js', '', array ());
  $response->addJavascript('theme_limitless/pages/form_layouts.js', '', array ());
  $response->addJavascript('theme_limitless/core/libraries/jquery_ui/widgets.min.js', '', array ());
  $response->addJavascript('theme_limitless/plugins/notifications/pnotify.min.js', '', array ());
  $response->addJavascript('theme_limitless/plugins/forms/selects/bootstrap_multiselect.js', '', array ());
  $response->addJavascript('theme_limitless/pages/form_multiselect.js', '', array ());
  $response->addJavascript('theme_limitless/plugins/notifications/sweet_alert.min.js', '', array ());
  $response->addJavascript('theme_limitless/core/app.js', '', array ());
  $response->addJavascript('theme_limitless/pages/jqueryui_forms.js', '', array ());
  $response->addJavascript('theme_limitless/pages/components_modals.js', '', array ());
  $response->addJavascript('theme_limitless/pages/form_mask.js', '', array ());
  $response->addJavascript('theme_limitless/common.js', '', array ());
  $response->addJavascript('depend.js', '', array ());
  $response->addJavascript('common_new.js', '', array ());
  $response->addJavascript('jquery.dataTables.editable_new.js', '', array ());
  $response->addJavascript('jquery.jeditable.js', '', array ());
  $response->addJavascript('jquery.validate.js', '', array ());
  $response->addJavascript('ZeroClipboard.js', '', array ());
  $response->addJavascript('jqueryTable.js', '', array ());

