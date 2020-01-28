<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {

		$('#export_excel').click(function(){
			tableToExcel('tableau_releve','Situation Client');
		});
		
	    var oTable2 = new jqueryTable();
	    oTable2.create($('.display'));   
	    oTable2.generate();
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

	    var oTable_appel = new jqueryTable();
	    $(document).on( 'click', 'tr', function () {
	 		table.$('tr.row_selected').removeClass('row_selected');
	 		$(this).addClass('row_selected');
	    } );
	   	////////////tableau_appel
	    oTable_appel.create($('#tableau_appel')); 
	    oTable_appel.setActionAdd({'url'  :  "<?php echo url_for('ConsulterRecouvrement',array('act'=>'addAppel','id'=>$id)) ?>", 'method'  :  "post", "id_form" :  "addform_appel"});	      
	    oTable_appel.isEditable();
	    oTable_appel.generate();

	    ////////////tableau_visite
	    var oTable_visite = new jqueryTable();
	    oTable_visite.create($('#tableau_visite')); 
	    oTable_visite.setActionAdd({'url'  :  "<?php echo url_for('ConsulterRecouvrement',array('act'=>'addVisite','id'=>$id)) ?>", 'method'  :  "post", "id_form" :  "addform_visite"});
	    oTable_visite.isEditable();
	    oTable_visite.generate();

	  });
