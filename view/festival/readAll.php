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

	<h1>Liste des festivals</h1>

	<a href="/index.php?controller=festival&action=viewCreate">Créer un festival</a>
	<?php if (!$listFestival): ?>
		<p>Aucun festival</p>
	<?php
		else:
			foreach ($listFestival as $festival) {
	?>

		<p>
			<a href="/index.php?controller=festival&action=viewUpdate&idFestival=<?php $festival->echo('idFestival') ?>"><?php $festival->echo('anneeFestival') ?></a>
			<a href="/index.php?controller=festival&action=actionDelete&idFestival=<?php $festival->echo('idFestival') ?>">Supprimer</a>
		</p>

	<?php
			}
		endif;
	?>

</div>
