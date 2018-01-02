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

<h1> Consultation d'un représentant </h1>
<h2> <?php if(isset($representant)): echo($representant->prenomRepresentant .' '. $representant->nomRepresentant);endif; ?> </h2>

<!-- Affichage des informations du représentant -->
<div>
    <ul>

        <li>
            Prénom : <?php if (isset($representant)): $representant->echo('prenomRepresentant'); endif; ?>
        </li>

        <li>
            Nom : <?php if (isset($representant)): $representant->echo('nomRepresentant'); endif; ?>
        </li>

        <li>
            Editeur : <?php if(isset($editeur)):?>
        <a href="/index.php?controller=editeur&action=consult&idEditeur=<?php $editeur->echo('idEditeur') ?>"> <?php $editeur->echo('nomEditeur') ?></a>

    <?php endif; ?>
        </li>

        <li>
            Mail : <?php if (isset($representant)): $representant->echo('mailRepresentant'); endif; ?>
        </li>

        <li>
            Téléphone Fixe : <?php if (isset($representant)): $representant->echo('telFixeRepresentant'); endif; ?>
        </li>

        <li>
            Téléphone Mobile : <?php if (isset($representant)): $representant->echo('telMobileRepresentant'); endif; ?>
        </li>

        <li>
            Commentaire : <?php if (isset($representant)): $representant->echo('commentaireRepresentant'); endif; ?>
        </li>

        <li> Actif :
            <?php
            if(isset($representant)) {
                if($representant->actifRepresentant){
                    echo('Oui');
                } else {
                    echo('Non');
                }
            }?>
        </li>
    </ul>

    <?php
    if(isset($representant)){ ?>
        <p><a href="/index.php?controller=representant&action=viewUpdate&idRepresentant=<?php  $representant->echo('idRepresentant');?>">Modifier <?php echo($representant->prenomRepresentant .' '. $representant->nomRepresentant);?> </a></p>
        <p><a href="/index.php?controller=representant&action=actionDelete&idRepresentant=<?php $representant->echo('idRepresentant') ?>">Supprimer</a></p>
    <?php } ?>
</div>
