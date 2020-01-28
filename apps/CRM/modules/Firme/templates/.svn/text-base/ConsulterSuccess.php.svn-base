<script type="text/javascript">
    $(document).ready(function(){

        $('.sidebar-control').click();
    });

    $(document).on( 'click', '#rub_click', function () {
        var b= $("#rub_stats > div").length;

        if( b==0){
        rubrique();}
    } );

    function rubrique(){
        $('#rub_stats').empty();

        $.ajax({
            url: "<?php echo url_for('https://www.telecontact.ma/telecontact-analytics-crm/'.substr($oForm->getData("code_firme"), 2)) ?>",
            type: 'GET',
            delay: 250,
            success: function (data) {
                $('#rub_stats').append(data);
            },
            error: function( msg ) {
                $('#addform #loading-result').hide();
                alert('Erreur Ajax!');
            }
        });
    }

</script>
<!-- Page header -->
<div class="page-header">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="#"><i class="icon-home2 position-left"></i> Accueil</a></li>
            <li class="active">Consulter Firmes</li>
        </ul>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <!-- Basic layout-->
    <div class="entete">
        <?php if ($sf_user->hasFlash('success')) :  ?>
            <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                <button type="button" class="close" data-dismiss="alert"><span>x</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">Felicitation !</span> <?php echo html_entity_decode($sf_user->getFlash('success')) ; ?>.
            </div>
        <?php endif; ?>
        <?php if ($sf_user->hasFlash('error')) :  ?>
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <button type="button" class="close" data-dismiss="alert"><span>x</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">Attention !</span> <?php echo html_entity_decode($sf_user->getFlash('error')); ?>.
            </div>
        <?php endif; ?>

        <div class="alert alert-info alert-styled-left alert-arrow-left alert-bordered">

            <?php echo $oForm->getData("rs_comp"); ?>

            <?php echo " - " .$oForm->getData("code_firme"); ?>
            </b> - <?php if($affecte_telecontact Or $affecte_kompass): ?>affectée à </span> <?php if($affecte_telecontact) echo $affecte_telecontact." (Telecontact)";  if($affecte_kompass && $affecte_kompass != $affecte_telecontact) echo " - ".$affecte_kompass." (Kompass)" ; ?> <?php else:?> Firme non affectée <?php endif;?>.
            </br> <?php echo "Telecontact: ".$oForm->getData("maj_k").($oForm->getData("pub_k")?$oForm->getData("pub_k"):".");
            echo "  -  Kompass: ".$oForm->getData("maj_n").($oForm->getData("pub_n")?$oForm->getData("pub_n"):".");
                /* edit rania 10/12/2019 */
                    if( $oForm->getData("maj_n") == 1 || $oForm->getData("maj_e") == 1 || $oForm->getData("maj_f") == 1 || $oForm->getData("maj_k") == 1 ){
                    echo ('<br> Annonceur : ');
                    }
                    if ($oForm->getData("maj_k") == 1)
                    {
                        echo ('- Telecontact ');
                    }
                    if ($oForm->getData("maj_f") == 1)
                    {
                        echo ('- Telecontact internet ');
                    }
                    if($oForm->getData("maj_n") == 1)
                    {
                        echo ('- Kompass ');
                    }
                    if($oForm->getData("maj_e") == 1)
                    {
                        echo ('- Kompass internet ');
                    }
                    if( $oForm->getData("maj_n") == 1 || $oForm->getData("maj_e") == 1 || $oForm->getData("maj_f") == 1 || $oForm->getData("maj_k") == 1 ){
                        echo ('.');
                    }
                /* end edit*/
            ?>
            <br>


            <?php if($firme_mere_id) echo "firme mère: <a href='http://www.crm.edicom.ma/index.php/Firme/Consulter?id=".$firme_mere_id."'  target='_blank' > ".$firme_mere."</a>";  ?>

            <h5><?php echo $valide; ?></h5>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-flat  panel-collapsed bg-teal-700">
                    <div class="panel-heading">
                        <div class="heading-elements">
                            <ul>
                                <li><a data-action="collapse"><h6 class="panel-title">Informations de base</h6></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">



                        <div class="row">
                            <!--  <div class="col-md-6">
                                <strong tts_titre="code_statut" tts_titre="code_statut">statuts : </strong>
                                <div tts_text="code_statut" name="update" style="display: inline;"><?php echo $data["statut"]; ?></div>
                                <div tts_input="code_statut" style="display: none;">
                                    <?php
                            echo TTSList::getListBox(array(
                                "query" => "select code,status from statuts",
                                "form" => $form,
                                "oForm" => $oForm,
                                "value" => "code",
                                "libel" => "status",
                                "key" => "code_statut",
                                "db" => "bd_web",
                                "class" => "select"
                            ));
                            ?>
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <strong tts_titre="code_nature">nature : </strong>
                                <div tts_text="code_nature" name="update" style="display: inline;"><?php echo $data["nature"]; ?></div>
                                <div tts_input="code_nature" style="display: none;">
                                    <?php
                                    echo TTSList::getListBox(array(
                                        "query" => "select code,nature from natures",
                                        "form" => $form,
                                        "oForm" => $oForm,
                                        "value" => "code",
                                        "libel" => "nature",
                                        "key" => "code_nature",
                                        "db" => "bd_web",
                                        "class" => "select"
                                    ));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="code_firme_mere">code firme mere : </strong>
                                <div tts_text="code_firme_mere" name="update" style="display: inline;text-align:justify;"><?php if($oForm->getData("code_firme_mere")) echo $oForm->getData("code_firme_mere").' - '.$firme_mere;  ?></div>
                                <div tts_input="code_firme_mere" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["code_firme_mere"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6" id="div_rs_comp">
                                <strong tts_titre="rs_comp">Raison Sociale : </strong>
                                <div tts_text="rs_comp" name="update" style="display: inline;"><?php echo $oForm->getData("rs_comp"); ?></div>
                                <div tts_input="rs_comp" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["rs_comp"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="rs_abr">Raison Sociale Abrégée : </strong>
                                <div tts_text="rs_abr" name="update" style="display: inline;"><?php echo $oForm->getData("rs_abr"); ?></div>
                                <div tts_input="rs_abr" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["rs_abr"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="rs_courte">Enseigne : </strong>
                                <div tts_text="rs_courte" name="update" style="display: inline;"><?php echo $oForm->getData("rs_courte"); ?></div>
                                <div tts_input="rs_courte" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["rs_courte"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="rs_tri">Tri forcé : </strong>
                                <div tts_text="rs_tri" name="update" style="display: inline;"><?php echo $oForm->getData("rs_tri"); ?></div>
                                <div tts_input="rs_tri" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["rs_tri"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="tp_40">Activit&eacute; simplifi&eacute;e : </strong>
                                <div tts_text="tp_40" name="update" style="display: inline;text-align:justify;"><?php echo $oForm->getData("tp_40"); ?></div>
                                <div tts_input="tp_40" style="display: none;">
                                    <textarea class="form-control" <?php echo $form["tp_40"]; ?>><?php echo $oForm->getData("tp_40"); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="tp_45">Activit&eacute; complète: </strong>
                                <div tts_text="tp_45" name="update" style="display: inline;text-align:justify;"><?php echo $oForm->getData("tp_45"); ?></div>
                                <div tts_input="tp_45" style="display: none;">
                                    <textarea class="form-control" <?php echo $form["tp_45"]; ?>><?php echo $oForm->getData("tp_45"); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="tp_48">Pr&eacute;sentation Kompass.com : </strong>
                                <div tts_text="tp_48" name="update" style="display: inline;text-align:justify;"><?php echo $oForm->getData("tp_48"); ?></div>
                                <div tts_input="tp_48" style="display: none;">
                                    <textarea class="form-control" <?php echo $form["tp_48"]; ?>><?php echo $oForm->getData("tp_48"); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="code_statut">Statuts : </strong>
                                <div tts_text="code_statut" name="update" style="display: inline;"><?php echo $data["statut"]; ?></div>
                                <div tts_input="code_statut" style="display: none;">
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
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="code_fichier">Fichier : </strong>
                                <div tts_text="code_fichier" name="update" style="display: inline;"><?php echo $data["fichier"]; ?></div>
                                <div tts_input="code_fichier" style="display: none;">
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
                            <div class="col-md-12" id="adresse">
                                <strong>Adresse: </strong>
                                <div style="display: inline;text-align:justify;"><?php echo $oForm->getData("num_voie")." ".$oForm->getData("comp_num_voie")." ".$data["voie"]." ".$oForm->getData("comp_voie")." ".$data["quartier"]." ".$data["arrondissement"]." ".$data["ville"]; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="panel panel-flat  panel-collapsed bg-info-800">
                    <div class="panel-heading">
                        <div class="heading-elements">
                            <ul>
                                <li><a data-action="collapse"><h6 class="panel-title">Informations Financières </h6></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">


                        <div class="col-md-6">
                            <strong tts_titre="gamme_ca">Tranche CA : </strong>
                            <div tts_text="gamme_ca" name="update" style="display: inline;"><?php echo $oForm->getData("gamme_ca"); ?></div>
                            <div tts_input="gamme_ca" style="display: none;">
                                <input type="text" class="form-control" <?php echo $form["gamme_ca"]; ?>>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <strong tts_titre="ca">CA : </strong>
                            <div tts_text="ca" name="update" style="display: inline;"><?php echo $oForm->getData("ca"); ?></div>
                            <div tts_input="ca" style="display: none;">
                                <input type="number" class="form-control" <?php echo $form["ca"]; ?>>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-flat panel-collapsed bg-info-700">
                    <div class="panel-heading">
                        <div class="heading-elements">
                            <ul>
                                <li><a data-action="collapse"><h6 class="panel-title">Informations générales</h6></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong tts_titre="ouv_matin">Ouverture matin : </strong>
                                <div tts_text="ouv_matin" name="update" style="display: inline;"><?php echo $oForm->getData("ouv_matin"); ?></div>
                                <div tts_input="ouv_matin" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["ouv_matin"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="ferm_matin">Fermeture matin : </strong>
                                <div tts_text="ferm_matin" name="update" style="display: inline;"><?php echo $oForm->getData("ferm_matin"); ?></div>
                                <div tts_input="ferm_matin" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["ferm_matin"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="ouv_soir">Ouverture soir : </strong>
                                <div tts_text="ouv_soir" name="update" style="display: inline;"><?php echo $oForm->getData("ouv_soir"); ?></div>
                                <div tts_input="ouv_soir" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["ouv_soir"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="ferm_soir">Fermeture soir : </strong>
                                <div tts_text="ferm_soir" name="update" style="display: inline;"><?php echo $oForm->getData("ferm_soir"); ?></div>
                                <div tts_input="ferm_soir" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["ferm_soir"]; ?>>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong tts_titre="eff_min">Effectif minimum : </strong>
                                <div tts_text="eff_min" name="update" style="display: inline;"><?php echo $oForm->getData("eff_min"); ?></div>
                                <div tts_input="eff_min" style="display: none;">
                                    <input type="number" class="form-control" <?php echo $form["eff_min"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="eff_max">Effectif maximum : </strong>
                                <div tts_text="eff_max" name="update" style="display: inline;"><?php echo $oForm->getData("eff_max"); ?></div>
                                <div tts_input="eff_max" style="display: none;">
                                    <input type="number" class="form-control" <?php echo $form["eff_max"]; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong tts_titre="nb_cadres">Nombre de cadres : </strong>
                                <div tts_text="nb_cadres" name="update" style="display: inline;"><?php echo $oForm->getData("nb_cadres"); ?></div>
                                <div tts_input="nb_cadres" style="display: none;">
                                    <input type="number" class="form-control" <?php echo $form["nb_cadres"]; ?>>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <strong tts_titre="sup">Superficie totale : </strong>
                                <div tts_text="sup" name="update" style="display: inline;"><?php echo $oForm->getData("sup"); ?></div>
                                <div tts_input="sup" style="display: none;">
                                    <input type="number" class="form-control" <?php echo $form["sup"]; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong tts_titre="sup_couv">Superficie couverte : </strong>
                                <div tts_text="sup_couv" name="update" style="display: inline;"><?php echo $oForm->getData("sup_couv"); ?></div>
                                <div tts_input="sup_couv" style="display: none;">
                                    <input type="number" class="form-control" <?php echo $form["sup_couv"]; ?>>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($consult_detail):?>
                <div class="col-md-6">
                    <div class="panel panel-flat  panel-collapsed bg-info-800">
                        <div class="panel-heading">

                            <div class="heading-elements">
                                <ul>
                                    <li>
                                        <a data-action="collapse">
                                            <h6 class="panel-title">Compte EDICOM </h6>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">

                            <div class="col-md-6">
                                <strong class="col-md-7">Dernier BC TELECONTACT : </strong>
                                <div class="col-md-4"><?php echo $mt_ttc_telecontact?></div>
                            </div>
                            <div class="col-md-6">
                                <strong class="col-md-7">Dernier BC KOMPASS : </strong>
                                <div class="col-md-4"><?php echo $mt_ttc_kompass ?></div>
                            </div>
                            <div class="col-md-6">
                                <strong class="col-md-7">Signataire : </strong>
                                <div class="col-md-4"><?php echo $signataire ?></div>
                            </div>
                            <div class="col-md-6">
                                <a href="<?php echo url_for('DetailSolde',array("code_firme" => $code_firme)) ?>" style="color: white">
                                    <strong class="col-md-6">

                                        Solde client :

                                    </strong>
                                    <div class="col-md-4"><?php echo number_format($solde,0,'.',' ')?></div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="annonceur">Annonceur : </strong>
                                <div tts_text="annonceur" name="update" style="display: inline;text-align:justify;">
                                    <?php
                                    if($oForm->getData("annonceur")==1)
                                        echo "Oui";
                                    else
                                        echo "Non";
                                    ?>
                                </div>
                                <div tts_input="annonceur" style="display: none;">
                                    <select class="form-control select" <?php echo $form["annonceur"]; ?>>
                                        <option value="2">Non</option>
                                        <option value="1">Oui</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-flat panel-collapsed bg-teal">
                    <div class="panel-heading">

                        <div class="heading-elements">
                            <ul>
                                <li><a data-action="collapse"><h6 class="panel-title">Informations Juridiques</h6></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <!-- <div class="col-md-6">
                                    <strong tts_titre="chef_file_banque">Code banque chef fil : </strong>
                                    <div tts_text="chef_file_banque" name="update" style="display: inline;"><?php echo $data["banque"]; ?></div>
                                    <div tts_input="chef_file_banque" style="display: none;">
                                        <?php
                            echo TTSList::getListBox(array(
                                "query" => "select code,banque from banques",
                                "form" => $form,
                                "oForm" => $oForm,
                                "value" => "code",
                                "libel" => "banque",
                                "key" => "chef_file_banque",
                                "db" => "bd_web",
                                "class" => "select"
                            ));
                            ?>
                                    </div>
                                </div> -->
                            <div class="col-md-6">
                                <strong tts_titre="code_forme_jur">forme juridique : </strong>
                                <div tts_text="code_forme_jur" name="update" style="display: inline;"><?php echo $data["forme_jur"]; ?></div>
                                <div tts_input="code_forme_jur" style="display: none;">
                                    <?php
                                    echo TTSList::getListBox(array(
                                        "query" => "select code,forme_jur from formes_juridiques",
                                        "form" => $form,
                                        "oForm" => $oForm,
                                        "value" => "code",
                                        "libel" => "forme_jur",
                                        "key" => "code_forme_jur",
                                        "db" => "bd_web",
                                        "class" => "select"
                                    ));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="cap">Capital : </strong>
                                <div tts_text="cap" name="update" style="display: inline;"><?php echo $oForm->getData("cap"); ?></div>
                                <div tts_input="cap" style="display: none;">
                                    <input type="number" class="form-control" <?php echo $form["cap"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="rc">Registre de Commerce : </strong>
                                <div tts_text="rc" name="update" style="display: inline;"><?php echo $oForm->getData("rc"); ?></div>
                                <div tts_input="rc" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["rc"]; ?>>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <strong tts_titre="code_ville_rc">Ville du RC : </strong>
                                <div tts_text="code_ville_rc" name="update" style="display: inline;"><?php echo $data["ville_rc"]; ?></div>
                                <div tts_input="code_ville_rc" style="display: none;">
                                    <?php
                                    echo TTSList::getListBox(array(
                                        "query" => "select code,ville from villes",
                                        "form" => $form,
                                        "oForm" => $oForm,
                                        "value" => "code",
                                        "libel" => "ville",
                                        "key" => "code_ville_rc",
                                        "db" => "bd_web",
                                        "class" => "select"
                                    ));
                                    ?>
                                </div>
                            </div>
                            <form id="ice_form_id">
                                <div class="col-md-6">
                                    <strong tts_titre="ref_ann_leg">ICE: </strong>
                                    <div tts_text="ref_ann_leg" name="update" style="display: inline;"><?php echo $oForm->getData("ref_ann_leg"); ?></div>
                                    <div tts_input="ref_ann_leg" style="display: none;">
                                        <input type="text" class="form-control" maxlength="15" <?php echo $form["ref_ann_leg"]; ?>>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-6">
                                <strong tts_titre="ident_fisc">Identifiant fiscal : </strong>
                                <div tts_text="ident_fisc" name="update" style="display: inline;"><?php echo $oForm->getData("ident_fisc"); ?></div>
                                <div tts_input="ident_fisc" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["ident_fisc"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="patente">Taxe professionnelle : </strong>
                                <div tts_text="patente" name="update" style="display: inline;"><?php echo $oForm->getData("patente"); ?></div>
                                <div tts_input="patente" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["patente"]; ?>>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <strong tts_titre="annee_inscr">Année création  : </strong>
                                <div tts_text="annee_inscr" name="update" style="display: inline;"><?php echo $oForm->getData("annee_inscr"); ?></div>
                                <div tts_input="annee_inscr" style="display: none;">
                                    <input type="number" class="form-control" <?php echo $form["annee_inscr"]; ?>>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="panel panel-flat panel-collapsed bg-teal-300">
                    <div class="panel-heading">
                        <div class="heading-elements">
                            <ul>
                                <li><a data-action="collapse"><h6 class="panel-title">Echanges Edicom</h6></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-6">
                                <strong class="col-md-6">Appel Televente <?php echo date('Y');?>: </strong>
                                <div class="col-md-4"><?php echo number_format($nb_televente,0,'.',' ')?></div>
                            </div>
                            <div class="col-md-6">
                                <strong class="col-md-6">Appel Recouv <?php echo date('Y');?>: </strong>
                                <div class="col-md-4"><?php echo number_format($nb_appel_recouvrement,0,'.',' ')?></div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <strong class="col-md-3">dernier commentaire:</strong>
                                <div class="col-md-9"><?php echo $dernier_commentaire ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong tts_titre="maj_n">MAJ Kompass : </strong>
                                <div tts_text="maj_n" name="update" style="display: inline;"><?php echo $oForm->getData("maj_n"); ?></div>
                                <div tts_input="maj_n" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["maj_n"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="maj_k">MAJ Télécontact : </strong>
                                <div tts_text="maj_k" name="update" style="display: inline;"><?php echo $oForm->getData("maj_k"); ?></div>
                                <div tts_input="maj_k" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["maj_k"]; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong tts_titre="maj_f">Barrette telecontact.ma : </strong>
                                <div tts_text="maj_f" name="update" style="display: inline;"><?php echo $oForm->getData("maj_f"); ?></div>
                                <div tts_input="maj_f" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["maj_f"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="maj_e">Barrette kompass.com : </strong>
                                <div tts_text="maj_e" name="update" style="display: inline;"><?php echo $oForm->getData("maj_e"); ?></div>
                                <div tts_input="maj_e" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["maj_e"]; ?>>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong tts_titre="pub_f">type client telecontact.ma : </strong>
                                <div tts_text="pub_f" name="update" style="display: inline;"><?php echo $oForm->getData("pub_f"); ?></div>
                                <div tts_input="pub_f" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["pub_f"]; ?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="pub_e">type client kompass.com : </strong>
                                <div tts_text="pub_e" name="update" style="display: inline;"><?php echo $oForm->getData("pub_e"); ?></div>
                                <div tts_input="pub_e" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["pub_e"]; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong tts_titre="pub_n">PUB Kompass : </strong>
                                <div tts_text="pub_n" name="update" style="display: inline;"><?php echo $oForm->getData("pub_n"); ?></div>
                                <div tts_input="pub_n" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["pub_n"]; ?>>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <strong tts_titre="pub_k">PUB Télécontact : </strong>
                                <div tts_text="pub_k" name="update" style="display: inline;"><?php echo $oForm->getData("pub_k"); ?></div>
                                <div tts_input="pub_k" style="display: none;">
                                    <input type="text" class="form-control" <?php echo $form["pub_k"]; ?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong tts_titre="logo_d">DISTRIBUE TELEC : </strong>
                                <div tts_text="logo_d" name="update" style="display: inline;"><?php echo $oForm->getData("logo_d"); ?></div>

                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="logo_f">DISTRI_TELEC_CLIENT : </strong>
                                <div tts_text="logo_f" name="update" style="display: inline;"><?php echo $oForm->getData("logo_f"); ?></div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong tts_titre="logo_n">DISTRIBUE KOMPASS  : </strong>
                                <div tts_text="logo_n" name="update" style="display: inline;"><?php echo $oForm->getData("logo_n"); ?></div>

                            </div>
                            <div class="col-md-6">
                                <strong tts_titre="logo_e">DISTRI_KOMPASS_CLIENT : </strong>
                                <div tts_text="logo_e" name="update" style="display: inline;"><?php echo $oForm->getData("logo_e"); ?></div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="panel panel-flat  panel-collapsed bg-info-800">
                    <div class="panel-heading">
                        <div class="heading-elements">
                            <ul>
                                <li><a data-action="collapse" id="rub_click"><h6 class="panel-title">Statistiques de consultation mensuelle par rubrique  </h6></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">


                        <div class="row" id="rub_stats">

                        </div>

                    </div>
                </div>
            </div>


        </div>

        <div class="row">

        </div>
    </div>

    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <?php if(!$sf_user->hasCredential('profil_restreint') Or $consult_detail) : ?>
                        <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                            <li class="active"><a href="#map" data-toggle="tab">Adresse</a></li>
                            <li><a href="#contact" data-toggle="tab">Coordonnées</a></li>
                            <li><a href="#dirigeant" data-toggle="tab">Dirigeant</a></li>
                            <li><a href="#certif" data-toggle="tab">Certifications</a></li>
                            <?php if($sf_user->hasCredential('consultertelevente')) : ?>
                                <li><a href="#televentes" data-toggle="tab">Gestion Appels</a></li>
                            <?php endif; ?>
                            <li><a href="#info" data-toggle="tab">Infos rubrique</a></li>
                            <li><a href="#marque" data-toggle="tab">Marque et Prestation</a></li>
                            <?php if($consult_historique && $consult_detail):?>
                                <li><a href="#historique" data-toggle="tab">Historique</a></li>
                            <?php endif?>
                        </ul>
                    <?php endif;?>

                    <div class="tab-content">
                        <div class="tab-pane has-padding active" id="map">
                            <div class="row">
                                <div class="col-md-6 entete">

                                    <div id="map_canvas" style="width:500px;height:300px;">
                                    </div>
                                    <div class="row">
                                        <strong tts_titre="latitude" class="col-md-2">latitude : </strong>
                                        <div tts_text="latitude" name="update"  class="col-md-2">
                                            <?php echo $oForm->getData("latitude"); ?>
                                        </div>
                                        <div tts_input="latitude" style="display: none;"  class="col-md-2">
                                            <input type="text" class="form-control" <?php echo $form["latitude"]; ?>>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <strong tts_titre="longitude"  class="col-md-2">longitude : </strong>
                                        <div tts_text="longitude" name="update"  class="col-md-2">
                                            <?php echo $oForm->getData("longitude"); ?>
                                        </div>
                                        <div tts_input="longitude" style="display: none;">
                                            <input type="text" class="form-control" <?php echo $form["longitude"]; ?>>
                                        </div>
                                        <?php if($modif_ligne) { ?>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-primary" id="btn-map">
                                                    Enregistrer Position <i class="icon-arrow-right14 position-right"></i>
                                                </button>
                                            </div>
                                        <?php } ?>
                                    </div>

                                </div>
                                <div class="col-md-6 entete" id="detail_adresse">
                                    <script type="text/javascript" charset="utf-8">
                                        $(document).ready( function () {

                                            $('.itemName-voie').select2({
                                                placeholder: 'Select an item',
                                                ajax: {
                                                    url: "<?php echo url_for('Common/AutoCompleteVoie') ?>",
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

                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong tts_titre="code_voie">Voie : </strong>
                                            <div tts_text="code_voie" name="update" style="display: inline;"><?php echo $data["voie"]; ?></div>
                                            <div tts_input="code_voie" style="display: none;">
                                                <select class="itemName-voie form-control select" <?php echo $form["code_voie"]; ?>>
                                                    <?php if($oForm->getData('code_voie')):?>
                                                        <option value="<?php echo $oForm->getData('code_voie').'||'.$data["voie"] ?>"><?php echo $data["voie"] ?></option>
                                                    <?php endif;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong tts_titre="comp_voie">comp voie : </strong>
                                            <div tts_text="comp_voie" name="update" style="display: inline;"><?php echo $oForm->getData("comp_voie"); ?></div>
                                            <div tts_input="comp_voie" style="display: none;">
                                                <input type="text" class="form-control" <?php echo $form["comp_voie"]; ?>>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <strong tts_titre="num_voie">num voie : </strong>
                                            <div tts_text="num_voie" name="update" style="display: inline;"><?php echo $oForm->getData("num_voie"); ?></div>
                                            <div tts_input="num_voie" style="display: none;">
                                                <input type="text" class="form-control" <?php echo $form["num_voie"]; ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong tts_titre="comp_num_voie">comp num voie : </strong>
                                            <div tts_text="comp_num_voie" name="update" style="display: inline;"><?php echo $oForm->getData("comp_num_voie"); ?></div>
                                            <div tts_input="comp_num_voie" style="display: none;">
                                                <input type="text" class="form-control" <?php echo $form["comp_num_voie"]; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <strong tts_titre="code_ville">ville : </strong>
                                            <div tts_text="code_ville" name="update" style="display: inline;"><?php echo $data["ville"]; ?></div>
                                            <div tts_input="code_ville" style="display: none;">
                                                <?php
                                                echo TTSList::getListBox(array(
                                                    "query" => "select code,ville from villes",
                                                    "form" => $form,
                                                    "oForm" => $oForm,
                                                    "value" => "code",
                                                    "libel" => "ville",
                                                    "key" => "code_ville",
                                                    "db" => "bd_web",
                                                    "class" => "select"
                                                ));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong tts_titre="bp">Boite postale : </strong>
                                            <div tts_text="bp" name="update" style="display: inline;"><?php echo $oForm->getData("bp"); ?></div>
                                            <div tts_input="bp" style="display: none;">
                                                <input type="text" class="form-control" <?php echo $form["bp"]; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <strong tts_titre="code_ville_bp">Ville BP : </strong>
                                            <div tts_text="code_ville_bp" name="update" style="display: inline;"><?php echo $data["ville_bp"]; ?></div>
                                            <div tts_input="code_ville_bp" style="display: none;">
                                                <?php
                                                echo TTSList::getListBox(array(
                                                    "query" => "select code,ville from villes",
                                                    "form" => $form,
                                                    "oForm" => $oForm,
                                                    "value" => "code",
                                                    "libel" => "ville",
                                                    "key" => "code_ville_bp",
                                                    "db" => "bd_web",
                                                    "class" => "select"
                                                ));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong tts_titre="code_postal">code postal : </strong>
                                            <div tts_text="code_postal" name="update" style="display: inline;"><?php echo $oForm->getData("code_postal"); ?></div>
                                            <div tts_input="code_postal" style="display: none;">
                                                <input type="text" class="form-control" <?php echo $form["code_postal"]; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <strong tts_titre="code_arr">ARR : </strong>
                                            <div tts_text="code_arr" name="update" style="display: inline;"><?php echo $data["arrondissement"]; ?></div>
                                            <div tts_input="code_arr" style="display: none;">
                                                <?php
                                                echo TTSList::getListBox(array(
                                                    "query" => "select code,arrondissement from arrondissements order by arrondissement",
                                                    "form" => $form,
                                                    "oForm" => $oForm,
                                                    "value" => "code",
                                                    "libel" => "arrondissement",
                                                    "key" => "code_arr",
                                                    "db" => "bd_web",
                                                    "class" => "select"
                                                ));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong tts_titre="code_quart">quartier : </strong>
                                            <div tts_text="code_quart" name="update" style="display: inline;"><?php echo $data["quartier"]; ?></div>
                                            <div tts_input="code_quart" style="display: none;">
                                                <?php
                                                echo TTSList::getListBox(array(
                                                    "query" => "select code,quartier from quartiers order by quartier",
                                                    "form" => $form,
                                                    "oForm" => $oForm,
                                                    "value" => "code",
                                                    "libel" => "quartier",
                                                    "key" => "code_quart",
                                                    "db" => "bd_web",
                                                    "class" => "select"
                                                ));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <strong tts_titre="zone_geo">ZONES : </strong>
                                            <div tts_text="zone_geo" name="update" style="display: inline;"><?php echo $oForm->getData("zone_geo"); ?></div>
                                            <div tts_input="zone_geo" style="display: none;">
                                                <input type="text" class="form-control" <?php echo $form["zone_geo"]; ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane has-padding" id="info">
                            <div class="row">
                                <div class="col-md-6" id="produit">
                                    <?php echo include_partial('produit',array("oFormLien_produit"=>$oFormLien_produit,"lien_produit"=>$lien_produit,"pays_export"=>$pays_export,"code_firme"=>$code_firme,"formLien_produit"=>$formLien_produit,"modif"=>$modif_ligne)); ?>
                                </div>
                                <div class="col-md-6"  id="rubrique">

                                    <?php echo include_partial('rubrique',array("oFormLien_rubrique"=>$oFormLien_rubrique,"lien_rubrique"=>$lien_rubrique,"code_firme"=>$code_firme,"formLien_rubrique"=>$formLien_rubrique,"modif"=>$modif_ligne)); ?>
                                </div>
                                <div class="col-md-6"  id="rubrique_internet">

                                    <?php echo include_partial('rubriqueinternet',array("oFormLien_rubrique_internet"=>$oFormLien_rubrique_internet,"lien_rubrique_internet"=>$lien_rubrique_internet,"code_firme"=>$code_firme,"formLien_rubrique_internet"=>$formLien_rubrique_internet,"modif"=>$modif_ligne)); ?>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane has-padding" id="dirigeant">
                            <?php echo include_partial('dirigeant',array("oFormPersonne"=>$oFormPersonne,
                                "dirigeants"=>$dirigeants,
                                //"dirigeants_sec"=>$dirigeants_sec,
                                "code_firme"=>$code_firme,
                                "formPersonne"=>$formPersonne,
                                "formLien_dirigeant"=>$formLien_dirigeant,
                                "oFormLien_dirigeant"=>$oFormLien_dirigeant,
                                "modif"=>$modif_ligne,
                                "fonction"=>$fonction,
                                "fonctions"=>$fonctions,
                                "fonctions_dir" => $fonctions_dir,
                                "civilite"=>$civilite)); ?>
                        </div>
                        <?php if($sf_user->hasCredential('consultertelevente')) : ?>
                            <div class="tab-pane has-padding" id="televentes">
                                <?php
                                echo include_partial('televente',
                                    array(
                                        "oFormTelevente"=>$oFormTelevente,
                                        "televentes"=>$televentes,
                                        "code_firme"=>$code_firme,
                                        'id'=>$id,
                                        'num_compagne'=>$num_compagne,
                                        "formTelevente"=>$formTelevente,
                                        "modif"=>$modif_ligne,
                                        "support"=>$support
                                    )
                                );
                                ?>
                            </div>
                        <?php endif ?>
                        <div class="tab-pane has-padding" id="contact">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo include_partial('email',array("oFormLien_email"=>$oFormLien_email,"lien_email"=>$lien_email,"code_firme"=>$code_firme,"formLien_email"=>$formLien_email,"modif"=>$modif_ligne)); ?>
                                </div>
                                <div class="col-md-6">
                                    <?php echo include_partial('portable',array("oFormLien_portable"=>$oFormLien_portable,"lien_portable"=>$lien_portable,"code_firme"=>$code_firme,"formLien_portable"=>$formLien_portable,"modif"=>$modif_ligne)); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo include_partial('telephone',array("oFormLien_telephone"=>$oFormLien_telephone,"lien_telephone"=>$lien_telephone,"code_firme"=>$code_firme,"formLien_telephone"=>$formLien_telephone,"modif"=>$modif_ligne)); ?>
                                </div>
                                <div class="col-md-6">
                                    <?php echo include_partial('fax',array("oFormLien_fax"=>$oFormLien_fax,"lien_fax"=>$lien_fax,"code_firme"=>$code_firme,"formLien_fax"=>$formLien_fax,"modif"=>$modif_ligne)); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo include_partial('web',array("oFormLien_web"=>$oFormLien_web,"lien_web"=>$lien_web,"code_firme"=>$code_firme,"formLien_web"=>$formLien_web,"modif"=>$modif_ligne)); ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane has-padding" id="certif">
                            <?php echo include_partial('certif',array("modif"=>$modif_ligne, "oFormCertif"=>$oFormCertif,"certifications" => $certifications,"formCertif" => $formCertif ,"code_firme"=>$code_firme) ); ?>
                        </div>

                        <div class="tab-pane has-padding" id="historique">
                            <form id="form-filter">
                                <div class="row">
                                    <label class="col-md-1">
                                        Date
                                    </label>
                                    <div class="col-md-2 input-group">
                                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                        <input type="text" name="dateFrom"  id="dateFrom" class="form-control datepicker-menus"/>
                                    </div>
                                    <label class="col-md-1 col-md-offset-1">
                                        &nbsp; et  :  &nbsp; </label>
                                    <div class="col-md-2 input-group">
                                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                        <input type="text" name="dateTo" id="dateTo" class="form-control datepicker-menus"/>
                                    </div>

                                    <label class="col-md-1 col-md-offset-1"> Type MVT  :  </label>
                                    <div class="col-md-2 multi-select-full">
                                        <SELECT NAME="Mouvement" id="Mouvement" MULTIPLE SIZE=5 class="multiselect-sm">


                                            <optgroup label="Reclamation">
                                                <?php if($sf_user->hasCredential('consulterhistoriquereclamation')) : ?><option VALUE="reclamation">Réclamation</option><?php endif;?>

                                            </optgroup>
                                            <optgroup label="Bon de Commande">

                                                <?php if($sf_user->hasCredential('consulterhistoriquebc')) : ?><option VALUE="bc">Bon de commande</option><?php endif;?>

                                            </optgroup>
                                            <optgroup label="Visites">
                                                <?php if($sf_user->hasCredential('consulterhistoriquerdv')) : ?><option VALUE="rdv">RDV</option><?php endif;?>
                                                <?php if($sf_user->hasCredential('consulterhistoriquevisiteeffectuees')) : ?><option VALUE="visiteeffectuees">Visites effectuées</option><?php endif;?>
                                                <?php if($sf_user->hasCredential('consulterhistoriqueopportunite')) : ?><option VALUE="opportunite">Opportunités</option><?php endif;?>
                                                <?php if($sf_user->hasCredential('consulterhistoriquedecouverte')) : ?><option VALUE="decouverte">Découverte</option><?php endif;?>
                                                <?php if($sf_user->hasCredential('consulterhistoriquecommentaire')) : ?><option VALUE="commentaire">Commentaire client</option><?php endif;?>

                                            </optgroup>
                                            <optgroup label="Encaissement">
                                                <?php if($sf_user->hasCredential('consulterhistoriqueencaissement')) : ?><option VALUE="encaissement">Encaissement</option><?php endif;?>
                                                <?php if($sf_user->hasCredential('consulterhistoriqueimpaye')) : ?><option VALUE="impaye">Impayés</option><?php endif;?>
                                                <?php if($sf_user->hasCredential('consulterhistoriqueappel_recouvrement')) : ?><option VALUE="appel_recouvrement">Recouvrement</option><?php endif;?>


                                            </optgroup>
                                            <optgroup label="Televente">

                                                <?php if($sf_user->hasCredential('consulterhistoriquetelevente')) : ?><option VALUE="televente">Télévente</option><?php endif;?>
                                                <?php if($sf_user->hasCredential('consulterhistoriqueappel_televente')) : ?><option VALUE="appel_televente">Appel televente</option><?php endif;?>

                                            </optgroup>
                                            <optgroup label="Affectation">
                                                <?php if($sf_user->hasCredential('consulterhistoriqueaffectation')) : ?><option VALUE="affectation">Affectation</option><?php endif;?>
                                            </optgroup>
                                            <optgroup label="Maj Firme">

                                                <?php if($sf_user->hasCredential('consulterhistoriquemaj_firme')) : ?><option VALUE="maj_firme">MaJ Firme</option><?php endif;?>

                                            </optgroup>
                                            <optgroup label="Salon">
                                                <?php if($sf_user->hasCredential('consulterhistoriquesalon')) : ?><option VALUE="salon">Salon</option><?php endif;?>

                                            </optgroup>
                                            <optgroup label="Production">
                                                <?php if($sf_user->hasCredential('consulterhistoriqueproduction')) : ?><option VALUE="production">Production</option><?php endif;?>

                                            </optgroup>
                                            <!--  <?php if($sf_user->hasCredential('consulterhistoriquemiseenligne')) : ?><option VALUE="miseenligne">Mise en ligne</option><?php endif;?> -->
                                            <!-- <?php if($sf_user->hasCredential('consulterhistoriquemiseajour')) : ?><option VALUE="miseajour">Mises à jour</option><?php endif;?>-->
                                            <!-- <?php if($sf_user->hasCredential('consulterhistoriquemarketingdirect')) : ?><option VALUE="marketingdirect">Marketing direct</option><?php endif;?> -->
                                            <!-- <?php if($sf_user->hasCredential('consulterhistoriquesav')) : ?><option VALUE="sav">SAV</option><?php endif;?> -->
                                            <!-- <?php if($sf_user->hasCredential('consulterhistoriquefacture')) : ?><option VALUE="facture">Facture</option><?php endif;?> -->
                                            <!-- <?php if($sf_user->hasCredential('consulterhistoriquebackofficesiteweb')) : ?><option VALUE="backofficesiteweb">Backoffice site web</option><?php endif;?> -->
                                        </SELECT>
                                    </div>
                                    <div class="col-md-2"><input class="btn btn-primary" id="filter-button" type="button" name="filtrer" value="Filtrer"/></div>
                                </div>
                                <div class="row">
                                    <div id="resultat"></div>

                                    <div id="loading-result" style="background: url('/img/pbar-ani.gif');width:200px;height:22px;margin:auto;margin-top: 15px"> </div>

                                </div>
                            </form>
                        </div>
                        <div class="tab-pane has-padding" id="marque">
                            <div class="row">
                                <div class="col-md-12" id="produit">

                                    <?php echo include_partial('marque',array("oFormMarque"=>$oFormMarque,"lien_marque"=>$lien_marque,"code_firme"=>$code_firme,"formMarque"=>$formMarque,"modif"=>$modif_ligne, "pays"=>$pays)); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="prest">

                                    <?php echo include_partial('prestations',array("oFormPrestation"=>$oFormPrestation,"prestations"=>$prestations,"code_firme"=>$code_firme,"formPrestation"=>$formPrestation,"modif"=>$modif_ligne,'rubrique_ran'=>$rubrique_ran)); ?>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <?php if($sf_user->hasCredential("ajouteropportunite")):?>
                        <button type="button" class="btn btn-primary" onClick="window.open('<?php echo url_for("Ajouter_Opportunite",array('code_firme'=>$code_firme)); ?>')" >
                            <i class="icon-add position-left"></i>
                            Créer une opportunité
                        </button>
                    <?php endif;?>
                    <?php if($sf_user->hasCredential("ajoutervisite_effectuee")):?>
                        <button type="button" class="btn btn-primary"  onClick="window.open('<?php echo url_for("AjouterVisitesR",array('code_firme'=>$code_firme)); ?>')">
                            <i class="icon-add position-left"></i>
                            Compte rendu de visite
                        </button>
                    <?php endif;?>
                    <?php if($sf_user->hasCredential("ajoutervisite_planifiee")):?>
                        <button type="button" class="btn btn-primary"  onClick="window.open('<?php echo url_for("AjouterVisitesP",array('code_firme'=>$code_firme)); ?>')">
                            <i class="icon-add position-left"></i>
                            Planifier une visite
                        </button>
                    <?php endif;?>
                    <?php if($sf_user->hasCredential("ajouterdecouverte")):?>
                        <button type="button" class="btn btn-primary"  onClick="window.open('<?php echo url_for("Ajouterdecouverte",array('code_firme'=>$code_firme)); ?>')">
                            <i class="icon-add position-left"></i>
                            Ajouter une découverte
                        </button>
                    <?php endif;?>
                    <?php if($sf_user->hasCredential("ajoutercommentaire")):?>
                        <button type="button" class="btn btn-primary"  onClick="window.open('<?php echo url_for("Ajoutercommentaire",array('code_firme'=>$code_firme)); ?>')">
                            <i class="icon-add position-left"></i>
                            Ajouter un commentaire
                        </button>
                    <?php endif; ?>
                    <?php if($sf_user->hasCredential("supprimerfirme") && $modif_ligne):?>
                        <a href="<?php echo url_for("SupprimerFirme",array('code_firme'=>$code_firme)); ?>"  class="confirm_supp" >
                            <button type="button" class="btn btn-danger" ">
                            <i class="icon-add position-left"></i>
                            Supprimer la Firme
                            </button>
                        </a>
                    <?php endif; ?>
                    <?php if($sf_user->hasCredential("validetracabilite") && $valide=="Rejetée"):?>
                        <button type="button" class="btn btn-success" onClick="modifier('tts_firme_ajoute',<?php echo $fa_id ?>,1);" >
                            <i class="icon-check"></i> Valider
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic layout -->
</div>
<script>

    //------------------ update information ---------------------//
    <?php if($modif_ligne) { ?>
    $('#detail_adresse').hide();
    $('#adresse').on('click', function(){ // on écoute le clic et le double-clic !
        $('#detail_adresse').show();
    });
    /* edit rania 10/12/2019 */
    $('#onglet_adresse').on('click', function(){
        $('#detail_adresse').show();
    });
    /* end edit */
    $('[name=update]').on('click', function(){ // on écoute le clic et le double-clic !
        $('[tts_input='+$( this ).attr('tts_text')+']').show();
        var Focus_Input = $('#firmes_'+$( this ).attr('tts_text'));
        if(!Focus_Input.is("select"))
        {
            var strLength = Focus_Input.val().length * 2;
            Focus_Input.focus();
            Focus_Input[0].setSelectionRange(strLength, strLength);
        }
        $( this ).hide();
    });
    $('.entete strong').on('click', function(){ // on écoute le clic et le double-clic !
        $('[tts_input='+$( this ).attr('tts_titre')+']').show();

        var Focus_Input = $('#firmes_'+$( this ).attr('tts_titre'));
        if(!Focus_Input.is("select"))
        {
            var strLength = Focus_Input.val().length * 2;
            Focus_Input.focus();
            Focus_Input[0].setSelectionRange(strLength, strLength);
        }
        $('[tts_text='+$( this ).attr('tts_titre')+']').hide();
    });
    $(".entete :input")
        .focusout(function() {
            if($( this ).attr('name')!='pac-input'){
                var champ=$( this ).attr('name').split(/\[+/).slice(1,6).join("").slice(0,-1);
                $('[tts_text='+champ+']').show();
                $('[tts_input='+champ+']').hide();
                $('[tts_text='+champ+']').text($( this ).val());
                if(champ=="code_firme_mere")
                    $('#div_rs_comp').show();
                if($( this ).val()=="")
                    $( this ).val("");
                if($('[tts_text='+champ+']').text()!=$( this ).val()){
                    var new_value=$( this ).val().replace(/&/gi, "%and%");
                    var parameters = "champ="+champ+"&type_modification=modification entete&new_value="+$( this ).val();
                    $.ajax({
                        url: '<?php echo url_for('Modifier', array("id_firme"=>$id)) ?>',
                        type: 'post',
                        data: parameters,
                        success: function( data ) {
                            if(data){
                                $('#resultat').html(data);
                                $('#loading-result').hide();
                                $('#resultat').show();
                            }
                            else
                            {
                                $('#resultat').html('');
                                $('#resultat').hide();
                            }
                        },
                        error: function( msg ) {
                            $('#loading-result').hide();
                            alert('Erreur Ajax!');
                        }
                    });
                }
            }
        });
    $(document).on('click', '#btn-map',function(){
        if($('[tts_text=longitude]').text()!=$( this ).val()){
            var parameters = "champ=longitude&type_modification=modification entete&new_value="+$('[tts_text=longitude]').text();
            $.ajax({
                url: '<?php echo url_for('Modifier', array("id_firme"=>$id)) ?>',
                type: 'post',
                data: parameters,
                success: function( data ) {
                    if(data){
                        $('#resultat').html(data);
                        $('#loading-result').hide();
                        $('#resultat').show();
                    }
                    else
                    {
                        $('#resultat').html('');
                        $('#resultat').hide();
                    }
                },
                error: function( msg ) {
                    $('#loading-result').hide();
                    alert('Erreur Ajax!');
                }
            });
        }
        if($('[tts_text=latitude]').text()!=$( this ).val()){
            var parameters = "champ=latitude&type_modification=modification entete&new_value="+$('[tts_text=latitude]').text();
            $.ajax({
                url: '<?php echo url_for('Modifier', array("id_firme"=>$id)) ?>',
                type: 'post',
                data: parameters,
                success: function( data ) {
                    if(data){
                        $('#resultat').html(data);
                        $('#loading-result').hide();
                        $('#resultat').show();
                    }
                    else
                    {
                        $('#resultat').html('');
                        $('#resultat').hide();
                    }
                },
                error: function( msg ) {
                    $('#loading-result').hide();
                    alert('Erreur Ajax!');
                }
            });
        }
        if($('[tts_text=longitude]').text()!=$( this ).val() || $('[tts_text=latitude]').text()!=$( this ).val()){
            alert("la firme a été modifiée avec succès !")
        }
    });
    $(document).on('change', '.entete :input',function(){
        if($( this ).attr('name')!='pac-input'){
            var champ=$( this ).attr('name').split(/\[+/).slice(1,6).join("").slice(0,-1);
            if($('[tts_text='+champ+']').text()!=$( this ).val()){
                $('[tts_text='+champ+']').text($( this ).val());
                if($( this ).val()==""){
                    new_value='';
                }
                else
                    var new_value=$( this ).val().replace(/&/gi, "%and%");
                var parameters = "champ="+champ+"&type_modification=modification entete&new_value="+new_value;
                $.ajax({
                    url: '<?php echo url_for('Modifier', array("id_firme"=>$id)) ?>',
                    type: 'post',
                    data: parameters,
                    success: function( data ) {
                        if(data){
                            $('#resultat').html(data);
                            $('#loading-result').hide();
                            $('#resultat').show();
                        }
                        else
                        {
                            $('#resultat').html('');
                            $('#resultat').hide();
                        }
                    },
                    error: function( msg ) {
                        $('#loading-result').hide();
                        alert('Erreur Ajax!');
                    }
                });
            }
            $('[tts_text='+champ+'] ').text($( this ).find('option:selected').text());
            $('[tts_text='+champ+']').show();
            $('[tts_input='+champ+']').hide();
        }
    });
    <?php } ?>
</script>


<script>
    //------------------ hider les images ajax loading---------------------//
    $('#resultat').hide();
    $('#loading-result').hide();

    //-------------- Filtre des Dates ! ----------------- //
    var currentTime = new Date();
    var currentMonth = currentTime.getMonth() + 1
    var currentDay = currentTime.getDate()
    var currentYear = currentTime.getFullYear()
    var currentDate = currentDay + "/" + currentMonth + "/" + currentYear;
    var lastDate = "01/" + "01/" + currentYear;
    //$('#dateFrom').val(lastDate);

    $(document).ready(function(){

        //-----------------Filter Button ------------- //
        $(document).on('click', '#filter-button',function(){
            var parameters = "dateFrom="+$('#dateFrom').val()+"&dateTo="+$('#dateTo').val();
            var mvt = $('#Mouvement').val();

            if (mvt){
                for(i=0;i<mvt.length;i++){
                    parameters += "&Mouvement[]="+mvt[i];
                }
            }
            $('#resultat').html('');
            $('#loading-result').show();
            $.ajax({
                url: '<?php echo url_for('Historique', array("code_firme"=>$code_firme)) ?>',
                type: 'post',
                data: parameters,
                success: function( data ) {
                    if(data){
                        $('#resultat').html(data);
                        $('#loading-result').hide();
                        $('#resultat').show();
                    }
                    else
                    {
                        $('#resultat').html('');
                        $('#resultat').hide();
                    }
                },
                error: function( msg ) {
                    $('#loading-result').hide();
                    alert('Erreur Ajax!');
                }
            });
        });

    });
    function modifier(ligne,id,act){ // on écoute le clic et le double-clic !
        var parameters = "ligne="+ligne+"&id="+id+"&act="+act;
        $.ajax({
            url: '<?php echo url_for('Valide') ?>',
            type: 'post',
            data: parameters,
            success: function( data ) {
                location.reload();

            },
            error: function( msg ) {
                alert('Erreur Ajax!');
            }
        });
    }
</script>


<script type="text/javascript">
    $(document).ready(function() {
        //function initialize() {
        <?php if($id):?>
        var x= "33.5720635";
        var y = "-7.6574303";
        <?php $latitude= $oForm->getData("latitude"); if(!empty($latitude)): ?>
        x=$('[tts_text=latitude]').text();
        <?php endif; ?>
        <?php $longitude = $oForm->getData("longitude"); if(!empty($longitude)): ?>
        y=$('[tts_text=longitude]').text();
        <?php endif; ?>
        var myLatlng = new google.maps.LatLng(x,y);
        <?php endif; ?>
        var myOptions = {
            zoom: 15,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

        addMarker(myLatlng, 'Default Marker', map);
        //Désactiver l'affichage des frontières
        var marocStyles = [{featureType: "administrative.country",stylers: [{ visibility: "off" }]}];
        var marocMapType = new google.maps.StyledMapType(marocStyles ,{name: "Maroc"});

        // Associer la carte de style avec le MapTyped
        map.mapTypes.set('maroc', marocMapType );
        map.setMapTypeId('maroc');
        layer = new google.maps.FusionTablesLayer({
            query: {
                select: 'geometry',
                from: '1S4aLkBE5u_WS0WMVSchhBgMLdAARuPEjyW4rs20',
                where: "col1 contains 'MAR'"
            },
            styles: [{
                polylineOptions: {
                    strokeColor: "#6E6E6E",
                    strokeWeight: 1
                }
            }]
        });
        layer.setMap(map);
        //}

        function addMarker(latlng,title,map) {
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: title,
                <?php if($modif_ligne) { ?>
                draggable:true
                <?php } ?>
            });


            google.maps.event.addListener(marker,'drag',function(event) {
                $('[tts_text=latitude]').text(event.latLng.lat());
                $('[tts_text=longitude]').text(event.latLng.lng());
            });

            google.maps.event.addListener(marker,'dragend',function(event) {
                $('[tts_text=latitude]').text(event.latLng.lat());
                $('[tts_text=longitude]').text(event.latLng.lng());
                var $lati = event.latLng.lat();
                var $longitude = event.latLng.lng();
            });
        }


    });

</script>

<!-- script minlength -->

<script>

    /*$("#ice_form_id").validate({
        rules: {
            name: {
                minlength: 16
            }
        },
        messages: {
            name: {
                required: "We need your email address to contact you",
                minlength: jQuery.validator.format("At least {0} characters required!")
            }
        }
    });*/

    $( "#firmes_ref_ann_leg" ).rules( "add", {
        minlength: 5
        messages: {
            minlength: jQuery.validator.format("Please, at least {5} characters are necessary")
        }
    });

</script>