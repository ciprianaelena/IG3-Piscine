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

<h1> Consultation d'un jeu </h1>
<h2> <?php if(isset($jeu)): $jeu->echo('nomJeu');endif; ?> </h2>

<!-- Affichage des informations du jeu -->
<div>
	<ul>
		<li>
			Identifiant : <?php if (isset($jeu)): $jeu->echo('idJeu'); endif; ?>
		</li>


		<li>
			Nom : <?php if (isset($jeu)): $jeu->echo('nomJeu'); endif; ?>
		</li>

		<li>
			Editeur : <?php if(isset($editeur)):?>
				<a href="/index.php?controller=editeur&action=consult&idEditeur=<?php $editeur->echo('idEditeur') ?>"> <?php $editeur->echo('nomEditeur') ?></a>
			<?php endif; ?>
		</li>

		<li>
			Règles du jeu : <?php if (isset($jeu)): $jeu->echo('regles'); endif; ?>
		</li>

		<li> Prototype :
			<?php
			if(isset($jeu)) {
				if($jeu->prototype){
					echo('Oui');
				} else {
					echo('Non');
				}
			}?>
		</li>

		<li>Dimensions :
			<ul>
				<li>
					Largeur : <?php if (isset($jeu)): $jeu->echo('largeur'); endif; ?>
				</li>

				<li>
					Hauteur : <?php if (isset($jeu)): $jeu->echo('hauteur'); endif; ?>
				</li>

				<li>
					Longueur : <?php if (isset($jeu)): $jeu->echo('longueur'); endif; ?>
				</li>
			</ul>
		</li>

		<li>
			Poids : <?php if (isset($jeu)): $jeu->echo('poids'); endif; ?>
		</li>

		<li>
			Date de Sortie : <?php if (isset($jeu)): $jeu->echo('dateSortie'); endif; ?>
		</li>

		<li>
			Nombre de joueur :  <?php if (isset($jeu)): $jeu->echo('nbJoueur'); endif; ?>
		</li>

		<li>
			Durée d'une partie : <?php if (isset($jeu)): $jeu->echo('dureePartie'); endif; ?>
		</li>
	</ul>

	<?php
	if(isset($jeu)){
		echo('<a href="/index.php?controller=jeu&action=viewUpdate&idJeu='.$jeu->idJeu.'">Modifier '.$jeu->nomJeu.'</a>');
	}?>
</div>
