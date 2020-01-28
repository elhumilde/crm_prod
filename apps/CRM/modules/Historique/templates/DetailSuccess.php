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
			<li><a href="#">Detail</a></li>
		</ul>
	</div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Détai</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
		<div class="row">
		<?php if(count($detail)):?>
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
                        foreach ($title as $k=>$c) : if($k != 'id'):
                            ?>
				<th><?php echo $k; ?></th>
			     <?php endif; endforeach; ?>
		          </tr>
				</thead>

				<tbody>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
        		<?php foreach($detail as $row): ?>
        		<tr>
        			<?php foreach($row as $k=>$c): if($k != 'id'): ?>
        			
        			<td>
        				 <?php echo $c;  endif;?>
        			</td>
        			<?php  endforeach; ?>
        		</tr>
        		<?php endforeach; ?>
	           </tbody>
	           
			</table>
			
	       	<?php else :  ?>
	       		<div class="alert alert-warning alert-styled-left alert-arrow-left alert-bordered">
			 			la ligne a été supprimée
			         </div>
	       	<?php endif;?>
		</div>
	</div>
</div>



