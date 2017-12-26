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

<h1> Consultation d'un contact </h1>


<!-- Affichage des informations du contact -->
<div>
    <ul>
        <li>
            Identifiant : <?php if (isset($contact)): $contact->echo('idContact'); endif; ?>
        </li>

        <li>
            Type de contact : <?php if (isset($contact)): $contact->echo('typeContact'); endif; ?>
        </li>

        <li>
            Editeur :
            <?php if(isset($editeur)):?>
                <a href="/index.php?controller=editeur&action=consult&idEditeur=<?php $editeur->echo('idEditeur') ?>"> <?php $editeur->echo('nomEditeur') ?></a>
            <?php endif; ?>
        </li>

        <li>
            Date du contact : <?php if (isset($contact)): $contact->echo('dateContact'); endif; ?>
        </li>

        <li>
            Date de relance : <?php if (isset($contact)): $contact->echo('dateRelance'); endif; ?>
        </li>

        <li>
            Commentaire : <?php if (isset($contact)): $contact->echo('commentaireContact'); endif; ?>
        </li>

        <li> Clos :
            <?php
            if(isset($contact)) {
                if($contact->clos){
                    echo('Oui');
                } else {
                    echo('Non');
                }
            }?>
        </li>
    </ul>
</div>
