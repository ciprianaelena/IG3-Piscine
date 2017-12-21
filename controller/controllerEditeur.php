<?php
	require_once File::buildPath(array('model', 'modelEditeur.php'));

	class ControllerEditeur {

		// Affiche la page de création d'éditeur
		public static function viewCreateUpdateEditeur() {
			$controller = 'editeur';
			$view = 'update';
			$title = 'Créer ou modifier un editeur';

			require_once File::buildPath(array('view', 'view.php'));
		}

		// Modifie ou créer un editeur dans la base de donnée
		public static function actionCreateUpdateEditeur() {
			$controller = 'editeur';
			$view = 'update';
			$title = 'Créer ou modifier un editeur';

			$editeur = new ModelEditeur();
			$editeur->setArray($_POST);

			// Le nom d'éditeur est obligatoire
			if (!isset($editeur->nomEditeur) && $editeur->nomEditeur == '') {
				$error = 'Le nom d\'éditeur est obligatoire';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			if (!isset($editeur->idEditeur)) {
				$editeur->idEditeur = -1;
			}

			// On créer l'éditeur si il n'existe pas encore
			try {
				$editeurFound = ModelEditeur::getEditeurId($editeur->idEditeur);	
			} catch (PDOException $exception) {
				if (Conf::$debug) {
					echo $exception->getMessage();
					die();
				}
				$error = 'Impossible de créer ou modifier cet éditeur...';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}


			if (!$editeurFound) {
				// L'éditeur n'existe pas, on le créer
				$info = 'Nouvel éditeur créer';
				unset($editeur->idEditeur);
				var_dump($editeur);
				$editeur->create();
				require_once File::buildPath(array('view', 'view.php'));

			} else {
				// L'éditeur existe on le modifie
				$editeur = editeurFound[0];
				$info = 'Editeur mis à jour';
				$editeur->update();
			}
			
			require_once File::buildPath(array('view', 'view.php'));
		}
	}
?>