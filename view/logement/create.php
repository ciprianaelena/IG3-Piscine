<h1>Faire une demande de logement</h1>

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

<p>
	Editeur :
	<?php if(isset($editeur)):?>
		<a href="/index.php?controller=editeur&action=consult&idEditeur=<?php $editeur->echo('idEditeur') ?>"> <?php $editeur->echo('nomEditeur') ?></a>
	<?php endif; ?>
</p>

<form method='post' action='index.php?controller=logement&action=actionCreate'>

	<input type="hidden" name="idEditeur" value="<?php if (isset($_GET['idEditeur'])): echo($_GET['idEditeur']); endif; ?>">

	<p>
		Festival
		<?php if (empty($listFestival)): ?>
			<p>Aucun festival existant</p>
		<?php else: ?>
			<select name="(int)idFestival">
				<option value="-1">Choisissez un festival</option>
				<?php foreach ($listFestival as $festival) { ?>
						<option value="<?php $festival->echo('idFestival'); ?>"><?php $festival->echo('anneeFestival'); ?></option>
				<?php } ?>
			</select>
		<?php endif; ?>
	</p>

	<p>
		<input type="text" placeholder="Coût par nuit"
		name="(null)(int)coutParNuit" value="<?php if (isset($logement)): $logement->echo('coutParNuit'); endif; ?>" />
	</p>

	<p>
		<input type="number" placeholder="Nombre de places"
		name="(null)(int)nbPlace" value="<?php if (isset($logement)): $logement->echo('nbPlace'); endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Rue logement"
		name="RueLogement" value="<?php if (isset($logement)): $logement->echo('RueLogement'); endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Code postal logement"
		name="CPLogement" value="<?php if (isset($logement)): $logement->echo('CPLogement'); endif; ?>" />
	</p>

	<p><input type="submit" value="Ajouter" /></p>

</form>
