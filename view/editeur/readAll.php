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

	<h1>Liste des éditeurs</h1>

	<a href="/index.php?controller=editeur&action=viewCreate">Ajouter un éditeur</a>
	<?php if (!$listEditeur): ?>
		<p> Aucun éditeur </p>
	<?php
		else:
			foreach ($listEditeur as $editeur) {
	?>

		<p>
			<a href="/index.php?controller=editeur&action=consult&idEditeur=<?php $editeur->echo('idEditeur') ?>"><?php $editeur->echo('nomEditeur') ?></a>
			<a href="/index.php?controller=representant&action=readAll&idEditeur=<?php $editeur->echo('idEditeur') ?>">Voir les représentants</a>
			<a href="/index.php?controller=editeur&action=actionDelete&idEditeur=<?php $editeur->echo('idEditeur') ?>">Supprimer</a>
		</p>

	<?php
			}
		endif;
	?>

</div>
