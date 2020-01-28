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
      <li class="active">Gestion des profil</li>
    </ul>
  </div>
</div>
<!-- /page header -->
	<!-- Content area -->
	<div class="content">

		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Liste des profils</h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
					</ul>
				</div>
			</div>
            <div class="col-md-2 col-md-offset-10">
                <a href="<?php echo url_for('AjouterProfil') ?>">
    				<button type="button" class="btn btn-default">
    	              <i class="icon-add position-left"></i> 
    	              Ajouter un profil
    	            </button>
	            </a>	
			</div>
			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>Profil</th>
						<th>Description</th>
						<th>Nombre Users</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
							    <?php foreach ($data as $row):?>
								<tr>
						<td><?php echo $row['profil']?></td>
						<td><?php echo $row['description']?></td>
						<td><?php echo $row['nb']?></td>
						<td class="text-center">
							<ul class="icons-list">
								<li class="dropdown"><a href="#" class="dropdown-toggle"
									data-toggle="dropdown"> <i class="icon-menu9"></i>
								</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a
											href="<?php echo url_for('AjouterProfil',array("id" => $row['id'])) ?>"><i
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
