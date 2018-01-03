<h1> Consultation d'un éditeur </h1>

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

<h2><?php if(isset($editeur)): $editeur->echo('nomEditeur'); endif; ?> </h2>

<!-- Affichage des informations de léditeur -->
<div>
	<ul>

		<li> Nom : <?php if (isset($editeur)): $editeur->echo('nomEditeur'); endif; ?></li>

		<li> Rue : <?php if (isset($editeur)): $editeur->echo('rueEditeur'); endif; ?> </li>

		<li> Code Postal : <?php if (isset($editeur)): $editeur->echo('codePostalEditeur'); endif; ?> </li>

		<li> Ville : <?php if (isset($editeur)): $editeur->echo('villeEditeur'); endif; ?></li>

		<li> Pays : <?php if (isset($editeur)): $editeur->echo('paysEditeur'); endif; ?> </li>

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
		<p>
			<a href="/index.php?controller=editeur&action=viewUpdate&idEditeur=<?php $editeur->echo('idEditeur')?>">Modifier <?php $editeur->echo('nomEditeur')?></a>
		</p>
		<a href="/index.php?controller=editeur&action=actionDelete&idEditeur=<?php $editeur->echo('idEditeur') ?>">Supprimer</a>
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
			<p> Aucun contact </p>
		<?php
			else:
				foreach ($listContact as $contact) {
		?>

			<p>
				<a href="/index.php?controller=contact&action=consult&idContact=<?php $contact->echo('idContact') ?>"><?php echo($contact->typeContact." / ".$contact->dateContact); ?></a>
				<a href="/index.php?controller=contact&action=actionDelete&idContact=<?php $contact->echo('idContact') ?>">Supprimer</a>
			</p>

		<?php
				}
			endif;
		?>

</div>

<!-- Affichage des logements de l'éditeur -->
<div>

	<h2>Demande de logements</h2>

		<a href="/index.php?controller=logement&action=viewCreate&idEditeur=<?php if (isset($editeur)): $editeur->echo('idEditeur'); endif; ?>">Faire une demande de logement</a>

		<?php if (!$listLogement): ?>
			<p>Aucune demande de logement</p>
		<?php
			else:
				foreach ($listLogement as $logement) {
		?>

			<p>
				<a href="/index.php?controller=logement&action=viewUpdate&idDemande=<?php $logement->echo('idDemande') ?>">Demande n°<?php echo($logement->idDemande); ?></a>
				<a href="/index.php?controller=logement&action=actionDelete&idDemande=<?php $logement->echo('idDemande') ?>">Supprimer</a>
			</p>

		<?php
				}
			endif;
		?>

</div>

<!-- Affichage des colis de l'éditeur -->
<div>

	<h2>Colis</h2>

		<a href="/index.php?controller=colis&action=viewCreate&idEditeur=<?php if (isset($editeur)): $editeur->echo('idEditeur'); endif; ?>">Ajouter un colis</a>

		<?php if (!$listColis): ?>
			<p> Aucun colis </p>
		<?php
			else:
				foreach ($listColis as $colis) {
		?>

			<p>
				<a href="/index.php?controller=colis&action=consult&idColis=<?php $colis->echo('idColis') ?>"><?php echo("Colis n°".$colis->idColis) ?></a>
				<a href="/index.php?controller=colis&action=actionDelete&idColis=<?php $colis->echo('idColis') ?>">Supprimer</a>
			</p>

		<?php
				}
			endif;
		?>

</div>
