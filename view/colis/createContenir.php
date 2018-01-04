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

<h1>Créer un colis : Ajout des jeux</h1>

<form method='post' action='index.php?controller=colis&action=actionCreateContenir'>

	<input type="hidden" name="(int)idContenir" value="<?php if (isset($contenir)): $contenir->echo('idContenir'); endif; ?>" />
	<input type="hidden" name="(int)idColis" value="<?php if (isset($colis)): $colis->echo('idColis'); endif; ?>" />

	<p>
		Editeur :
		<?php if(isset($editeur)):?>
			<a href="/index.php?controller=editeur&action=consult&idEditeur=<?php $editeur->echo('idEditeur') ?>"> <?php $editeur->echo('nomEditeur') ?></a>
		<?php endif; ?>
	</p>

	<p>
		Jeu :
		<?php if (empty($listJeu)): ?>
			Aucun jeu existant. Veuillez en <a href="/index.php?controller=jeu&action=viewCreate&idEditeur=<?php $editeur->echo('idEditeur') ?>">créer</a> un.
		<?php else: ?>
			<select name="(int)idJeu">
				<option selected value="-1">Choisissez un jeu</option>
				<?php foreach ($listJeu as $jeu) {
						$id = $jeu->idJeu; ?>
						<option value="<?php $jeu->echo('idJeu'); ?>"><?php $jeu->echo('nomJeu'); ?></option>
				<?php } ?>
			</select>
		<?php endif; ?>
	</p>


	<p>
		Quantité :
		<input type="number" name="(null)quantite" placeholder="Quantité"  value="<?php if (isset($contenir)): $contenir->echo('quantite'); endif; ?>" required/>
	</p>

	<p>
		<input type="checkbox" placeholder="renvoyer" name="(int)renvoyer" value="renvoyer"
			<?php
				if (isset($contenir)) {
					if ($contenir->renvoyer) {
						echo "checked";
					}
				}
			?>
		/>
		Jeu à renvoyer ?
	</p>

	<p><input type="submit" value="Créer"/></p>

</form>
