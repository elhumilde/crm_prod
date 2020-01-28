<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
		var oTable2 = new jqueryTable();
	    oTable2.create($('#tableau'));   
	    oTable2.generate();

    	$('#bon_commande_societe').change();
	});

</script>
<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li><a href="#">Télévente</a></li>
      <li class="active">Suivi de Télévente</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Suivi de télévente</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
    	<form method="post">
            <div class="row">
				<label class="col-md-1 text-right" for="selectError">Télévendeur</label>
				<div class="col-md-3">
					<?php echo TTSList::getListBox(array(
						"query" => "select code_commercial, concat(prenom,' ',nom) as login from tts_utilisateur where actif = 1  and id_service in (3, 11) ",
						"form" => $filter,
						"oForm" => $oFilter,
						"value" => "code_commercial",
						"libel" => "login",
						"key" => "code_commercial",
						"db" => "crm",
						"class" => "select"
					)); ?>
				</div>
				<label class="col-md-1 text-right" for="focusedInputdes">Date Entre</label>
				<div class="col-md-3">
                    <div class="input-group" style="float:left">
                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                        <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus" <?php echo $filter["date_from"]?> required="required">                             
                    </div>

				</div>
				<label class="col-md-1 text-right" for="focusedInputdes">Et </label>
				<div class="col-md-3">
                    <div class="input-group" style="float:left">
                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                        <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus" <?php echo $filter["date_to"]?> required="required">                             
                    </div>

				</div>
            </div>
            
                <div class="row">

                	<label class="col-md-1 text-right" for="selectError">Groupe</label>
					<div class="col-md-3">
						<?php echo TTSList::getListBox(array(
							"query" => "select distinct id,libelle from par_tts_groupe order by libelle ",
							"form" => $filter,
							"oForm" => $oFilter,
							"value" => "id",
							"libel" => "libelle",
							"key" => "id_groupe",
							"db" => "crm",
							"class" => "select"
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
    		<table class="table table-hover table-striped" id="tableau">
				<thead>
					<tr>
						<th>Télévendeur</th>
						<th>Nb appels</th>
						<th>Nb appels uniques</th>
						<th>Nb fiches clotur&eacute;es </th>
						<th>Nb argument&eacute;s</th>
						<th>Nb devis</th>
						<th>Nb de BC</th>

					</tr>
				</thead>
				<tbody>
				<?php 
					$nbr_appel=0;
					$nbr_appel_unique = 0;
					$nbr_devis=0;
					$nbr_bc=0;
					$nbr_argumente=0;
					$nbr_cloture=0;
					$nbr_conc=0;
				 ?>
				<?php $total_ht = 0; foreach ($datas as $row):?>
					<tr>
						
						<td><?php echo $row["agent"];  ?></td>
						<td onClick="window.open('<?php echo url_for('SuiviTelevente',array("act" => "nbr_appel", "id_user" => $row["id"], "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
						 style="cursor: pointer;" ><?php echo number_format($row["nbr_appel"],0,'',' '); $nbr_appel+=$row["nbr_appel"]; ?></td>
						
						<td onClick="window.open('<?php echo url_for('SuiviTelevente',array("act" => "nbr_appel_unique", "id_user" => $row["id"], "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
						 style="cursor: pointer;" ><?php echo number_format($row["nbr_appel_unique"],0,'',' '); $nbr_appel_unique+=$row["nbr_appel_unique"]; ?></td>
						
						<td onClick="window.open('<?php echo url_for('SuiviTelevente',array("act" => "nbr_cloture", "id_user" => $row["id"], "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
						 style="cursor: pointer;" ><?php echo number_format($row["nbr_cloture"],0,'',' '); $nbr_cloture+=$row["nbr_cloture"]; ?></td>
						
						<td onClick="window.open('<?php echo url_for('SuiviTelevente',array("act" => "nbr_argumente", "id_user" => $row["id"], "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
						 style="cursor: pointer;" ><?php echo number_format($row["nbr_argumente"],0,'',' '); $nbr_argumente+=$row["nbr_argumente"]; ?></td>
						
						<td onClick="window.open('<?php echo url_for('SuiviTelevente',array("act" => "nbr_devis", "id_user" => $row["id"], "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
						 style="cursor: pointer;" ><?php echo number_format($row["nbr_devis"],0,'',' '); $nbr_devis+=$row["nbr_devis"]; ?></td>
						
						<td onClick="window.open('<?php echo url_for('SuiviTelevente',array("act" => "nbr_bc", "id_user" => $row["id"], "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
						 style="cursor: pointer;" ><?php echo number_format($row["nbr_bc"],0,'',' '); $nbr_bc+=$row["nbr_bc"]; ?></td>
						
						 
					</tr>
				<?php endforeach;?>
				</tbody>
				<tfoot>
					<tr>
					    <td> Total </td>
					    
					    <td onClick="window.open('<?php echo url_for('SuiviTelevente',array("act" => "nbr_appel", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
						 style="cursor: pointer;" ><?php echo number_format($nbr_appel,0,'',' '); ?></td>
					    
					    <td onClick="window.open('<?php echo url_for('SuiviTelevente',array("act" => "nbr_appel_unique", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
						 style="cursor: pointer;" ><?php echo number_format($nbr_appel_unique,0,'',' '); ?></td>
					    
					    <td onClick="window.open('<?php echo url_for('SuiviTelevente',array("act" => "nbr_cloture", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($nbr_cloture,0,'',' '); ?></td>
					    
					    <td onClick="window.open('<?php echo url_for('SuiviTelevente',array("act" => "nbr_argumente", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($nbr_argumente,0,'',' '); ?></td>
					    
					    
					    <td onClick="window.open('<?php echo url_for('SuiviTelevente',array("act" => "nbr_devis", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
						 style="cursor: pointer;"><?php echo number_format($nbr_devis,0,'',' '); ?></td>
					    
					    <td onClick="window.open('<?php echo url_for('SuiviTelevente',array("act" => "nbr_bc", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
						 style="cursor: pointer;" ><?php echo number_format($nbr_bc,0,'',' '); ?></td>
					    
				    </tr>
				</tfoot>
			</table>
    	</div>
    	   
    	</div>
	</div>
</div>

