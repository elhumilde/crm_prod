<script>

$(document).ready(function(){
	var oTable = new jqueryTable();
	oTable.create($("#tableau"));
	<?php $i=1; foreach($attr as $k=>$c): ?>
		<?PHP if(empty($dataFkey[$k])) :?>
			oTable.setColumn(<?php echo $i?>,{name: '<?php echo $tab?>[<?php echo $k; ?>]'});
		<?PHP endif; ?>
		<?PHP $i++; ?>
	<?php endforeach; ?>
	oTable.setActionAdd({'url' : "<?php echo url_for('ParametrerTable',array("act"=>"addElem","table_parametrage"=>$tab)); ?>",'method' : "post", "id_form": "addForm_<?php echo $tab; ?>"});
	oTable.setActionUpdate({'url' : "<?php echo url_for('ParametrerTable',array("act"=>"update","id"=>"1","table_parametrage"=>$tab)); ?>"});
		
	oTable.isEditable();
	oTable.generate();
});

</script>
	<!-- Content area -->
	<div class="content">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><?php echo $table["libelle"]; ?></h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
					</ul>
				</div>
			</div>
			<form method="post" enctype="multipart/form-data">
				<div class="row-fluid">
						<div class="content">
							<table id="tableau" class="display table table-striped table-hover" width="100%">
								<thead>
									<tr>
									
										<?php foreach($attr as $k=>$c): ?>
											<th><?php echo (!empty($dataFkey[$k]) ? (!empty($table["FKey"][$k]["libelle_attr"]) ? $table["FKey"][$k]["libelle_attr"] : $table["FKey"][$k]["libelle"]) : $k); ?></th>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach($data as $each): ?>
										<tr id="<?php echo $each["id"]; ?>">
											<?php foreach($attr as $k=>$c): ?>
												<td><?php echo !empty($dataFkey[$k]) && $each[$k] ? (!empty($dataFkey[$k][$each[$k]]) ? $dataFkey[$k][$each[$k]][0] : "-") : $each[$k]; ?></td>
											<?php endforeach; ?>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						
					</div>
						
				</div>
			</form>


			<div id="addForm_<?php echo $tab; ?>">
				<form>
					<div class="row">

						<?php foreach($attr as $k=>$c): ?>
							<div class="row">
								<div class="col-md-3">
								<?php echo (!empty($dataFkey[$k]) ? (!empty($table["FKey"][$k]["libelle_attr"]) ? $table["FKey"][$k]["libelle_attr"] : $table["FKey"][$k]["libelle"]) : $k); ?>
								 :</div>
								<div class="col-md-3">
									<?php if(!empty($dataFkey[$k])): ?>
									<select class="select" <?php echo $form[$k]; ?>>
										<option></option>
										<?php foreach($dataFkey[$k] as $kf=>$each): ?>
											<option value="<?php echo $kf; ?>"><?php echo $each[0]; ?></option>
										<?php endforeach; ?>
									</select>
									<?php else: ?>
									<input type="text" class="form-control" <?php echo $form[$k]; ?>>
									<?php endif; ?>
								</div>
							
						<?php endforeach; ?></div>
					<input type="submit" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>