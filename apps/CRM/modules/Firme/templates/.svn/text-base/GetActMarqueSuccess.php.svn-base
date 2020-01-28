
<?php if ($_POST): ?>
<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var act_marques = new jqueryTable();
	     act_marques.create($('#tableau_act_marque')); 

	    act_marques.setActionAdd({'url'  :  "<?php echo url_for('ConsulterFirme',array('act'=>'addActMarque','code_firme'=>$info_marque['code_firme'],'code_marque'=>$info_marque['code_marque'])) ?>", 'method'  :  "post", "id_form" :  "addform_act_marque"});
	    act_marques.setColumn(3,{name: 'act_marque[exportateur]'});
	    act_marques.setColumn(4,{name: 'act_marque[importateur]'});
	    act_marques.setColumn(5,{name: 'act_marque[fda]',type: 'select',cssclass:'select', data: " {'F':'fabriquant','D':'distributeur','A':'agent'}"});
	    act_marques.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updateActMarque",'code_firme'=>$info_marque['code_firme'])); ?>"});
	    
	    act_marques.setActionDelete({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"delete_lien",'code_firme'=>$info_marque['code_firme'], 'table_lien' => 'act_marque', 'col' => 'id')); ?>"});
	      
	    act_marques.isEditable();
	    act_marques.generate();
	    $('.itemName-produit').select2({
	        placeholder: 'Select an item',
	        ajax: {
	          url: "<?php echo url_for('Common/AutoCompleteProduit') ?>",
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
<div id="addform_act_marque">
    <form action="">
		<div class="panel-body">
			<div class="row">	
					<div class="col-md-2">Exportateur:</div> 
					<div class="col-md-4">
						<input type="text" class="form-control" <?php echo $formActMarque["exportateur"]; ?>>
					</div>	
					<div class="col-md-2">Importateur:</div> 
					<div class="col-md-4">
						<input type="text" class="form-control" <?php echo $formActMarque["importateur"]; ?>>
					</div>
					<div class="col-md-2">produit:</div> 
					<div class="col-md-4">
						<select class="itemName-produit form-control select" <?php echo $formActMarque["code_produit"]; ?>>
						  <?php if($oFormActMarque->getData('code_produit')):?> 
						      <option value="<?php echo $oFormLien_rubrique->getData('code_produit')?>"><?php echo $produit ?></option>
						  <?php endif;?>
						</select>
					</div>
					<div class="col-md-2">fda:</div> 
					<div class="col-md-4">
					    <select class="form-control" <?php echo $formActMarque["fda"]; ?>>
	                    	<option value=""></option>
	                    	<option value="F">fabriquant</option>
	                    	<option value="D">distributeur</option>
	                    	<option value="A">agent</option>
	                    </select>

					</div>
			</div>
				<div class="row">
    				<div class="text-left">
						<button type="submit" class="btn btn-primary">
							Enregistrer <i class="icon-arrow-right14 position-right"></i>
						</button>
					</div>
    			</div>

		</div>
	</form>
</div>

<div class="content panel">
	<table id="tableau_act_marque" class="table table-hover table-striped" >

		<thead>
			<tr>
				<th>Marque</th>
				<th>Produit</th>
				<th>Exportateur</th>
				<th>Importateur</th>
				<th>Fda</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($act_marque as $row): ?>
				<tr id="<?php echo $row["id"]; ?>" >
					<td><?php echo $row['nom_marque'] ?></td>
					<td><?php echo $row['lib_produit'] ?></td>
					<td><?php echo $row['exportateur'] ?></td>
					<td><?php echo $row['importateur'] ?></td>
					<td><?php echo $row['fda'] ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>

	</table>
</div>
<?php endif ?>