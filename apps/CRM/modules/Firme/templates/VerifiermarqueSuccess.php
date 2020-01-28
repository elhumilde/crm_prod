
<?php if ($_POST): ?>

<fieldset style="padding : 1em;max-height: 200px;overflow: auto;">
	<table class="display table table-hover table-striped" >

		<thead>
			<tr>
				<th>action</th>
				<th style="display: none;"></th>
				<th style="display: none;"></th>
				<th style="display: none;"></th>
				<th>Code</th>
				<th>Nom</th>
				<th>Descripion</th>		
				<th>Code firme</th>		
				<th>Firme</th>		
			</tr>
		</thead>

		<tbody>
			<?php foreach ($verfier as $row): ?>
				<tr>
				<td><input type="radio" name="ligne" value="<?php echo $row['code_marque'] ?>"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td><?php echo $row['code_marque'] ?></td>
					<td><?php echo $row['nom_marque'] ?></td>
					<td><?php echo $row['description'] ?></td>
					<td><?php echo $row['code_firme'] ?></td>
					<td><?php echo $row['rs_comp'] ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>

	</table>
</fieldset>
<?php endif ?>