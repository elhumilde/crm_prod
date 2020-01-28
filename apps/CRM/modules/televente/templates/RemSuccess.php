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
            <li class="active">Televente</li>
        </ul>
    </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Liste de REM </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <table  id="tableau2" class="display table table-striped table-hover">
                <thead>
                <tr>
                    <th class="essential persist">Firme</th>
                    <th class="essential persist">Commercial</th>
                    <th class="optional">Nb Appel</th>
                    <th class="optional">Prochain Appel</th>
                    <th class="optional">Dernier Appel</th>
                    <th class="optional">Dernier Resultat</th>
                    <th class="optional">Compagne</th>

                    <th class="essential persist" >Activit&eacute;</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($data as $row):?>
                    <tr style="cursor: pointer; cursor: hand;"
                        ondblclick='window.open("<?php echo url_for('ConsulterFirme',array('id'=>$row['id'])); ?>", "_blank");'>
                        <td><?php echo $row["rs_comp"]; ?></td>
                        <td><?php echo $row["commercial"]; ?></td>
                        <td><?php echo $row["nb_appel"]; ?></td>
                        <td><?php echo $row["date_rappel"]; ?></td>
                        <td><?php echo $row["date_appel"]; ?></td>
                        <td><?php echo $row["res"]; ?>          </td>
                        <td><?php echo $row["compa"]; ?>          </td>
                        <td><?php echo $row["tp_40"]; ?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

