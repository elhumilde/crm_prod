<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable_rubrique_internet = new jqueryTable();
	    var table = $('.display').DataTable();
	    $(document).on( 'click', 'tr', function () {
	 		table.$('tr.row_selected').removeClass('row_selected');
	 		$(this).addClass('row_selected');
	    } );
	    oTable_rubrique_internet.create($('#tableau_rubrique_internet')); 
	    <?php if($modif) { ?>  
	          oTable_rubrique_internet.setActionAdd({'url'  :  "<?php echo url_for('ConsulterFirme',array('act'=>'addRubrique_internet','code_firme'=>$code_firme)) ?>", 'method'  :  "post", "id_form" :  "addform_rubrique_internet"});
	          oTable_rubrique_internet.setColumn(2,{name: 'lien_rubrique_internet[editable]',type: 'select',cssclass:'select', data: " {'+':'+','-':'-'}"});
	          oTable_rubrique_internet.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updateRubrique_internet",'code_firme'=>$code_firme)); ?>"});
	          
	          oTable_rubrique_internet.setActionDelete({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"delete_lien",'code_firme'=>$code_firme, 'table_lien' => 'lien_rubrique_internet', 'col' => 'code_rubrique')); ?>"});
	        	
	          //oTable_rubrique_internet.setColumn(1,{name: 'lien_rubrique_internet_telecontact[code_rubrique_internet]',type: 'select',cssclass:'new-test', data: "{'':''}"});
	          //oTable_rubrique_internet.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updateRubrique_internet")); ?>"});
	    <?php } ?>

	    oTable_rubrique_internet.isEditable();
	    oTable_rubrique_internet.generate();


	    $('.itemName-rubrique_internet').select2({
	        placeholder: 'Select an item',
	        ajax: {
	          url: "<?php echo url_for('Common/AutoCompleteRubrique') ?>",
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
<div id="addform_rubrique_internet">
    <form action="">
		<div class="panel-body">
		      <div class="row">			
				<div class="col-md-2">Libellé:</div> 
				<div class="col-md-4">
					<select class="itemName-rubrique form-control select" <?php echo $formLien_rubrique_internet["code_rubrique"]; ?>>
					  <?php if($oFormLien_rubrique_internet->getData('code_rubrique')):?> 
					      <option value="<?php echo $oFormLien_rubrique_internet->getData('code_rubrique')?>"><?php echo $rubrique_internet ?></option>
					  <?php endif;?>
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
<h5>Rubrique internet</h5>
<div class="content panel">

	<table id="tableau_rubrique_internet" class="display table table-striped table-hover">
		<thead>
			<tr>
				<th>Libellé</th>
				<th>Editable</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($lien_rubrique_internet as $data) : ?>
				<tr id="<?php echo $data["id"]; ?>">
					<td><?php echo $data['Lib_Rubrique'] ?></td>
				    <td><?php echo $data['editable'] ?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

</div>