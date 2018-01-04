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

<h1>Créer un colis</h1>

<form method='post' action='index.php?controller=colis&action=actionCreateColis'>

	<input type="hidden" name="idColis" value="<?php if (isset($colis)): $colis->echo('idColis'); endif; ?>" />

	<p>
		Editeur
		<?php if (empty($listEditeur)): ?>
			<p>Aucun éditeur existant</p>
		<?php else: ?>
			<select name="(int)idEditeur">
				<option <?php if($selectedEditeur==-1): echo("selected"); endif; ?> value="-1">Choisissez un éditeur</option>
				<?php foreach ($listEditeur as $editeur) {
						$id = $editeur->idEditeur; ?>
						<option <?php if($selectedEditeur==$id): echo("selected"); endif; ?> value="<?php echo($id); ?>"><?php $editeur->echo('nomEditeur'); ?></option>
				<?php } ?>
			</select>
		<?php endif; ?>
	</p>

	<p>
		Date d'envoi
		<input type="date" name="(null)dateEnvoi" placeholder="AAAA-MM-JJ" value="<?php if (isset($colis)): $colis->echo('dateEnvoi'); else: echo(date("Y-m-d")); endif; ?>" required/>
	</p>


	<p>
		Date de reception
		<input type="date" name="(null)dateReception" placeholder="AAAA-MM-JJ"  value="<?php if (isset($colis)): $colis->echo('dateReception'); endif; ?>"/>
	</p>

	<p>
		<textarea placeholder="Commentaires"
		name="commentaire"><?php if (isset($colis)): $colis->echo('commentaire'); endif; ?></textarea>
	</p>
	<p><input type="submit" value="Créer" /></p>

</form>
