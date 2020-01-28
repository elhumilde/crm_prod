<script>
$(document).ready(function(){
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
      <li><a href="#">Découverte</a></li>
      <li class="active">Ajouter</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Création d'une découverte</h5>
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
				
				<label class="col-md-1" for="selectError">Firme</label>
				<div class="col-md-2">
					<select class="itemName form-control select" <?php echo $form["code_firme"]; ?>>
    					  <?php if($oForm->getData('code_firme')):?> 
    					      <option value="<?php echo $oForm->getData('code_firme')?>"><?php echo $firme?></option>
    					  <?php endif;?>
					</select>
				</div>
				<?php if($id): ?>
					<label class="col-md-1 col-md-offset-1" for="focusedInput">Date de création </label>
					<div class="col-md-2">
				      	<div class="input-group" style="float:left">
					        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
					        <input type="text" placeholder="jj/mm/aaaa" disabled="disabled" class="form-control datepicker-menus datepicker-menus" <?php echo $form["date_creation"]?>>
					    </div>
					</div>
					<label class="col-md-1 col-md-offset-1" for="focusedInput">Créateur </label>
					<div class="col-md-2">
						<input id="focusedInput" readonly="readonly" type="text" class="form-control"
							value="<?php echo $createur?>">
					</div>
					<br><br>
				<?php endif; ?>
				<label class="col-md-12" for="textarea2">Quelles sont toutes vos activités ? </label>
				<div class="col-md-8">
					<textarea  class="form-control" rows="6" <?php echo $form["activite"]?>><?php echo $oForm->getData("activite")?></textarea>
				</div>
                <label class="col-md-12" for="textarea2">Décrivez comment vous communiquez aujourd'hui?  </label>
				<div class="col-md-8">
					<textarea  class="form-control" rows="6"  <?php echo $form["description"]?>><?php echo $oForm->getData("description")?></textarea>
				</div>
				<label class="col-md-12" for="textarea2">Qui sont vos clients ? - Comment viennent-ils ? - Budget moyen par client ? </label>
				<div class="col-md-8">
					<textarea  class="form-control" rows="6"  <?php echo $form["clients"]?>><?php echo $oForm->getData("clients")?></textarea>
				</div>
				<label class="col-md-12" for="textarea2">Où travaillez vous ?  Villes ? Régions ? National ? International ?</label>
				<div class="col-md-8">
					<textarea  class="form-control" rows="6"  <?php echo $form["travail"]?>><?php echo $oForm->getData("travail")?></textarea>
				</div>
				<label class="col-md-12" for="textarea2">Qu'est ce que vous souhaitez développer ? </label>
				<div class="col-md-8">
					<textarea  class="form-control" rows="6"  <?php echo $form["developper"]?>><?php echo $oForm->getData("developper")?></textarea>
				</div>
			</div>

			<div class="row">
				<div class="form-actions">
					<div class="text-left">
						<button type="submit" class="btn btn-primary">
							Enregistrer <i class="icon-arrow-right14 position-right"></i>
						</button>
					</div>				
				</div>
			</div>
		</form>
	</div>
</div>

