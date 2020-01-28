<button type="button" class="btn btn-default btn-sm" id="btn-modal" data-toggle="modal" data-target="#modal_form_vertical"></button>
<script>

$(document).ready(function(){
	$('#btn-modal').hide();
dataDepend.setUrl("<?php echo url_for('setDependanceChoice'); ?>");


//-------//
	
	var depend = new dataDepend('tts_visites_planifiees_code_firme','tts_visites_planifiees_code_contact');
	depend.setSource('tts_firmes',['code_firme','code_firme']);
	depend.setDestin('tts_firme_contact',['code_firme',"code_contact,concat((prenom),(' '),(nom)) as fullname"]);
	depend.setData({value:'code_contact', libel:'fullname'});
	<?php if($id):?>
	depend.setSelected({value: '<?php echo $oForm->getData("code_contact"); ?>'}); 
	<?php endif;?>
	depend.setup();


	<?php if($id Or $code_firme):?>
    	$('#tts_visites_planifiees_code_firme').change();
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
	$('#tts_visites_planifiees_code_firme').change();
	
//-----------------//
	$(document).on('change', '#tts_visites_planifiees_code_contact',function(){
	 	if($("#tts_visites_planifiees_code_firme").val()!=null)
	 	{
	 		var parameters = "contact="+$(this).val()+"&code_firme="+$("#tts_visites_planifiees_code_firme").val();
	 		$.ajax({
                url: '<?php echo url_for('FindContact') ?>',
                type: 'post',
                data: parameters,
                success: function( data ) {
                    if(data==0){
                    	var contact = $("#tts_visites_planifiees_code_contact").val().split(" ");
                    	$('#prenomContact').val(contact[0]);
                    	$('#nomContact').val(contact[1]);
                        $('#btn-modal').click();
                    }
                },
                error: function( msg ) {
                    $('#loading-result').hide();
                    alert('Erreur Ajax!');
                }
            });
        }
        else
	 		alert("vous devez choisir une firme !");
	 });
	 $(document).on('click', '#ajoutContact',function(){

		if(!$('#nomContact').val()){
			alert('Vous devez renseigner le nom !');
			return false;
		}

		if(!$('#prenomContact').val()){
			alert('Vous devez renseigner le prenom !');
			return false;
		}
		if(!$('#civilite').val()){
			alert('Vous devez renseigner la civilite !');
			return false;
		}
		if(!$('#code_fonction').val()){
			alert('Vous devez renseigner la fonction !');
			return false;
		}
	 	var parameters = "nom="+$('#nomContact').val()
	 					 +"&prenom="+$('#prenomContact').val()
	 					 +"&code_firme="+$('#tts_visites_planifiees_code_firme').val()
	 					 +"&email="+$('#emailContact').val()
	 					 +"&tel="+$('#telContact').val()
	 					 +"&sex="+$('#sexContact').val()
	 					 +"&civilite="+$('#civilite').val()
	 					 +"&code_fonction="+$('#code_fonction').val()
	 					 ;
	 	$.ajax({
                url: '<?php echo url_for('AjouterContact') ?>',
                type: 'post',
                data: parameters,
                success: function( data ) {
                    if(data){
					 	var o = $("<option/>", {value: data, text: $('#prenomContact').val()+ ' '+ $('#nomContact').val()});
						$('#tts_visites_planifiees_code_contact').append(o);
						$('#tts_visites_planifiees_code_contact option[value="' + data + '"]').prop('selected',true);
						$("#tts_visites_planifiees_code_contact").val(data).trigger('change');
						$('#close-modal').click();
                    }
                },
                error: function( msg ) {
                    $('#loading-result').hide();
                    alert('Erreur Ajax!');
                }
            });
	 });

//-------//

//--------------------//

$('#tts_visites_planifiees_code_firme').change();


});
</script>
<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li><a href="#">Visites</a></li>
    </ul>
  </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5>
				<?php if($id):?>
				 	Visite Planifiée le <?php echo $oForm->getData("date_visite"); ?>
				 	</br>
				 	<a href="<?php echo url_for('ConsulterFirme',array("id" => $id_firme)) ?>" class="text-right">
    					consultez la firme <?php echo $oForm->getData('code_firme') ?>
    				</a>
				<?php else:?> Ajouter visite Planifiée.  Date: 
				<?php echo $date; endif?>.
				
			</h5>
			
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>

		<div class="panel-body">
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
					<div class="col-md-3">
						<select class="itemName form-control select" <?php echo $form["code_firme"]; ?>>
    					  <?php if($oForm->getData('code_firme')):?> 
    					      <option value="<?php echo $oForm->getData('code_firme')?>"><?php echo $firme?></option>
    					  <?php endif;?>
					   </select>
					</div>
					<div class="col-md-2"></div>
					<label class="col-md-1" for="selectError">Contact Firme</label>
					<div class="col-md-3">
						<select class="select-multiple-tags" <?php echo $form["code_contact"]?>></select>
					</div>
				</div>
				<div class="row">
					<?php if(!$date):?>
			       <label class="col-md-1" for="focusedInput">Date visite : </label>
		 		   <div class="col-md-3">

					    <div class="input-group" style="float:left">
					        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
					        <input type="text" placeholder="jj/mm/aaaa" mindate="03-24-2017" class="form-control datepicker-menus" <?php echo $form["date_visite"] ?>>   						    
					    </div>
	     		    </div>
			     		    
			     	
					<div class="col-md-2"></div>
			        <?php endif; ?>
					<label class="col-md-1" for="focusedInput">Heure visite </label>
					<div class="col-md-2">
						<input type="time" class="form-control" <?php echo $form["heure_visite"]?>>

					</div>	    
				</div>
				<div class="row">
					   
					<input value=<?php echo $IDU  ?> type="hidden"
					<?php echo $form["id_utilisateur"]?>>
					<label class="col-md-1" for="focusedInput">Commercial </label>
					<div class="col-md-3">
							<?php 
						   		$cond_commercial="";
						   		if(!$sf_user->hasCredential('allvisite')) $cond_commercial=" and id in ($ids_users_affecte)";
							echo TTSList::getListBox(array(
										"query" => "select id, concat(prenom,' ', nom) as commercial from tts_utilisateur where actif = 1  $cond_commercial",
										"form" => $form,
										"oForm" => $oForm,
										"value" => "id",
										"libel" => "commercial",
										"key" => "id_utilisateur",
										"db" => "crm",
										"class" => "select"
									)); 

							?>

					</div>
					<div class="col-md-2"></div>
					<label class="col-md-1" for="typeahead">Commentaire</label>
						<div class="col-md-2">
							<textarea class="form-control" <?php echo $form["commentaire"]; ?>><?php echo $oForm->getData('commentaire')?></textarea>
				        </div>
				</div>
				<div class="row">
					<div class="form-actions">
					   
						<div class="text-left">
							<?php if (!$id):?>
							<button type="submit" class="btn btn-primary">
								Enregistrer <i class="icon-arrow-right14 position-right"></i>
							</button>
							<?php endif;?>
						
    						<?php if ($id):?>
    						<button type="submit" class="btn btn-primary">
								Modifier RDV <i class="icon-arrow-right14 position-right"></i>
							</button>
    						<a href="<?php echo  url_for("AjouterVisitesR",array("id_visiteP"=>$id));?>"
    							class="btn btn-success"><i class="icon-check icon-white"></i>
    							Compte rendu RDV
    						</a>
    						<!-- 
    						<a onClick="return confirm('Voulez-vous vraiment supprimer cette visite ?');"
    						href="<?php echo url_for("SupprimerVisiteEffectuee",array("id"=>$id)); ?>"><button
    						type="button" class="btn btn-danger" name="supprimervisite_effectuee">Supprimer</button>
    						</a> -->
    						<?php endif;?>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	</div>
