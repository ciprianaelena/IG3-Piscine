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

    <h1>Liste des contacts</h1>

    <a href="/index.php?controller=contact&action=viewCreate&idEditeur=<?php echo($_GET['idEditeur']) ?>">Ajouter un contact</a>
    <?php if (!$listContact): ?>
        <p> Aucun contact </p>
    <?php
        else:
            foreach ($listContact as $editeur) {
    ?>

        <p> 1 </p>

    <?php
            }
        endif;
    ?>

</div>
