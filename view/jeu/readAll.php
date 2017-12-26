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

<div>

	<h1>Liste des jeux</h1>

	<a href="/index.php?controller=jeu&action=viewCreate">Ajouter un jeu</a>

	<?php if (!$listJeux): ?>
		<p> Aucun jeu </p>
	<?php
		else:
			foreach ($listJeux as $jeu) {
	?>

		<p>
			<a href="/index.php?controller=jeu&action=consult&idJeu=<?php $jeu->echo('idJeu') ?>"><?php $jeu->echo('nomJeu'); ?></a>
			<a href="/index.php?controller=jeu&action=actionDelete&idJeu=<?php $jeu->echo('idJeu') ?>">Supprimer</a>
		</p>

	<?php
			}
		endif;
	?>

</div>
