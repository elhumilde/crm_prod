<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('#tableau'));   
	    oTable2.generate();
	  });
</script>
<!-- Page header -->
<div class="page-header">
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
			<li><a href="#">Alerte</a></li>
		</ul>
	</div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Détail de l'alerte</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<table class="display table table-striped table-hover" id="tableau">
				<thead>
					<tr>
						<th style="display: none;"></th>
						<th style="display: none;"></th>
						<th style="display: none;"></th>
						<th style="display: none;"></th>
						<th style="display: none;"></th>
						<th style="display: none;"></th>
                        <?php
                        $result = $sf_data->getRaw("detail");
                        $title = array_shift($result);
                     $i=0;
                        foreach ($title as $k=>$c) :
                            $i++;
                            ?>
			        <?php if ($i !=1){?>	<th> <?php  echo $k; ?> </th> <?php } ?>
			     <?php endforeach; ?>
		          </tr>
				</thead>

				<tbody>
        		<?php  foreach($detail as $row):  ?>
        		<tr>
        			<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
        			<?php $j=0; foreach($row as $c): $j++;
        			if ($j ==1)$data= $c;
        			?>
                    <?php if ($j !=1){?>	<td <?php if ($j==2 or $j==3){ ?> 	onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $data)) ?>')"
                                                                                 style="cursor: pointer;"<?php }?> > <?php  echo $c;  ?></td><?php } ?>
        			<?php endforeach; ?>
        		</tr>
        		<?php endforeach; ?>
	       </tbody>
			</table>

		</div>
	</div>
</div>



