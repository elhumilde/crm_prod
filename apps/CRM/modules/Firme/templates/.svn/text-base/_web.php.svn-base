<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable_web = new jqueryTable();
	    oTable_web.addOption({
	    	'sDom' : 'lrt',
		});
		var table = $('.display').DataTable();
		$(document).on( 'click', 'tr', function () {
	 		table.$('tr.row_selected').removeClass('row_selected');
	 		$(this).addClass('row_selected');
	    } );
	    oTable_web.create($('#tableau_web')); 
	    <?php if($modif) { ?>  
	          oTable_web.setActionAdd({'url'  :  "<?php echo url_for('ConsulterFirme',array('act'=>'addWeb','code_firme'=>$code_firme)) ?>", 'method'  :  "post", "id_form" :  "addform_web"});
	          oTable_web.setColumn(2,{name: 'lien_web[web]'});
	          oTable_web.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updateWeb",'code_firme'=>$code_firme)); ?>"});
	          oTable_web.setActionDelete({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"delete_lien",'code_firme'=>$code_firme, 'table_lien' => 'lien_web', 'col' => 'web')); ?>"});
			     
	    <?php } ?>
	    oTable_web.isEditable();
	    oTable_web.generate();
	  });

	  $( function() {
			$('#sortable3').sortable({
				placeholder: "ui-state-highlight",
				helper:'clone',
				update: function (event, ui) {
			        var data = $(this).sortable('serialize');
			        // POST to server using $.post or $.ajax
			        $.ajax({
			            data: data+'&table=lien_web',
			            type: 'POST',
			            url: '<?php echo url_for('UpdateOrdreChamp') ?>'
			        });
			    }
			});

	  } );
</script>
<?php if($modif) { ?>
<div id="addform_web">
    <form action="" class="form-validate-jquery">
		<div class="panel-body">
		      <div class="row">			
				<div class="col-md-4">
					<input type="text" placeholder="https://site.com/" class="form-control validation_url" <?php echo $formLien_web["web"]; ?>>
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

	<table id="tableau_web" class="display table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th>Web</th>
			</tr>
		</thead>
		<tbody id="sortable3">
			<?php foreach ($lien_web as $data) : ?>
				
				<tr class="ui-state-default" id="div_sort_<?php echo $data["id"]; ?>" >
					<td></td>
					<td><?php echo $data['web'] ?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

</div>