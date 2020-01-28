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
      <li class="active">Detail BC</li>
    </ul>
  </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

	<div class="entete">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">Informations générales de bon de commande numéro <b><?php echo $bc["num_bc"] ?></b></h6>
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
				    		<strong class="text-semibold col-md-5">Firme : </strong>
				    		<div class="text-size-small text-primar col-md-7"><?php echo $bc["rs_comp"] ?></div>
				    	</h5>
					</div>
				    <div class="col-md-4">
				    	<h5>
				    		<strong  class="text-semibold col-md-5">Responsable : </strong>
				    		<div class="text-size-small text-primary col-md-7"><?php echo $bc["responsable"] ?></div>
				    	</h5>
					</div>
				    <div class="col-md-4">
				    	<h5>
				    		<strong  class="text-semibold col-md-5">Date : </strong>
				    		<div class="text-size-small text-primary col-md-7"><?php echo $bc["date_bc"] ?></div>
				    	</h5>
					</div>
				    <div class="col-md-4">
				    	<h5>
				    		<strong  class="text-semibold col-md-5">Montant ttc : </strong>
				    		<div class="text-size-small text-primary col-md-7"><?php echo number_format($bc["mt_ttc"],0,'', ' '); ?></div>
				    	</h5>
					</div>
					<div class="col-md-4">
				    	<h5>
				    		<strong  class="text-semibold col-md-5">Montant reglé : </strong>
				    		<div class="text-size-small text-primary col-md-7"><?php echo number_format($bc["reglem_ttc"],0,'', ' '); ?></div>
				    	</h5>
					</div>
					<div class="col-md-4">
				    	<h5>
				    		<strong  class="text-semibold col-md-5">Société : </strong>
				    		<div class="text-size-small text-primary col-md-7"><?php echo $bc["nom_societe"] ?></div>
				    	</h5>
					</div>
					<div class="col-md-4">
				    	<h5>
				    		<strong  class="text-semibold col-md-5">Support : </strong>
				    		<div class="text-size-small text-primary col-md-7"><?php echo $bc["nom_support"] ?></div>
				    	</h5>
					</div>
					<div class="col-md-4">
				    	<h5>
				    		<strong  class="text-semibold col-md-5">Edition : </strong>
				    		<div class="text-size-small text-primary col-md-7"><?php echo $bc["edition"] ?></div>
				    	</h5>
					</div>
					<div class="col-md-4">
				    	<h5>
				    		<strong  class="text-semibold col-md-5">Date d'échéance : </strong>
				    		<div class="text-size-small text-primary col-md-7"><?php echo $bc["date_prev"] ?></div>
				    	</h5>
					</div>
				</div>
				<div class="row">
					Liste des Produits du BC
				    <table id="tableau" class="display table table-striped table-hover">
						<thead>
							<tr>
								<th>produit</th>
								<th>emplacement</th>
								<th>prod</th>
								<th>date fin</th>
								<th>Préstation</th>
								<th>remise</th>
								<th>prix ht</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($detail_bc as $row) : ?>
								<tr>
									<td><?php echo $row['code_produit']?></td>
									<td><?php echo $row['libelle_emplacement']?></td>
									<td><?php echo $row['produit_papier'] ? $row['produit_papier'] :$row['produit_internet'] ?></td>
									<td><?php if($row['date_fin']!="0000-00-00") echo $row['date_fin']?></td>
									<td><?php echo $row['module']?></td>
									<td><?php echo number_format($row['remise'],0,'', ' ');?></td>
									<td><?php echo number_format($row['prix_ht'],0,'', ' ');?></td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
				Liste des Reglements du BC

				<div class="row">
				    <table id="tableau" class="display table table-striped table-hover">
						<thead>
							<tr>
								<th>code</th>
								<th>date</th>
								<th>objet</th>
								<th>responsable</th>
								<th>resultat</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($detail_reglement as $row) : ?>
								<tr>
									<td><?php echo $row['code']?></td>
									<td><?php echo $row['date']?></td>
									<td><?php echo $row['objet'] ?></td>
									<td><?php echo $row['responsable']?></td>
									<td><?php echo number_format($row['resultat'],0,'', ' ');?></td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>

   			</div>
		</div>
	</div>
</div>