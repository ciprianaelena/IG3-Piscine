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

	<h1>Liste des représentants</h1>

	<a href="/index.php?controller=representant&action=viewCreate&idEditeur=<?php echo($_GET['idEditeur']) ?>">Ajouter un représentant</a>

	<?php if (!$listRepresentant): ?>
		<p> Aucun représentant pour cet éditeur </p>
	<?php
		else:
			foreach ($listRepresentant as $representant) {
	?>

		<p>
			<a href="/index.php?controller=representant&action=viewUpdate&idRepresentant=<?php $representant->echo('idRepresentant') ?>"><?php $representant->echo('prenomRepresentant'); echo(' '); $representant->echo('nomRepresentant'); ?></a>
			<a href="/index.php?controller=representant&action=actionDelete&idRepresentant=<?php $representant->echo('idRepresentant') ?>">Supprimer</a>
		</p>

	<?php
			}
		endif;
	?>

</div>