<style>
    .ui-dialog {
        width:auto!important;
    }
</style>
<script type="text/javascript" charset="utf-8">
    $(document).ready( function () {
        var certifi = new jqueryTable();
        var table = $('.display').DataTable();
        $(document).on( 'click', 'tr', function () {
            table.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        } );
        certifi.create($('#tableau_certif'));

        <?php if($modif) { ?>
        certifi.setActionAdd({'url'  :  "<?php echo url_for('ConsulterFirme',array('act'=>'addCertif','code_firme'=>$code_firme)) ?>", 'method'  :  "post", "id_form" :  "addform_certif"});
        certifi.setColumn(1,{name: 'firme_certif[aut_certification]'});
        certifi.setColumn(2,{name: 'firme_certif[certification]'});
        certifi.setColumn(3,{name: 'firme_certif[cert_expiration]'});
        certifi.setColumn(4,{name: 'firme_certif[num_certification]'});
        certifi.setColumn(5,{name: 'firme_certif[produit]'});
        certifi.setActionUpdate({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"updateCertif",'code_firme'=>$code_firme)); ?>"});
        certifi.setActionDelete({'url' : "<?php echo url_for('ConsulterFirme',array("act"=>"delete_certif",'code_firme'=>$code_firme)); ?>"});

        <?php } ?>
        certifi.isEditable();
        certifi.generate();

    });
</script>

<?php if($modif) { ?>
    <div id="addform_certif">
        <form action="">
            <div class="panel-body">
                <div class="row">
                    <div id="nouv-certif">


                        <div class="col-md-2">ORGANISME de certification :</div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" <?php echo $formCertif["aut_certification"]; ?>>
                        </div>
                        <div class="col-md-2">CERTIFICATION:</div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" <?php echo $formCertif["certification"]; ?>>
                        </div>
                        <div class="col-md-2">Date EXPIRATION:</div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" <?php echo $formCertif["cert_expiration"]; ?>>
                        </div>
                        <div class="col-md-2">type de certification:</div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" <?php echo $formCertif["num_certification"]; ?>>
                        </div>
                        <div class="col-md-2">PRODUIT:</div>
                        <div class="col-md-4">
                            <textarea class="form-control" <?php echo $formCertif["produit"]; ?>></textarea>
                        </div>

                    </div>
                    <div id="resultat_marque"></div>
                </div>
                <div class="row">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">
                            Enregistrer <i class="icon-arrow-right14 position-right"></i>
                        </button>
                        <button type="reset" class="btn btn-danger">
                            Vider <i class="icon-arrow-right14 position-right"></i>
                        </button>
                        <button type="button" class="btn btn-success" id="verifier_certif">
                            Verifier <i class="icon-arrow-right14 position-right"></i>
                        </button>
                        <button type="button" class="btn btn-danger" id="vider_certif">
                            Nouvelle marque <i class="icon-arrow-right14 position-right"></i>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
<?php } ?>

<h5>Certifications</h5>
<div class="col-md-12">
    <div class="content panel">

        <table id="tableau_certif" class="display table table-striped table-hover">
            <thead>
            <tr>
                <!--                <th>CODE_FIRME</th>-->
                <th>ORGANISME DE CERTIFICATION</th>
                <th>CERTIFICATION</th>
                <th>DATE EXPIRATION</th>
                <th>NUM CERTIFICATION</th>
                <th>PRODUIT OU SERVICE</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($certifications as $data) : ?>
                <tr id="<?php echo $data["id"]; ?>">
                    <!--                    <td class="id_certification" id="--><?php //echo $data["id"]; ?><!--">--><?php //echo $data['CODE_FIRME']?><!--</td>-->
                    <td><?php echo $data['AUT_CERTIFICATION']?></td>
                    <td><?php echo $data['CERTIFICATION']?></td>
                    <td><?php echo $data['CERT_EXPIRATION']?></td>
                    <td><?php echo $data['NUM_CERTIFICATION']?></td>

                    <td><?php echo $data['PRODUIT']?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
