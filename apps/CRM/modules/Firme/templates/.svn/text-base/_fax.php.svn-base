<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable_fax = new jqueryTable();
	    oTable_fax.addOption({
	    	'sDom' : 'lrt',
		});
		var table = $('.display').DataTable();
		$(document).on( 'click', 'tr', function () {
	 		table.$('tr.row_selected').removeClass('row_selected');
	 		$(this).addClass('row_selected');
	    } );
	    oTable_fax.create($('#tableau_fax'));
	    <?php if($modif) { ?>  
	          oTable_fax.setActionAdd({'url'  :  "<?php echo url_for('ConsulterFirme',array('act'=>'addFax','code_firme'=>$code_firme)) ?>", 'method'  :  "post", "id_form" :  "addform_fax"});
	          oTable_fax.setColumn(2,{name: 'lien_fax[fax]',type:'tel'});
	          oTable_fax.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updateFax",'code_firme'=>$code_firme)); ?>"});
	          oTable_fax.setActionDelete({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"delete_lien",'code_firme'=>$code_firme, 'table_lien' => 'lien_fax', 'col' => 'fax')); ?>"});
			     
	    <?php } ?>
	    oTable_fax.isEditable();
	    oTable_fax.generate();
	  });

	  $( function() {
			$('#sortable5').sortable({
				placeholder: "ui-state-highlight",
				helper:'clone',
				update: function (event, ui) {
			        var data = $(this).sortable('serialize');
			        // POST to server using $.post or $.ajax
			        $.ajax({
			            data: data+'&table=lien_fax',
			            type: 'POST',
			            url: '<?php echo url_for('UpdateOrdreChamp') ?>'
			        });
			    }
			});

	  } );
	
</script>
<?php if($modif) { ?>
<div id="addform_fax">
    <form action="">
		<div class="panel-body">
		      <div class="row">			
				<div class="col-md-4">
					<input type="tel" placeholder="Fax" class="form-control phone" <?php echo $formLien_fax["fax"]; ?>>
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
<div class="content panel">

	<table id="tableau_fax" class="display table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th>Fax</th>
			</tr>
		</thead>
		<tbody id="sortable5">
			<?php foreach ($lien_fax as $data) : ?>
				<tr class="ui-state-default" id="div_sort_<?php echo $data["id"]; ?>">
					<td></td>
					<td><?php echo $data['fax'] ?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

</div>