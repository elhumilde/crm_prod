<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var produits_kompass = new jqueryTable();
	    var table = $('.display').DataTable();
	    $(document).on( 'click', 'tr', function () {
	 		table.$('tr.row_selected').removeClass('row_selected');
	 		$(this).addClass('row_selected');
	    } );
	    produits_kompass.create($('#tableau_produit')); 
	    <?php if($modif) { ?>    
	    produits_kompass.setActionAdd({'url'  :  "<?php echo url_for('ConsulterFirme',array('act'=>'addProduit','code_firme'=>$code_firme)) ?>", 'method'  :  "post", "id_form" :  "addform_produit"});
	    produits_kompass.setColumn(4,{name: 'lien_produits_kompass[fda]',type: 'select',cssclass:'select', data: " {'F':'fabriquant','D':'distributeur','A':'agent'}"});
	    //produits_kompass.setColumn(1,{name: 'lien_produits_kompass[code_produit]',type: 'select',cssclass:'itemName select', data:''});
	    produits_kompass.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updateProduit",'code_firme'=>$code_firme)); ?>"});
	    produits_kompass.setActionDelete({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"delete_lien",'code_firme'=>$code_firme, 'table_lien' => 'lien_produits_kompass', 'col' => 'code_produit')); ?>"});
      	
	    <?php } ?>
	    produits_kompass.isEditable();
	    produits_kompass.generate();
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
<?php if($modif) { ?>  
<div id="addform_produit">
    <form action="">
		<div class="panel-body">
			<div class="row">			
				
				<div class="col-md-2">Libellé:</div> 
				<div class="col-md-4">
					<select class="itemName-produit form-control select" <?php echo $formLien_produit["code_produit"]; ?>>
					  <?php if($oFormLien_produit->getData('code_produit')):?> 
					      <option value="<?php echo $oFormLien_produit->getData('code_produit')?>"><?php echo $produit ?></option>
					  <?php endif;?>
					</select>
				</div>
				<div class="col-md-2">Export:</div> 
				<div class="col-md-4">
					<select class="form-control select" <?php echo $formLien_produit["export"]; ?>>
					  <option value="">Non</option>
					  <option value="E">Oui</option>
					</select>
				</div>
				<div class="col-md-2">Import:</div> 
				<div class="col-md-4">
					<select class="form-control select" <?php echo $formLien_produit["import"]; ?>>
					  <option value="">Non</option>
					  <option value="I">Oui</option>
					</select>
				</div>
				<div class="col-md-2">fda:</div> 
				<div class="col-md-4">
					<select class="form-control select" <?php echo $formLien_produit["fda"]; ?>>
                    	<option value=""></option>
                    	<option value="F">fabriquant</option>
                    	<option value="D">distributeur</option>
                    	<option value="A">agent</option>
                    </select>
				</div>
				<div class="col-md-6">
    				<div class="text-left">
        				<button type="submit" class="btn btn-primary">
        					Enregistrer <i class="icon-arrow-right14 position-right"></i>
        				</button>
        				<button type="reset" class="btn btn-danger">
							Vider <i class="icon-arrow-right14 position-right"></i>
						</button>
        			</div>
    			</div>
			</div>

		</div>
	</form>
</div>
<?php } ?>
<h5>Produit kompass</h5>
<div class="content panel">

	<table id="tableau_produit" class="display table table-striped table-hover">
		<thead>
			<tr>
				<th>libellé</th>
				<th>Export</th>
				<th>Import</th>
				<th>fda</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($lien_produit as $data) : ?>
				<tr id="<?php echo $data["id"]; ?>">
					<td><?php echo $data['lib_produit']?></td>
					<td><?php echo $data['export']?></td>
					<td><?php echo $data['import']?></td>
					<td><?php echo $data['fda']?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

</div>

<div class="content panel">

	<table class="display table table-striped table-hover">
		<thead>
			<tr>
				<th>Pays d'export</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($pays_export as $data) : ?>
				<tr id="<?php echo $data["id"]; ?>">
					<td><?php echo $data['pays']?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

</div>