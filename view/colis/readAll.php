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

    <h1>Liste des colis</h1>

    <a href="/index.php?controller=colis&action=viewCreateColis">Ajouter un colis</a>
    <?php if (!$listColis): ?>
        <p> Aucun colis </p>
    <?php
        else:
            foreach ($listColis as $colis) {
    ?>

        <p>
            <a href="/index.php?controller=colis&action=consult&idColis=<?php $colis->echo('idColis') ?>"><?php echo("Colis n°".$colis->idColis)?></a>
            <a href="/index.php?controller=colis&action=actionDelete&idColis=<?php $colis->echo('idColis') ?>">Supprimer</a>
        </p>

    <?php
            }
        endif;
    ?>

</div>
