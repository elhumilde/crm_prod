<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('#tableau'));   
	    oTable2.generate();
	  });
</script>
<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li><a href="#">Consulter Firmes</a></li>
      <li class="active">Detail Production</li>
    </ul>
  </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

	<div class="entete">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">Informations générales de Production numéro <b><?php echo $production ["num_bc"] ?></b></h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
					</ul>
				</div>
			</div>

			<div class="panel-body">		        
		        <div class="row">
		        	<div class="col-md-4">
						<h5>
				    		<strong  class="text-semibold col-md-5">edition : </strong>
				    		<div class="text-size-small text-primary col-md-7"> <?php echo $production["edition"]; ?>
				    		</div>
				    	</h5>
					</div>
					<div class="col-md-4">
						<h5>
				    		<strong  class="text-semibold col-md-5">oper : </strong>
				    		<div class="text-size-small text-primary col-md-7"><?php echo $production["operateur"]; ?>
				    		</div>
				    	</h5>
					</div>
					<div class="col-md-4">
						<h5>
				    		<strong  class="text-semibold col-md-5">Responsable : </strong>
				    		<div class="text-size-small text-primary col-md-7"><?php echo $production["responsable"]; ?>
				    		</div>
				    	</h5>
					</div>
					<div class="col-md-4">
						<h5>
				    		<strong  class="text-semibold col-md-5">date oper : </strong>
				    		<div class="text-size-small text-primary col-md-7"> <?php if($production['date_operateur']!="0000-00-00") echo $production["date_operateur"]; ?>
				    		</div>
				    	</h5>
					</div>
					<div class="col-md-4">
						<h5>
				    		<strong  class="text-semibold col-md-5">code prod : </strong>
				    		<div class="text-size-small text-primary col-md-7"> <?php echo $production["code_produit"]; ?>
				    		</div>
				    	</h5>
					</div>
					<div class="col-md-4">
						<h5>
				    		<strong  class="text-semibold col-md-5">date env : </strong>
				    		<div class="text-size-small text-primary col-md-7"> <?php if($production['date_envoi_bat']!="0000-00-00") echo $production["date_envoi_bat"]; ?>
				    		</div>
				    	</h5>
					</div>
					<div class="col-md-4">
						<h5>
				    		<strong  class="text-semibold col-md-5">date rtr : </strong>
				    		<div class="text-size-small text-primary col-md-7"> <?php if($production['date_retour_bat']!="0000-00-00") echo $production["date_retour_bat"]; ?>
				    		</div>
				    	</h5>
					</div>
					<div class="col-md-4">
						<h5>
				    		<strong  class="text-semibold col-md-5">moy env : </strong>
				    		<div class="text-size-small text-primary col-md-7"> <?php echo $production["moyen_envoi"]; ?>
				    		</div>
				    	</h5>
					</div>
					<div class="col-md-4">
						<h5>
				    		<strong  class="text-semibold col-md-5">result: </strong>
				    		<div class="text-size-small text-primary col-md-7"> <?php echo $production["resultat_bat"]; ?>
				    		</div>
				    	</h5>
					</div>
				</div>
				<div class="row">
				    <table id="tableau" class="display table table-striped table-hover">
						<thead>
							<tr>
								<th>firme</th>
								<th> societe</th>
								<th> num</th>
								<th> edition</th>
								<th> support</th>
								<th>num reglem</th>
								<th> num facture</th>
								<th> mt ttc</th>
								<th> mode_reglem</th>
								<th> date reg</th>
								<th> date valeur</th>
								<th> date encais</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($detail_production as $row) : ?>
								<tr>
									<td><?php echo $row['code_firme']?></td>
									<td><?php echo $row['nom_societe']?></td>
									<td><?php echo $row['num_bc']?></td>
									<td><?php echo $row['edition']?></td>
									<td><?php echo $row['nom_support']?></td>
									<td><?php echo $row['num_reglem']?></td>
									<td><?php echo $row['num_facture']?></td>
									<td><?php echo $row['mt_ttc']?></td>
									<td><?php echo $row['mode_reglem']?></td>
									<td><?php if($row['date_reg']!="0000-00-00") echo $row['date_reg']?></td>
									<td><?php if($row['date_valeur']!="0000-00-00") echo $row['date_valeur']?></td>
									<td><?php if($row['date_encais']!="0000-00-00") echo $row['date_encais']?></td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
   			</div>
		</div>
	</div>
</div>