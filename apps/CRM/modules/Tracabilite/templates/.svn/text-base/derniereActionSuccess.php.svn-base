<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('#tableau2'));   
	    oTable2.generate();
	  });
</script>
<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li><a href="#">Tracabilité</a></li>
      <li class="active">Dernière activité</li>
    </ul>
  </div>
</div>
<!-- /page header -->
	<!-- Content area -->
	<div class="content">
		
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Date et heure dernière activité par utilisateur</h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
					</ul>
				</div>
			</div>

			<div class="panel row">
    			<table id="tableau2" class="display table table-striped table-hover">
    				<thead>
    					<tr>
    						<th>Utilisateur</th>
    						<th>Code</th>
    						<th>Operation</th>
    						<th>Module</th>
    						<th>Date & heure</th>
    						<th>Adresse ip</th>
    					</tr>
    				</thead>
    				<tbody>
    
    					<?php foreach ($datas as $data):?>
    					<tr>
    						<td><?php echo $data['fullname']?></td>
    						<td><?php echo $data['code']?></td>
    						<td><?php echo $data['operation']?></td>
    						<td><?php echo $data['module']?></td>
    						<td><?php echo $data['date']." ".$data['heure'] ?></td>
    						<td><?php echo $data['adresse_ip']?></td>
    					</tr>
    					<?php endforeach;?>
    				</tbody>
    			</table>
			</div>
		</div>

	</div>
	<!-- /content area -->



	
	