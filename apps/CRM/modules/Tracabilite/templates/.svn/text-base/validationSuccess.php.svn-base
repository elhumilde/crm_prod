<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('.display'));   
	    oTable2.generate();

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
					<label class="col-md-1 col-md-offset-1">Raisons : </label>
						<div class="col-md-2">
							<?php echo TTSList::getListBox(array(
	    								"query" => "select id, libelle from par_tts_raison",
								"form" => $filterPersonne,
								"oForm" => $oFilterPersonne,
	    								"value" => "id",
	    								"libel" => "libelle",
	    								"key" => "raison",
	    								"db" => "crm",
	    								"class"=>"select"
	                              )); ?>
						</div>
				</div>
				<div class="row">
                        <label class="col-md-1">Date :</label>
						<div class="col-md-2">
							<div class="input-group" style="float:left">
						        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
						        <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus" <?php echo $filterPersonne["date_from"]; ?>>   						    
						    </div>
						</div>
						<label class="col-md-1 col-md-offset-1">Au :</label>
						<div class="col-md-2">
							<div class="input-group" style="float:left">
						        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
						        <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus" <?php echo $filterPersonne["date_to"]; ?>>   						    
						    </div>
						</div>
						<label class="col-md-1 col-md-offset-1">Validation :</label>
						<div class="col-md-2">
							<select <?php echo $filterPersonne["validation"]; ?> class="select">
								<option></option>
								<option value="1" <?php if($oFilterPersonne->getData("validation")=="1") echo "selected" ; ?>>Validé</option>
								<option value="2" <?php if($oFilterPersonne->getData("validation")=="2") echo "selected" ; ?>>Rejeté</option>
							</select>
						</div>
					</div>
				<div class="row">
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
						<table class="display table table-striped table-hover">
		    				<thead>
		    					<tr>
		    						<th>Utilisateur</th>
		    						<th>validateur</th>
		    						<th>date validation</th>
		    						<th>raison</th>
		    						<th>Cmtr rejet</th>		    						
		    						<th>Serv</th>
		    						<th>code firme</th>
		    						<th>RS</th>
		    						<th>Date</th>
		    					</tr>
		    				</thead>
		    				<tbody>
		    
		    					<?php foreach ($firmes as $data):?>
		    					<tr  id="<?php echo "tts_firme_ajoute_".$data["id"]; ?>"  onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;background-color: <?php if($data['valide']==1) echo "#aafdaa"; else echo "#f9b7b7"; ?>">
		    						<td><?php echo $data['utilisateur']?></td>
		    						<td><?php echo $data['validateur']?></td>
		    						<td><?php echo $data['date_validation']?></td>
		    						<td><?php echo $data['raison']?></td>
		    						<td><?php echo $data['commentaire_rejet']?></td>
		    						<td><?php echo $data['service']?></td>
		    						<td><?php echo $data['code_firme']?></td>
		    						<td><?php echo $data['rs_comp']?></td>
		    						<td><?php echo $data['date']?></td>
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
										<th>validateur</th>
			    						<th>date validation</th>
			    						<th>raison</th>
			    						<th style="min-width: 150px">Cmtr rejet</th>
										<th style="min-width: 100px">Code Personne</th>
										<th style="min-width: 150px">Nom</th>
										
									</tr>
								</thead>
								<tbody>
									<?php foreach ($personnes as $data) : ?>
										<tr id="<?php echo "tts_personne_ajout_".$data["pa_id"]; ?>" style="background-color: <?php if($data['valide']==1) echo "#aafdaa"; else echo "#f9b7b7"; ?>" >
											<td><?php echo $data['utilisateur']?></td>
											<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php echo $data['code_firme']?></td>
											<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;"><?php echo $data['rs_comp']?></td>
											<td><?php echo $data['validateur']?></td>
				    						<td><?php echo $data['date_validation']?></td>
				    						<td><?php echo $data['raison']?></td>
				    						<td><?php echo $data['commentaire_rejet']?></td>
											<td><?php echo $data['code_personne']?></td>
											<td><?php echo $data['nom']." ".$data['prenom']?></td>
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
										<th style="min-width: 150px">Validateur</th>
										<th style="min-width: 100px">date validation</th>
										<th style="min-width: 150px">Raison</th>
										<th style="min-width: 150px">Cmtr rejet</th>
										<th style="min-width: 150px">Code firme</th>
										<th style="min-width: 150px">RS</th>
										<th style="min-width: 150px">Type</th>
										<th style="min-width: 150px">Champ</th>
										<th style="min-width: 150px">Ancienne valeur</th>
										<th style="min-width: 150px">Nouvelle valeur</th>
										
									</tr>
								</thead>
								<tbody>

									<?php foreach ($historiques_firme as $data):?>
									<tr onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')" style="cursor: pointer;background-color: <?php if($data['valide']==1) echo "#aafdaa"; else echo "#f9b7b7"; ?>" >
										<td><?php echo $data['validateur']?></td>
										<td><?php echo $data['date_validation']?></td>
										<td><?php echo $data['raison']?></td>
										<td><?php echo $data['commentaire_rejet']?></td>
										<td><?php echo $data['code_firme']?></td>
										<td><?php echo $data['rs_comp']?></td>
										<td><?php echo $data['type_modification']?></td>
										<td ><?php echo $data['champ']?></td>
										<td ><?php echo $data['old_value']?></td>
										<td ><?php echo $data['new_value']?></td>
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