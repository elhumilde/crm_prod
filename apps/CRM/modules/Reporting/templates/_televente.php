<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
		dataDepend.setUrl("<?php echo url_for('setDependanceChoice',array('bd'=> 'bd_web')); ?>");

		var depend = new dataDepend('appel_televente_societe','appel_televente_support');
		depend.setSource('societes',['code','code']);
		depend.setDestin('support',['societe',"code,support"]);
		depend.setData({value:'code', libel:'support'});
		depend.setSelected({value: '<?php echo $support ?>'});
		depend.setup();
		depend.setEmpty(false);
		$('#appel_televente_societe').change();
	    var oTable_appel = new jqueryTable();
	    $(document).on( 'click', 'tr', function () {
	 		table.$('tr.row_selected').removeClass('row_selected');
	 		$(this).addClass('row_selected');
	    } );
	    oTable_appel.create($('#tableau_appel')); 
	    oTable_appel.setActionAdd({'url'  :  "<?php echo url_for('ConsulterTelevente',array('act'=>'addAppel','id'=>$id,'num_compagne'=>$num_compagne)) ?>", 'method'  :  "post", "id_form" :  "addform_appel"});	      
	    oTable_appel.isEditable();
	    oTable_appel.generate();


	  });
</script>
<script type="text/javascript">
    $(document).ready(function(){
    	$('.sidebar-control').click();
    });
    $(document).on('change', '#appel_televente_resultat',function(){
    	if($(this).val()=="PROP"){
    		$("#montant_devis").show();
    	}
    	else
    	{
    		$("#montant_devis").hide();
    	}
    });

</script>
<?php if($modif) { ?> 
<div id="addform_appel">
    <form action="">
		<div class="panel-body">
			<div class="row" style="visibility: hidden;">
		    	<div class="col-md-2">Societes:</div> 
				<div class="col-md-4">
					<?php 
						echo TTSList::getListBox(array(
							"query" => "select code, societe from societes ",
							"form" => $formTelevente,
							"oForm" => $oFormTelevente,
							"value" => "code",
							"libel" => "societe",
							"key" => "societe",
							"db" => "bd_web",
							"required" => "required",
                            "class" => "select"
						)); 
					?>
				</div>
		    	<div class="col-md-2">Support:</div> 
				<div class="col-md-4">
					<select class="select" <?php echo $formTelevente["support"]; ?>></select>
				</div>		
			</div>
			<div class="row">		
				<input type="hidden" <?php echo $formTelevente["num_compagne"]; ?>>	
				<div class="col-md-2">Contact:</div> 
				<div class="col-md-4">
					<input type="text" class="form-control"  required="required" <?php echo $formTelevente["contact"]; ?>>
				</div>			
				<div class="col-md-2">Fonction:</div> 
				<div class="col-md-4">
					<input type="text" class="form-control" <?php echo $formTelevente["fonction"]; ?>>
				</div>	
			</div>
			<div class="row">	
				<div class="col-md-2">Resultat:</div> 
				<div class="col-md-4">
					<?php 
						echo TTSList::getListBox(array(
							"query" => "select code, libelle from resultat_televentes where code not in('HCib','RDV','PAS N','INJ','CH')",
							"form" => $formTelevente,
							"oForm" => $oFormTelevente,
							"value" => "code",
							"libel" => "libelle",
							"key" => "resultat",
							"db" => "bd_web",
							"required" => "required",
                            "class" => "select"
						)); 
					?>
				</div>
			</div>
			<div class="row" id="montant_devis" style="display: none;">
				<div class="col-md-2">Montant devis:</div> 
				<div class="col-md-4">
					<input type="text" class="form-control" <?php echo $formTelevente["montant_devis"]; ?>>
				</div>	

				<div class="col-md-2">Lien vers E-contact:</div> 
				<div class="col-md-4">
					<input type="text" class="form-control" <?php echo $formTelevente["lien_e_contact"]; ?>>
				</div>	
			</div>
			<div class="row">	
			<div class="col-md-2">Etapes:</div> 
				<div class="col-md-4">
					<?php 
						echo TTSList::getListBox(array(
							"query" => "select id, libelle from par_etape_vente ",
							"value" => "id",
							"libel" => "libelle",
							"key" => "id_etape",
							"multiple" => "multiple",
							"db" => "crm",
                            "class" => "select"
						)); 
					?>
				</div>	
				<div class="col-md-2">Observation:</div> 
				<div class="col-md-4">
					<textarea class="form-control" <?php echo $formTelevente["observation"]; ?>> </textarea>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-2">Date rappel:</div> 
				<div class="col-md-4">
					<div class="input-group" style="float: left">
						<span class="input-group-addon"><i class="icon-calendar22"></i></span>
						<input type="text" placeholder="jj/mm/aaaa"
							class="form-control datepicker-menus"
							<?php echo $formTelevente["date_rappel"]; ?>>
					</div>
				</div>	
				<div class="col-md-2">Heure rappel :</div> 
				<div class="col-md-4">
					<input type="time" class="form-control" placeholder="hh:mm" <?php echo $formTelevente["appel_heure_rappel"]; ?>>
				</div>
			</div>
			<div class="row">
				
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
<div class="content">
	<fieldset style="padding : 1em;max-width: 100%;overflow: auto;">
		<table class="table table-striped table-hover" id="tableau_appel">
			<thead>
				<tr>
	                <th style="min-width:150px" >contact</th>
	                <th style="min-width:150px" >fonction</th>
					<th style="min-width:150px"  data-column="observation">observation</th>
					<th style="min-width:150px"  data-column="date_appel">date appel</th>
					<th style="min-width:150px"  data-column="date_rappel">date rappel</th>
					<th style="min-width:150px"  data-column="appel_heure_rappel">heure rappel</th>
					<th style="min-width:150px"  data-column="resultat">resultat</th>
					<th style="min-width:150px"  data-column="montant_devis">Montant devis</th>
					<th style="min-width:150px"  data-column="Lien_vers_E-contact">Lien vers E-contact</th>
					<th style="min-width:150px"  data-column="resultat">Etapes</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($televentes as $row):?>
					<tr id="<?php echo $row["id"]; ?>">
	                    <td><?php echo $row["contact"]; ?></td>
	                    <td><?php echo $row["fonction"]; ?></td>
						<td><?php echo $row["observation"]; ?></td>
						<td><?php echo $row["date_appel"]? date("d/m/Y", strtotime($row["date_appel"])) :''; ?></td>
						<td><?php echo $row["date_rappel"]? date("d/m/Y", strtotime($row["date_rappel"])) :''; ?></td>
						<td><?php echo substr($row["appel_heure_rappel"], 0,2).":".substr($row["appel_heure_rappel"], 2); ?></td>
						<td><?php echo $row["resultat"]; ?></td>
						<td><?php echo $row["montant_devis"]; ?></td>
						<td><?php echo $row["lien_e_contact"]; ?></td>
						<td><?php echo $row["etapes"]; ?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</fieldset>
</div>