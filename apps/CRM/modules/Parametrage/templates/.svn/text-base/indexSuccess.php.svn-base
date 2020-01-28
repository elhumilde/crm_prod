<script>
$(document).ready(function(){
	$('form').submit(function(){
		var oTable = new jqueryTable();
		var table_parametrage = $('[name=table_parametrage]').val();
		if(!table_parametrage) {alert("Vous devez choisir une table !");unloadPage();return false;}
		$.ajax({
			url: '<?php echo url_for('Parametrage/parametrage'); ?>',
			type: 'post',
			data: {table_parametrage:table_parametrage},
			success: function(msg){
				unloadPage();
				$('#content_param').html(msg);
				oTable.generate();
			},
			error: function(){
				unloadPage();
				alert('Erreur est survenu!');
			}
		});
		return false;
	});
});

</script>
<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li class="active">Paramétrage</li>
    </ul>
  </div>
</div>
<!-- /page header -->
	<!-- Content area -->
	<div class="content">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">Param&egrave;trage</h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
					</ul>
				</div>
			</div>
			<form method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-3">Choisissez une table de param&egrave;trage :</div>
						<div class="col-md-2">
							<select name="table_parametrage" class="select">
								<option></option>
								<?php foreach($table as $k=>$each): ?>
									<option value="<?php echo $k; ?>"><?php echo $each["libelle"]; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-md-2">
							<button class="btn btn-primary">Continue</button>
						</div>
					</div>
			</form>
		</div>
	</div>


<div id="content_param"></div>