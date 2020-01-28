<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('.display'));   
	    oTable2.generate();

	    dataDepend.setUrl("<?php echo url_for('setDependanceChoice',array('bd'=> 'bd_web')); ?>");

		var depend = new dataDepend('compagne_societe','compagne_support');
		depend.setSource('societes',['code','code']);
		depend.setDestin('support',['societe',"code,support"]);
		depend.setData({value:'code', libel:'support'});

		<?php if($oFilter2->getValue("support")):?>
		depend.setSelected({value: '<?php echo $oFilter2->getValue("support"); ?>'}); 
		<?php endif;?>

		depend.setup();

    	$('#compagne_societe').change();

	  });
</script>
<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li><a href="#">Televente</a></li>
      <li class="active">Compagne</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Liste des campagnes</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
		<div class="row">

			<form method="post">

                <div class="row">
                    <label class="col-md-1" for="selectError">Société</label>
					<div class="col-md-2">
						<?php echo TTSList::getListBox(array(
								"query" => "select distinct s.code, s.societe  from societes s inner join compagne c on c.societe = s.code ",
								"form" => $filter2,
								"oForm" => $oFilter2,
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
								"query" => "select distinct s.code, s.support  from support s inner join compagne c on c.support = s.support",
								"form" => $filter2,
								"oForm" => $oFilter2,
								"value" => "code",
								"libel" => "support",
								"key" => "support",
								"db" => "bd_web",
								"class"=>"select"
                          )); ?>
					</div>
                
					
					<label class="col-md-1 col-md-offset-1" for="selectError">Actif</label>
					<div class="col-md-2">
						<select class="select" name="compagne[actif]" id= "compagne_support" >
							<option value=""></option>
							<option value="1" <?php if($oFilter2->getValue("actif")==1) echo "selected"; ?>>Oui</option>
							<option value="2" <?php if($oFilter2->getValue("actif")==2) echo "selected"; ?>>Non</option>
						</select>
					</div>
                </div>
                <div class="row">
                
                
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" value="Rechercher" >
                        </div>
                        

                    </div>
    		</form>
		</div>
    	<div class="row">
    	   <table class="display table table-striped table-hover">
				<thead>
					<tr>
						<th>Campagne</th>
						<th>Nb Firmes Affecté</th>
						<th>Support</th>
						<th>Edition</th>
						<th style="display: none"></th>
						<th style="display: none"></th>
					</tr>
				</thead>
				<tbody>

				<?php foreach ($compagne as $row):?>
					<tr style="cursor: pointer; cursor: hand;"
						ondblclick='window.open("<?php echo url_for('televente',array('num_compagne'=>$row['num_compagne'])); ?>", "_blank");'>
						<td><?php echo $row["libelle"]; ?></td>
						<td><?php echo $row["nombre"]; ?></td>
						<td><?php echo $row["support"]; ?></td>
						<td><?php echo $row["edition"]; ?></td>
						<td style="display: none"></td>
						<td style="display: none"></td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
    	</div>
	</div>
</div>

