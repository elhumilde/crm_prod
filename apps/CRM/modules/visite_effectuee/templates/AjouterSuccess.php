<script>

$(document).ready(function(){
dataDepend.setUrl("<?php echo url_for('setDependanceChoice'); ?>");


$('#tts_opportunite_id_type_opportunite').attr("required",false)
$('#tts_opportunite_objet').attr("required",false);
$('#btn-modal').hide();
//-------//



	
	var depend = new dataDepend('tts_visites_realisees_code_firme','tts_visites_realisees_code_contact');
	depend.setSource('tts_firmes',['code_firme','code_firme']);
	depend.setDestin('tts_firme_contact',['code_firme',"code_contact,concat((prenom),(' '),(nom)) as fullname"]);
	depend.setData({value:'code_contact', libel:'fullname'});
	<?php if($id || $id_visiteP):?>
	depend.setSelected({value: '<?php echo $oForm->getData("code_contact"); ?>'}); 
	<?php endif;?>
	depend.setup();


	<?php if($id Or $id_visiteP Or $code_firme):?>
    	$('#tts_visites_realisees_code_firme').change();
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
	
//-----------------//

    $('#oppo').hide();
	 $(document).on('change', '#tts_visites_realisees_code_contact',function(){
	 	if($("#tts_visites_realisees_code_firme").val()!=null)
	 	{
	 		var parameters = "contact="+$(this).val()+"&code_firme="+$("#tts_visites_realisees_code_firme").val();
	 		$.ajax({
                url: '<?php echo url_for('FindContact') ?>',
                type: 'post',
                data: parameters,
                success: function( data ) {
                    if(data==0){
                    	var contact = $("#tts_visites_realisees_code_contact").val().split(" ");
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
	 					 +"&code_firme="+$('#tts_visites_realisees_code_firme').val()
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
						$('#tts_visites_realisees_code_contact').append(o);
						$('#tts_visites_realisees_code_contact option[value="' + data + '"]').prop('selected',true);
						$("#tts_visites_realisees_code_contact").val(data).trigger('change');
						$('#close-modal').click();
                    }
                },
                error: function( msg ) {
                    $('#loading-result').hide();
                    alert('Erreur Ajax!');
                }
            });
	 });
	 $(document).on('change', '#tts_visites_realisees_id_resultat_visite',function(){
			var resultat_visite = $(this).val();
			if(
				resultat_visite == "5" || 
				resultat_visite == "6" || 
				resultat_visite == "7"
			 ){
				$('#tts_visites_realisees_nouv_opportunite').attr("required",true);
			}else{
				$('#tts_visites_realisees_nouv_opportunite').attr("required",false);
				}
		 });
	 $(document).on('change', '#tts_visites_realisees_nouv_opportunite',function(){
			var besoin = $(this).val();
			if(besoin == 1){
				$('#oppo').show();
				$('#a_opportunite').hide();
				$('#tts_opportunite_id_type_opportunite').attr("required",true);
				$('#tts_opportunite_objet').attr("required",true);
			}if(besoin == 2){
				$('#oppo').hide();
				$('#tts_opportunite_id_type_opportunite').attr("required",false);
				$('#tts_opportunite_objet').attr("required",false);
				}
		 });
	 
//-------//

//--------------------//

$('#tts_visites_realisees_id_type_visite').change();
$('#tts_visites_realisees_besoin_identifie').change();
<?php if($id Or $id_visiteP):?>
$('#tts_visites_realisees_nouv_opportunite').change();
<?php endif;?>

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
<button type="button" class="btn btn-default btn-sm" id="btn-modal" data-toggle="modal" data-target="#modal_form_vertical"></button>
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5>
					<?php if($id):?>
					   Modification visite. Date <?php echo $oForm->getData("date_visite"); ?>
					   <a href="<?php echo url_for('ConsulterFirme',array("id" => $id_firme)) ?>" class="text-right">consultez la firme <?php echo $oForm->getData('code_firme') ?></a>
					<?php elseif($id_visiteP): ?> 
					   Modification visite. Date   <?php echo $v_planifiee['date_visite']; ?>
					   <a href="<?php echo url_for('ConsulterFirme',array("id" => $id_firme)) ?>" class="text-right">consultez la firme <?php echo $oForm->getData('code_firme') ?></a>
				    <?php else:?> Ajouter visite.  Date: <?php echo $date; endif?>.
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
		        <label class="col-md-1" for="focusedInput">Commercial </label>
					<div class="col-md-2">
							<?php 
						   		$cond_commercial="";
						   		if(!$sf_user->hasCredential('allvisite')) $cond_commercial=" and id in ($ids_users_affecte)";
									echo TTSList::getListBox(array(
										"query" => "select id, concat(prenom,' ', nom) as commercial from tts_utilisateur where actif = 1 $cond_commercial order by nom",
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
					<?php if(!$date && !$id):?>
					       <div class="col-md-1"></div>
					       <label class="col-md-1" for="focusedInput">Date visite : </label>
				 		   <div class="col-md-2">

							    <div class="input-group" style="float:left">
        					        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
        					        <input type="text" placeholder="jj/mm/aaaa" mindate="03-24-2017" class="form-control datepicker-menus" <?php echo $form["date_visite"] ?>>   						    
        					    </div>
			     		    </div>
			     	<?php endif; ?>
			     	
					<div class="col-md-1"></div>
					<label class="col-md-1" for="focusedInput">Heure visite </label>
					<div class="col-md-2">
						<input type="time" class="form-control" <?php echo $form["heure_visite"]?>>

					</div>
		        </div>
		        
				<div class="row">
					<label class="col-md-1" for="selectError">Firme</label>
					<div class="col-md-2">
						<select class="itemName form-control select" <?php echo $form["code_firme"]; ?>>
    					  <?php if($oForm->getData('code_firme')):?> 
    					      <option value="<?php echo $oForm->getData('code_firme')?>"><?php echo $firme?></option>
    					  <?php endif;?>
					   </select>
					</div>
					<div class="col-md-1"></div>
					<label class="col-md-1" for="selectError">Contact Firme</label>
					<div class="col-md-2">
						<select class="select-multiple-tags" <?php echo $form["code_contact"]?>></select>
					</div>
					<div class="col-md-1"></div>
					
					<label class="col-md-1" for="selectError">Résultat Visite</label>
						<div class="col-md-2">
							<?php echo TTSList::getListBox(array(
									"query" => "select id, resultat from par_tts_visite_resultat",
									"form" => $form,
									"oForm" => $oForm,
									"value" => "id",
									"libel" => "resultat",
									"key" => "id_resultat_visite",
									"db" => "crm",
									"class" => "select"
								)); ?>
						</div>
					   <div class="col-md-1"></div>
					
				</div>

				<div class="row">
				    <div id="opportunite">
						<label class="col-md-1" for="selectError">Nouvelle
							Opportunit&eacute;</label>
						<div class="col-md-2">
							<select  class="select"
							<?php echo $form["nouv_opportunite"]; ?>>
								<option value=""></option>
								<?php foreach($n_opp as $k=>$c): ?>
								<option value="<?php echo $k; ?>"
								<?php echo $oForm->setSelected("nouv_opportunite",$k); ?>>
									<?php echo $c; ?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>
					   <div class="col-md-1"></div>
					</div>                   					
				</div>
					
					<div id="oppo">
				<div class="row">
						<label class="col-md-1" for="selectError">Type Opportunité</label>
						<div class="col-md-2">
							<?php echo TTSList::getListBox(array(
									"query" => "select id, type from par_tts_opportunite_type",
									"form" => $formOpp,
									"oForm" => $oFormOpp,
									"value" => "id",
									"libel" => "type",
									"key" => "id_type_opportunite",
									"db" => "crm",
									"class" => "select"
								)); ?>
						</div>
					   <div class="col-md-1"></div>
					
						<label class="col-md-1" for="typeahead">Montant Probable </label>
						<div class="col-md-2">
							<input type="text" class="form-control" <?php echo $formOpp["montant_probable"]; ?>>
						</div>
						
					   <div class="col-md-1"></div>
						<label class="col-md-1" for="typeahead">reussite en %</label>
						<div class="col-md-2">
							<input type="text" class="form-control" <?php echo $formOpp["pourcentage_reussite"]; ?>>
						</div>
						
					   <div class="col-md-1"></div>
						
				</div>
				<div class="row">
						
						<label class="col-md-1" for="typeahead">Date d'echeance</label>
						<div class="col-md-2">
							<div class="input-group" style="float:left">
        					        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
        					        <input type="text" placeholder="jj/mm/aaaa" mindate="03-24-2017" class="form-control datepicker-menus" <?php echo $formOpp["date_echeance"]; ?>>   						    
        					  </div>
						</div>
						
					   <div class="col-md-1"></div>
						<label class="col-md-1" for="typeahead">Objet Opportunité</label>
						<div class="col-md-2">
							<textarea class="form-control" <?php echo $formOpp["objet"]; ?>><?php echo $oFormOpp->getData('objet')?></textarea>
						</div>
						
					    <div class="col-md-1"></div>
					</div>

				</div>

				<div class="row">
					<label class="col-md-1" for="textarea2">Rapport de visite</label>
					<div class="col-md-6">
						<textarea class="form-control" rows="3" <?php echo $form["rapport_visite"]?>><?php echo $oForm->getData("rapport_visite")?></textarea>
					</div>
					<div class="col-md-1"></div>
					<div>

					   <label class="col-md-1" for="focusedInput">Date prochaine visite : </label>
				 		  
				 		  <div class="col-md-2">

							  <div class="input-group" style="float:left">
        					        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
        					        <input type="text" placeholder="jj/mm/aaaa" mindate="03-24-2017" class="form-control datepicker-menus" <?php echo $form["date_prochainev"] ?>>   						    
        					    </div>
			     		   </div>
			        </div>
				</div>
				<div class="row">
					<div class="form-actions">
					   
						<?php if (!$id):?>
						<div class="text-left">
							<button type="submit" class="btn btn-primary">
								Enregistrer <i class="icon-arrow-right14 position-right"></i>
							</button>
						</div>
						<?php endif;?>
						<!--  
						<?php if ($id):?>
						<a onClick="return confirm('Voulez-vous vraiment supprimer cette visite ?');"
						href="<?php echo url_for("SupprimerVisiteEffectuee",array("id"=>$id)); ?>"><button
						type="button" class="btn btn-danger" name="supprimervisite_effectuee">Supprimer</button>
						</a>
						<?php endif;?>
						-->
						
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