<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('.display'));   
	    oTable2.generate();
	    $('.itemName').select2({
	        placeholder: 'Select an item',
	        ajax: {
	          url: "<?php echo url_for('Common/AutoComplete') ?>",
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
      <li class="active">Réclamation</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Recherche des Réclamations</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
    		<form method="post">
    				<!--  DESIGNATION -->
                <div class="row">
    					<label class="col-md-1" for="selectError">Firme</label>
    					<div class="col-md-3">
    					   
        					<select class="itemName form-control select" <?php echo $filter["code_firme"]; ?>>
        					
            					  <?php if($oFilter->getData('code_firme')):?> 
            					      <option value="<?php echo $oFilter->getData('code_firme')?>"><?php echo $firme?></option>
            					  <?php endif;?>
        					</select>
    					</div>
    
    
    					<label class="col-md-1 col-md-offset-1" for="focusedInputdes">Date
    					 Entre</label>
    					<div class="col-md-2">
                            <div class="input-group" style="float:left">
                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus"<?php echo $filter["date_from"]?>>                             
                            </div>

    					</div>
    					<label class="col-md-1 text-center" for="focusedInputdes">et </label>
    					<div class="col-md-2">
                            <div class="input-group" style="float:left">
                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus"<?php echo $filter["date_to"]?>>                             
                            </div>

    					</div>
                </div>
                <div class="row">
                    <label class="col-md-1" for="selectError">service affect&eacute;</label>
					<div class="col-md-3">
						<?php echo TTSList::getListBox(array(
								"query" => "select * from par_tts_service",
								"form" => $filter,
								"oForm" => $oFilter,
								"value" => "id",
								"libel" => "libelle",
								"key" => "id_service",
								"db" => "crm",
								"class"=>"select"
                          )); ?>
					</div>
    					<label class="col-md-1 col-md-offset-1" for="focusedInputdes">Cloturée</label>
    					<div class="col-md-2">
    						<?php echo TTSList::getListBox(array(
    								"query" => "#:boolData#",
    								"form" => $filter,
    								"oForm" => $oFilter,
    								"key" => "is_resoluee",
                                    "class" => "select"
                          )); ?>
    					</div>
                </div>
                    <div class="row">
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" value="Rechercher" >
                        </div>
                        <div class="col-md-2 col-md-offset-7">
                            <a href="<?php echo  url_for("AjouterReclamation");?>">
                                <button type="button" class="btn btn-default">
                                  <i class="icon-add position-left"></i> 
                                  Ajouter Réclamation
                                </button>
                            </a>
                        </div>

                    </div>
    		</form>
    	<div class="row">
    	   <table class="display table table-striped table-hover">
				<thead>
					<tr>
						<th>Code</th>
						<th>Date réclamation</th>
						<th >Gravité</th>
						<th >Entreprise</th>
						<th >Contact entreprise</th>
						<th>Service</th>
						<th >Objet</th>
						<th >Clôturée</th>
						<th >Date de clôture</th>
					</tr>
				</thead>
				<tbody>

				<?php foreach ($data as $row):?>
					<tr style="cursor: pointer; cursor: hand;"
						onClick="document.location='<?php echo url_for("AjouterReclamation",array("id"=>$row['id'])); ?>'">
						<td><?php echo $row["code"]; ?></td>
						<td><?php echo $row["date_reclamation"]? date("Y/m/d", strtotime($row["date_reclamation"])) :''; ?>
						</td>
						<td><?php echo $row["libelle"]; ?></td>
						<td><?php echo $row["firme"]; ?></td>
						<td><?php echo $row["contact"]; ?></td>
						<td><?php echo $row["service"]; ?></td>
						<td><?php echo $row["objet"]; ?></td>
						<td><?php echo $row["is_resolue"] ? 'Oui' : 'Non'; ?></td>
						<td><?php echo $row["date_resolution"] ? date("Y/m/d", strtotime($row["date_resolution"])) :''; ?>
						</td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
    	</div>
	</div>
</div>