</div>
<!-- Vertical form modal -->
<div id="modal_form_vertical" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Contact</h5>
			</div>

			<div class="modal-body">
				<div class="form-group">
					<div class="row">
						<div class="col-sm-6">
							<label>Nom</label>
							<input type="text" placeholder="Nom..." class="form-control" id="nomContact">
						</div>

						<div class="col-sm-6">
							<label>Prenom</label>
							<input type="text" placeholder="Prenom..." class="form-control" id="prenomContact">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Sexe</label>
							<select id="sexContact" class="select">
								<option value="M">M</option>
								<option value="F">F</option>
							</select>
						</div>

						<div class="col-sm-6">
							<label>Civilité</label>
							<?php 
		                        echo TTSList::getListBox(array(
		                          "query" => "select code,civilite from civilite",
		                          "value" => "code",
		                          "libel" => "civilite",
		                          "key" => "civilite",
		                          "db" => "bd_web",
		                          "class" => "select",
	                              "required"=>"required"
		                        ));
		                      ?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Fonction</label>
							<?php 
		                        echo TTSList::getListBox(array(
		                          "query" => "select code,fonction from fonction",
		                          "value" => "code",
		                          "libel" => "fonction",
		                          "key" => "code_fonction",
		                          "db" => "bd_web",
		                          "class" => "select",
                                  "required"=>"required"
		                        ));
		                      ?>
						</div>
						
					
						<div class="col-sm-6">
							<label>Email</label>
							<input type="text" placeholder="xxx@xx.x" class="form-control" id="emailContact">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Tel 1</label>
							<input type="text" placeholder="06..." class="form-control" id="telContact">
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" id="ajoutContact" class="btn btn-primary">ajouter</button>
				<button type="button" id="close-modal" class="btn btn-link" data-dismiss="modal">fermer</button>
				
			</div>
		</div>
	</div>
</div>
<!-- /vertical form modal -->