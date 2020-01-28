<script>
$(document).ready(function(){
	dataDepend.setUrl("<?php echo url_for('setDependanceChoice'); ?>");

	var depend = new dataDepend('tts_reclamation_code_firme','tts_reclamation_code_contact');
	depend.setSource('tts_firmes',['code_firme','code_firme']);
	depend.setDestin('tts_firme_contact',['code_firme',"code_contact,concat((prenom),(' '),(nom)) as fullname"]);
	depend.setData({value:'code_contact', libel:'fullname'});
	<?php if($id):?>
		depend.setSelected({value: '<?php echo $oForm->getData("code_contact"); ?>'}); 
	<?php endif;?>
	depend.setup();

	<?php if($id):?>
    	$('#tts_reclamation_code_firme').change();
	<?php endif;?>
	$('.itemName').select2({
        placeholder: 'Select an item',
        ajax: {
          url: "<?php echo url_for('Common/AutoComplete') ?>",
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }
      });
	//-------//
	$('#resoluer').click(function(){
		var action  = $('#tts_reclamation_action').val();
		if(!action){
			alert('Veuillez renseigner les actions de cloture');
			return false;
		}
		if (!confirm('Voulez-vous vraiment cloturer cette reclamation ?'))
		{
			return false;
		}
	});
//--------------------//  
  
  
});

