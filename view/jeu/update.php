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

<h1>Modifier un jeu</h1>

<form method='post' action='index.php?controller=jeu&action=actionUpdate'>

	<input type="hidden" name="idJeu" value="<?php if (isset($jeu)): $jeu->echo('idJeu'); endif; ?>" />

	<p>
		<input type="text" placeholder="Nom" 
		name="nomJeu" value="<?php if (isset($jeu)): $jeu->echo('nomJeu'); endif; ?>" required />
	</p>

	<p>
		<p>Règles du jeu</p>
		<textarea name="regles" value="<?php if (isset($jeu)): $jeu->echo('regles'); endif; ?>"></textarea>
	</p>

	<p>
		<input type="checkbox" placeholder="Actif" name="prototype" value="prototype" 
			<?php 
				if (isset($jeu)) {
					if ($jeu->prototype) {
						echo "checked";
					}
				} else {
					echo "checked";
				}
			?> 
		/>
		Prototype
	</p>


	<p>Dimensions</p>
	<p>
		<input type="text" placeholder="Largeur" 
		name="largeur" value="<?php if (isset($jeu)): $jeu->echo('largeur'); endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Hauteur" 
		name="hauteur" value="<?php if (isset($jeu)): $jeu->echo('hauteur'); endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Longueur" 
		name="longueur" value="<?php if (isset($jeu)): $jeu->echo('longueur'); endif; ?>" />
	</p>

	<p>
		Poids en grammes
		<input type="text" placeholder="Poids" 
		name="poids" value="<?php if (isset($jeu)): $jeu->echo('poids'); endif; ?>" />
	</p>

	<p>
		Date de sortie
		<input type="date" name="dateSortie" value="<?php if (isset($jeu)): $jeu->echo('dateSortie'); endif; ?>" />
	</p>

	<p>
		Nombre de joueur
		<input type="number" name="nbJoueur" value="<?php if (isset($jeu)): $jeu->echo('nbJoueur'); endif; ?>" />
	</p>

	<p>
		Durée moyenne d'une partie
		<input type="number" name="dureePartie" value="<?php if (isset($jeu)): $jeu->echo('dureePartie'); endif; ?>" />
	</p>

	<p><input type="submit" value="Ajouter" /></p>

</form>