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
			<h5 class="panel-title">Détail</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<table class="display table table-striped table-hover" id="tableau">
				<?php if(count($detail)):?>
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
                        foreach ($title as $k=>$c) : if($k != 'id' && $k != 'id_firme'):
                            ?>
				<th><?php echo $k; ?></th>
			     <?php endif; endforeach; ?>
		          </tr>
				</thead>

				<tbody>

        		<?php foreach($detail as $row): ?>
        		<tr>
        			<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
        			<?php foreach($row as $k=>$c): if($k != 'id' && $k != 'id_firme'): ?>
        			<?php if($k == 'code_firme' or $k == 'rs_comp'):?>
        			<td onClick="window.open('<?php echo url_for('ConsulterFirme',array("id" => $row["id_firme"])) ?>')" style="cursor: pointer;"> 
        			 <?php echo $c; ?>
        			</td>
        			
        			<?php else:?>
        			
        			<td>
        				<?php if($k=="Commentaire" && $c==1 ): ?> <img src='/images/Chloride.png' width="16" height="16" />  <?php elseif($k=="Commentaire"): echo "";elseif (is_numeric ($c)): echo intval($c); else: echo $c; endif ;?></td>
        			<?php endif;?>
        			<?php endif; endforeach; ?>
        		</tr>
        		<?php endforeach; ?>
	           </tbody>
	           <?php endif;?>
			</table>

		</div>
	</div>
</div>



