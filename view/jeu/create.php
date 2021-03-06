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

<h1>Ajouter un jeu</h1>

<form method='post' action='index.php?controller=jeu&action=actionCreate'>

	<input type="hidden" name="idJeu" value="<?php if (isset($jeu)): $jeu->echo('idJeu'); endif; ?>" />

	<p>
		<input type="text" placeholder="Nom"
		name="nomJeu" value="<?php if (isset($jeu)): $jeu->echo('nomJeu'); endif; ?>" required />
	</p>

	<p>
		Editeur
		<?php if (empty($listEditeur)): ?>
			<p>Aucun éditeur existant</p>
		<?php else: ?>
			<select name="(int)idEditeur">
				<option <?php if($selectedEditeur==-1): echo("selected"); endif; ?> value="-1">Choisissez un éditeur</option>
				<?php foreach ($listEditeur as $editeur) {
						$id = $editeur->idEditeur; ?>
						<option <?php if($selectedEditeur==$id): echo("selected"); endif; ?> value="<?php echo($id); ?>"><?php $editeur->echo('nomEditeur'); ?></option>
				<?php } ?>
			</select>
		<?php endif; ?>
	</p>

	<p>
		<p>Règles du jeu</p>
		<textarea name="regles"><?php if (isset($jeu)): $jeu->echo('regles'); endif; ?></textarea>
	</p>

	<p>
		<input type="checkbox" placeholder="Actif" name="prototype" value="prototype"
			<?php
				if (isset($jeu)) {
					if ($jeu->prototype) {
						echo "checked";
					}
				}
			?>
		/>
		Prototype
	</p>


	<p>Dimensions</p>
	<p>
		<input type="number" placeholder="Largeur"
		name="(null)(int)largeur" value="<?php if (isset($jeu)): $jeu->echo('largeur'); endif; ?>" />
	</p>

	<p>
		<input type="number" placeholder="Hauteur"
		name="(null)(int)hauteur" value="<?php if (isset($jeu)): $jeu->echo('hauteur'); endif; ?>" />
	</p>

	<p>
		<input type="number" placeholder="Longueur"
		name="(null)(int)longueur" value="<?php if (isset($jeu)): $jeu->echo('longueur'); endif; ?>" />
	</p>

	<p>
		Poids en grammes
		<input type="number" placeholder="Poids"
		name="(null)(int)poids" value="<?php if (isset($jeu)): $jeu->echo('poids'); endif; ?>" />
	</p>

	<p>
		Date de sortie
		<input type="date" name="(null)dateSortie" value="<?php if (isset($jeu)): $jeu->echo('dateSortie'); endif; ?>" />
	</p>

	<p>
		Nombre de joueur
		<input type="number" name="(null)(int)nbJoueur" value="<?php if (isset($jeu)): $jeu->echo('nbJoueur'); endif; ?>" />
	</p>

	<p>
		Durée moyenne d'une partie en minutes
		<input type="number" name="(null)(int)dureePartie" value="<?php if (isset($jeu)): $jeu->echo('dureePartie'); endif; ?>" />
	</p>

	<p><input type="submit" value="Ajouter" /></p>

</form>
