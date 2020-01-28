<script type="text/javascript" charset="utf-8">
    $(document).ready( function () {
        var prestation_one = new jqueryTable();
        var table = $('.display').DataTable();
        $(document).on( 'click', 'tr', function () {
            table.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        });

        prestation_one.create($('#tableau_prestations'));

        <?php if($modif) { ?>

        prestation_one.setActionAdd({'url'  :  "<?php echo url_for('ConsulterFirme',array('act'=>'addPrestation','code_firme'=>$code_firme)) ?>", 'method'  :  "post", "id_form" :  "addform_Prestation_pre"});
        prestation_one.setColumn(1,{name: 'firme_prestation[prestation]'});
        //prestation_one.setColumn(2,{name: 'firme_prestation[rubrique_id]',type: 'select',cssclass:'select', data: '<?php echo json_encode($sf_data->getRaw('rubrique_ran')); ?>'});
        prestation_one.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updatePrestation",'code_firme'=>$code_firme)); ?>"});
        prestation_one.setActionDelete({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"deletePrestation",'code_firme'=>$code_firme)); ?>"});

        <?php } ?>

        prestation_one.isEditable();
        prestation_one.generate();

    });
</script>



<?php
/*print_r($formPrestation["prestation"]);
die('tta');
*/?>

<?php if($modif) { ?>
    <div id="addform_Prestation_pre">
        <form action="">
            <div class="panel-body">
                <div class="row">
                    <div id="nouv-prestation">

                        <div class="col-md-2">Rubrique:</div>
                        <div class="col-md-4">
                            <select class="itemName-rubrique form-control select" <?php echo $formPrestation["rubrique_id"]; ?> name="lien_dirigeant_direction" id= "firme_prestation_code_rubrique_dir">
                                <?php if($oFormPrestation->getData('Lib_Rubrique')):?>
                                    <option value="<?php echo $formPrestation["Lib_Rubrique"]; ?>"><?php echo $formPrestation["Lib_Rubrique"]; ?></option>
                                <?php endif;?>
                            </select>
                        </div>

                        <div class="col-md-2">Prestation:</div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" <?php echo $formPrestation["prestation"]; ?>>
                        </div>

                    </div>
                    <!-- <div id="resultat_marque"></div>-->
                </div>
                <div class="row">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">
                            Enregistrer <i class="icon-arrow-right14 position-right"></i>
                        </button>
                        <button type="reset" class="btn btn-danger">
                            Vider <i class="icon-arrow-right14 position-right"></i>
                        </button>
                        <button type="button" class="btn btn-danger" id="vider_prest">
                            Nouvelle prest <i class="icon-arrow-right14 position-right"></i>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
<?php } ?>


<h5>Prestation télécontact</h5>
<div class="content panel">

    <table id="tableau_prestations" class="display table table-striped table-hover">
        <thead>
        <tr>
            <th>Rubrique</th>
            <th>Prestation</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($prestations as $data) : ?>
            <tr id="<?php echo $data["id"]; ?>">
                <td><?php echo $data['rubrique_ran'] ?></td>
                <td><?php echo $data['prestation'] ?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

</div>


<script>
    $(document).on( 'change', '#firme_prestation_code_rubrique_dir', function () {
        var b = $(this).val();
    } );
</script>