<script type="text/javascript" charset="utf-8">
	$(document).ready( function () {
	    var oTable2 = new jqueryTable();
	    oTable2.create($('#tableau2')); 
	    var table = $('.display').DataTable();
	 	$(document).on( 'click', 'tr', function () {
	 		table.$('tr.row_selected').removeClass('row_selected');
	 		$(this).addClass('row_selected');
	    } );
	    $(document).on( 'click', '#vider', function () {
            $('#addform #resultat').html(" ");
            $('#addform #nouv-personne').show();
            $('#addform #resultat').hide();
            $("#personne_civilite").attr("required", true);
	    } );
	 	$(document).on( 'keypress', '.number', function () {
            return event.charCode >= 48 && event.charCode <= 57
	    } );
	    //$(document).on( 'click', '#btnAddtableau2', function () {
	    	//$("#form_dirigeant")[0].reset();
	    //} );
	    
	    
	    $(document).on( 'click', '#verifier', function () {
	 		var parameters = "nom="+$('#personne_nom').val()+"&prenom="+$("#personne_prenom").val();
	 		$("#personne_civilite").attr("required", false);
	 		$.ajax({
	 			 
                url: '<?php echo url_for('ConsulterFirme',array('act'=>'verifirepersonne')) ?>',
                type: 'post',
                data: parameters,
                success: function( data ) {
                    if(data){
                        $('#fonction_div').show();
                        $('#addform #resultat').html(data);
                        $('#addform #nouv-personne').hide();
                        $('#addform #resultat').show();

                    }
                    else
                    {
                        $('#addform #resultat').html('');
                        $('#addform #resultat').hide();
                    }
                },
                error: function( msg ) {
                    $('#addform #loading-result').hide();
                    alert('Erreur Ajax!');
                }
            });
	    } );

        function fonction(){
            var parameters = "fonction="+$('#lien_dirigeant_code_fonction_dir').val();

            $('#lien_dirigeant_code_fonction').empty();

            $("#fonction_div").show();
            $.ajax({
                url: "<?php echo url_for('Common/AutoCompleteFonction') ?>",
                type: 'GET',
                delay: 250,
                data: parameters,
                success: function (data) {

                    $.each(JSON.parse(data), function (i, pres) {
                       if (i==1) {
                           $('#lien_dirigeant_code_fonction').append('<option   value="' + pres.code + '"  style="display:none;" checked>' + pres.fonction + '</option>')
                       }
                       else{
                           $('#lien_dirigeant_code_fonction').append('<option   value="' + pres.code + '"  style="display:none;"  >' + pres.fonction + '</option>')

                       }

                       });
                },
                error: function( msg ) {
                    $('#addform #loading-result').hide();
                    alert('Erreur Ajax!');
                }
            });
        }

        $(document).on( 'change', '#lien_dirigeant_code_fonction_dir', function () {
            fonction();

        });
        fonction();




	    <?php if($modif) { ?>
	        oTable2.setActionAdd({'url'  :  "<?php echo url_for('ConsulterFirme',array('act'=>'addDirigeant','code_firme'=>$code_firme)) ?>", 'method'  :  "post", "id_form" :  "addform"});
	        <?php if($sf_user->hasCredential("modifierdiregeantfirme")):?>
	        oTable2.setColumn(1,{name: 'personne[civilite]',type: 'select',cssclass:'select', data: '<?php echo json_encode($sf_data->getRaw('civilite')); ?>'});
		        oTable2.setColumn(2,{name: 'personne[nom]'});
		        oTable2.setColumn(3,{name: 'personne[prenom]'});
		        
	        <?php endif; ?>
	        oTable2.setColumn(4,{name: 'lien_dirigeant[code_fonction]',type: 'select',cssclass:'select', data: '<?php echo addslashes(json_encode($sf_data->getRaw('fonction'))); ?>'});
	        oTable2.setColumn(5,{name: 'lien_dirigeant[comp_fonct]'});
	        oTable2.setColumn(6,{name: 'lien_dirigeant[email]'});
	        oTable2.setColumn(7,{name: 'lien_dirigeant[tel_1]',type:'tel'});
	        oTable2.setColumn(8,{name: 'lien_dirigeant[tel_2]',type:'tel'});
	        oTable2.setColumn(9,{name: 'lien_dirigeant[fax]',type:'tel'});
	        
	        oTable2.setColumn(10,{name: 'lien_dirigeant[class_actif]',type:'number'});
	        oTable2.setColumn(11,{name: 'lien_dirigeant[class_passif]',type:'number'});
	        oTable2.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array('act'=>'updatePersonne','code_firme'=>$code_firme)); ?>"});
	        oTable2.setActionDelete({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"delete_lien",'code_firme'=>$code_firme, 'table_lien' => 'lien_dirigeant', 'col' => 'code_personne')); ?>"});
			  
	    <?php } ?>
	    oTable2.isEditable();
	    oTable2.generate();
	  });
