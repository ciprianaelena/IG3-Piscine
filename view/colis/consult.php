<?php if (isset($error)): ?>
    <p class="error">
        <?php echo $error; ?>
    </p>
<?php endif; ?>

<?php if (isset($info)): ?>
    <p class="info">
        <?php echo $info; ?>
    </p>
<?php endif;?>

<h1> Consultation d'un colis </h1>


<!-- Affichage des informations du contact -->
<div>
    <ul>
        <li>
            Editeur :
            <?php if(isset($editeur)):?>
                <a href="/index.php?controller=editeur&action=consult&idEditeur=<?php $editeur->echo('idEditeur') ?>"> <?php $editeur->echo('nomEditeur') ?></a>
            <?php endif; ?>
        </li>

        <li>
            Date d'envoi : <?php if (isset($colis)): $colis->echo('dateEnvoi'); endif; ?>
        </li>

        <li>
            Date de réception : <?php if (isset($colis)): $colis->echo('dateReception'); endif; ?>
        </li>

        <li>
            Commentaire : <?php if (isset($colis)): $colis->echo('commentaire'); endif; ?>
        </li>

    </ul>

    <?php if(isset($colis)){ ?>
        <a href="/index.php?controller=colis&action=viewUpdate&idColis= <?php $colis->echo('idColis');?>">Modifier ce colis </a>
        <a href="/index.php?controller=colis&action=actionDelete&idColis=<?php $colis->echo('idColis') ?>">Supprimer</a>
    <?php }?>
</div>
