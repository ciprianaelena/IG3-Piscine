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

	<p> Représentant :
		<?php if (empty($listRepresentant)): ?>
			Aucun représentant existant. Veuillez en <a href="/index.php?controller=representant&action=viewCreate&idEditeur=<?php echo($_GET['idEditeur']) ?>">créer</a> un.
		<?php else: ?>
			<select name="idRepresentant">
				<option selected value="-1">Choisissez un représentant</option>
				<?php foreach ($listRepresentant as $repr) {?>
						<option value="<?php $repr->echo('idRepresentant'); ?>"><?php echo($repr->prenomRepresentant.' '.$repr->nomRepresentant);?></option>
				<?php } ?>
			</select>
		<?php endif; ?>

	</p>


	<p>
		Type de contact <input type="text" placeholder="Mail / Appel / SMS ..." name="typeContact" value="<?php if (isset($contact)): $contact->echo('typeContact'); endif; ?>" required />
	</p>

	<p>
		Date du contact <input type="date" placeholder="AAAA-MM-JJ" name="dateContact" value="<?php if (isset($contact)): $contact->echo('dateContact'); else: echo(date("Y-m-d"));endif; ?>" required />
	</p>

	<p>
		Date de relance <input type="date" placeholder="AAAA-MM-JJ" name="dateRelance" value="<?php if (isset($contact)): $contact->echo('dateRelance'); endif; ?>" />
	</p>


	<p>
		<textarea type="text" placeholder="Commentaires"
		name="commentaireContact"><?php if (isset($contact)): $contact->echo('commentaireContact'); endif; ?></textarea>
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
