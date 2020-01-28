<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable_telephone = new jqueryTable();
	    oTable_telephone.addOption({
	    	'sDom' : 'lrt',
		});
		var table = $('.display').DataTable();
		$(document).on( 'click', 'tr', function () {
	 		table.$('tr.row_selected').removeClass('row_selected');
	 		$(this).addClass('row_selected');
	    } );
	    $('#button').click( function () {
	        table.row('.selected').remove().draw( false );
	    } );
	    oTable_telephone.create($('#tableau_telephone')); 
	    <?php if($modif) { ?>  
	          oTable_telephone.setActionAdd({'url'  :  "<?php echo url_for('ConsulterFirme',array('act'=>'addTelephone','code_firme'=>$code_firme)) ?>", 'method'  :  "post", "id_form" :  "addform_telephone"});
	          oTable_telephone.setColumn(2,{name: 'lien_telephone[tel]',type:'tel'});
	          oTable_telephone.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updateTelephone",'code_firme'=>$code_firme)); ?>"});
	          oTable_telephone.setActionDelete({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"delete_lien",'code_firme'=>$code_firme, 'table_lien' => 'lien_telephone', 'col' => 'tel')); ?>"});
		      	
	    <?php } ?>
	    oTable_telephone.isEditable();
	    oTable_telephone.generate();
	  });

	  $( function() {
			$('#sortable2').sortable({
				placeholder: "ui-state-highlight",
				helper:'clone',
				update: function (event, ui) {
			        var data = $(this).sortable('serialize');
			        // POST to server using $.post or $.ajax
			        $.ajax({
			            data: data+'&table=lien_telephone',
			            type: 'POST',
			            url: '<?php echo url_for('UpdateOrdreChamp') ?>'
			        });
			    }
			});

	  } );
</script>
<?php if($modif) { ?>
<div id="addform_telephone">
    <form action="">
		<div class="panel-body">
		      <div class="row">			
				<div class="col-md-4">
					<input type="tel" placeholder="Telephone" class="form-control phone" <?php echo $formLien_telephone["tel"]; ?>>
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

	<table id="tableau_telephone" class="display table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th>Telephone</th>
			</tr>
		</thead>
		<tbody id="sortable2">
			<?php foreach ($lien_telephone as $data) : ?>
				
				<tr class="ui-state-default" id="div_sort_<?php echo $data["id"]; ?>">
					<td></td>
					<td><?php echo $data['tel'] ?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

</div>