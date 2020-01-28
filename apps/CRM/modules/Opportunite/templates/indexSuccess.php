<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('#tableau'));   
	    oTable2.generate();
	    $('.itemName').select2({
	        placeholder: 'Select an item',
	        ajax: {
	          url: "<?php echo url_for('Common/AutoComplete') ?>",
	          dataType: 'json',
	          delay: 250,
	          processResults: function (data) {
	            return {
	              results: data
	            };
	          },
	          cache: true
	        }
	      });
	  });
</script>
<!-- Page header -->
<div class="page-header">
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
      <li><a href="#">opportunité</a></li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Liste des Opportunités</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
		<div class="row">
		    <form method="post">
					<div class="row">
		  			<div class="control-group">
							<label class="col-md-1" for="focusedInput">Code</label>
						 		 <div class="col-md-2">
									<input id="focusedInput" type="text" class="form-control" <?php echo $filter["code"]?>>
					     		 </div>
							<div class="col-md-1"></div>
			        </div>
						
					<div class="control-group">
					   <label class="col-md-1" for="focusedInput">Date Opp. du: </label>
				 		  <div class="col-md-2">

							  <div class="input-group" style="float:left">
        					        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
        					        <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus" <?php echo $filter["date_opportunite_from"] ?>>   						    
        					    </div>
			     		   </div>
							<div class="col-md-1"></div>
			        </div>

			        <div class="control-group">
						<label class="col-md-1" for="focusedInput">Au </label>
				 		  <div class="col-md-2">
							  <div class="input-group" style="float:left">
        					        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
        					        <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus" <?php echo $filter["date_opportunite_to"] ?>>   						    
        					    </div>
			     		   </div>
							<div class="col-md-1"></div>
			        </div>
		        </div>
		        <div class="row">
				    <div class="control-group">
						<label class="col-md-1" for="selectError">Firme</label>
						   <div class="col-md-2">
    					   
        					<select class="itemName form-control select" <?php echo $filter["code_firme"]; ?>>
        					
            					  <?php if($oFilter->getData('code_firme')):?> 
            					      <option value="<?php echo $oFilter->getData('code_firme')?>"><?php echo $firme?></option>
            					  <?php endif;?>
        					</select>
    					</div>
					   <div class="col-md-1"></div>
						   
					</div>
					<div class="control-group">
						<label class="col-md-1" for="selectError">Commercial</label>
						   <div class="col-md-2">
						   		<?php 
						   		$cond_commercial="";
						   		if(!$sf_user->hasCredential('allopportunite')):
						   		$cond_commercial="and f.id in ($ids_users_affecte)";
						   		endif;
						   			
									echo TTSList::getListBox(array(
										"query" => "select f.code_commercial,concat(prenom,' ',nom) as nom from tts_utilisateur f where actif = 1 $cond_commercial",
										"form" => $filter,
										"oForm" => $oFilter,
										"value" => "code_commercial",
										"libel" => "nom",
										"key" => "code_commercial",
										"db" => "crm",
		                                "class" => "select"
									)); 
						   		?>
						   </div>
						   <div class="col-md-1"></div>
						   
					</div>
					<div class="control-group">
						<label class="col-md-1" for="selectError">Statut</label>
						   <div class="col-md-2">
							<?php echo TTSList::getListBox(array(
								"query" => "select id, statut from par_tts_opportunite_statut",
								"form" => $filter,
								"oForm" => $oFilter,
								"value" => "id",
								"libel" => "statut",
								"key" => "statut_avance",
								"db" => "crm",
								"class" => "select"
							)); ?>
						   </div>
						   
							<div class="col-md-1"></div>
					</div>
		    	</div>
			
				<div class="row">
					<div class="col-md-2">
						<input type="submit" value="Rechercher" >
					</div>
					<div class="col-md-2 col-md-offset-7 text-right">
					
						<a href="<?php echo url_for("Ajouter_Opportunite"); ?>">
				            <button type="button" class="btn btn-default">
				              <i class="icon-add position-left"></i> 
				              Ajouter une opportunité
				            </button>
				        </a>
					</div>
				</div>
	     	</form> 
     	</div>  
     	<div class="row">
     		<table class="display table table-striped table-hover" id="tableau">
				<thead>
					<tr>
						<th class="essential persist">Code</th>
					    <th class="essential persist">Type</th>
					    <th class="essential persist">Code Firme</th>
					    <th class="essential persist"> Entreprise Cliente</th>
					    <th class="optional">Date Ech&eacute;ance</th>
					    <th class="optional">Date Cr&eacute;ation</th>
					    <th class="optional"> Objet </th>
					    <th class="essential persist">Commercial</th>
					    <th class="optional"> Statut</th> 
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data as $row):?>
						<tr onClick="window.open('<?php echo url_for('Ajouter_Opportunite',array("id" => $row['id_op'])) ?>')" style="cursor: pointer;">
							<td><?php echo $row["code"]; ?></td>
							<td><?php echo $row["type_name"]; ?></td>
							<td><?php echo $row["code_firme"]; ?></td>
							<td><?php echo $row["firme"]; ?></td>
							<td><?php echo (($row["date_echeance"])?date("Y-m-d", strtotime($row["date_echeance"])):"..."); ?></td>
							<td><?php echo date("Y-m-d", strtotime($row["date_creation"])) ?></td>
							<td><?php echo $row["objet"]; ?></td>
							<td><?php echo $row["commercial"]; ?></td>
							<td><?php echo $row["statut_name"]; ?></td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
     	</div>   
    </div>
</div>



		