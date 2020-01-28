<script type="text/javascript" charset="utf-8">
		function validateEmail(sEmail) {
		    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		    if (filter.test(sEmail)) {
		        return true;
		    }
		    else {
		        return false;
		    }
		}
    function VerifForm() {
    	if ($('#lien_email_email').val() == "") {
    	    	
		        //$("#validation").show();
		        //return false;
		    }
		    else
		    {
		    	var sEmail = $('#lien_email_email').val();
			        if (!validateEmail(sEmail)) 
			        {
			            alert('Invalid Adresse Email');
			            return false;
			        }
		    }
		    if ($('#lien_telephone_tel').val() == "") {
		        $("#validation").show();
		        return false;
		    }
		    else
		    {
		    	var sTel = $('#lien_telephone_tel').val();
		    	//les chiffres soient espac�s d�espace
	    		var filter = /^([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
	    
			    if (filter.test(sTel)) {
			    }
			    else {
			    	alert('Tel invalide ');
			        return false;
			    }

		    }
    	    if ($('#tts_firme_ajoute_rs_comp').val() == "") {
		        $("#validation").show();
		        return false;
		    }
    	    if ($('#firmes_code_forme_jur').val() == "") {
		        $("#validation").show();
		        return false;
		    }
    	    if ($('#firmes_num_voie').val() == null) {
		        $("#validation").show();
		        return false;
		    }
    	    if ($('#firmes_code_voie').val() == null) {
		        $("#validation").show();
		        return false;
		    }
    	    if ($('#firmes_code_ville').val() == "") {
		        $("#validation").show();
		        return false;
		    }
    	    if ($('#lien_rubrique_telecontact_code_rubrique').val() == null) {
		        $("#validation").show();
		        return false;
		    }

    	    if ($('#firmes_tp_40').val() == "") {
		        $("#validation").show();
		        return false;
		    }
    	 var nom_firme = $('#tts_firme_ajoute_rs_comp').val();
    	 var firmes_num_voie = $('#firmes_num_voie').val();
    	 var firmes_code_voie = $('#firmes_code_voie').val();
    	 var firmes_code_ville = $('#firmes_code_ville').val();
    	 var lien_rubrique_telecontact_code_rubrique = $('#lien_rubrique_telecontact_code_rubrique').val();
    	 var lien_telephone_tel = $('#lien_telephone_tel').val();
    	 var firmes_code_ville = $('#firmes_code_ville').val();
    	 var firmes_code_forme_jur = $('#firmes_code_forme_jur').val();
    	 var firmes_tp_40 = $('#firmes_tp_40').val();

    	 //appeler l'action 
		   $.ajax({

        			url: '<?php echo url_for('AjouterFirme',array('act'=>'verifier_unicite')) ?>',
        			type: 'post',
        			data: {'nom_firme':nom_firme,'firmes_num_voie':firmes_num_voie,'firmes_code_voie':firmes_code_voie,'firmes_code_ville':firmes_code_ville,'lien_telephone_tel':lien_telephone_tel,'firmes_code_ville':firmes_code_ville,'firmes_code_forme_jur':firmes_code_forme_jur,'lien_rubrique_telecontact_code_rubrique':lien_rubrique_telecontact_code_rubrique,'firmes_tp_40':firmes_tp_40,},
        			success: function( data ) {
        				if(data == '2'){
            				$("#validation").show();
		        			return false;
                        }
        				if(data == '1'){
            				var confirmation = confirm("Il existe deja un nom de firme similaire. Voulez vous continuer?");
            			    if(confirmation){
            			    	$("#ajouter_firme").hide();
            			    	$('#ajouter_firme_form').submit();
            			    }
            			    else
        					{   
        						unloadPage();
        						return false;
        					}
                        }
        				else{
        					$("#ajouter_firme").hide();
        					$('#ajouter_firme_form').submit();
        				}
        			}
        	});
        
        	return false;
        	  
        	  
        	};
	$(document).ready( function () {

		$('.itemName-rubrique').select2({
	        placeholder: 'Select an item',
	        ajax: {
	          url: "<?php echo url_for('Common/AutoCompleteRubrique') ?>",
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
	    $('.itemName-voie').select2({
	        placeholder: 'Select an item',
	        ajax: {
	          url: "<?php echo url_for('Common/AutoCompleteVoie') ?>",
	          dataType: 'json',
	          delay: 250,
	          data: function (params) {
	                return {
	                    q: params.term,
	                    term : params.term,
	                    ville: $('#firmes_code_ville').val(), // search term
	                    page: params.page
	                };
	            },
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
      <li><a href="#">Référentiel</a></li>
      <li class="active">Firmes</li>
    </ul>
  </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

	<!-- Basic layout-->
	<form method="post" id="ajouter_firme_form">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title"><?php if($id):?> Consultation/Modification d'une firme <?php else:?> Ajout d'une firme <?php endif?></h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
					</ul>
				</div>
			</div>

			<div class="panel-body">
				<?php if ($sf_user->hasFlash('success')): ?>
	                <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
	                    <button type="button" class="close" data-dismiss="alert"><span>x</span><span class="sr-only">Close</span></button>
	                    <span class="text-semibold">Felicitation !</span> <?php echo html_entity_decode($sf_user->getFlash('success')) ; ?>.
	                </div>
              	<?php endif; ?>
              	<?php if ($sf_user->hasFlash('error')): ?>
		          <div class="alert alert-danger alert-styled-left alert-bordered">
		              <button type="button" class="close" data-dismiss="alert"><span>x</span><span class="sr-only">Close</span></button>
		              <span class="text-semibold">Attention !</span> <?php echo html_entity_decode($sf_user->getFlash('error')); ?>.
		          </div>
		        <?php endif; ?>
		        <div class="row" id="validation" style="display: none;">
		          <div class="alert alert-danger alert-styled-left alert-bordered">
		              <span class="text-semibold">Attention !</span> Veuillez remplir tout les champs obligatoire (*)
		          </div>
		        </div>
				<div class="row">
				
					<label class="col-md-1">code firme </label> 
					<div class="col-md-2">
						<input type="text" class="form-control" <?php echo $formAjout["code_firme"]; ?> disabled="disabled"
								value="<?php echo $oFormAjout->getData("code_firme"); ?>">
					</div>
					<label class="col-md-1 col-md-offset-1">Raison Sociale complete <span style="color:red;">*</span> </label>
					<div class="col-md-2">
						<input type="text" class="form-control" required="required" value="<?php echo $nom_firme; ?>" <?php echo $formAjout["rs_comp"]; ?>>
					</div> 	
					
			    	<label class="col-md-1 col-md-offset-1">Année création </label>
				    <div class="col-md-2">
						<input type="text" class="form-control" <?php echo $form["annee_inscr"]; ?> >
					</div>
	              </div>
	              
	              <div class="row">                 
	             	 <label class="col-md-1 ">ville <span style="color:red;">*</span> </label>
	                      
	                    <div class="col-md-2">
	                      <?php 
	                        echo TTSList::getListBox(array(
	                          "query" => "select code,ville from villes",
	                          "form" => $form,
	                          "oForm" => $oForm,
	                          "value" => "code",
	                          "libel" => "ville",
	                          "key" => "code_ville",
	                          "db" => "bd_web",
	                          "class" => "select",
	                          "required" => "required"
	                        ));
	                      ?>
	                    </div> 
	                    
	                  <label class="col-md-1 col-md-offset-1">Voie  <span style="color:red;">*</span> </label>
	                  <div class="col-md-2">
	                      	<select class="itemName-voie form-control select" <?php echo $form["code_voie"]; ?> required>
        					  <?php if($oForm->getData('code_voie')):?> 
        					      <option value="<?php echo $oForm->getData('code_voie').'||'.$data["voie"] ?>"><?php echo $data["voie"] ?></option>
        					  <?php endif;?>
        					</select>
	                    </div>
	                    <label class="col-md-1 col-md-offset-1">comp voie </label>
	                    <div class="col-md-2">
	                        <input type="text" class="form-control" <?php echo $form["comp_voie"]; ?> >
	                    </div>
	              </div>
	              <div class="row">
	                   
	                    <label class="col-md-1">num voie <span style="color:red;">*</span> </label>
	                    <div class="col-md-2">
                        	<input type="text" class="form-control" <?php echo $form["num_voie"]; ?> required>
                      	</div>
                      	<label class="col-md-1  col-md-offset-1">comp num voie</label>
	                    <div class="col-md-2">
                        	<input type="text" class="form-control" style="text-transform:uppercase" <?php echo $form["comp_num_voie"]; ?> >
                      	</div>
	                    
	                    <label class="col-md-1 col-md-offset-1">Email </label>
                    <div class="col-md-2">
                    	<input type="text" class="form-control mail" <?php echo $formLien_email["email"]; ?> >
                  	</div>
				</div>
				<div class="row">
					
				<label class="col-md-1">Tel 1  <span style="color:red;">*</span> </label>
                    <div class="col-md-2">
                        <input type="tel" class="form-control" placeholder="xx-xxxx-xxxx" <?php echo $formLien_telephone["tel"]; ?> required="required">
                    </div>
                    
                  	<label class="col-md-1 col-md-offset-1">Rubrique  <span style="color:red;">*</span> </label>
                    <div class="col-md-2">
                    	<select class="itemName-rubrique form-control select" <?php echo $formLien_rubrique["code_rubrique"]; ?> required>
						  <?php if($oFormLien_rubrique->getData('code_rubrique')):?> 
						      <option value="<?php echo $oFormLien_rubrique->getData('code_rubrique')?>"><?php echo $rubrique ?></option>
						  <?php endif;?>
						</select>
                  	</div>
                  	<label class="col-md-1 col-md-offset-1">ICE </label>
				    <div class="col-md-2">
						<input type="text" class="form-control" <?php echo $form["ref_ann_leg"]; ?>>
					</div>
				</div>
				<div class="row">
					
			    	
					
			    	<label class="col-md-1">Registre de Commerce </label>
				    <div class="col-md-2">
						<input type="text" class="form-control" <?php echo $form["rc"]; ?>>
					</div>
			    	<label class="col-md-1 col-md-offset-1">Ville du RC</label>
				    <div class="col-md-2">
						<?php 
							echo TTSList::getListBox(array(
								"query" => "select code,ville from villes",
								"form" => $form,
								"oForm" => $oForm,
								"value" => "code",
								"libel" => "ville",
								"key" => "code_ville_rc",
								"db" => "bd_web",
								"class" => "select",
							));
						?>
					</div>
					<label class="col-md-1 col-md-offset-1">forme juridique <span style="color:red;">*</span> </label>
			    	<div class="col-md-2">
						<?php 
							echo TTSList::getListBox(array(
								"query" => "select code,forme_jur from formes_juridiques",
								"form" => $form,
								"oForm" => $oForm,
								"value" => "code",
								"libel" => "forme_jur",
								"key" => "code_forme_jur",
								"db" => "bd_web",
								"class" => "select",
	                          	"required" => "required"
							));
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-md-1 ">nature : </label>
                    <div class="col-md-2">
						<?php 
							echo TTSList::getListBox(array(
								"query" => "select code,nature from natures",
								"form" => $form,
								"oForm" => $oForm,
								"value" => "code",
								"libel" => "nature",
								"key" => "code_nature",
								"db" => "bd_web",
								"class" => "select",
                          		"required" => "required"
							));
						?>
					</div>
										
			    	<label class="col-md-1 col-md-offset-1">statuts : </label>
                    <div class="col-md-2">
						<?php 
							echo TTSList::getListBox(array(
								"query" => "select code,status from statuts",
								"form" => $form,
								"oForm" => $oForm,
								"value" => "code",
								"libel" => "status",
								"key" => "code_statut",
								"db" => "bd_web",
								"class" => "select",
                          		"required" => "required"
							));
						?>
					</div>   
					
					<label class="col-md-1 col-md-offset-1">Fichier : </label>
				    <div class="col-md-2">
						<?php 
							echo TTSList::getListBox(array(
								"query" => "select code, fichier, concat(fichier,' ',code) as libelle from fichier where SUBSTRING(code, 1, 1)='K' or SUBSTRING(code, 1, 1)='H' or SUBSTRING(code, 1, 1)='T'",
								"form" => $form,
								"oForm" => $oForm,
								"value" => "code",
								"libel" => "libelle",
								"key" => "code_fichier",
								"db" => "bd_web",
								"class" => "select",
	                          	"required" => "required"
							));
						?>
					</div>         
	                    
				</div>
				<div class="row">
					<label class="col-md-1">Annonceur  <span style="color:red;">*</span> </label>
                    <div class="col-md-2">
                    	<select class="form-control select" <?php echo $form["annonceur"]; ?> required>
						      <option value="2">Non</option>
						      <option value="1">Oui</option>
						</select>
                  	</div>
	                <label class="col-md-1 col-md-offset-1">Description courte  <span style="color:red;">*</span> </label>
				    <div class="col-md-6">
					    <textarea class="form-control" <?php echo $form["tp_40"]; ?> required><?php echo $oForm->getData("tp_40"); ?></textarea>
					</div>
                    
					
					
				</div>
				<div class="text-left">
					<input type="button"  class="btn btn-primary" value="enregistrer" onclick="VerifForm()" id= "ajouter_firme" name="Enregistrer">
				</div>

			</div>
		</div>

	</form>
	
	<!-- /basic layout -->
</div>
