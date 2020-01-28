<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('#tableau2'));   
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
      <li class="active">Commentaire</li>
    </ul>
  </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Recherche des Commentaires</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
				</ul>
			</div>
		</div>
    		<form method="post">
    				<!--  DESIGNATION -->
                <div class="row">
    					<label class="col-md-1" for="selectError">Firme</label>
    					<div class="col-md-2">
    					   
        					<select class="itemName form-control select" <?php echo $filter["code_firme"]; ?>>
        					
            					  <?php if($oFilter->getData('code_firme')):?> 
            					      <option value="<?php echo $oFilter->getData('code_firme')?>"><?php echo $firme?></option>
            					  <?php endif;?>
        					</select>
    					</div>
    
    
    					<label class="col-md-1 col-md-offset-1" for="focusedInputdes">Date
    					 Entre</label>
    					<div class="col-md-2">
                            <div class="input-group" style="float:left">
                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus"<?php echo $filter["date_from"]?>>                             
                            </div>

    					</div>
    					<label class="col-md-1 col-md-offset-1" for="focusedInputdes">ET </label>
    					<div class="col-md-2">
                            <div class="input-group" style="float:left">
                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                <input type="text" placeholder="jj/mm/aaaa" class="form-control datepicker-menus"<?php echo $filter["date_to"]?>>                             
                            </div>

    					</div>
                </div>
                    <div class="row">
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" value="Rechercher" >
                        </div>
                        <div class="col-md-2 col-md-offset-8">
                            <a href="<?php echo  url_for("Ajoutercommentaire");?>">
                                <button type="button" class="btn btn-default">
                                  <i class="icon-add position-left"></i> 
                                  Ajouter Commentaire
                                </button>
                            </a>
                        </div>

                    </div>
    		</form>
    	<div class="row">
    	   <table class="table table-striped table-hover" id="tableau2">
				<thead>
					<tr>
						<th>Créateur</th>
						<th>Firme</th>
						<th>Date création</th>
					</tr>
				</thead>

				<?php foreach ($data as $row):?>
				<tbody>
					<tr style="cursor: pointer; cursor: hand;"
						onClick="document.location='<?php echo url_for("Ajoutercommentaire",array("id"=>$row['id'])); ?>'">
						<td><?php echo $row["createur"]; ?></td>
						<td><?php echo $row["firme"]; ?></td>
						<td><?php echo $row["date_creation"]? date("d/m/Y", strtotime($row["date_creation"])) :''; ?>
						</td>
					</tr>
				</tbody>
				<?php endforeach;?>
			</table>
    	</div>
	</div>
</div>

