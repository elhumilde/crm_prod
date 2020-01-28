<form method="<?php if(!empty($_GET["bd_src"])) echo "POST"; else "GET"; ?>">

<h3>Veuillez suivre les &eacute;tapes :</h3>

<table>
	<tr>
		<td>Applications : </td>
		<td>
			<select name="app" required="required">
				<option></option>
				<?php foreach($all_apps as $a): ?>
				<option value="<?php echo $a; ?>" <?php if(!empty($_GET["app"]) && $_GET["app"] == $a) echo "selected"; ?>><?php echo $a; ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
</table>

<?php if(!empty($_GET["app"])): ?>

<table>
	<tr>
		<td>BD Destinataire : </td>
		<td>
			<select name="bd_dest" required="required">
				<option></option>
				<?php foreach($all_db as $a=>$c): ?>
				<option value="<?php echo $a; ?>" <?php if(!empty($_GET["bd_dest"]) && $_GET["bd_dest"] == $a) echo "selected"; ?>><?php echo $a; ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
</table>

<?php endif; ?>

<?php if(!empty($_GET["bd_dest"])): ?>

<table>
	<tr>
		<td>BD Source : </td>
		<td>
			<select name="bd_src" required="required">
				<option></option>
				<?php foreach($list_src as $a): ?>
				<option value="<?php echo $a; ?>" <?php if(!empty($_GET["bd_src"]) && $_GET["bd_src"] == $a) echo "selected"; ?>><?php echo $a; ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
</table>

<?php endif; ?>

<?php if(!empty($_GET["bd_src"])): ?>

<h4>Listes des Fichiers de migration trouv&eacute;s : </h4>

<ul style="list-style: none;">
<?php foreach($files as $f): ?>
	<li><input type="checkbox" checked="checked" name="file_mg[]" value="<?php echo $f; ?>" ><?php echo $f; ?></li>
<?php endforeach; ?>
</ul>

<?php endif; ?>

<br><br>
<button><?php if(!empty($_GET["bd_src"])) echo "Confirmer et Executer"; else echo "Continue &gt;&gt;"; ?></button>
</form>