</script>
<?php if($modif) { ?> 

<div id="addform">
    <form action="">
		<div class="panel-body">
			<div id="nouv-personne">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Nom:</label> 
							<input required="required" type="text" placeholder="Nom" class="form-control" <?php echo $formPersonne["nom"]; ?>>
						</div>
					</div>
				
					<div class="col-md-6">
						<div class="form-group">
							<label>Prénom:</label> <input  type="text" placeholder="Prénom" class="form-control" <?php echo $formPersonne["prenom"]; ?>>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>sex:</label>
							<select class="select" <?php echo $formPersonne["sex"]; ?>>
							  <option value="M">Homme</option>
							  <option value="F">Femme</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>civilite:</label> 
							<?php 
		                        echo TTSList::getListBox(array(
		                          "query" => "select code,civilite from civilite",
		                          "form" => $formPersonne,
		                          "oForm" => $oFormPersonne,
		                          "value" => "code",
		                          "libel" => "civilite",
		                          "key" => "civilite",
		                          "db" => "bd_web",
		                          "class" => "select",
		                        ));
		                      ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div id="resultat"></div>
			</div>
            <div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Email:</label> 
						<input type="email" placeholder="xxx@xx.com" class="form-control" <?php echo $formLien_dirigeant["email"]; ?>>
					</div>
				</div>
			
				<div class="col-md-6">
					<div class="form-group">
						<label>Fax:</label> <input type="text" placeholder="05XXXXXXXX" class="form-control phone" <?php echo $formLien_dirigeant["fax"]; ?>>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Tel 1:</label> 
						<input type="text" placeholder="06XXXXXXXX" class="form-control phone" <?php echo $formLien_dirigeant["tel_1"]; ?>>
					</div>
				</div>
			
				<div class="col-md-6">
					<div class="form-group">
						<label>Tel2:</label> <input type="text" placeholder="06XXXXXXXX" class="form-control phone" <?php echo $formLien_dirigeant["tel_2"]; ?>>
					</div>
				</div>
			</div>
			<div class="row">

				<div class="col-md-4">
					<div class="form-group">
						<label>Direction :</label>
						<select   class="select" name="lien_dirigeant_direction" id= "lien_dirigeant_code_fonction_dir">
                           <?php /* echo $fonctions_dir ;*/?>
							<?php foreach($fonctions_dir as $dir):?>

							<option value="<?php echo $dir['tri_famille'] ?>"><?php echo $dir['famille']?></option>

							<?php endforeach;?>

						</select>


						
					</div>
				</div>

                <div class="col-md-4" id="fonction_div" style="display: none;">
                    <div class="form-group">
                        <label>Fonction:</label>
                    <!--    <select  required="required" class="select" name="lien_dirigeant[code_fonction]" id= "lien_dirigeant_code_fonction">

                            <?php /*$famille = ""; foreach($fonctions as $fonction):*/?>
                            <?php /*if($famille != $fonction['famille']): $famille = $fonction['famille'] ; */?>
                            </optgroup>
                            <optgroup label="<?php /*echo $fonction['famille'] */?>">
                                <?php /*endif;*/?>
                                <option brs="<?php /*echo $fonction['tri_famille'] */?>" value="<?php /*echo $fonction['code'] */?>"><?php /*echo $fonction['fonction']*/?></option>

                                <?php /*endforeach;*/?>
                            </optgroup>
                        </select>-->

                          <select  required="required" class="select" name="lien_dirigeant[code_fonction]" id= "lien_dirigeant_code_fonction">
                        </select>


                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>comp fonct:</label>
                        <input type="text" placeholder="comp_fonct" class="form-control" <?php echo $formLien_dirigeant["comp_fonct"]; ?>>
                    </div>
                </div>

			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>class actif:</label> <input type="number" placeholder="Class actif" class="form-control" <?php echo $formLien_dirigeant["class_actif"]; ?>>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label>class passif:</label> <input type="number" placeholder="Class passif" class="form-control" <?php echo $formLien_dirigeant["class_passif"]; ?> >
					</div>
				</div>
			</div>





            <div class="row text-left">
				<button type="submit" class="btn btn-primary">
					Enregistrer <i class="icon-arrow-right14 position-right"></i>
				</button>
				<button type="reset" class="btn btn-primary">
					Vider <i class="icon-arrow-right14 position-right"></i>
				</button>
				<button type="button" class="btn btn-success" id="verifier">
					Verifier <i class="icon-arrow-right14 position-right"></i>
				</button>
				<button type="button" class="btn btn-danger" id="vider">
					Nouvelle personne <i class="icon-arrow-right14 position-right"></i>
				</button>
			</div>
		</div>

	</form>
</div>
<?php } ?>
<div class="content">
	<table id="tableau2" class="display table table-striped table-hover">
		<thead>
			<tr>
				<th>Civilite</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Fonction</th>
				<th>comp fonct</th>
				<th>Email</th>
				<th>Tel 1</th>
				<th>Tel 2</th>
				<th>Fax</th>
				<th>class actif</th>
				<th>class passif</th>
				<th>Fonction sec.</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($dirigeants as $data) : ?>
				<tr id="<?php echo $data["id"]; ?>">
					<td><?php echo $data['civilite']?></td>
					<td><?php echo $data['nom']?></td>
					<td><?php echo $data['prenom']?></td>
					<td><?php echo $data['fonction']?></td>
					<td><?php if(isset($data['comp_fonct']))echo $data['comp_fonct']?></td>
					<td><?php if(isset($data['email']))echo $data['email']?></td>
					<td><?php if(isset($data['tel_1']))echo $data['tel_1']?></td>
					<td><?php if(isset($data['tel_2']))echo $data['tel_2']?></td>
					<td><?php if(isset($data['fax']))echo $data['fax']?></td>
					<td><?php if(isset($data['class_actif']))echo $data['class_actif']?></td>
					<td><?php if(isset($data['class_passif']))echo $data['class_passif']?></td>
					<td><?php if(isset($data['fonction2']))echo $data['fonction2']?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	
	<!--  
	<h2>Fonctions Secondaire</h2>
	<table class="display table table-striped table-hover">
		<thead>
			<tr>
				<th>Civilite</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Fonction Secondaire</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($dirigeants_sec as $data) : ?>
				<tr id="<?php echo $data["id"]; ?>">
					<td><?php echo $data['civilite']?></td>
					<td><?php echo $data['nom']?></td>
					<td><?php echo $data['prenom']?></td>
					<td><?php echo $data['fonction']?></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>
 -->
</div>

<script>
    $(document).on( 'change', '#lien_dirigeant_code_fonction_dir', function () {
        var b = $(this).val();
    } );
</script>