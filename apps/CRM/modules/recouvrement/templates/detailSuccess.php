<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('.display'));   
	    oTable2.generate();
	  });
</script>
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
			<h5 class="panel-title">Detail des encaissement</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
    	<div class="row" style="padding : 1em;max-width: 100%;overflow: auto;">
    	    <table class="table table-striped table-hover display">
				<thead>
					<tr>
						<th style="min-width:1px"></th>
	                    <th style="min-width:150px">Agent</th>
						<th style="min-width:150px" data-column="num_bc">Code firme</th>
						<th style="min-width:150px">Raison comp</th>
	                    <th style="min-width:150px">Date</th>
						<th style="min-width:150px" data-column="resultat">Resultat</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data as $row):?>
						<tr id="<?php echo $row["id"]; ?>">
							<td></td>
		                    <td><?php echo $row["agent"]; ?></td></td>
							<td><?php echo $row["code_firme"]; ?></td>
							<td><?php echo $row["rs_comp"]; ?></td>
		                    <td><?php echo $row["max_date"]; ?></td>
							<td><?php echo $row["resultat"]; ?></td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
    	</div>
	</div>
</div>

