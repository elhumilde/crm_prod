<script>

$(document).ready(function(){
dataDepend.setUrl("<?php echo url_for('setDependanceChoice'); ?>");

	

var depend = new dataDepend('tts_opportunite_code_firme','tts_opportunite_code_contact');
	depend.setSource('tts_firmes',['code_firme','code_firme']);
	depend.setDestin('tts_firme_contact',['code_firme',"code_contact,concat((prenom),(' '),(nom)) as fullname"]);
	depend.setData({value:'code_contact', libel:'fullname'});
	<?php if($id):?>
	depend.setSelected({value: '<?php echo $oForm->getData("code_contact"); ?>'}); 
	<?php endif;?>
	depend.setup();
	depend.setEmpty(false);

	<?php if($id Or $code_firme):?>
	$('#tts_opportunite_code_firme').change();
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
});
</script>

<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li><a href="#">Opportunité</a></li>
      <li class="active">Ajouter</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Gestion des Opportunit&eacute;s</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
		<div class="row">
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
					<div class="control-group">
						<label class="col-md-1" for="selectError">Code</label>
						<div class="col-md-2">
							<input type="text" class="form-control" disabled="disabled"
								value="<?php echo $oForm->getData("code"); ?>">
						</div>
					</div>
					
					<div class="control-group">
						<label class="col-md-1 col-md-offset-1" for="typeahead">Date cr&eacute;ation
						</label>
						<div class="col-md-2">
							<input type="text" class="form-control" <?php echo $form["date_creation"]; ?>
								disabled="disabled">
						</div>
					</div>
					

					<div class="control-group">
						<label class="col-md-1 col-md-offset-1" for="focusedInputdes">Statut </label>
						<div class="col-md-2">
							<?php echo TTSList::getListBox(array(
									"query" => "select id, statut from par_tts_opportunite_statut",
									"form" => $form,
									"oForm" => $oForm,
									"value" => "id",
									"libel" => "statut",
									"key" => "id_statut_opportunite",
									"db" => "crm",
									"class" => "select"
								)); ?>

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


					<div class="control-group">
						<label class="col-md-1 col-md-offset-1" for="selectError">R&eacute;sponsable
							op&eacute;ration </label>
						<div class="col-md-2">
							<select class="select" required="required"
							<?php echo $form["code_contact"]?>></select>
						</div>
					</div>
					<div class="control-group">
						<label class="col-md-1 col-md-offset-1" for="focusedInput">Type
							opportunit&eacute;</label>
						<div class="col-md-2">
							<?php echo TTSList::getListBox(array(
									"query" => "select id, type from par_tts_opportunite_type",
									"form" => $form,
									"oForm" => $oForm,
									"value" => "id",
									"libel" => "type",
									"key" => "id_type_opportunite",
									"db" => "crm",
									"class" => "select"
								)); ?>
						</div>
					</div>

				</div>
				<div class="row">
					<div class="control-group">
						<label class="col-md-1" for="focusedInputdes">Commercial </label>
						<div class="col-md-2">
							<?php 
						   		$cond_commercial="";
						   		if(!$sf_user->hasCredential('allopportunite')) $cond_commercial=" and  id in ($ids_users_affecte)";
							echo TTSList::getListBox(array(
										"query" => "select code_commercial, concat(prenom,' ', nom) as commercial from tts_utilisateur  where actif = 1 $cond_commercial",
										"form" => $form,
										"oForm" => $oForm,
										"value" => "code_commercial",
										"libel" => "commercial",
										"key" => "code_commercial",
										"db" => "crm",
										"class" => "select"
									)); 

							?>

						</div>
					</div>

					<div class="control-group">
						<label class="col-md-1 col-md-offset-1" for="typeahead">Montant Probable </label>
						<div class="col-md-2">
							<input type="number" class="form-control" <?php echo $form["montant_probable"]; ?>>
						</div>
					</div>

					<div class="control-group">
						<label class="col-md-1 col-md-offset-1" for="typeahead">
							R&eacute;ussite en % </label>
						<div class="col-md-2">
							<input type="number" class="form-control" <?php echo $form["pourcentage_reussite"]; ?>>
						</div>
					</div>
					
				</div>
				<div class="row">
					
					<div class="control-group">
						<label class="col-md-1" for="typeahead">Date
							&eacute;ch&eacute;ance </label>
						<div class="col-md-2">
							<div class="input-group" style="float:left">
    					        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
    					        <input type="text" required = "required"  placeholder="jj/mm/aaaa" class="form-control datepicker-menus" <?php echo $form["date_echeance"] ?>>   						    
    					    </div>
						</div>
					</div>
					<div class="control-group">
						<label class="col-md-1 col-md-offset-1" for="typeahead">Description </label>
						<div class="col-md-6">
							<textarea  class="form-control"  <?php echo $form["objet"]; ?>><?php echo $oForm->getData('objet')?></textarea>
						</div>
					</div>
				</div>
				<div class="row">

			<?php if (!$id):?>
				<button type="submit" class="btn btn-primary">
					Enregistrer <i class="icon-arrow-right14 position-right"></i>
				</button>
			<?php endif;?>

			<div class="form-actions">
				<?php if($id):?>
				<a
					href="<?php echo  url_for("Ajouter_Opportunite", array("id"=>$id));?>"><button
						type="submit" class="btn btn-info" name="Ajouter_Opportunite"> Modifier
					</button>
				</a>
				<button value="dupliquer" name="dupliquer" type="submit" class="btn btn-default">
					Dupliquer
				</button>
				
				<!-- <a onClick="return confirm('Voulez-vous vraiment supprimer cette opportunité ?');"
					href="<?php echo url_for("SupprimerOpportunite",array("id"=>$id)); ?>"><button
					type="button" class="btn btn-danger" name="supprimeropportunite">Supprimer</button>
				</a>
 -->			<?php endif; ?>
			</div>
		</div>
			</form>
		</div>
	</div>
</div>
