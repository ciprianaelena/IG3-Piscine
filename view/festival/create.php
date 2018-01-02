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

<h1>Création d'un festival</h1>

<form method='post' action='index.php?controller=festival&action=actionCreate'>

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

	<p><input type="submit" value="Créer" /></p>

</form>