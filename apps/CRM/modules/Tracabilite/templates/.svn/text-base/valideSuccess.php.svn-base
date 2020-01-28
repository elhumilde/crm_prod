<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('.display'));   
	    oTable2.generate();

	  });
	function modifier(ligne,id,act){ // on écoute le clic et le double-clic !
		var parameters = "ligne="+ligne+"&id="+id+"&act="+act;
	    $.ajax({
            url: '<?php echo url_for('Valide') ?>',
            type: 'post',
            data: parameters,
            success: function( data ) {
                $("#"+ligne+"_"+id).hide();

            },
            error: function( msg ) {
                $('#loading-result').hide();
                alert('Erreur Ajax!');
            }
        });
	}
	function rejeter(){ 
		
		ligne=$("#ligne").val();
		id=$("#id_ligne").val();
		raison=$("#raison").val();
		if(!raison) alert("veuillez indiquer la raison de rejet");
		else {var parameters = "ligne="+ligne+"&id="+$("#id_ligne").val()+"&raison="+$("#raison").val()+"&commentaire_rejet="+$("#commentaire_rejet").val()+"&act=2";
		 
		$.ajax({
            url: '<?php echo url_for('Valide') ?>',
            type: 'post',
            data: parameters,
            success: function( data ) {
            	if(data) alert(data);
                $("#"+ligne+"_"+id).hide();
            },
            error: function( msg ) {
                $('#loading-result').hide();
                alert('Erreur Ajax!');
            }
        });
		$(".close").click();
		}
	    
	}
	$(document).on('click', '#link_modal',function(){
		$("#id_ligne").val($(this).attr('id_ligne'));
		$("#ligne").val($(this).attr('ligne'));
		$("#btn-modal").click();
	});
</script>
<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li class="active">Validation des ajouts et modifications</li>
    </ul>
  </div>
