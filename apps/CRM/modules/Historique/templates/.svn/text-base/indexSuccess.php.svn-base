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
      <li><a href="#">Historique</a></li>
      <li class="active">Firmes</li>
    </ul>
  </div>
</div>
<!-- /page header -->
	<!-- Content area -->
	<div class="content">
		
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Historique modification des firmes</h5>
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
						<?php if($sf_user->hasCredential('allfirme')): ?>
							<label class="col-md-1">utilisateur :</label>
							<div class="col-md-2">
								<?php echo TTSList::getListBox(array(
										"query" => "select id, concat(prenom,' ',nom) as login from tts_utilisateur where actif = 1 ",
										"form" => $filter,
										"oForm" => $oFilter,
										"value" => "id",
										"libel" => "login",
										"key" => "id_user",
										"db" => "crm",
										"class" => "select"
									)); ?>
							</div>
						<?php endif; ?>
						
						<label class="col-md-1 col-md-offset-1">Date :</label>
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
						<label class="col-md-1">Firmes :</label>
							<div class="col-md-2">
								<input type="text" class="form-control" <?php echo $filter["firme"]; ?>>
							</div>
						<label class="col-md-1 col-md-offset-1">Code Firme</label>
							<div class="col-md-2">
								<input type="text" class="form-control" <?php echo $filter["code_firme"]; ?>>
							</div>
							
							
						<label class="col-md-1 col-md-offset-1">Service :</label>
    					<div class="col-md-2">
    						<?php echo TTSList::getListBox(array(
    								"query" => "select id, libelle from par_tts_service",
    								"form" => $filter,
    								"oForm" => $oFilter,
    								"value" => "id",
    								"libel" => "libelle",
    								"key" => "id_service",
    								"db" => "crm",
    								"class"=>"select"
                              )); ?>
    					</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<input type="submit" class="btn btn-primary" value="Rechercher" >
						</div>
					</div>
			</form>
			<table id="tableau2" class="display table table-striped table-hover">
				<thead>
					<tr>
						<?php if($sf_user->hasCredential('allfirme')):?>
							<th>utilisateur</th>
						<?php endif;?>
						<th>Code firme</th>
						<th>Firme</th>
						<th>Type</th>
						<th>Champ</th>
						<th>Ancienne valeur</th>
						<th>Nouvelle valeur</th>
						<th>date</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($datas as $data):?>
					<tr 
						onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data['id_firme'])) ?>')"
						 style="cursor: pointer;">
						<?php if($sf_user->hasCredential('allfirme')):?>
							<td><?php echo $data['fullname']?></td>
						<?php endif;?>
						<td><?php echo $data['code_firme']?></td>
						<td><?php echo $data['firme']?></td>
						<td><?php echo $data['type_modification']?></td>
						<td><?php echo $data['champ']?></td>
						<td><?php echo $data['old_value']?></td>
						<td><?php echo $data['new_value']?></td>
						<td><?php echo $data['date_modification']?></td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>

	</div>
	<!-- /content area -->



	
	