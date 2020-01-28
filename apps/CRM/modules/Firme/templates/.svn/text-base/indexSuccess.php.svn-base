<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('#tableau2'));  
	    oTable2.generate();
	    $('.itemName').select2({
	        placeholder: 'Select an item',
	        ajax: {
	          url: "<?php echo url_for('Common/AutoCompleteRS') ?>",
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
      <li><a href="#">Commercial</a></li>
      <li class="active">Firmes</li>
    </ul>
  </div>
</div>
<!-- /page header -->
	<!-- Content area -->
	<div class="content">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Liste des firmes</h5>
				<div class="heading-elements">
    				<ul class="icons-list">
    					<li><a data-action="collapse"></a></li>
    				</ul>
    			</div>
			</div>
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
	        <form method="post">
					<div class="row">
							<div class="col-md-1">Code Firme :</div>
							<div class="col-md-2">
								<input type="text" class="form-control" <?php echo $filter["code_firme"]; ?>>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-1">R. sociale</div>
							<div class="col-md-2">
								<input type="text" class="form-control" <?php echo $filter["nom_firme"]; ?>>
							</div>
							<div class="col-md-1"></div>
    						<div class="col-md-1">telephone :</div>
    						<div class="col-md-2">
    							<input type="text" class="form-control" <?php echo $filter["num_tel"]; ?>>
    						</div>
							<div class="col-md-1"></div>
						
					</div>
					<div class="row">
                            <div class="col-md-1">Code Personne:</div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" <?php echo $filter["code_personne"]; ?>>
                            </div>
                            <div class="col-md-1"></div>
							<div class="col-md-1">Nom :</div>
							<div class="col-md-2">
								<input type="text" class="form-control" <?php echo $filter["nom"]; ?>>
							</div>
							<div class="col-md-1"></div>
    						<div class="col-md-1">Prénom :</div>
    						<div class="col-md-2">
    							<input type="text" class="form-control" <?php echo $filter["prenom"]; ?>>
    						</div>
							<div class="col-md-1"></div>
						
					</div>
					<div class="row">
						<div class="col-md-2">
							<input type="submit" class="btn btn-primary" value="Rechercher" >
						</div>
						<div class="col-md-2 col-md-offset-8">
		    				<a href="<?php echo url_for("AjouterFirme",array("nom_firme"=>$oFilter->getData("nom_firme"))); ?>">
		    		            <button type="button" class="btn btn-default">
		    		              <i class="icon-add position-left"></i> 
		    		              Ajouter une Firme
		    		            </button>
		    		        </a>
		    			 </div>
					</div>
			</form>
			<table id="tableau2" class="display table table-striped table-hover">
				<thead>
					<tr>
						<th>Code firme</th>
						<th>Raison Sociale complete</th>
						<th>Raison Sociale abrégée</th>
						<th>Nature</th>
						<th>Ville</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($datas as $data):?>
					<tr 
						onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id'])) ?>')"
						 style="cursor: pointer;">
						<td><?php echo $data['code_firme']?></td>
						<td><?php echo $data['rs_comp']?></td>
						<td><?php echo $data['rs_abr']?></td>
						<td><?php echo $data['nature']?></td>
						<td><?php echo $data['ville']?></td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>

	</div>
	<!-- /content area -->



	
	