</div>
<!-- /page header -->
	<!-- Content area -->
	<div class="content">
		
		<div class="panel panel-flat">					
			<div class="panel-heading">
						<h5 class="panel-title">Firmes</h5>
						<div class="heading-elements">
							<ul class="icons-list">
								<li><a data-action="collapse"></a></li>
							</ul>
						</div>
					</div>
			<form method="post">
						<div class="row">
							<?php if($sf_user->hasCredential('allfirme')): ?>
								<label class="col-md-1">utilisateur :</label>
								<div class="col-md-2">
									<?php echo TTSList::getListBox(array(
											"query" => "select id, concat(prenom,' ',nom) as login from tts_utilisateur where actif = 1 ",
											"form" => $filterPersonne,
											"oForm" => $oFilterPersonne,
											"value" => "id",
											"libel" => "login",
											"key" => "id",
											"db" => "crm",
											"class" => "select"
										)); ?>
								</div>
							<?php endif; ?>
							<label class="col-md-1 col-md-offset-1">Service :</label>
	    					<div class="col-md-2">
	    						<?php echo TTSList::getListBox(array(
	    								"query" => "select id, libelle from par_tts_service",
	    								"form" => $filterPersonne,
	    								"oForm" => $oFilterPersonne,
	    								"value" => "id",
	    								"libel" => "libelle",
	    								"key" => "id_service",
	    								"db" => "crm",
	    								"class"=>"select"
	                              )); ?>
	    					</div>
	    					<label class="col-md-1">Annonceur </label>
                            <div class="col-md-2">
                            	<select class="form-control select" <?php echo $filterPersonne["annonceur"]; ?>>
        						      <option value=""></option>
        						      <option value="2" <?php if($oFilterPersonne->getData("annonceur")=="2") echo "selected" ; ?>>Non</option>
        						      <option value="1" <?php if($oFilterPersonne->getData("annonceur")=="1") echo "selected" ; ?>>Oui</option>
        						</select>
                  	</div>
	    				</div>
	    				<div class="row">
							<div class="col-md-2">
								<input type="submit" class="btn btn-primary" value="Rechercher" >
							</div>
						</div>
	    			</form>
			<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
				<li class="active"><a href="#firmes" data-toggle="tab">Firmes</a></li>
				<li><a href="#personnes" data-toggle="tab">Personnes</a></li>
				<li><a href="#historiques_firme" data-toggle="tab">Historique de modifications des firmes</a></li>
			</ul>
				<div class="tab-content">
					<div class="tab-pane has-padding active" id="firmes">
		    			<table class="table table-striped table-hover display">
		    				<thead>
		    					<tr>
		    						<th>Utilisateur</th>
		    						<th style="min-width: 100px">Serv</th>
		    						<th>code firme</th>
		    						<th>RS</th>
		    						<th>Annonceur</th>
		    						<th>Date</th>
		    						<th>Action</th>
		    					</tr>
		    				</thead>
		    				<tbody>
		    
		    					<?php foreach ($firmes as $data):?>
		    					<tr  id="<?php echo "tts_firme_ajoute_".$data["id"]; ?>">
		    						<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php echo $data['utilisateur']?></td>
		    						<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php echo $data['service']?></td>
		    						<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php echo $data['code_firme']?></td>
		    						<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php echo $data['rs_comp']?></td>
		    						<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php if($data['annonceur'] ==1) echo "Oui"; else echo "Non"; ?></td>
		    						<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php echo $data['date']?></td>
		    						
		    						<td>
		    							<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle"
													data-toggle="dropdown"> 
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li>
														<a onClick="modifier('tts_firme_ajoute',<?php echo $data["id"] ?>,1);" >
						    								<i class="icon-check"></i> Valider
						    							</a>
													</li>
													<li>
													<a id="link_modal" id_ligne="<?php echo $data['id'] ?>" ligne="tts_firme_ajoute">
								    								<i class="icon-close2"></i> Rejeter
								    							</a>
													</li>
												</ul>
											</li>
										</ul>
		    						</td>
		    					</tr>
		    					<?php endforeach;?>
		    				</tbody>
		    			</table>
	    			</div>
					<div class="tab-pane has-padding" id="personnes">
		    			<div class="row" style="padding : 1em;max-width: 100%;overflow: auto;">
			    			<table class="display table table-striped table-hover">
			    				<thead>
									<tr>
										<th style="min-width: 150px">Utilisateur</th>
										<th style="min-width: 100px">Code firme</th>
										<th style="min-width: 100px">RS</th>
										<th style="min-width: 100px">Annonceur</th>
										<th style="min-width: 100px">Code personne</th>
										<th style="min-width: 150px">Nom</th>
										<th style="min-width: 100px">Fonc</th>
										<th style="min-width: 100px">Srv</th>
										<th style="min-width: 200px">Email</th>
										<th style="min-width: 150px">Tel 1</th>
										<th style="min-width: 150px">Date Création</th>
										<th style="min-width: 60px">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($personnes as $data) : ?>
										<tr id="<?php echo "tts_personne_ajout_".$data["pa_id"]; ?>">
											<td><?php echo $data['utilisateur']?></td>
											<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php echo $data['code_firme']?></td>
											<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php echo $data['rs_comp']?></td>
											<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php if($data['annonceur'] ==1) echo "Oui"; else echo "Non"; ?></td>
											<td><?php echo $data['code_personne']?></td>
											<td><?php echo $data['nom']." ".$data['prenom']?></td>
											<td><?php echo $data['fonction']?></td>
											<td><?php echo $data['service']?></td>
											<td><?php if(isset($data['email']))echo $data['email']?></td>
											<td><?php if(isset($data['tel_1']))echo $data['tel_1']?></td>
											<td><?php if(isset($data['date_modification']))echo $data['date_modification']?></td>
											<td>
				    							<ul class="icons-list">
													<li class="dropdown">
														<a href="#" class="dropdown-toggle"
															data-toggle="dropdown"> 
															<i class="icon-menu9"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right">
															<li>
																<a onClick="modifier('tts_personne_ajout',<?php echo $data["pa_id"] ?>,1);">
								    								<i class="icon-check"></i> Valider
								    							</a>
															</li>
															<li>
																<a id="link_modal" id_ligne="<?php echo $data['pa_id'] ?>" ligne="tts_personne_ajout">
								    								<i class="icon-close2"></i> Rejeter
								    							</a>
															</li>
														</ul>
													</li>
												</ul>
				    						</td>
										</tr>
									<?php endforeach;?>
								</tbody>
			    			</table>
		    			</div>
	    			</div>
					<div class="tab-pane has-padding" id="historiques_firme">
						<div class="row" style="padding : 1em;max-width: 100%;overflow: auto;">
			    			<table class="display table table-striped table-hover">
			    				<thead>
									<tr>
										<th style="min-width: 150px">utilisateur</th>
										<th style="min-width: 100px">Serv</th>
										<th style="min-width: 80px">Code firme</th>
										<th style="min-width: 150px">RS</th>
										<th style="min-width: 150px">Annonceur</th>
										<th style="min-width: 200px">Type</th>
										<th style="min-width: 100px">Champ</th>
										<th style="min-width: 100px">Ancienne valeur</th>
										<th style="min-width: 100px">Nouvelle valeur</th>
										<th style="min-width: 100px">Date</th>
										<th style="min-width: 60px">Action</th>
									</tr>
								</thead>
								<tbody>

									<?php foreach ($historiques_firme as $data):?>
									<tr  id="<?php echo "tts_historique_modification_".$data["id"]; ?>" >
										<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php echo $data['fullname']?></td>
										<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php echo $data['service']?></td>
										<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"> <?php echo $data['code_firme']?></td>
										<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php echo $data['firme']?></td>
										<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php if($data['annonceur'] ==1) echo "Oui"; else echo "Non"; ?></td>
										<td><?php echo $data['type_modification']?></td>
										<td ><?php echo $data['champ']?></td>
										<td ><?php echo $data['old_value']?></td>
										<td ><?php echo $data['new_value']?></td>
										<td ><?php echo $data['date_modification']?></td>
										<td>
				    						<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle"
														data-toggle="dropdown"> 
														<i class="icon-menu9"></i>
													</a>

													<ul class="dropdown-menu dropdown-menu-right">
														<li>
															
						    							<a onClick="modifier('tts_historique_modification',<?php echo $data["id"] ?>,1);">
						    								<i class="icon-check"></i> Valider
						    							</a>
			    						
														</li>
														<li>
															<a id="link_modal" id_ligne="<?php echo $data['id'] ?>" ligne="tts_historique_modification">
							    								<i class="icon-close2"></i> Rejeter
							    							</a>
														</li>
													</ul>
												</li>
											</ul>
			    						</td>
									</tr>
									<?php endforeach;?>
								</tbody>
			    			</table>
			    		</div>
	    			</div>

    			</div>
		</div>

	</div>
	<!-- /content area -->

<!-- Vertical form modal -->
<button type="button" class="btn btn-default btn-sm" id="btn-modal" data-toggle="modal" data-target="#modal_form_vertical" style="display: none;"></button>
<div id="modal_form_vertical" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Raison de rejet</h5>
			</div>

			<div class="modal-body">
				<div class="form-group">
					<div class="row">
						<input type="hidden" id="id_ligne" value="">
						<input type="hidden" id="ligne" value="">
						<label class="col-md-3">Raisons : </label>
						<div class="col-md-4">
							<?php echo TTSList::getListBox(array(
	    								"query" => "select id, libelle from par_tts_raison",
	    								"value" => "id",
	    								"libel" => "libelle",
	    								"key" => "raison",
	    								"db" => "crm",
	    								"class"=>"select"
	                              )); ?>
						</div>
						<label class="col-md-3">Commentaire: </label>
						<div class="col-md-4">
							<textarea  class="form-control" rows="6" name="commentaire_rejet" id="commentaire_rejet"></textarea>
						</div>
						<div class="modal-footer col-md-5">
							<button type="button" id="ajoutContact" class="btn btn-primary" 
							onClick="rejeter('tts_historique_modification',<?php echo $data["id"] ?>,2);">confirmer</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /vertical form modal -->
	