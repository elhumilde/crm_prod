<form method="post">

	<!-- Page header -->
	<div class="page-header">
		<div class="breadcrumb-line">
			<ul class="breadcrumb">
				<li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
				<li><a href="#">Administration</a></li>
				<li class="active">Gestion des utilisateurs</li>
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
					<h5 class="panel-title"><?php if($id):?> Consultation/Modification d'un utilisateur <?php else:?> Ajout d'un utilisateur <?php endif?></h5>
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="collapse"></a></li>
						</ul>
					</div>
				</div>

				<div class="panel-body">
					<?php if ($sf_user->hasFlash('success')): ?>
		                <div
						class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
						<button type="button" class="close" data-dismiss="alert">
							<span>x</span><span class="sr-only">Close</span>
						</button>
						<span class="text-semibold">Felicitation !</span> <?php echo html_entity_decode($sf_user->getFlash('success')) ; ?>.
		                </div>
	              	<?php endif; ?>
	              	<?php if ($sf_user->hasFlash('error')): ?>
			          <div
						class="alert alert-danger alert-styled-left alert-bordered">
						<button type="button" class="close" data-dismiss="alert">
							<span>x</span><span class="sr-only">Close</span>
						</button>
						<span class="text-semibold">Attention !</span> <?php echo html_entity_decode($sf_user->getFlash('error')); ?>.
			          </div>
			        <?php endif; ?>
					<div class="row">

						<div class="col-md-2">Login:</div>
						<div class="col-md-2">
							<input type="text" placeholder="Login" class="form-control"
								<?php echo $form["login"]; ?>>
						</div>
						<div class="col-md-2">Nom:</div>
						<div class="col-md-2">
							<input type="text" placeholder="Nom" class="form-control"
								<?php echo $form["nom"]; ?>>
						</div>
						<div class="col-md-2">Pr&eacute;nom:</div>
						<div class="col-md-2">
							<input type="text" placeholder="prenom" class="form-control"
								<?php echo $form["prenom"]; ?>>
						</div>

					</div>
					<div class="row">
						<div class="col-md-2">Email:</div>
						<div class="col-md-2">
							<input type="email" placeholder="Email" class="form-control"
								<?php echo $form["email"]; ?>>
						</div>
						<div class="col-md-2">Commerciaux
							affect&eacute;s:</div>
						<div class="col-md-2">


							<select multiple="multiple" class="multiselect"
								name="tts_utilisateur_affecte[id_utilisateur_affecte][]">
								<?php foreach($users as $service=>$rows): ?>
									<optgroup label="<?php echo $service; ?>">
									<?php foreach($rows as $row): ?>
									<option value="<?php echo $row["id"]; ?>"
									<?php echo in_array($row["id"], $sf_data->getRaw('utilisateurs_aff')) ? "selected" : ""; ?>>
										<?php echo $row["user"]; ?>
									</option>
									<?php endforeach; ?>
                				<?php endforeach; ?>
    							</select>
						</div>
						<div class="col-md-2">Code Affectation:</div>
						<div class="col-md-2">
							<input type="text" placeholder="Code" class="form-control"
								<?php echo $form["code_commercial"]; ?>>
						</div>
						
                            
					</div>
					<div class="row">
                    
						<div class="col-md-2">Service:</div>
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
						<div class="col-md-2">Profil:</div>
						<div class="col-md-2">
							<select multiple="multiple" class="multiselect"
								name="tts_habilitation_utilisateur[id_habilitation_profil][]">
									<?php foreach($profil as $row): ?>
									<option value="<?php echo $row["id"]; ?>"
									<?php echo in_array($row["id"], $sf_data->getRaw('profil_user')) ? "selected" : ""; ?>>
										<?php echo $row["profil"]; ?>
									</option>
									<?php endforeach; ?>
    							</select>
						</div>
						<div class="col-md-2">Groupe:</div>
						<div class="col-md-2">
							<?php echo TTSList::getListBox(array(
        								"query" => "select * from par_tts_groupe",
        								"form" => $form,
        								"oForm" => $oForm,
        								"value" => "id",
        								"libel" => "libelle",
        								"key" => "id_groupe",
        								"db" => "crm",
        								"class"=>"select"
                                  )); ?>
						</div>
						
						
					</div>

					<div class="row">
					   <div class="col-md-2">Actif:</div>
						<div class="col-md-2">
							<input type="hidden" value='0' <?php echo $form["actif"]; ?>> <input
								type="checkbox" value='1'
								<?php echo $oForm->getData("actif") == "1" ? "checked" : ""; ?>
								<?php echo $form["actif"]; ?>>
						</div>
                     		<?php if($id): ?>
        						<div class="col-md-2">Date cr&eacute;ation:</div>
						<div class="col-md-2">
							<input type="text" placeholder="Date cr&eacute;ation"
								class="form-control" disabled="disabled"
								<?php echo $form["date_creation"]; ?>>
						</div>

						<div class="col-md-2">Date modification:</div>
						<div class="col-md-2">
							<input type="text" placeholder="Date modification"
								class="form-control" disabled="disabled"
								<?php echo $form["date_modif"]; ?>>
						</div>
				</div>
				<div class="row">
						<div class="col-md-2">Changement de mot de passe:</div>
						<div class="col-md-2">
							<input type="password"
									class="form-control" name="newpwd"
									pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
									title="Le mot de passe doit contenir au moins un chiffre et une lettre en majuscule et une lettre en miniscule (8 caracteres)">
						</div>
        					<?php else:?>
        					<div class="col-md-2">Mot de passe:</div>
						<div class="col-md-2">
							<input type="text" placeholder="password" class="form-control"
								<?php echo $form["pwd"]; ?>
								pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
								title="Le mot de passe doit contenir au moins un chiffre et une lettre en majuscule et une lettre en miniscule (8 caracteres)">
						</div>
                            <?php endif;?>
                            
						<div class="col-md-2">Code Commande:</div>
						<div class="col-md-2">
							<input type="text" placeholder="Code Commande" class="form-control"
								<?php echo $form["code_commande"]; ?>>
						</div>


					</div>

					<div class="row">
						<div>
							<button type="submit" class="btn btn-primary">
								Enregistrer <i class="icon-arrow-right14 position-right"></i>
							</button>
						</div>
						<!-- --------------------------------------------------------------------------- -->


					</div>
		
		</form>
	</div>