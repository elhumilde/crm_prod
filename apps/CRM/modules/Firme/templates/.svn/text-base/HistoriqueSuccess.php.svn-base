<script>

$(document).ready(function(){

	var oTable = new jqueryTable();
	oTable.addOption( { aoColumnDefs: [{ aTargets: [3], sType: 'date-euro' }] } );
	oTable.create($('#table11'));
	oTable.isEditable();
	oTable.generate();

});

</script>

<?php if ($_POST): ?>

<fieldset style="padding : 1em;">
	<table id="table11" class="display table table-hover table-striped" >

		<thead>
			<tr>
				<th>Type</th>
				<th>Code</th>
				<th>Acteur</th>
				<th>Libellé</th>
				<th>date </th>		
				<th>Résultat </th>		
			</tr>
		</thead>

		<tbody>
			<?php foreach ($histo as $row): ?>
			<tr 
			     <?php if($row['type']=="bc"): ?>
			         onClick="window.open('<?php echo url_for('Detailbc',array("num_bc" => $row['code'])) ?>')"
						 style="cursor: pointer;"
			     <?php elseif($row['type']=="production"): ?>
			         onClick="window.open('<?php echo url_for('Detailproduction',array("num_bc" => $row['code'])) ?>')"
						 style="cursor: pointer;"
						 
			     <?php elseif($row['type']=="reclamation"): ?>
			         onClick="window.open('<?php echo url_for('AjouterReclamation',array("code" => $row['code'])) ?>')"
						 style="cursor: pointer;"
			     <?php elseif($row['type']=="opportunite"): ?>
			         onClick="window.open('<?php echo url_for('Ajouter_Opportunite',array("code" => $row['code'])) ?>')"
						 style="cursor: pointer;"
			     <?php elseif($row['type']=="visiteeffectuees"): ?>
			         onClick="window.open('<?php echo url_for('AjouterVisitesR',array("id" => $row['code'])) ?>')"
						 style="cursor: pointer;"
				<?php elseif($row['type']=="decouverte"): ?>
			         onClick="window.open('<?php echo url_for('Ajouterdecouverte',array("id" => $row['code'])) ?>')"
						 style="cursor: pointer;"
				<?php elseif($row['type']=="commentaire"): ?>
			         onClick="window.open('<?php echo url_for('Ajoutercommentaire',array("id" => $row['code'])) ?>')"
						 style="cursor: pointer;"
			     <?php endif; ?>
			 >
				<td><?php echo $row['type'] ?></td>
				<td><?php echo $row['code'] ?></td>
				<td><?php echo $row['responsable'] ?></td>
				<td><?php echo $row['objet'] ?></td>
				<td><?php if($row['type'] == 'salon') echo substr($row['date'],0, 4); elseif($row['date']!="0000-00-00") echo $row['date'] ?></td>
				<td><?php echo $row['resultat'] ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>

	</table>
</fieldset>
<?php endif ?>