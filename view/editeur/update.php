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


<form method='post' action='index.php?controller=editeur&action=actionCreateUpdateEditeur'>

	<input type="hidden" name="idEditeur" value="<?php if (isset($idEditeur)): echo $idEditeur; endif; ?>">

	<p>
		<input type="text" placeholder="Nom" 
		name="nomEditeur" value="<?php if (isset($nomEditeur)): echo $nomEditeur; endif; ?>" required />
	</p>

	<p>
		<input type="text" placeholder="Pays" 
		name="paysEditeur" value="<?php if (isset($paysEditeur)): echo $paysEditeur; endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Ville" 
		name="villeEditeur" value="<?php if (isset($villeEditeur)): echo $villeEditeur; endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Rue" 
		name="rueEditeur" value="<?php if (isset($rueEditeur)): echo $rueEditeur; endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Code postal" 
		name="codePostalEditeur" value="<?php if (isset($codePostalEditeur)): echo $codePostalEditeur; endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Site web" 
		name="siteWebEditeur" value="<?php if (isset($siteWebEditeur)): echo $siteWebEditeur; endif; ?>" />
	</p>

	<p>
		<input type="text" placeholder="Commentaires" 
		name="commentaireEditeur" value="<?php if (isset($commentaireEditeur)): echo $commentaireEditeur; endif; ?>" />
	</p>

	<p>
		<input type="checkbox" placeholder="Actif" 
		name="actifEditeur" value="<?php if (isset($actifEditeur)): echo $actifEditeur; endif; ?>" />
		Actif
	</p>

	<p><input type="submit" value="Enregistrer" /></p>

</form>