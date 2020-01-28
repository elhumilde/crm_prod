<script type="text/javascript">

$(function() {
    $('.datatable-basic').DataTable();
});


</script>

<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li><a href="#">Administration</a></li>
      <li class="active">Gestion des utilisateur</li>
    </ul>
  </div>
</div>
<!-- /page header -->


	<!-- Content area -->
	<div class="content">

<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Recherche des Utilisateurs</h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
					</ul>
				</div>
			</div>

			<div class="panel-body">
			<form method="post">
					<div class="row">

						<div class="col-md-4">
							<div class="form-group">
								<label>Nom:</label> <input type="text"
									placeholder="Nom" class="form-control" <?php echo $filter["nom"]; ?>>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Pr&eacute;nom:</label> <input type="text"
									placeholder="Pr&eacute;nom" class="form-control" <?php echo $filter["prenom"]; ?>>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Actif:</label> 
								
    						<?php echo TTSList::getListBox(array(
    								"query" => "#:boolData#",
    								"form" => $filter,
    								"oForm" => $oFilter,
    								"key" => "actif",
                                    "class" => "select"
                          )); ?>
    					
							</div>
						</div>

					</div>

					<div class="col-md-2">
						<button type="submit" class="btn btn-primary btn-xs">
							Recherche 
						</button>
					</div>
					<div class="col-md-2 col-md-offset-8">
					
				<a href="<?php echo url_for('AjouterUser') ?>">
					<button type="button" class="btn btn-default">
		              <i class="icon-add position-left"></i> 
		              Ajouter un Utilisateur
		            </button>
		        </a>	
			</div>
				</div>
        </form>
		</div>

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
						<th>Login</th>
						<th>E-mail</th>
						<th>Service</th>
						<th>Profil</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
						<?php foreach ($data as $row):?>

					<tr>
						<td><?php echo $row["nom"]?></td>
						<td><?php echo $row["prenom"]?></td>
						<td><?php echo $row["login"]?></td>
						<td><?php echo $row["email"]?></td>
						<td><?php echo $row["service"]?></td>
						<td><?php echo $row["profil"]?></td>
						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown"><a href="#" class="dropdown-toggle"
									data-toggle="dropdown"> <i class="icon-menu9"></i>
								</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a
											href="<?php echo url_for('AjouterUser',array("id" => $row['id'])) ?>"><i
												class="icon-pen"></i>Modifier</a></li>
										
									</ul></li>
							</ul>
						</td>
					</tr>
								<?php endforeach;?>
							</tbody>
			</table>
		</div>

	</div>
	<!-- /content area -->

	<!-- /content area -->



<!-- ------------------------------------------------- -->
