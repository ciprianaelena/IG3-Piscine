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

<h1>Modifier un colis</h1>

<p>
	Editeur :
	<?php if(isset($editeur)):?>
		<a href="/index.php?controller=editeur&action=consult&idEditeur=<?php $editeur->echo('idEditeur') ?>"> <?php $editeur->echo('nomEditeur') ?></a>

	<?php endif; ?>
</p>

<form method='post' action='index.php?controller=colis&action=actionUpdate'>

	<input type="hidden" name="idColis" value="<?php if (isset($colis)): $colis->echo('idColis'); endif; ?>" />

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

	<p><input type="submit" value="Modifier" /></p>

</form>
