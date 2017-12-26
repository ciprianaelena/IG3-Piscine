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


<h1> Consultation d'un éditeur </h1>
<h2><?php if(isset($editeur)): $editeur->echo('nomEditeur'); endif; ?> </h2>


<!-- Affichage des informations de léditeur -->
<div>
	<ul>

		<li> Identifiant : <?php if (isset($editeur)): $editeur->echo('idEditeur'); endif; ?></li>


		<li> Nom : <?php if (isset($editeur)): $editeur->echo('nomEditeur'); endif; ?></li>



		<li> Pays : <?php if (isset($editeur)): $editeur->echo('paysEditeur'); endif; ?> </li>



		<li> Ville : <?php if (isset($editeur)): $editeur->echo('villeEditeur'); endif; ?></li>



		<li> Rue : <?php if (isset($editeur)): $editeur->echo('rueEditeur'); endif; ?> </li>



		<li> Code Postal : <?php if (isset($editeur)): $editeur->echo('codePostalEditeur'); endif; ?> </li>



		<li> Site Web : <?php if (isset($editeur)): $editeur->echo('siteWebEditeur'); endif; ?> </li>



		<li> Commentaire : <?php if (isset($editeur)): $editeur->echo('commentaireEditeur'); endif; ?> </li>



		<?php
				if (isset($editeur)) {
					if ($editeur->actifEditeur) {
						echo "<li>Editeur Actif</li>";
					} else {
						echo "<li>Editeur Inactif</li>";
					}
				}
		?>
	</ul>

	<?php if(isset($editeur)):?>
		<a href="/index.php?controller=representant&action=readAll&idEditeur=<?php $editeur->echo('idEditeur') ?>">Voir les représentants</a>
		<a href="/index.php?controller=editeur&action=viewUpdate&idEditeur=<?php $editeur->echo('idEditeur')?>">Modifier <?php $editeur->echo('nomEditeur	')?></a>
	<?php endif;?>
</div>



<!-- Affichage des jeux de léditeur -->
<div>

	<h2>Jeux</h2>

		<a href="/index.php?controller=jeu&action=viewCreate&idEditeur=<?php if (isset($editeur)): $editeur->echo('idEditeur'); endif; ?>">Ajouter un jeu</a>

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

<!-- Affichage des contacts avec l'éditeur -->
<div>

	<h2>Contact</h2>

		<a href="/index.php?controller=contact&action=viewCreate&idEditeur=<?php if (isset($editeur)): $editeur->echo('idEditeur'); endif; ?>">Ajouter un contact</a>

		<?php if (!$listContact): ?>
			<p> Aucun jeu </p>
		<?php
			else:
				foreach ($listContact as $contact) {
		?>

			<p>
				<a href="/index.php?controller=contact&action=consult&idContact=<?php $contact->echo('idContact') ?>"><?php $contact->echo('dateContact'); ?></a>
			</p>

		<?php
				}
			endif;
		?>

</div>
