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

<h1>Créer un contact</h1>

<p>
	Editeur :
	<?php if(isset($editeur)):?>
		<a href="/index.php?controller=editeur&action=consult&idEditeur=<?php $editeur->echo('idEditeur') ?>"> <?php $editeur->echo('nomEditeur') ?></a>

	<?php endif; ?>
</p>

<form method='post' action='index.php?controller=contact&action=actionCreate'>

	<input type="hidden" name="idEditeur" value="<?php if (isset($_GET['idEditeur'])): echo($_GET['idEditeur']); endif; ?>">
	<input type="hidden" name="idContact" value="<?php if (isset($contact)): $contact->echo('idContact'); endif; ?>">

	<p> Représentant
		<?php if (empty($listRepresentant)): ?>
			<p>Aucun représentant existant</p>
		<?php else: ?>
			<select name="idRepresentant">
				<option selected value="-1">Choisissez un représentant</option>
				<?php foreach ($listRepresentant as $repr) {
						 $repr->idRepresentant; ?>
						<option value="<?php $repr->echo('idRepresentant'); ?>"><?php echo($repr->prenomRepresentant.' '.$repr->nomRepresentant);?></option>
				<?php } ?>
			</select>
		<?php endif; ?>

	</p>


	<p>
		<input type="text" placeholder="Type de contact" name="typeContact" value="<?php if (isset($contact)): $contact->echo('prenomRepresentant'); endif; ?>" required />
	</p>

	<p>
		<input type="date" placeholder="Date du contact AAAA-MM-JJ" name="dateContact" value="<?php if (isset($contact)): $contact->echo('dateContact'); endif; ?>" required />
	</p>

	<p>
		<input type="date" placeholder="Date de relance" name="dateRelance" value="<?php if (isset($contact)): $contact->echo('dateRelance'); endif; ?>" />
	</p>


	<p>
		<input type="text" placeholder="Commentaires"
		name="commentaireRepresentant" value="<?php if (isset($contact)): $contact->echo('commentaireRepresentant'); endif; ?>" />
	</p>

	<p>
		<input type="checkbox" placeholder="Clos" name="clos"
			<?php
				if (isset($contact)) {
					if ($contact->clos) {
						echo "checked";
					}
				}
			?>
		/>
		Clos
	</p>

	<p><input type="submit" value="Enregistrer" /></p>

</form>
