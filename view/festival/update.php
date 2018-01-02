<?php if (isset($error)): ?>
	<p class="error">
		<?php echo $error; ?>
	</p>
<?php endif; ?>

<?php if (isset($info)): ?>
	<p class="info">
		<?php echo $info; ?>
	</p>
<?php endif;?>

<h1>Modifier le festival de <?php $festival->echo('anneeFestival'); ?></h1>

<form method='post' action='index.php?controller=festival&action=actionUpdate'>

	<input type="hidden" name="idFestival" value="<?php if (isset($festival)): $festival->echo('idFestival'); endif; ?>">

	<p>
		<input type="text" placeholder="Année du festival"
		name="(int)anneeFestival" value="<?php if (isset($festival)): $festival->echo('anneeFestival'); endif; ?>" required />
	</p>

	<p>
		<input type="number" placeholder="Prix unitaire emplacement"
		name="(null)(int)prixUnitaireEmplacement" value="<?php if (isset($festival)): $festival->echo('prixUnitaireEmplacement'); endif; ?>" />
	</p>

	<p>
		<input type="number" placeholder="Nombre emplacement festival"
		name="(null)(int)nbEmplacementFestival" value="<?php if (isset($festival)): $festival->echo('nbEmplacementFestival'); endif; ?>" />
	</p>

	<p><input type="submit" value="Modifier" /></p>

</form>