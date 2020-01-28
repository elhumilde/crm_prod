<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
		var oTable2 = new jqueryTable();
	    oTable2.create($('.display'));   
	    oTable2.generate();
	    dataDepend.setUrl("<?php echo url_for('setDependanceChoice',array('bd'=> 'bd_web')); ?>");

		var depend = new dataDepend('bon_commande_societe','bon_commande_support');
		depend.setSource('societes',['code','code']);
		depend.setDestin('support',['societe',"code,support"]);
		depend.setData({value:'code', libel:'support'});
		<?php if($oFilter->getValue("support")):?>
		depend.setSelected({value: '<?php echo $oFilter->getValue("support"); ?>'}); 
		<?php endif;?>
		depend.setEmpty("");
		depend.setup();

    	$('#bon_commande_societe').change();
	});

</script>
<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li class="active">Suivi des activités</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Suivi des activités</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
    		<form method="post">
    				<!--  DESIGNATION -->
                <div class="row">
    					

                        <label class="col-md-1  col-md-offset-1" for="selectError">Service</label>
    					<div class="col-md-2">
    						<?php echo TTSList::getListBox(array(
    								"query" => "select id, libelle from par_tts_service",
    								"form" => $filter,
    								"oForm" => $oFilter,
    								"value" => "id",
    								"libel" => "libelle",
    								"key" => "id_service",
    								"db" => "crm",
    								"class"=>"select"
                              )); ?>
    					</div>
                    <label class="col-md-1 col-md-offset-1" for="selectError">Société</label>
					<div class="col-md-2">
						<?php echo TTSList::getListBox(array(
								"query" => "select code, societe  from societes",
								"form" => $filter,
								"oForm" => $oFilter,
								"value" => "code",
								"libel" => "societe",
								"key" => "societe",
								"db" => "bd_web",
								"class"=>"select"
                          )); ?>
					</div>
					
                    <label class="col-md-1 col-md-offset-1" for="selectError">Support</label>
					<div class="col-md-2">
						<?php echo TTSList::getListBox(array(
								"query" => "select code, support  from support",
								"form" => $filter,
								"oForm" => $oFilter,
								"value" => "code",
								"libel" => "support",
								"key" => "support",
								"db" => "bd_web",
								"class"=>"select"
                          )); ?>
					</div>
					

                </div>
                <div class="row">
                <label class="col-md-1 col-md-offset-1" for="selectError">groupe</label>
					<div class="col-md-2">
						<?php echo TTSList::getListBox(array(
								"query" => "select id, libelle  from par_tts_groupe",
								"form" => $filter,
								"oForm" => $oFilter,
								"value" => "id",
								"libel" => "libelle",
								"key" => "id_groupe",
								"db" => "crm",
								"class"=>"select"
                          )); ?>
					</div>
					

                </div>
                <div class="row">
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" value="Rechercher" >
                        </div>
                        

                    </div>
    		</form>
    	<div class="row">
    	<div class="col-md-14">
    		<table class="table datatable-fixed-left datatable-button-init-basic">
				<thead>
					<tr>
						<th>Commercial</th>
						<th>Code</th>
						<th>Actif</th>
						<th >Mt Délai dépassé (0 et 90J)</th>
						<th >Mt Délai dépassé (0 et 30J)</th>
						<th >Mt Délai dépassé (30 et 60J) </th>
						<th >Mt Délai dépassé (60 et 90J)</th>
						<th >NB Délai dépassé (0 et 90J)</th>
						<th >NB Délai dépassé (0 et 30J)</th>
						<th >NB Délai dépassé (30 et 60J) </th>
						<th >NB Délai dépassé (60 et 90J)</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$rem_client=0;
					$rem_client_30=0;
					$rem_client_60=0;
					$rem_client_90=0;
					
					$nb_rem_client=0;
					$nb_rem_client_30=0;
					$nb_rem_client_60=0;
					$nb_rem_client_90=0;
				 ?>
				<?php $total_ht = 0; foreach ($datas as $row):?>
					<tr>
						<td><?php echo $row["nom_courtier"];  ?></td>
						<td><?php echo $row["code"];  ?></td>
						<td><?php echo $row["actif"];  ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($row["rem_client"],0,'',''); $rem_client+=$row["rem_client"]; ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_30", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($row["rem_client_30"],0,'',''); $rem_client_30+=$row["rem_client_30"]; ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_60", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($row["rem_client_60"],0,'',''); $rem_client_60+=$row["rem_client_60"]; ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_90", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($row["rem_client_90"],0,'',''); $rem_client_90+=$row["rem_client_90"]; ?></td>
						
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $row["nb_rem_client"]; $nb_rem_client+=$row["nb_rem_client"]; ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_30", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $row["nb_rem_client_30"]; $nb_rem_client_30+=$row["nb_rem_client_30"]; ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_60", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $row["nb_rem_client_60"]; $nb_rem_client_60+=$row["nb_rem_client_60"]; ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_90", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $row["nb_rem_client_90"]; $nb_rem_client_90+=$row["nb_rem_client_90"]; ?></td>
						
					</tr>
				<?php endforeach;?>
				</tbody>
				<tfoot>
					<tr>
					    <td> Total </td>
					    <td>  </td>
					    <td>  </td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($rem_client,0,'',' '); ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_30", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($rem_client_30,0,'',' '); ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_60", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($rem_client_60,0,'',' '); ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_90", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($rem_client_90,0,'',' '); ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $nb_rem_client; ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_60", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $nb_rem_client_30; ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_60", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $nb_rem_client_60; ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_90", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $nb_rem_client_90; ?></td>
				    </tr>
				</tfoot>
			</table>
    	</div>
    	
    	
    	
    	<div class="col-md-14">
    		<table class="table datatable-fixed-left datatable-button-init-basic">
				<thead>
					<tr>
						<th>Commercial</th>
						<th>Code</th>
						<th>Actif</th>
						<th >Mt rem client (0 et 90J)</th>
						<th >Mt rem client (0 et 30J)</th>
						<th >Mt rem client (30 et 60J) </th>
						<th >Mt rem client (60 et 90J)</th>
						<th >NB rem client (0 et 90J)</th>
						<th >NB rem client (0 et 30J)</th>
						<th >NB rem client (30 et 60J) </th>
						<th >NB rem client (60 et 90J)</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$rem_client=0;
					$rem_client_30=0;
					$rem_client_60=0;
					$rem_client_90=0;
					
					$nb_rem_client=0;
					$nb_rem_client_30=0;
					$nb_rem_client_60=0;
					$nb_rem_client_90=0;
				 ?>
				<?php $total_ht = 0; foreach ($datas2 as $row):?>
					<tr>
						<td><?php echo $row["nom_courtier"];  ?></td>
						<td><?php echo $row["code"];  ?></td>
						<td><?php echo $row["actif"];  ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_remb", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($row["rem_client"],0,'',''); $rem_client+=$row["rem_client"]; ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_30b", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($row["rem_client_30"],0,'',''); $rem_client_30+=$row["rem_client_30"]; ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_60b", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($row["rem_client_60"],0,'',''); $rem_client_60+=$row["rem_client_60"]; ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_90b", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($row["rem_client_90"],0,'',''); $rem_client_90+=$row["rem_client_90"]; ?></td>
						
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_remb", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $row["nb_rem_client"]; $nb_rem_client+=$row["nb_rem_client"]; ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_30b", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $row["nb_rem_client_30"]; $nb_rem_client_30+=$row["nb_rem_client_30"]; ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_60b", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $row["nb_rem_client_60"]; $nb_rem_client_60+=$row["nb_rem_client_60"]; ?></td>
						<td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_90b", "id_user" => $row["id_user"], "courtier" => $row["code"], "bon_commande[support]" => $oFilter->getData("support"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $row["nb_rem_client_90"]; $nb_rem_client_90+=$row["nb_rem_client_90"]; ?></td>
						
					</tr>
				<?php endforeach;?>
				</tbody>
				<tfoot>
					<tr>
					    <td> Total </td>
					    <td>  </td>
					    <td>  </td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_remb", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($rem_client,0,'',' '); ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_30b", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($rem_client_30,0,'',' '); ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_60b", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($rem_client_60,0,'',' '); ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_90b", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($rem_client_90,0,'',' '); ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_remb", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $nb_rem_client; ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_60b", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $nb_rem_client_30; ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_60b", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $nb_rem_client_60; ?></td>
					    <td onClick="window.open('<?php echo url_for('suivirem',array("act" => "detail_rem_90b", "bon_commande[support]" => $oFilter->getData("support"),  "bon_commande[id_service]" => $oFilter->getData("id_service"),"bon_commande[id_groupe]" => $oFilter->getData("id_groupe"), "bon_commande[societe]" => $oFilter->getData("societe"))) ?>')"
						 style="cursor: pointer;"><?php echo $nb_rem_client_90; ?></td>
				    </tr>
				</tfoot>
			</table>
    	</div>
    	   
    	</div>
	</div>
</div>

