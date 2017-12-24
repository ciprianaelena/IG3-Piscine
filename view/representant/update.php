<?php if (isset($error)): ?>
	<p class="error">
		<?php echo $error; ?>
	</p>
<?php endif; ?>

<?php if (isset($info)): ?>
	<p class="info">
		<?php echo $info; ?>
	</p>
<?php endif; ?>

<h1>Modifier un représentant</h1>

<form method='post' action='index.php?controller=representant&action=actionUpdate'>

	<input type="hidden" name="idRepresentant" value="<?php if (isset($representant)): $representant->echo('idRepresentant'); endif; ?>">

	<p>
		<input type="text" placeholder="Nom" 
		name="nomRepresentant" value="<?php if (isset($representant)): $representant->echo('nomRepresentant'); endif; ?>" required />
	</p>

	<p>
		<input type="text" placeholder="Prenom" 
		name="prenomRepresentant" value="<?php if (isset($representant)): $representant->echo('prenomRepresentant'); endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Mail" 
		name="mailRepresentant" value="<?php if (isset($representant)): $representant->echo('mailRepresentant'); endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Téléphone fixe" 
		name="telFixeRepresentant" value="<?php if (isset($representant)): $representant->echo('telFixeRepresentant'); endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Téléphone Mobile" 
		name="telMobileRepresentant" value="<?php if (isset($representant)): $representant->echo('telMobileRepresentant'); endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Site web" 
		name="siteWebEditeur" value="<?php if (isset($representant)): $representant->echo('siteWebEditeur'); endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Commentaires" 
		name="commentaireRepresentant" value="<?php if (isset($representant)): $representant->echo('commentaireRepresentant'); endif; ?>" />
	</p>

	<p>
		<input type="checkbox" placeholder="Actif" name="actifRepresentant" value="actifRepresentant" 
			<?php 
				if (isset($representant)) {
					if ($representant->actifRepresentant) {
						echo "checked";
					}
				} else {
					echo "checked";
				}
			?> 
		/>
		Actif
	</p>

	<p><input type="submit" value="Enregistrer" /></p>

</form>