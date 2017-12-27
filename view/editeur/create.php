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

<h1>Créer un éditeur</h1>

<form method='post' action='index.php?controller=editeur&action=actionCreate'>

	<input type="hidden" name="idEditeur" value="<?php if (isset($editeur)): $editeur->echo('idEditeur'); endif; ?>">

	<p>
		<input type="text" placeholder="Nom"
		name="nomEditeur" value="<?php if (isset($editeur)): $editeur->echo('nomEditeur'); endif; ?>" required />
	</p>

	<p>
		<input type="text" placeholder="Rue"
		name="rueEditeur" value="<?php if (isset($editeur)): $editeur->echo('rueEditeur'); endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Code postal"
		name="codePostalEditeur" value="<?php if (isset($editeur)): $editeur->echo('codePostalEditeur'); endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Ville"
		name="villeEditeur" value="<?php if (isset($editeur)): $editeur->echo('villeEditeur'); endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Pays"
		name="paysEditeur" value="<?php if (isset($editeur)): $editeur->echo('paysEditeur'); else : echo('France'); endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Site web"
		name="siteWebEditeur" value="<?php if (isset($editeur)): $editeur->echo('siteWebEditeur'); endif; ?>" />
	</p>

	<p>
		<textarea placeholder="Commentaires"
		name="commentaireEditeur"><?php if (isset($editeur)): $editeur->echo('commentaireEditeur'); endif; ?></textarea>
	</p>

	<p>
		<input type="checkbox" placeholder="Actif" name="actifEditeur" value="actifEditeur"
			<?php
				if (isset($editeur)) {
					if ($editeur->actifEditeur) {
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
