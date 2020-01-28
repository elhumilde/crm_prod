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
      <li><a href="#">Recouvrement</a></li>
      <li class="active">Suivi des recouvrement par resultat</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Suivi des recouvrement par resultat</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
    	<form method="post">
            <div class="row">
				<label class="col-md-1 text-right" for="selectError">Agent</label>
				<div class="col-md-3">
					<?php echo TTSList::getListBox(array(
						"query" => "select code_commercial, concat(prenom,' ',nom) as login from tts_utilisateur where actif = 1  and ifnull(code_commercial,'') != ''",
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
                        <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus"<?php echo $filter["date_from"]?>>                             
                    </div>

				</div>
				<label class="col-md-1 text-right" for="focusedInputdes">Et </label>
				<div class="col-md-3">
                    <div class="input-group" style="float:left">
                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                        <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus"<?php echo $filter["date_to"]?>>                             
                    </div>

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
						<th>resultat</th>
						<th>Nombre des appels</th>
						<th>Nombre des visites</th>
						<th style="display: none;"></th>
						<th style="display: none;"></th>
						<th style="display: none;"></th>

					</tr>
				</thead>
				<tbody>
				<?php 
					$nbr_appel=0;
					$nbr_visite=0;
				 ?>
				<?php $total_ht = 0; foreach ($datas as $row):?>
					<tr>
						<td><?php echo $row["resultat"];  ?></td>
						<td style="cursor: pointer; cursor: hand;"
						ondblclick='window.open("<?php echo url_for('DetailRecouvrement',array('act'=>'appel','resultat'=>$row['id_resultat'],'date_from'=>$oFilter->getValue('date_from'),'date_to'=>$oFilter->getValue('date_to'))); ?>", "_blank");'><?php echo number_format($row["nbr_appel"],0,'',''); $nbr_appel+=$row["nbr_appel"]; ?></td>
						<td style="cursor: pointer; cursor: hand;"
						ondblclick='window.open("<?php echo url_for('DetailRecouvrement',array('act'=>'visite','resultat'=>$row['id_resultat'],'date_from'=>$oFilter->getValue('date_from'),'date_to'=>$oFilter->getValue('date_to'))); ?>", "_blank");'><?php echo number_format($row["nbr_visite"],0,'',''); $nbr_visite+=$row["nbr_visite"]; ?></td>
						<td style="display: none;"></td>
						<td style="display: none;"></td>
						<td style="display: none;"></td>

					</tr>
				<?php endforeach;?>
				</tbody>
				<tfoot>
					<tr>
					    <td> Total </td>
					    <td><?php echo number_format($nbr_appel,0,'',' '); ?></td>
					    <td><?php echo number_format($nbr_visite,0,'',' '); ?></td>
					    <td style="display: none;"></td>
						<td style="display: none;"></td>
						<td style="display: none;"></td>
				    </tr>
				</tfoot>
			</table>
    	</div>
    	   
    	</div>
	</div>
</div>

