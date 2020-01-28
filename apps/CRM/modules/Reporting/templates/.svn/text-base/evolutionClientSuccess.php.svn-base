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
		depend.setup();

    	$('#bon_commande_societe').change();
	});
</script>
<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li class="active">Evolution Client</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Reporting par Client</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
    		<form method="post">
    				<!--  DESIGNATION -->
                <div class="row">
                    <label class="col-md-1" for="selectError">Société</label>
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
					
					
					
                    <label class="col-md-1 col-md-offset-1" for="selectError">Produit</label>
					<div class="col-md-2">
						<?php echo TTSList::getListBox(array(
								"query" => "select code_produit  from detail_bc group by code_produit ",
								"form" => $filter,
								"oForm" => $oFilter,
								"value" => "code_produit",
								"libel" => "code_produit",
								"key" => "code_produit",
								"db" => "bd_web",
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
    	   <table class="display table table-striped table-hover">
				<thead>
					<tr>
						<th>Firme</th>
						<th>CA N-4</th>
						<th>CA N-3</th>
						<th>CA N-2</th>
						<th>CA N-1</th>
						<th>CA N</th>
					</tr>
				</thead>
				<tbody>

				<?php $total_ht4 = 0; $total_ht3 = 0; $total_ht2 = 0; $total_ht1 = 0; $total_ht = 0; foreach ($data as $row):?>
					<tr>
						<td><?php echo $row["rs_comp"]; ?></td>
						<td><?php echo number_format($row["N4"], 0, '', ' '); $total_ht4 += $row["N4"];  ?></td>
						<td><?php echo number_format($row["N3"], 0, '', ' '); $total_ht3 += $row["N3"];  ?></td>
						<td><?php echo number_format($row["N2"], 0, '', ' '); $total_ht2 += $row["N2"];  ?></td>
						<td><?php echo number_format($row["N1"], 0, '', ' '); $total_ht1 += $row["N1"];  ?></td>
						<td><?php echo number_format($row["N"], 0, '', ' '); $total_ht += $row["N"]; ?></td>
					</tr>
				<?php endforeach;?>
				</tbody>
				
				<tfoot>
				    <td> Total </td>
					<td><?php echo number_format($total_ht4, 0, '', ' '); ?></td>
					<td><?php echo number_format($total_ht3, 0, '', ' '); ?></td>
					<td><?php echo number_format($total_ht2, 0, '', ' '); ?></td>
					<td><?php echo number_format($total_ht1, 0, '', ' '); ?></td>
					<td><?php echo number_format($total_ht, 0, '', ' '); ?></td>
				</tfoot>
			</table>
    	</div>
	</div>
</div>

