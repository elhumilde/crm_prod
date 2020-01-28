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
			<li class="active">Suivi des objectifs</li>
		</ul>
	</div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Suivi des activités</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
		<form method="post">
			<!--  DESIGNATION -->
			<div class="row">

				<label class="col-md-1" for="focusedInputdes">Date Entre</label>
				<div class="col-md-2">
					<div class="input-group" style="float: left">
						<span class="input-group-addon"><i class="icon-calendar22"></i></span>
						<input type="text" placeholder="jj/mm/aaaa" required="required"
							class="form-control datepicker-menus"
							<?php echo $filter["date_from"]?>>
					</div>

				</div>
				<label class="col-md-1 col-md-offset-1" for="focusedInputdes">ET </label>
				<div class="col-md-2">
					<div class="input-group" style="float: left">
						<span class="input-group-addon"><i class="icon-calendar22"></i></span>
						<input type="text" placeholder="jj/mm/aaaa" required="required"
							class="form-control datepicker-menus"
							<?php echo $filter["date_to"]?>>
					</div>

				</div>
				<label class="col-md-1 col-md-offset-1" for="selectError">Utilisateur</label>
				<div class="col-md-2">
					   		<?php
										$cond_commercial = "";
										if (! $sf_user->hasCredential ( 'allobjectif' )) :
											$cond_commercial = " and ifnull(u.code_commercial, '') in ($codes_users_affecte)";
										
					   		 endif;
					   		 
					   			echo TTSList::getListBox(array(
									"query" => "select u.id,concat(u.nom,' ',u.prenom) as login from tts_utilisateur u where actif = 1 $cond_commercial order by nom",
									"form" => $filter,
									"oForm" => $oFilter,
									"value" => "id",
									"libel" => "login",
									"key" => "id",
									"db" => "crm",
	                                "class" => "select"
								)); 
					   		?>
					    </div>

			</div>

			<div class="row">

				<label class="col-md-1" for="selectError">Service</label>
				<div class="col-md-2">
    						<?php echo TTSList::getListBox(array(
    								"query" => "select id, libelle from par_tts_service",
    								"form" => $filter,
    								"oForm" => $oFilter,
    								"value" => "id",
    								"libel" => "libelle",
    								"key" => "id_service",
    								"db" => "crm",
    								"class"=>"select"
                              )); ?>
    					</div>
				<label class="col-md-1 col-md-offset-1" for="selectError">Groupe</label>
				<div class="col-md-2">
						<?php echo TTSList::getListBox(array(
								"query" => "select id, libelle  from par_tts_groupe group by libelle",
								"form" => $filter,
								"oForm" => $oFilter,
								"value" => "id",
								"libel" => "libelle",
								"key" => "id_groupe",
								"db" => "crm",
								"class"=>"select"
                          )); ?>
					</div>
					<label class="col-md-1  col-md-offset-1"" for="selectError">Société</label>
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
					
			</div>
			<div class="row">
					<label class="col-md-1" for="selectError">Support</label>
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

			</div>
			<div class="row">
				<div class="col-md-2">
					<input type="submit" class="btn btn-primary" value="Rechercher">
				</div>


			</div>
		</form>
    	<?php if(ISSET($datas[0])):?>
    	<div class="row">
			<div class="col-md-12">
				<table
					class="table datatable-fixed-left datatable-button-init-basic">

					<thead>
						<tr>

						<?php $totaux = array(); $i=0; foreach ($datas[0] as $key => $value) { ?>
							<?php if($key!="id_user"): ?>
								<th><?php echo $key; ?></th>
								<?php if($i>3) $totaux[$key]=0; ?>
							<?php endif; ?>
						<?php $i++ ;} ?>
						
						
					</tr>
					</thead>
					<tbody>
				<?php foreach ($datas as $row):?>
					<tr>
						<?php $i=0; foreach ($row as $key => $value) : ?>
							<?php if($key!="id_user"): ?>
								<td <?php if($i>3 and $value>0): ?>
								onClick="window.open('<?php echo url_for('Objectif',array("act" => $key, "id_user" => $row["id_user"],  "tts_utilisateur[date_from]" => $oFilter->getData("date_from"),  "tts_utilisateur[date_to]" => $oFilter->getData("date_to"))) ?>')"
								style="cursor: pointer;" <?php endif; ?> >
									
									<?php if($i>3): ?> 
									<?php echo number_format($value,0,'','');  $totaux[$key]+=$value; ?>
									<?php else:?>
									<?php  echo $value; ?>
									<?php endif;?>
									
								</td>
							<?php endif; ?>
						<?php $i++ ; endforeach; ?>						
					</tr>
				<?php endforeach;?>
				</tbody>
					<tfoot>
						<tr>
							<td>Total</td>
							<td></td>
							<td></td>
					    <?php foreach ($totaux as $total):?>
						    <td><?php echo number_format($total,0,'',' '); ?></td>
					    <?php endforeach; ?>
					    
				    </tr>
					</tfoot>
				</table>
			</div>

		</div>
    	<?php endif;?>
	</div>
</div>

