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
				<h6 class="panel-title">Détail du solde client</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
					</ul>
				</div>
			</div>

			<div class="panel-body">		        
		        
				<div class="row">
				    <table id="tableau" class="display table table-striped table-hover">
						<thead>
							<tr>
								<th>code firme</th>
								<th>num facture</th>
								<th>mt ttc</th>
								<th>reglem ttc</th>
								<th>solde</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($impaye as $row) : ?>
								<tr>
									<td>MA<?php echo $row['code_firme']?></td>
									<td><?php echo $row['nfact']?></td>
									<td><?php echo number_format($row['ttc'],0,'', ' ');?></td>
									<td><?php echo number_format($row['mtrg'],0,'', ' ');?></td>
									<td><?php echo number_format($row['solde'],0,'', ' ');?></td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
   			</div>
		</div>
	</div>
</div>