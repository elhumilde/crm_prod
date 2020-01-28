<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {

		$('#export_excel').click(function(){
			tableToExcel('tableau_releve','Situation Client');
		});
		
	    var oTable2 = new jqueryTable();
	    oTable2.create($('#tableau_bc'));   
	    oTable2.generate();
	    var oTable2 = new jqueryTable();
	    oTable2.create($('#tableau_decouverte'));   
	    oTable2.generate();
	    var oTable4 = new jqueryTable();
	    oTable4.create($('#tableau_visite'));   
	    oTable4.generate();
	    $('.itemName').select2({
	        placeholder: 'Select an item',
	        ajax: {
	          url: "<?php echo url_for('Common/AutoComplete') ?>",
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
	   	////////////tableau_appel
	    oTable_appel.create($('#tableau_appel')); 
	    oTable_appel.setActionAdd({'url'  :  "<?php echo url_for('ConsulterTelevente',array('act'=>'addAppel','id'=>$id)) ?>", 'method'  :  "post", "id_form" :  "addform_appel"});	      
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
    });

    </script>

<style type="text/css">
.style_table{
	width:100%;
	border: 1px solid #ccc;
}

.style_table thead tr th{
	padding: 9px;
	border: 1px solid #ccc;
	background-color: #f0f0f0;
}

.style_table tbody tr td{
	padding: 9px;
	border: 1px solid #ccc;
}

.style_table tfoot tr td{
	padding: 9px;
	border: 1px solid #ccc;
	background-color: #f0f0f0;
	font-weight: bold;
}

	#DataTables_Table_0_wrapper .DTTT_container , #DataTables_Table_0_wrapper .dataTables_length , #DataTables_Table_0_wrapper .dataTables_filter {display: none!important;}
</style>
<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li class="active">Televente</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Affichage des informations de la televente</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
			
        <div class="row">
			<label class="col-md-1 col-md-offset-1" for="selectError">Code firme</label>
			<div class="col-md-2">
			   <input type="text" value="<?php echo $televente['code_firme']; ?>" class="form-control" readonly>
			</div>
			<label class="col-md-1 col-md-offset-1" for="selectError">Raison social</label>
			<div class="col-md-2">
			   <input type="text" value="<?php echo $televente['rs_comp']; ?>" class="form-control" readonly>
			</div>
			<label class="col-md-1 col-md-offset-1" for="selectError">rs_comp</label>
			<div class="col-md-2">
			   <input type="text" value="<?php echo $televente['rs_comp']; ?>" class="form-control" readonly>
			</div>
			
        </div>
        <div class="row">
			<label class="col-md-1 col-md-offset-1" for="selectError">Activité simplifiée : </label>
			<div class="col-md-2">
			   <input type="text" value="<?php echo $televente['tp_40']; ?>" class="form-control" readonly>
			</div>
			<label class="col-md-1 col-md-offset-1" for="selectError">Nature</label>
			<div class="col-md-2">
			   <input type="text" value="<?php echo $televente['nature']; ?>" class="form-control" readonly>
			</div>
			
			
			<label class="col-md-1 col-md-offset-1" for="selectError">Statut</label>
			<div class="col-md-2">
			   <input type="text" value="<?php echo $televente['status']; ?>" class="form-control" readonly>
			</div>
			
        </div>
        <div class="row">
			<label class="col-md-1 col-md-offset-1" for="selectError">Adresse</label>
			<div class="col-md-2">
			   <textarea class="form-control" readonly><?php echo $televente["num_voie"]." ".$televente["comp_num_voie"]." ".$televente["voie"]." ".$televente["comp_voie"]." ".$televente["quartier"]." ".$televente["arrondissement"]." ".$televente["ville"]; ?></textarea>
			</div>
			<label class="col-md-1 col-md-offset-1" for="selectError">T&eacute;lephone</label>
			<div class="col-md-2">
			   <input type="text" value="<?php echo $televente['tel']; ?>" class="form-control" readonly>
			</div>
			<label class="col-md-1 col-md-offset-1" for="selectError">Zone</label>
			<div class="col-md-2">
			   <input type="text" value='<?php echo $televente["zone_geo"]; ?>' class="form-control" readonly>
			</div>
		</div>
        <div class="row">
			<div class="col-md-12">
				<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
					<li class="active"><a href="#appel" data-toggle="tab">Liste des appels </a></li>
					<!-- <li><a href="#visite " data-toggle="tab">Visite </a></li>
					<li><a href="#bcs" data-toggle="tab">Bons de commande </a></li> -->
					<li><a href="#decouverte" data-toggle="tab">Historique Decouverte</a></li>
				</ul>
				
				<div class="tab-content">
					<div class="tab-pane has-padding active" id="appel">
						<div id="addform_appel">
						    <form action="">
								<div class="panel-body">
								    <div class="row" style="visibility: hidden;">
								    	<div class="col-md-2">Societes:</div> 
										<div class="col-md-4">
											<?php 
												echo TTSList::getListBox(array(
													"query" => "select code, societe from societes ",
													"form" => $formAppel,
													"oForm" => $oFormAppel,
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
											<select class="select" required="required" <?php echo $formAppel["support"]; ?>></select>
										</div>		
									</div>
									<div class="row">			
										<div class="col-md-2">Contact:</div> 
										<div class="col-md-4">
											<input type="text" class="form-control"  required="required" <?php echo $formAppel["contact"]; ?>>
										</div>			
										<div class="col-md-2">Fonction:</div> 
										<div class="col-md-4">
											<input type="text" class="form-control" <?php echo $formAppel["fonction"]; ?>>
										</div>	
									</div>
									<div class="row">	
										<div class="col-md-2">Resultat:</div> 
										<div class="col-md-4">
											<?php 
												echo TTSList::getListBox(array(
													"query" => "select code, libelle from resultat_televentes ",
													"form" => $formAppel,
													"oForm" => $oFormAppel,
													"value" => "code",
													"libel" => "libelle",
													"key" => "resultat",
													"db" => "bd_web",
													"required" => "required",
					                                "class" => "select"
												)); 
											?>
										</div>
										<div id="montant_devis" style="display: none;">
											<div class="col-md-2">Montant devis:</div> 
											<div class="col-md-4">
												<input type="text" class="form-control" <?php echo $formAppel["montant_devis"]; ?>>
											</div>	
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
											<textarea class="form-control" <?php echo $formAppel["observation"]; ?>> </textarea>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2">Date rappel:</div> 
										<div class="col-md-4">
											<div class="input-group" style="float: left">
												<span class="input-group-addon"><i class="icon-calendar22"></i></span>
												<input type="text" placeholder="jj/mm/aaaa"
													class="form-control datepicker-menus"
													<?php echo $formAppel["date_rappel"]; ?>>
											</div>
										</div>	
										<div class="col-md-2">Heure rappel:</div> 
										<div class="col-md-4">
											<div class="input-group" style="float: left">
												<input type="number" placeholder="hh:mm"
													class="form-control"
													<?php echo $formAppel["appel_heure_rappel"]; ?>>
											</div>
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
						<fieldset style="padding : 1em;max-width: 100%;overflow: auto;">
						<table class="table table-striped table-hover" id="tableau_appel">
							<thead>
								<tr>
									<th style="min-width:1px"></th>
				                    <th style="min-width:150px" >contact</th>
				                    <th style="min-width:150px" >fonction</th>
									<th style="min-width:150px"  data-column="observation">observation</th>
									<th style="min-width:150px"  data-column="date_appel">date appel</th>
									<th style="min-width:150px"  data-column="date_rappel">date rappel</th>
									<th style="min-width:150px"  data-column="resultat">resultat</th>
									<th style="min-width:150px"  data-column="montant_devis">Montant devis</th>
									<th style="min-width:150px"  data-column="resultat">Etapes</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($appel as $row):?>
									<tr id="<?php echo $row["id"]; ?>">
										<td></td>
					                    <td><?php echo $row["contact"]; ?></td>
					                    <td><?php echo $row["fonction"]; ?></td>
										<td><?php echo $row["observation"]; ?></td>
										<td><?php echo $row["date_appel"]? date("d/m/Y", strtotime($row["date_appel"])) :''; ?></td>
										<td><?php echo $row["date_rappel"]? date("d/m/Y", strtotime($row["date_rappel"])) :''; ?></td>
										<td><?php echo $row["resultat"]; ?></td>
										<td><?php echo $row["montant_devis"]; ?></td>
										<td><?php echo $row["etapes"]; ?></td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</fieldset>
					</div>
					<!-- 
					<div class="tab-pane has-padding" id="visite">

                        <fieldset style="padding : 1em;max-width: 100%;overflow: auto;">
						<table class="table table-striped table-hover" id="tableau_visite">
							<thead>
								<tr>
									<th style="min-width:1px"></th>
				                    <th style="min-width:150px">contact</th>
									<th style="min-width:150px" data-column="date_rappel">date visite</th>
									<th style="min-width:150px" data-column="observation">heure visite</th>
									<th style="min-width:150px" data-column="date_rappel">date proch </th>
									<th style="min-width:150px" data-column="resultat">resultat</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($visite as $row):?>
									<tr>
										<td></td>
					                    <td><?php echo $row["code_contact"]; ?></td>
										<td><?php echo $row["date_visite"]? date("d/m/Y", strtotime($row["date_visite"])) :''; ?></td>
										<td><?php echo $row["heure_visite"]; ?></td>
										<td><?php echo $row["date_prochainev"]? date("d/m/Y", strtotime($row["date_prochainev"])) :''; ?></td>
										<td><?php echo $row["resultat"]; ?></td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</fieldset>
					</div>
					<div class="tab-pane has-padding" id="bcs">
						<table class="table table-striped table-hover" id="tableau_bc">
								<thead>
								<tr>
									<th style="min-width:1px"></th>
									<th style="min-width:150px" >num bc</th>
									<th style="min-width:150px">date bc</th>
				                    <th style="min-width:150px" >societe</th>
				                    <th style="min-width:150px" >support</th>
									<th style="min-width:150px"  data-column="observation">mtht</th>
									<th style="min-width:150px"  data-column="observation">mt ttc</th>
									<th style="min-width:150px"  data-column="date_appel">reglem ttc</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($bcs as $row):?>
									<tr id="<?php echo $row["id"]; ?>">
										<td></td>
										<td><?php echo $row["num_bc"]; ?></td>
										<td><?php echo $row["date_bc"]? date("d/m/Y", strtotime($row["date_bc"])) :''; ?></td>
					                    <td><?php echo $row["societe"]; ?></td>
					                    <td><?php echo $row["support"]; ?></td>
					                    <td><?php echo $row["mtht"]; ?></td>
										<td><?php echo $row["mt_ttc"]; ?></td>
										<td><?php echo $row["reglem_ttc"]; ?></td>
									</tr>
								<?php endforeach;?>
							</table>
					</div>
					
					 -->
					
					<div class="tab-pane has-padding" id="decouverte">
						<table class="table table-striped table-hover" id="tableau_decouverte">
							<thead>
								<tr>
									<th>Créateur</th>
									<th>Date création</th>
									<th>Description</th>
									<th>activite</th>
									<th>clients</th>
									<th>developper</th>
									<th>travail</th>
								</tr>
							</thead>

							<?php foreach ($decouverte as $row):?>
							<tbody>
								<tr style="cursor: pointer; cursor: hand;"
									onClick="document.location='<?php echo url_for("Ajouterdecouverte",array("id"=>$row['id'])); ?>'">
									<td><?php echo $row["createur"]; ?></td>
									<td><?php echo $row["date_creation"]? date("d/m/Y", strtotime($row["date_creation"])) :''; ?>
									<td><?php echo $row["description"]; ?></td>
									</td>

									<th><?php echo $row["activite"]; ?></th>
									<th><?php echo $row["clients"]; ?></th>
									<th><?php echo $row["developper"]; ?></th>
									<th><?php echo $row["travail"]; ?></th>
								</tr>
							</tbody>
							<?php endforeach;?>
						</table>
					</div>
					
					
				</div>
			</div>
		</div>
	</div>
</div>

