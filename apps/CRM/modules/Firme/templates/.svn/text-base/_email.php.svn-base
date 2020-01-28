<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable_email = new jqueryTable();
	    oTable_email.addOption({
			 'sDom' : 'lrt',
		});
		var table = $('.display').DataTable();
		$(document).on( 'click', 'tr', function () {
	 		table.$('tr.row_selected').removeClass('row_selected');
	 		$(this).addClass('row_selected');
	    } );
	    oTable_email.create($('#tableau_email')); 
	    <?php if($modif) { ?>  
	          oTable_email.setActionAdd({'url'  :  "<?php echo url_for('ConsulterFirme',array('act'=>'addEmail','code_firme'=>$code_firme)) ?>", 'method'  :  "post", "id_form" :  "addform_email"});
	          oTable_email.setColumn(2,{name: 'lien_email[email]'});
	          oTable_email.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updateEmail",'code_firme'=>$code_firme)); ?>"});
	          oTable_email.setActionDelete({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"delete_lien",'code_firme'=>$code_firme, 'table_lien' => 'lien_email', 'col' => 'email')); ?>"});
	      	
	    <?php } ?>
	    oTable_email.isEditable();
	    oTable_email.generate();
	  });
	  $( function() {
			$('#sortable1').sortable({
				placeholder: "ui-state-highlight",
				helper:'clone',
				update: function (event, ui) {
			        var data = $(this).sortable('serialize');
			        // POST to server using $.post or $.ajax
			        $.ajax({
			            data: data+'&table=lien_email',
			            type: 'POST',
			            url: '<?php echo url_for('UpdateOrdreChamp') ?>'
			        });
			    }
			});

	  } );
	  
</script>
<?php if($modif) { ?>
<div id="addform_email">
    <form action="" id="form_email">
		<div class="panel-body">
		      <div class="row">			
				<div class="col-md-4">
					Email <input type="email" placeholder="Email" class="form-control" <?php echo $formLien_email["email"]; ?>>
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

	<table id="tableau_email" class="display table table-striped table-hover">
		<thead>
			<tr>
				<th></th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody id="sortable1">
			<?php foreach ($lien_email as $data) : ?>
			
				<tr class="ui-state-default" id="div_sort_<?php echo $data["id"]; ?>">
					<td></td>
					<td><?php echo $data['email'] ?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

</div>