<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable_rubrique = new jqueryTable();
	    var table = $('.display').DataTable();
	    $(document).on( 'click', 'tr', function () {
	 		table.$('tr.row_selected').removeClass('row_selected');
	 		$(this).addClass('row_selected');
	    } );
	    oTable_rubrique.create($('#tableau_rubrique')); 
	    <?php if($modif) { ?>  
	          oTable_rubrique.setActionAdd({'url'  :  "<?php echo url_for('ConsulterFirme',array('act'=>'addRubrique','code_firme'=>$code_firme)) ?>", 'method'  :  "post", "id_form" :  "addform_rubrique"});
	          oTable_rubrique.setColumn(2,{name: 'lien_rubrique_telecontact[editable]',type: 'select',cssclass:'select', data: " {'+':'+','-':'-'}"});
	          oTable_rubrique.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updateRubrique",'code_firme'=>$code_firme)); ?>"});
	          
	          oTable_rubrique.setActionDelete({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"delete_lien",'code_firme'=>$code_firme, 'table_lien' => 'lien_rubrique_telecontact', 'col' => 'code_Rubrique')); ?>"});
	        	
	          //oTable_rubrique.setColumn(1,{name: 'lien_rubrique_telecontact[code_rubrique]',type: 'select',cssclass:'new-test', data: "{'':''}"});
	          //oTable_rubrique.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updateRubrique")); ?>"});
	    <?php } ?>

	    oTable_rubrique.isEditable();
	    oTable_rubrique.generate();


	    $('.itemName-rubrique').select2({
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
<div id="addform_rubrique">
    <form action="">
		<div class="panel-body">
		      <div class="row">			
				<div class="col-md-2">Libellé:</div> 
				<div class="col-md-4">
					<select class="itemName-rubrique form-control select" <?php echo $formLien_rubrique["code_rubrique"]; ?>>
					  <?php if($oFormLien_rubrique->getData('code_rubrique')):?> 
					      <option value="<?php echo $oFormLien_rubrique->getData('code_rubrique')?>"><?php echo $rubrique ?></option>
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
<h5>Rubrique télécontact</h5>
<div class="content panel">

	<table id="tableau_rubrique" class="display table table-striped table-hover">
		<thead>
			<tr>
				<th>Libellé</th>
				<th>Editable</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($lien_rubrique as $data) : ?>
				<tr id="<?php echo $data["id"]; ?>">
					<td><?php echo $data['Lib_Rubrique'] ?></td>
				    <td><?php echo $data['editable'] ?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

</div>