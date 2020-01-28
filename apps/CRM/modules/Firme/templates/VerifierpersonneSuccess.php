
<?php if ($_POST): ?>

<fieldset style="padding : 1em;max-height: 200px;overflow: auto;">
	<table class="display table table-hover table-striped" >

		<thead>
			<tr>
				<th>action</th>
				<th style="display: none;"></th>
				<th style="display: none;"></th>
				<th>Code</th>
				<th>nom</th>
				<th>prenom</th>	
				<th>fonction</th>	
				<th>Code Firme</th>
				<th>Firme</th>		
				<th>Ville</th>		
			</tr>
		</thead>

		<tbody>
			<?php foreach ($verfier as $row): ?>
				<tr>
				<td><input type="radio" name="ligne" value="<?php echo $row['code_personne'] ?>"></td>
					<td style="display: none;"></td>
					<td style="display: none;"></td>
					<td><?php echo $row['code_personne'] ?></td>
					<td><?php echo $row['nom'] ?></td>
					<td><?php echo $row['prenom'] ?></td>
					<td><?php echo $row['fonction'] ?></td>
					<td><?php echo $row['code_firme'] ?></td>
					<td><?php echo $row['rs_comp'] ?></td>
					<td><?php echo $row['ville'] ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>

	</table>
</fieldset>
<?php endif ?>