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


<!-- Affichage des informations du colis -->
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

        <li>
        <?php if (!$listContenir): ?>
            <p> Aucun jeu dans le colis </p>
        <?php
            else: ?>
            <p> Le colis comporte le(s) jeu(x) suivant(s) :
            <ul>
            <?php foreach ($listContenir as $contenir) {
                    //On recupere le jeu avec l'id
                    require_once File::buildPath(array('model','modelJeu.php'));
                    $jeu = ModelJeu::getID($contenir->idJeu)[0]; ?>

                <li> <a href="/index.php?controller=jeu$action=consult$idJeu=<?php $jeu->echo('idJeu') ?>"> <?php $jeu->echo('nomJeu') ?></a>
                    <ul>
                        <li>Quantité : <?php $contenir->echo('quantite');?></li>
                        <li>Jeux à renvoyer : <?php if($contenir->renvoyer): echo("Oui"); else: echo("Non"); endif; ?> </li>
                        <li><a href="/index.php?controller=colis&action=actionDeleteContenir&idContenir=<?php $contenir->echo('idContenir') ?>">Retirer</a></li>
                    </ul>
                </li>
        <?php } ?>

            </ul>

        <?php endif; ?>

        </li>

    </ul>



    <?php if(isset($colis)){ ?>
        <a href="/index.php?controller=colis&action=viewCreateContenir&idColis= <?php $colis->echo('idColis');?>">Ajouter un jeu à ce colis </a>

        <a href="/index.php?controller=colis&action=viewUpdate&idColis=<?php $colis->echo('idColis');?>">Modifier ce colis </a>

        <a href="/index.php?controller=colis&action=actionDeleteColis&idColis=<?php $colis->echo('idColis')?>">Supprimer</a>
    <?php }?>
</div>
