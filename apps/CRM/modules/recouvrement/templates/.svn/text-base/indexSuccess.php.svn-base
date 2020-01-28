<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('.display'));   
	    oTable2.generate();
	    $('.itemName').select2({
	        placeholder: 'Select an item',
	        ajax: {
	          url: "<?php echo url_for('Common/AutoComplete2') ?>",
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
      <li class="active">Encaissement</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Recherche des encaissement</h5>
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
					<label class="col-md-1 text-right" for="selectError">Ville</label>
					<div class="col-md-3">
						<?php echo TTSList::getListBox(array(
										"query" => "select distinct code,ville from villes order by ville ",
										"form" => $filter,
										"oForm" => $oFilter,
										"value" => "code",
										"libel" => "ville",
										"key" => "code_ville",
										"db" => "bd_web",
										"class" => "select"
									)); ?>
					</div>
					
					
				</div>
				<div class="row">					
					<?php if($sf_user->hasCredential('allencaissement')): ?>
					<label class="col-md-1 text-right" for="selectError">Agent</label>
					<div class="col-md-3">
						<?php echo TTSList::getListBox(array(
										"query" => "select ifnull(code_commercial,'NA') as code_commercial, concat(prenom,' ',nom) as login
										 from $db_name.tts_utilisateur u 
										inner join encaissement e on  u.code_commercial=e.CODE_TELEACTEUR 
										where u.actif = 1 group by  code_commercial , prenom , nom, CODE_TELEACTEUR  ",
										"form" => $filter,
										"oForm" => $oFilter,
										"value" => "code_commercial",
										"libel" => "login",
										"key" => "code_teleacteur",
										"db" => "bd_web",
										"class" => "select"
									)); ?>
					</div>
					<?php endif;?>
					<label class="col-md-1 text-right" for="selectError">Support</label>
					<div class="col-md-3">
						<?php echo TTSList::getListBox(array(
										"query" => "select distinct code, support from  support order by support",
										"form" => $filter,
										"oForm" => $oFilter,
										"value" => "code",
										"libel" => "support",
										"key" => "tedi",
										"db" => "bd_web",
										"class" => "select"
									)); ?>
					</div>
				
				
					<label class="col-md-1 text-right" for="selectError">Edition</label>
					<div class="col-md-3">
						<input type="text" class="form-control"<?php echo $filter["nedi"]?>>                             
					</div>
				</div>
				<div class="row">	
					<label class="col-md-1 text-right" for="focusedInputdes">Fact. Entre</label>
					<div class="col-md-3">
                        <div class="input-group" style="float:left">
                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                            <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus"<?php echo $filter["date_from"]?>>                             
                        </div>

					</div>
					<label class="col-md-1 text-right" for="focusedInputdes">Et </label>
					<div class="col-md-3">
                        <div class="input-group" style="float:left">
                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                            <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus"<?php echo $filter["date_to"]?>>                             
                        </div>

					</div>
					<label class="col-md-1 text-right" for="selectError">Secteur</label>
					<div class="col-md-3">
						<input type="text" class="form-control"<?php echo $filter["zone_geo"]?>>   
					</div>
                </div>
                <div class="row">
                	<label class="col-md-1 text-right" for="selectError">Quartier</label>
					<div class="col-md-3">
						<?php echo TTSList::getListBox(array(
							"query" => "select distinct code,quartier from quartiers order by quartier ",
							"form" => $filter,
							"oForm" => $oFilter,
							"value" => "code",
							"libel" => "quartier",
							"key" => "code_quartier",
							"db" => "bd_web",
							"class" => "select"
						)); ?>
					</div>
					<label class="col-md-1 text-right" for="selectError">Commercial</label>
					<div class="col-md-3">
						<?php echo TTSList::getListBox(array(
										"query" => "select id as id_commercial, concat(prenom,' ',nom) as login
										 from $db_name.tts_utilisateur u 
										where u.actif = 1   ",
										"form" => $filter,
										"oForm" => $oFilter,
										"value" => "id_commercial",
										"libel" => "login",
										"key" => "id_commercial",
										"db" => "bd_web",
										"class" => "select"
									)); ?>
					</div>
                </div>
                    <div class="row">
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" value="Rechercher" >
                        </div>

                    </div>
    		</form>
    	<div class="row">
    	   <table class="display table table-striped table-hover">
				<thead>
					<tr>
						<th>Firme</th>
						<th>Rs Abr</th>
						<th>Agent</th>
						<th>Societe</th>
						<th>Support</th>
						<th>BC</th>
						<th>Edition</th>
						<th>Date Creation</th>
						<!--  <th>Num Facture</th>
						<th>Date Facture</th> -->
						<th>TTC</th>
						<th>Reste</th>
						<th>Type</th>
						<th>nbr appel</th>
						<th>nbr visite</th>
					</tr>
				</thead>
				<tbody>

				<?php foreach ($data as $row):?>
					<tr style="cursor: pointer; cursor: hand;<?php if($row["cloture_imp"]!=0) echo 'background-color:#f9b7b7'; ?>"
						onclick='window.open("<?php echo url_for('ConsulterRecouvrement',array('id'=>$row['id'])); ?>", "_blank");'>
						<td><?php echo $row["rs_comp"]; ?></td>
						<td><?php echo $row["rs_abr"]; ?></td>
						<td><?php echo $row["agent"]; ?></td>
						<td><?php echo $row["societe"]; ?></td>
						<td><?php echo $row["support"]; ?></td>
						<td><?php echo $row["num_bc"]; ?></td>
						<td><?php echo $row["nedi"]; ?></td>
						<td><?php echo $row["datecr"]; ?></td>
						<!--  <td><?php echo $row["nfact"]; ?></td> 
						<td><?php echo $row["date_facture"]; ?></td>-->
						<td><?php echo $row["ttc"]; ?></td>
						<td><?php echo $row["solde"];; ?> </td>
						<td><?php if($row["cloture_imp"]!=0) echo "Impayé"; else echo $row["type"]; ?> </td>
						<td><?php echo $row["nbr_appel"];; ?> </td>
						<td><?php echo $row["nbr_visite"];; ?> </td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
    	</div>
	</div>
</div>

