<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('#tableau2'));  
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
      <li class="active">Televente</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Recherche des firmes</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
    		<form method="post">
    				<!--  DESIGNATION -->
                <div class="row">
                	<label class="col-md-1 text-right" for="selectError">Firme</label>
					<div class="col-md-3">
					   
    					<select class="itemName form-control select" <?php echo $filter["code_firme"]; ?>>
        					  <?php if($oFilter->getData('code_firme')):?> 
        					      <option value="<?php echo $oFilter->getData('code_firme')?>"><?php echo $firme?></option>
        					  <?php endif;?>
    					</select>
					</div>
					<label class="col-md-1 text-right" for="selectError">Code firme</label>
					<div class="col-md-3">
						<input type="text" class="form-control"<?php echo $filter["code_firme2"]?>>   
					</div>
                	<label class="col-md-1 text-right" for="selectError">Résultat</label>
					<div class="col-md-3">
						<?php echo TTSList::getListBox(array(
							"query" => "select distinct code,libelle from resultat_televentes order by code ",
							"form" => $filter,
							"oForm" => $oFilter,
							"value" => "code",
							"libel" => "libelle",
							"key" => "resultat_televente",
							"db" => "bd_web",
							"class" => "select"
						)); ?>
					</div>
					<label class="col-md-1 text-right" for="selectError">Télévendeur</label>
					<div class="col-md-3">
						<?php echo TTSList::getListBox(array(
							"query" => "select code_commercial, concat(prenom,' ',nom) as login from tts_utilisateur where actif = 1  and id_service in (3, 11) ",
							"form" => $filter,
							"oForm" => $oFilter,
							"value" => "code_commercial",
							"libel" => "login",
							"key" => "code_commercial",
							"db" => "crm",
							"class" => "select"
						)); ?>
					</div>
					<label class="col-md-1 text-right" for="selectError">Activité</label>
					<div class="col-md-3">
						<input type="text" class="form-control"<?php echo $filter["tp_40"]?>>   
					</div>
                </div>
                    <div class="row">
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" value="Rechercher" >
                        </div>

                    </div>
    		</form>
    	<div class="row">
    	   <table  id="tableau2" class="display table table-striped table-hover">
				<thead>
					<tr>
						<th class="essential persist">Firme</th>
						<th class="essential persist">Commercial</th>
						<th class="optional">Nb Appel</th>
                        <th class="optional">Prochain Appel</th>
						<th class="optional">Dernier Appel</th>
						<th class="optional">Dernier Resultat</th>

						<th class="essential persist" >Activit&eacute;</th>
					</tr>
				</thead>
				<tbody>

				<?php foreach ($data as $row):?>
					<tr style="cursor: pointer; cursor: hand;"
						ondblclick='window.open("<?php echo url_for('ConsulterFirme',array('id'=>$row['id'],'num_compagne'=>$row['num_compagne'])); ?>", "_blank");'>
						<td><?php echo $row["rs_comp"]; ?></td>
						<td><?php echo $row["commercial"]; ?></td>
						<td><?php echo $row["nb_appel"]; ?></td>
                        <td><?php echo $row["date_rappel"]; ?></td>
						<td><?php echo $row["date_appel"]; ?></td>
						<td><?php echo $row["res"]; ?>          </td>

						<td><?php echo $row["tp_40"]; ?></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
    	</div>
	</div>
</div>

