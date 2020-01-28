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
            <li class="active">Suivi des activités</li>
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
                    <div class="input-group" style="float:left">
                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                        <input type="text" placeholder="jj/mm/aaaa" required="required" class="form-control datepicker-menus"<?php echo $filter["date_from"]?> required="required"> 
                    </div>

                </div>
                <label class="col-md-1 col-md-offset-1" for="focusedInputdes">ET </label>
                <div class="col-md-2">
                    <div class="input-group" style="float:left">
                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                        <input type="text" placeholder="jj/mm/aaaa" required="required" class="form-control datepicker-menus"<?php echo $filter["date_to"]?> required="required">
                    </div>

                </div>

                <label class="col-md-1 col-md-offset-1" for="selectError">Service</label>
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
            </div>

            <div class="row">
                <label class="col-md-1" for="selectError">Société</label>
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

                <label class="col-md-1 col-md-offset-1" for="selectError">Support</label>
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


                <label class="col-md-1 col-md-offset-1" for="selectError">Produit</label>
                <div class="col-md-2">
                    <?php echo TTSList::getListBox(array(
                        "query" => "select code_produit  from detail_bc group by code_produit ",
                        "form" => $filter,
                        "oForm" => $oFilter,
                        "value" => "code_produit",
                        "libel" => "code_produit",
                        "key" => "code_produit",
                        "db" => "bd_web",
                        "class"=>"select"
                    )); ?>
                </div>
            </div>
            <div class="row">

                <label class="col-md-1" for="selectError">Groupe</label>
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
                <label class="col-md-1 col-md-offset-1" for="selectError">Actif</label>
                <div class="col-md-2">
                    <select class="select" <?php echo $filter["actif"]?>>
                        <option value=""></option>
                        <option value="1" <?php if($oFilter->getValue("actif")==1) echo "selected"; ?>>Oui</option>
                        <option value="2" <?php if($oFilter->getValue("actif")==2) echo "selected"; ?>>Non</option>
                    </select>
                </div>

                <label class="col-md-1 col-md-offset-1" for="selectError">Utilisateur</label>
                <div class="col-md-2">
                    <?php
                    $cond_commercial="";
                    if(!$sf_user->hasCredential('allencaissement')):
                        $cond_commercial="where u.id in ($ids_users_affecte)";
                    endif;

                    echo TTSList::getListBox(array(
                        "query" => "select u.id,concat(u.nom,' ',u.prenom) as login from tts_utilisateur u   $cond_commercial order by nom",
                        "form" => $filter,
                        "oForm" => $oFilter,
                        "value" => "id",
                        "libel" => "login",
                        "key" => "id_user",
                        "db" => "crm",
                        "class" => "select"
                    ));
                    ?>
                </div>
            </div>
            <div class="row">


                <div class="col-md-2">
                    <input type="submit" class="btn btn-primary" value="Rechercher" >
                </div>


            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table datatable-fixed-left datatable-button-init-basic">
                    <thead>
                    <tr>
                        <th>Commercial</th>
                        <th>Actif</th>
                        <th >REM Prospect</th>
                        <th >Nb Visites P.</th>
                        <th >Nb Visites R.</th>
                        <th >Nb Appel R.</th>
                        <th >Nb Fiche Rendues</th>
                        <th >Nb Opportunités</th>
                        <th >Nb actions CRM</th>
                        <th >Nb maj firme</th>
                        <th >Nb Création</th>
                        <th >Nb Découverte</th>
                        <th >Nb Reclamations</th>
                        <th >Nb Commande NC</th>
                        <th >Montant Commande NC HT</th>
                        <th >Nb Commande</th>
                        <th >Montant Commande HT</th>
                        <th >Nb Firme BC</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $nbr_visite_p=0;
                    $nbr_visite=0;
                    $nbr_appel=0;
                    $nb_opp=0;
                    $nbr_action=0;
                    $nbr_modification=0;
                    $nb_creation=0;
                    $nb_decouverte=0;
                    $nb_reclamation=0;
                    $nb_bc_nc=0;
                    $mt_ht_nc=0;
                    $nb_bc=0;
                    $mt_ht=0;
                    $nb_firme_bc=0;
                    $nb_fiche_rendues=0;
                    $rem_nb=0;
                    $rem_ca=0;
                    $rem_pros=0;
                    ?>
                    <?php $total_ht = 0; foreach ($datas as $row):?>
                        <tr>
                            <td><?php echo $row["nom_courtier"];  ?></td>
                            <td><?php echo $row["actif"];  ?></td>
                            <td <?php if($row['rem_pros']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "detail_rem_prospect", "courtier" => $row["code"] , "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?> ><?php echo number_format($row["rem_pros"],0,'.',''); $rem_pros+=number_format($row["rem_pros"],0,'.','') ?></td>
                            <td <?php if($row['nbr_visite_p']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "visite_p", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo $row["nbr_visite_p"]; $nbr_visite_p+=$row["nbr_visite_p"]; ?></td>
                            <td <?php if($row['nbr_visite']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "visite_r", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo $row["nbr_visite"]; $nbr_visite+=$row["nbr_visite"]; ?></td>

                            <td <?php if($row['nbr_appel']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "appel_r", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo $row["nbr_appel"]; $nbr_appel+=$row["nbr_appel"]; ?></td>


                            <td <?php if($row['nb_fiche_rendues']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_fiche_rendues", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo $row["nb_fiche_rendues"]; $nb_fiche_rendues+=$row["nb_fiche_rendues"]; ?></td>
                            <td <?php if($row['nb_opp']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_opp", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo $row["nb_opp"]; $nb_opp+=$row["nb_opp"] ; ?></td>
                            <td <?php if($row['nbr_action']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nbr_action", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo $row["nbr_action"]; $nbr_action+=$row["nbr_action"]; ?></td>
                            <td <?php if($row['nbr_modification']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nbr_modification", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo $row["nbr_modification"]; $nbr_modification+=$row["nbr_modification"]; ?></td>
                            <td <?php if($row['nb_creation']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_creation", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo $row["nb_creation"]; $nb_creation+=$row["nb_creation"]; ?></td>
                            <td <?php if($row['nb_decouverte']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_decouverte", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo $row["nb_decouverte"]; $nb_decouverte+=$row["nb_decouverte"]; ?></td>
                            <td <?php if($row['nb_reclamation']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_reclamation", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo $row["nb_reclamation"]; $nb_reclamation+=$row["nb_reclamation"]; ?></td>
                            <td <?php if($row['nb_bc_nc']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_bc_nc", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo $row["nb_bc_nc"]; $nb_bc_nc+=$row["nb_bc_nc"]; ?></td>
                            <td <?php if($row['mt_ht_nc']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "mt_ht_nc", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo number_format($row["mt_ht_nc"],0,'.',' '); $mt_ht_nc+=$row["mt_ht_nc"]; ?></td>
                            <td <?php if($row['nb_bc']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_bc", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo $row["nb_bc"]; $nb_bc+=$row["nb_bc"]; ?></td>

                            <td <?php if($row['mt_ht']): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_bc", "id_user" => $row["id_user"], "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                                style="cursor: pointer;" <?php endif ?>><?php echo number_format($row["mt_ht"],0,'.',''); $mt_ht+=$row["mt_ht"]; ?></td>
                            <td><?php echo $row["nb_firme_bc"]; $nb_firme_bc+=$row["nb_firme_bc"]; ?></td>

                        </tr>
                    <?php endforeach;?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td> Total </td>
                        <td>  </td>
                        <td <?php if($rem_pros): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "detail_rem_prospect", "id_groupe" => $oFilter->getData('id_groupe'))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo $rem_pros ?></td>
                        <td <?php if($nbr_visite_p): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "visite_p", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo $nbr_visite_p ?></td>

                        <td <?php if($nbr_visite): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "visite_r", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo $nbr_visite ?></td>

                        <td <?php if($nbr_appel): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "appel_r", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo $nbr_appel ?></td>


                        <td <?php if($nb_fiche_rendues): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_fiche_rendues", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo $nb_fiche_rendues ?></td>
                        <td <?php if($nb_opp): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_opp", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo $nb_opp ?></td>
                        <td <?php if($nbr_action): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nbr_action", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo $nbr_action ?></td>
                        <td <?php if($nbr_modification): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nbr_modification", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo $nbr_modification ?></td>
                        <td <?php if($nb_creation): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_creation", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo $nb_creation ?></td>
                        <td <?php if($nb_decouverte): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_decouverte", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo $nb_decouverte ?></td>
                        <td <?php if($nb_reclamation): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_reclamation", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo $nb_reclamation ?></td>
                        <td <?php if($nb_bc_nc): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_bc_nc", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo $nb_bc_nc ?></td>
                        <td <?php if($mt_ht_nc): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "mt_ht_nc", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo number_format($mt_ht_nc,0,'.','') ?></td>
                        <td <?php if($nb_bc): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_bc", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo $nb_bc ?></td>
                        <td <?php if($mt_ht): ?> onClick="window.open('<?php echo url_for('activiteCommerciale',array("act" => "nb_bc", "id_groupe" => $oFilter->getData('id_groupe'), "date_from" => $oFilter->getData('date_from'), "date_to" => date($oFilter->getData('date_to')))) ?>')"
                            style="cursor: pointer;" <?php endif ?>><?php echo number_format($mt_ht,0,'.','') ?></td>
                        <td><?php echo $nb_firme_bc ?></td>

                    </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>

