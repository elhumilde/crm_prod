<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var marques_kompass = new jqueryTable();
	    var table = $('.display').DataTable();
	    $(document).on( 'click', 'tr', function () {
	 		table.$('tr.row_selected').removeClass('row_selected');
	 		$(this).addClass('row_selected');
	    } );
	    $(document).on( 'click', '#vider_marque', function () {
            $('#addform_marque #resultat_marque').html(" ");
            $('#addform_marque #nouv-marque').show();
            $('#addform_marque #resultat_marque').hide();
	    } );
	    $(document).on( 'dblclick', '.id_marque', function () {
	 		var parameters = "id_lien_marque="+$(this).attr('id');
	 		$.ajax({
	 			 
                url: '<?php echo url_for('ConsulterFirme',array('act'=>'getActMarque')) ?>',
                type: 'post',
                data: parameters,
                success: function( data ) {
                    if(data){

                        $('#resultat_act_marque').html(data);
                    }
                    else
                    {
                        $('#resultat_act_marque').html('');
                        $('#resultat_act_marque').hide();
                    }
                },
                error: function( msg ) {
                    alert('Erreur Ajax!');
                }
            });
	    } );
	    $(document).on( 'click', '#verifier_marque', function () {
	 		var parameters = "nom_marque="+$('#marque_nom_marque').val();
	 		$.ajax({
	 			 
                url: '<?php echo url_for('ConsulterFirme',array('act'=>'verifiremarque')) ?>',
                type: 'post',
                data: parameters,
                success: function( data ) {
                    if(data){

                        $('#addform_marque #resultat_marque').html(data);
                        $('#addform_marque #nouv-marque').hide();
                        $('#addform_marque #resultat_marque').show();
                    }
                    else
                    {
                        $('#addform_marque #resultat_marque').html('');
                        $('#addform_marque #resultat_marque').hide();
                    }
                },
                error: function( msg ) {
                    alert('Erreur Ajax!');
                }
            });
	    } );
	    marques_kompass.create($('#tableau_marque')); 

	    <?php if($modif) { ?>    
	    marques_kompass.setActionAdd({'url'  :  "<?php echo url_for('ConsulterFirme',array('act'=>'addMarque','code_firme'=>$code_firme)) ?>", 'method'  :  "post", "id_form" :  "addform_marque"});
	    //marques_kompass.setColumn(1,{name: 'lien_marques_kompass[code_marque]',type: 'select',cssclass:'itemName select', data:''});

	    //marques_kompass.setColumn(2,{name: 'lien_marque[code_pays]',type: 'select',cssclass:'select', data: '<?php echo addslashes(json_encode($sf_data->getRaw('pays'))); ?>'});
	    marques_kompass.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updateMarque",'code_firme'=>$code_firme)); ?>"});
	    
	    marques_kompass.setActionDelete({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"delete_lien",'code_firme'=>$code_firme, 'table_lien' => 'lien_marque', 'col' => 'code_marque')); ?>"});
	      
	    <?php } ?>
	    marques_kompass.isEditable();
	    marques_kompass.generate();
	    
	  });
</script>
<?php if($modif) { ?>  
<div id="addform_marque">
    <form action="">
		<div class="panel-body">
			<div class="row">	
				<div id="nouv-marque">		
					<div class="col-md-2">Nom:</div> 
					<div class="col-md-4">
						<input type="text" class="form-control" <?php echo $formMarque["nom_marque"]; ?>>
					</div>
					<div class="col-md-2">pays:</div> 
					<div class="col-md-4">
						<?php 
	                        echo TTSList::getListBox(array(
	                          "query" => "select code_pays,pays from pays",
	                          "form" => $formMarque,
	                          "oForm" => $oFormMarque,
	                          "value" => "code_pays",
	                          "libel" => "pays",
	                          "key" => "code_pays",
	                          "db" => "bd_web",
	                          "class" => "select",
	                        ));
	                      ?>
					</div>
					<div class="col-md-2">Description:</div> 
					<div class="col-md-4">
					    <textarea class="form-control" <?php echo $formMarque["description"]; ?>></textarea>
					</div>
				</div>
				<div id="resultat_marque"></div>
			</div>
				<div class="row">
    				<div class="text-left">
						<button type="submit" class="btn btn-primary">
							Enregistrer <i class="icon-arrow-right14 position-right"></i>
						</button>
						<button type="reset" class="btn btn-danger">
							Vider <i class="icon-arrow-right14 position-right"></i>
						</button>
						<button type="button" class="btn btn-success" id="verifier_marque">
							Verifier <i class="icon-arrow-right14 position-right"></i>
						</button>
						<button type="button" class="btn btn-danger" id="vider_marque">
							Nouvelle marque <i class="icon-arrow-right14 position-right"></i>
						</button>
					</div>
    			</div>

		</div>
	</form>
</div>
<?php } ?>
<h5>marque</h5>
<div class="col-md-6">
    <div class="content panel">

        <table id="tableau_marque" class="display table table-striped table-hover">
    		<thead>
    			<tr>
    				<th>Nom</th>
    				<th>Pays</th>
    				<th>Description</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php foreach ($lien_marque as $data) : ?>
    				<tr id="<?php echo $data["id"]; ?>">
    					<td class="id_marque" id="<?php echo $data["id"]; ?>"><?php echo $data['nom_marque']?></td>
    					<td><?php echo $data['pays']?></td>
    					<td><?php echo $data['description']?></td>
    				</tr>
    			<?php endforeach;?>
    		</tbody>
    	</table>
    </div>
</div>
<div class="col-md-6">
	<div id="resultat_act_marque"></div>
</div>
