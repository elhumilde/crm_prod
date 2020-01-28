

<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li><a href="#">Administration</a></li>
      <li class="active">Gestion des profils</li>
    </ul>
  </div>
</div>
<!-- /page header -->
	<!-- Content area -->
	<div class="content">



		<!-- Basic layout-->
		<form method="post">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><?php if($id):?> Consultation/Modification d'un profil <?php else:?> Ajout d'un profil <?php endif?></h5>
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="collapse"></a></li>
						</ul>
					</div>
				</div>

				<div class="panel-body">
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
	
						<div class="col-md-6">
							<div class="form-group">
								<label>Profil:</label> <input type="text"
									placeholder="Profil" class="form-control" <?php echo $form["profil"]; ?>>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>description:</label> <input type="text"
									placeholder="description" class="form-control" <?php echo $form["description"]; ?>>
							</div>
						</div>
						
					</div>
					<!-- Disable filter -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Liste des actions associ&eacute;es</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                	</ul>
		                	</div>
						</div>

							<div class="form-group">
										<label>Liste des actions</label>
										<div class="multi-select-full">
											<select   id="action_profil"  class="multiselect" multiple="multiple" name="tts_habilitation[id_habilitation_action][]">
												<?php foreach($all_actions_profil as $module=>$rows): ?>
												<optgroup label="<?php echo $module; ?>">
                								    <?php foreach($rows as $row): ?>
                								    <option value="<?php echo $row["id"]; ?>"  <?php if($row["selected"]) : ?> selected="selected" <?php endif;?>> <?php echo $row["description"]; ?></option>
                							        <?php endforeach; ?>
                							    <?php endforeach; ?>
                						        
											</select>
										</div>
										
										
												

						</div>
					</div>
					<!-- /disable filter -->
					
					

					<div class="text-right">
						<button type="submit" class="btn btn-primary">
							Enregistrer <i class="icon-arrow-right14 position-right"></i>
						</button>
					</div>
				</div>
			</div>
		</form>
		<!-- /basic layout -->

				<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Liste des utilisateurs</h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
					</ul>
				</div>
			</div>

			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Pr&eacute;nom</th>
					</tr>
				</thead>
				<tbody>
						<?php foreach ($utilisateurs as $row):?>

					<tr>
						<td><?php echo $row["nom"]?></td>
						<td><?php echo $row["prenom"]?></td>
					</tr>
								<?php endforeach;?>
							</tbody>
			</table>
		</div>

	</div>
	<!-- /content area -->