</script>
<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li><a href="#">Réclamation</a></li>
      <li class="active">Ajouter</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Création d'une réclamation</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
		<form method="post">
			<?php if ($sf_user->hasFlash('success')): ?>
                <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                    <button type="button" class="close" data-dismiss="alert"><span>x</span><span class="sr-only">Close</span></button>
                    <span class="text-semibold">Felicitation !</span> <?php echo html_entity_decode($sf_user->getFlash('success')) ; ?>.
                </div>
          	<?php endif; ?>
          	<?php if ($sf_user->hasFlash('error')): ?>
	          <div class="alert alert-danger alert-styled-left alert-bordered">
	              <button type="button" class="close" data-dismiss="alert"><span>x</span><span class="sr-only">Close</span></button>
	              <span class="text-semibold">Attention !</span> <?php echo html_entity_decode($sf_user->getFlash('error')); ?>.
	          </div>
	        <?php endif; ?>
			<div class="row">
				<label class="col-md-1" for="focusedInput">Code </label>
				<div class="col-md-2">
					<input id="focusedInput" readonly="readonly" type="text" class="form-control"
					<?php echo $form["code"]?>>
				</div>
				<label class="col-md-1 col-md-offset-1" for="focusedInput">Date de création </label>
				<div class="col-md-2">
				      <div class="input-group" style="float:left">
					        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
					        <input type="text" placeholder="jj/mm/aaaa" disabled="disabled" class="form-control datepicker-menus datepicker-menus" <?php echo $form["date_creation"]?>>   						    
					    </div>
				</div>
				<label class="col-md-1 col-md-offset-1" for="focusedInput">Date réclamation </label>
				<div class="col-md-2">
				    <div class="input-group" style="float:left">
				        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
				        <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus datepicker-menus" <?php echo $form["date_reclamation"]?>>   						    
				    </div>
				</div>
			</div>
			<div class="row">

			<div class="control-group">
				<label class="col-md-1" for="selectError">Firme</label>
				<div class="col-md-2">
					<select class="itemName form-control select" <?php echo $form["code_firme"]; ?>>
    					  <?php if($oForm->getData('code_firme')):?> 
    					      <option value="<?php echo $oForm->getData('code_firme')?>"><?php echo $firme?></option>
    					  <?php endif;?>
					</select>
				</div>
			</div>
							

				<label class="col-md-1 col-md-offset-1" for="selectError">Contact Client</label>
				<div class="col-md-2">
						<select class="select" <?php echo $form["code_contact"]?>></select>
				</div>
				<label class="col-md-1 col-md-offset-1" for="selectError">service affect&eacute;</label>
					<div class="col-md-2">
						<?php echo TTSList::getListBox(array(
								"query" => "select * from par_tts_service",
								"form" => $form,
								"oForm" => $oForm,
								"value" => "id",
								"libel" => "libelle",
								"key" => "id_service",
								"db" => "crm",
								"class"=>"select"
                          )); ?>
					</div>
				
			</div>
			<div class="row">
				
				<label class="col-md-1" for="focusedInput">Créateur </label>
				<div class="col-md-2">
					<input id="focusedInput" readonly="readonly" type="text" class="form-control"
						value="<?php echo $createur?>">
				</div>
                <label class="col-md-1 col-md-offset-1" for="selectError">Gravité</label>
				<div class="col-md-2">

					<?php echo TTSList::getListBox(array(
							"query" => "select id,libelle from par_tts_gravite_reclamation",
							"form" => $form,
							"oForm" => $oForm,
							"value" => "id",
							"libel" => "libelle",
							"key" => "id_gravite",
							"db" => "crm",
							"class" => "select"
							)); ?>

				</div>
				<label class="col-md-1 col-md-offset-1" for="selectError">Type Réclamation</label>
				<div class="col-md-2">

					<?php echo TTSList::getListBox(array(
							"query" => "select id,type_reclamation from par_tts_type_reclamation",
							"form" => $form,
							"oForm" => $oForm,
							"value" => "id",
							"libel" => "type_reclamation",
							"key" => "id_type_reclamation",
							"db" => "crm",
							"class" => "select"
							)); ?>

				</div>
			</div>
			<div class="row">
				<label class="col-md-1" for="textarea2">Objet </label>
				<div class="col-md-4">
					<textarea  class="form-control" <?php echo $form["objet"]?>><?php echo $oForm->getData("objet")?></textarea>
				</div>

				<label class="col-md-1 col-md-offset-1" for="textarea2">Description </label>
				<div class="col-md-4">
					<textarea class="form-control" <?php echo $form["description"]?>><?php echo $oForm->getData("description")?></textarea>
				</div>
			</div>
			<div class="row">
				<?php if($id):?>
				<label class="col-md-1" for="textarea2">Action de Traitement </label>
				<div class="col-md-4">
					<textarea class="form-control" <?php echo $form["action"]?>><?php echo $oForm->getData("action")?></textarea>
				</div>
				<?php endif;?>
				
				<?php if($oForm->getData("is_resolue")==1):?>
					<label class="col-md-1 col-md-offset-1" for="focusedInput">Date résolution </label>
					<div class="col-md-2">
						<div class="input-group" style="float:left">
					        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
					        <input type="text" placeholder="jj/mm/aaaa" disabled="disabled" class="form-control datepicker-menus datepicker-menus" <?php echo $form["date_resolution"]?>>   						    
					    </div>
					</div>
				<?php endif;?>
			</div>

			<div class="row">
				<div class="form-actions">
					<?php if(!$id):?>
						<div class="text-left">
							<button type="submit" class="btn btn-primary">
								Enregistrer <i class="icon-arrow-right14 position-right"></i>
							</button>
						</div>
					<?php endif;?>

					<?php if($id && $oForm->getData("is_resolue") !=1): ?>
					<a
						href="<?php echo  url_for("AjouterReclamation", array("id"=>$id));?>"><button
							type="submit" class="btn btn-info" name="ajouterreclamation">
							 Modifier
						</button> 
					</a>
					<!-- 
					<a onClick="return confirm('Voulez-vous vraiment supprimer cette réclamation ?');"
					href="<?php echo url_for("SupprimerReclamation",array("id"=>$id)); ?>"><button
					type="button" class="btn btn-danger" name="supprimerreclamation">Supprimer</button>
					</a>
						 -->
					<a href="<?php echo  url_for("ResoluerReclamation", array("id"=>$id));?>"
					class="btn btn-danger" id="resoluer" name="resoluerreclamation"><i></i>Cloturer 
					</a>

					<?php elseif($id):?>
					<br><center><b>Réclamation Clôturée</b></center>
					<?php endif;?>
				</div>
			</div>
		</form>
	</div>
</div>

