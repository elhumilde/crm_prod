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
      <li class="active">détails des consultations</li>
    </ul>
  </div>
</div>
<!-- /page header -->
	<!-- Content area -->
	<div class="content">
		
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">détails des consultation</h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
					</ul>
				</div>
			</div>
	        <form method="post">
					<div class="row">
							<label class="col-md-1">utilisateur :</label>
							<div class="col-md-2">
								<?php echo TTSList::getListBox(array(
										"query" => "select id,concat(prenom, ' ',nom) as login from tts_utilisateur where actif = 1 ",
										"form" => $filter,
										"oForm" => $oFilter,
										"value" => "id",
										"libel" => "login",
										"key" => "id_utilisateur",
										"db" => "crm",
										"class" => "select"
									)); ?>
							</div>
					       <label class="col-md-1 col-md-offset-1">Operation :</label>
							<div class="col-md-2">
								<input type="text" class="form-control" <?php echo $filter["operation"]; ?>>
							</div>
							<label class="col-md-1 col-md-offset-1">Module :</label>
							<div class="col-md-2">
								<input type="text" class="form-control" <?php echo $filter["module"]; ?>>
							</div>
					</div>
					<div class="row">
                        <label class="col-md-1">Date :</label>
						<div class="col-md-2">
							<div class="input-group" style="float:left">
						        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
						        <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus" <?php echo $filter["date_from"]; ?>>   						    
						    </div>
						</div>
						<label class="col-md-1 col-md-offset-1">Au :</label>
						<div class="col-md-2">
							<div class="input-group" style="float:left">
						        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
						        <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus" <?php echo $filter["date_to"]; ?>>   						    
						    </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-right">
							<input type="submit" class="btn btn-primary" value="Rechercher" >
						</div>
					</div>
			</form>
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



	
	