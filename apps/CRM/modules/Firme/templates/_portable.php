<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable_portable = new jqueryTable();
	    oTable_portable.addOption({
	    	'sDom' : 'lrt',
		});
		var table = $('.display').DataTable();
		$(document).on( 'click', 'tr', function () {
	 		table.$('tr.row_selected').removeClass('row_selected');
	 		$(this).addClass('row_selected');
	    } );
	    oTable_portable.create($('#tableau_portable')); 
	    <?php if($modif) { ?>  
	          oTable_portable.setActionAdd({'url'  :  "<?php echo url_for('ConsulterFirme',array('act'=>'addPortable','code_firme'=>$code_firme)) ?>", 'method'  :  "post", "id_form" :  "addform_portable"});
	          oTable_portable.setColumn(2,{name: 'lien_portable[portable]',type:'tel'});
	          oTable_portable.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updatePortable",'code_firme'=>$code_firme)); ?>"});
	          oTable_portable.setActionDelete({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"delete_lien",'code_firme'=>$code_firme, 'table_lien' => 'lien_portable', 'col' => 'portable')); ?>"});
			     
	    <?php } ?>
	    oTable_portable.isEditable();
	    oTable_portable.generate();
	  });

	  $( function() {
			$('#sortable4').sortable({
				placeholder: "ui-state-highlight",
				helper:'clone',
				update: function (event, ui) {
			        var data = $(this).sortable('serialize');
			        // POST to server using $.post or $.ajax
			        $.ajax({
			            data: data+'&table=lien_portable',
			            type: 'POST',
			            url: '<?php echo url_for('UpdateOrdreChamp') ?>'
			        });
			    }
			});

	  } );
</script>
<?php if($modif) { ?>
<div id="addform_portable">
    <form action="">
		<div class="panel-body">
		      <div class="row">			
				<div class="col-md-4">
					<input type="tel" placeholder="Portable" class="form-control phone" <?php echo $formLien_portable["portable"]; ?>>
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

	<table id="tableau_portable" class="display table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th>Portable</th>
			</tr>
		</thead>
		<tbody id="sortable4">
			<?php foreach ($lien_portable as $data) : ?>
				
				<tr class="ui-state-default" id="div_sort_<?php echo $data["id"]; ?>" >
					<td></td>
					<td><?php echo $data['portable'] ?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

</div>