</script>
<script type="text/javascript">
    $(document).ready(function(){

    $('.sidebar-control').click();
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
      <li class="active">Encaissement</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Affichage des informations de l'encaissement</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
		<div style="padding: 9px; margin-bottom: 9px; color: #0000ff; background-color: #BBBBFF ;border: 1px solid #0000ff; font-weight: bold; text-align: center">Client en <?php echo $recouvrement['type']?></div>
			
                <div class="row">
					<label class="col-md-1 col-md-offset-1" for="selectError">N ordre</label>
					<div class="col-md-2">
					   <input type="text" value="<?php echo $recouvrement['nord']; ?>" class="form-control" readonly>
					</div>
					<label class="col-md-1 col-md-offset-1" for="selectError">Date Facture</label>
					<div class="col-md-2">
					   <input type="text" value="<?php echo $recouvrement['date_facture']; ?>" class="form-control" readonly>
					</div>
					<label class="col-md-1 col-md-offset-1" for="selectError">Firme</label>
					<div class="col-md-2">
					   <input type="text" value="<?php echo $recouvrement['rs_comp']; ?>" class="form-control" readonly>
					</div>
					
                </div>
                <div class="row">
					<label class="col-md-1 col-md-offset-1" for="selectError">Signataire</label>
					<div class="col-md-2">
					   <input type="text" value="<?php echo $recouvrement['signataire']; ?>" class="form-control" readonly>
					</div>
					
					<label class="col-md-1 col-md-offset-1" for="selectError">Support</label>
					<div class="col-md-2">
					   <input type="text" value="<?php echo $recouvrement['support']; ?>" class="form-control" readonly>
					</div>
					<label class="col-md-1 col-md-offset-1" for="selectError">Resp</label>
					<div class="col-md-2">
					   <input type="text" value="<?php echo $recouvrement['resp']; ?>" class="form-control" readonly>
					</div>
					
                </div>
                <div class="row">
					
					
					<label class="col-md-1 col-md-offset-1" for="selectError">N Facture</label>
					<div class="col-md-2">
					   <input type="text" value="<?php echo $recouvrement['facture']; ?>" class="form-control" readonly>
					</div>
					<label class="col-md-1 col-md-offset-1" for="selectError">Date BC</label>
					<div class="col-md-2">
					   <input type="text" value="<?php echo $recouvrement['date_bc']; ?>" class="form-control" readonly>
					</div>
					
					<label class="col-md-1 col-md-offset-1" for="selectError">Montant ttc</label>
					<div class="col-md-2">
					   <input type="text" value="<?php echo number_format($recouvrement['ttc'],0,',','');; ?>" class="form-control" readonly>
					</div>
					
                </div>
                <div class="row">
					<div class="col-md-6"  >
						<div class="panel" style="height: 260px;">
							<h5>R&eacute;glement pr&eacute;visionnel</h5>
							<table class="display table table-striped table-hover">
								<thead>
									<tr>
										<th>Date Prev</th>
										<th>num Bc</th>
										<th>Montant</th>
										<th style="display: none"></th>
										<th style="display: none"></th>
										<th style="display: none"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($reglements as $row):?>
										<tr>
											<td><?php echo $row["date_prev"]? date("d/m/Y", strtotime($row["date_prev"])) :''; ?>
											</td>
											<td><?php echo $row["num_bc"]; ?></td>
											<td><?php echo number_format($row["montant"],0,',','');; ?></td>
										<td style="display: none"></td>
										<td style="display: none"></td>
										<td style="display: none"></td>
										</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-6 panel" style="min-height: 220px;">
						<div class="row">
							<h5>Info Firme</h5>
							<div class="col-md-2 text-center" style="padding-top: 4%;"><i class="icon-coins text-primary" style="font-size: 36px;"></i></div>
							<div class="col-md-5">
								<label for="selectError">Montant a encaisser</label>
							   	<input type="text" value="<?php echo number_format($recouvrement['solde'],0,',','');; ?>" class="form-control" readonly>
							</div>
							<div class="col-md-5">
								<label for="selectError">Solde client</label>
							   	<input type="text" value="<?php echo number_format($recouvrement['solde_client'],0,',','');; ?>" class="form-control" readonly>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 text-center" style="padding-top: 4%;"><i class="icon-phone2 text-primary" style="font-size: 36px"></i></div>
							<div class="col-md-3">
								<label for="selectError">Fax</label>
							   	<input type="text" value='<?php echo $recouvrement["fax"]; ?>' class="form-control" readonly>
							</div>
                             <!--Modifier le 04/02/2019 par rania malk-->
							<div class="col-md-3">
								<label for="selectError">T&eacute;lephone</label>
                                <?php for($i = 0; $i < count($recouvrement_tel); ++$i):?>
                                    <input type="text" value='<?php echo $recouvrement_tel[$i]["tel"];  ?>' class="form-control" readonly>
                                <?php endfor;?>
                            </div>
                            <div class="col-md-3">
                                <label for="selectError">Portable</label>
                                <input type="text" value='<?php echo $recouvrement["portable"]; ?>' class="form-control" readonly>
                            </div>
                            <!--Fin edit-->
							<div class="col-md-3">
								<label for="selectError">Zone</label>
							   	<input type="text" value='<?php echo $recouvrement["zone_geo"]; ?>' class="form-control" readonly>
							</div>
						</div>
						<div class="row">
						
							<div class="col-md-2 text-center" style="padding-top: 4%;"><i class="icon-location3 text-primary" style="font-size: 36px"></i></div>
							<div class="col-md-10">
								<label for="selectError">Adresse</label>
							   	<textarea class="form-control" readonly><?php echo $recouvrement["num_voie"]." ".$recouvrement["comp_num_voie"]." ".$recouvrement["voie"]." ".$recouvrement["comp_voie"]." ".$recouvrement["quartier"]." ".$recouvrement["arrondissement"]." ".$recouvrement["ville"]; ?></textarea>
							</div>
						</div>
					</div>
                </div>
        <div class="row">
			<div class="col-md-12">
				<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
					<li class="active"><a href="#appel" data-toggle="tab">Appel </a></li>
					<li><a href="#visite " data-toggle="tab">Visite </a></li>
					<li><a href="#releve" data-toggle="tab">Relev&eacute;/Historique</a></li>
					<li><a href="#impaye" data-toggle="tab">impay&eacute;s </a></li>
					<li><a href="#historique_paiement" data-toggle="tab">Derniers Paiements</a></li>
				</ul>
				
				<div class="tab-content">
					<div class="tab-pane has-padding active" id="appel">
						<div id="addform_appel">
						    <form action="">
								<div class="panel-body">
								    <div class="row">			
										<div class="col-md-2">Contact:</div> 
										<div class="col-md-4">
											<input type="text" class="form-control" <?php echo $formAppel["contact"]; ?>>
										</div>			
										<div class="col-md-2">Fonction:</div> 
										<div class="col-md-4">
											<input type="text" class="form-control" <?php echo $formAppel["fonction"]; ?>>
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
										<div class="col-md-2">Resultat:</div> 
										<div class="col-md-4">
											<?php 
												echo TTSList::getListBox(array(
													"query" => "select code, libelle from resultat_encaissements ",
													"form" => $formAppel,
													"oForm" => $oFormAppel,
													"value" => "code",
													"libel" => "libelle",
													"key" => "resultat",
													"db" => "bd_web",
					                                "class" => "select"
												)); 
											?>
										</div>	
									</div>
									<div class="row">		
										<div class="col-md-2">Observation:</div> 
										<div class="col-md-10">
											<textarea class="form-control" <?php echo $formAppel["observation"]; ?>> </textarea>
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
						<fieldset style="padding : 1em;max-width: 100%;overflow: auto;">
						<table class="table table-striped table-hover" id="tableau_appel">
							<thead>
								<tr>
									<th style="min-width:1px"></th>
									<th style="min-width:150px" data-column="num_bc">Num bc</th>
									<th style="min-width:150px" >edition</th>
				                    <th style="min-width:150px" >societe</th>
				                    <th style="min-width:150px" >support</th>
				                    <th style="min-width:150px" >contact</th>
				                    <th style="min-width:150px" >fonction</th>
									<th style="min-width:150px"  data-column="observation">observation</th>
									<th style="min-width:150px"  data-column="date_appel">date appel</th>
									<th style="min-width:150px"  data-column="date_rappel">date rappel</th>
									<th style="min-width:150px"  data-column="resultat">resultat</th>
									<th style="min-width:150px"  data-column="resultat">Dossier impayé</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($appel as $row):?>
									<tr id="<?php echo $row["id"]; ?>">
										<td></td>
										<td><?php echo $row["num_bc"]; ?></td>
										<td><?php echo $row["edition"]; ?></td>
					                    <td><?php echo $row["societe"]; ?></td>
					                    <td><?php echo $row["support"]; ?></td>
					                    <td><?php echo $row["contact"]; ?></td>
					                    <td><?php echo $row["fonction"]; ?></td>
										<td><?php echo $row["observation"]; ?></td>
										<td><?php echo $row["date_appel"]? date("d/m/Y", strtotime($row["date_appel"])) :''; ?></td>
										<td><?php echo $row["date_rappel"]? date("d/m/Y", strtotime($row["date_rappel"])) :''; ?></td>
										<td><?php echo $row["resultat"]; ?></td>
										<td><?php echo $row["dossier_impaye"]; ?></td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</fieldset>
					</div>
					<div class="tab-pane has-padding" id="visite">
                        <div id="addform_visite">
                            <form action="">
                                <div class="panel-body">
                                    <div class="row">           
                                        <div class="col-md-2">Contact:</div> 
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" <?php echo $formVisite["contact"]; ?>>
                                        </div>          
                                        <div class="col-md-2">Fonction:</div> 
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" <?php echo $formVisite["fonction"]; ?>>
                                        </div>  
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">Date prochaine visite:</div> 
                                        <div class="col-md-4">
                                            <div class="input-group" style="float: left">
                                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                <input type="text" placeholder="jj/mm/aaaa"
                                                    class="form-control datepicker-menus"
                                                    <?php echo $formVisite["date_prochaine_visite"]; ?>>
                                            </div>
                                        </div>          
                                        <div class="col-md-2">Resultat:</div> 
                                        <div class="col-md-4">
                                            <?php 
                                                echo TTSList::getListBox(array(
                                                    "query" => "select code, libelle from resultat_encaissements ",
                                                    "form" => $formVisite,
                                                    "oForm" => $oFormVisite,
                                                    "value" => "code",
                                                    "libel" => "libelle",
                                                    "key" => "resultat",
                                                    "db" => "bd_web",
                                                    "class" => "select"
                                                )); 
                                            ?>
                                        </div>  
                                    </div>
                                    <div class="row">       
                                        <div class="col-md-2">Observation:</div> 
                                        <div class="col-md-10">
                                            <textarea class="form-control" <?php echo $formVisite["observation"]; ?>> </textarea>
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
                        <fieldset style="padding : 1em;max-width: 100%;overflow: auto;">
						<table class="table table-striped table-hover" id="tableau_visite">
							<thead>
								<tr>
									<th style="min-width:1px"></th>
									<th style="min-width:150px" data-column="num_bc">Num bc</th>
									<th style="min-width:150px">edition</th>
				                    <th style="min-width:150px">societe</th>
				                    <th style="min-width:150px">support</th>
				                    <th style="min-width:150px">contact</th>
				                    <th style="min-width:150px">fonction</th>
									<th style="min-width:150px" data-column="observation">observation</th>
									<th style="min-width:150px" data-column="date_rappel">date visite</th>
									<th style="min-width:150px" data-column="date_rappel">date proch v</th>
									<th style="min-width:150px" data-column="resultat">resultat</th>
									<th style="min-width:150px" data-column="resultat">Dossier</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($visite as $row):?>
									<tr>
										<td></td>
										<td><?php echo $row["num_bc"]; ?></td>
										<td><?php echo $row["edition"]; ?></td>
					                    <td><?php echo $row["societe"]; ?></td>
					                    <td><?php echo $row["support"]; ?></td>
					                    <td><?php echo $row["contact"]; ?></td>
					                    <td><?php echo $row["fonction"]; ?></td>
										<td><?php echo $row["observation"]; ?></td>
										<td><?php echo $row["date_visite"]? date("d/m/Y", strtotime($row["date_visite"])) :''; ?></td>
										<td><?php echo $row["date_prochaine_visite"]? date("d/m/Y", strtotime($row["date_prochaine_visite"])) :''; ?></td>
										<td><?php echo $row["resultat"]; ?></td>
										<td><?php echo $row["dossier_impaye"]; ?></td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</fieldset>
					</div>
					<div class="tab-pane has-padding" id="releve">
						<div align="right"><button id="export_excel" type="button">Export Excel</button></div>
						<table class="style_table" id="tableau_releve" style="width: 100%; border: 1"  >
							<thead>
								<tr style="background-color: #f0f0f0">
									<th data-column="societe">Num Facture</th>
									<th data-column="edition">Libellé</th>
									<th data-column="edition">Mt Facture</th>
									<th data-column="support">Montant Reste</th>
								</tr>
							</thead>
							<tbody>
								<?php $ttc = 0; $solde= 0; foreach ($releve as $row):?>
									<tr>
										<td><?php echo $row["nfact"]; ?></td>
										<td><?php echo $row["libelle"]; ?></td>
										<td><?php echo  number_format($row["ttc"],0,',',''); $ttc+=$row["ttc"];  ?></td>
										<td><?php echo number_format($row["solde"],0,',',''); $solde+= $row["solde"]; ?></td>
									</tr>
								<?php endforeach;?>
							</tbody>
							<tfoot>
								<tr style="background-color: #f0f0f0">
									<td>Total</td>
									<td></td>
									<td><?php echo $ttc;?></td>
									<td><?php echo $solde;?></td>
								</tr>
							
							</tfoot>
						</table>
					</div>
					<div class="tab-pane has-padding" id="impaye">
						<table class="table table-striped table-hover" id="tableau_impaye">
								<thead>
									<tr>
										<th>dossier</th>
										<th>Date</th>
										<th>Mt ordre</th>
										<th>Mt impayé</th>
										<th>Num Facture</th>
										<th>cloture</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($impaye as $row):?>
										<tr>
											<td><?php echo $row["dossier"]; ?></td>
											<td><?php echo $row["dimp"]? date("d/m/Y", strtotime($row["dimp"])) :''; ?></td>
											<td><?php echo $row["mtord"]; ?></td>
											<td><?php echo $row["mtrec"]; ?></td>
											<td><?php echo $row["nfact"]; ?></td>
											<td><?php if($row["cloture"]==1) echo "Oui"; else echo "Non"; ?></td>
										</tr>
									<?php endforeach;?>
								</tbody>
							</table>
					</div>
					
					
					
					<div class="tab-pane has-padding" id="historique_paiement">
						<table class="table table-striped table-hover" id="tableau_impaye">
								<thead>
									<tr>
										<th>Code</th>
										<th>Date</th>
										<th>Objet</th>
										<th>Resultat</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($historique_paiement as $row):?>
										<tr>
											<td><?php echo $row["code"]; ?></td>
											<td><?php echo $row["date"]? date("d/m/Y", strtotime($row["date"])) :''; ?></td>
											<td><?php echo $row["objet"]; ?></td>
											<td><?php echo $row["resultat"]; ?></td>
										</tr>
									<?php endforeach;?>
								</tbody>
							</table>
					</div>
					
					
				</div>
			</div>
		</div>
	</div>
</div>

