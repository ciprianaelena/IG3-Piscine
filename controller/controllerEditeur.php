<?php
	require_once File::buildPath(array('model', 'modelEditeur.php'));

	class ControllerEditeur {

		// Affiche tous les éditeurs
		public static function readAll($info = '', $error = '') {
			$controller = 'editeur';
			$view = 'readAll';
			$title = 'Liste des éditeurs';

			$listEditeur = ModelEditeur::read();
			require_once File::buildPath(array('view', 'view.php'));
		}

		// Affiche la page de création d'éditeur
		public static function viewCreate() {
			$controller = 'editeur';
			$view = 'create';
			$title = 'Créer un editeur';

			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function viewUpdate() {
			$controller = 'editeur';
			$view = 'update';
			$title = 'Modifier un editeur';

			if (isset($_GET['idEditeur'])) {
				$where = 'idEditeur = :idEditeur';
				$values = array('idEditeur' => $_GET['idEditeur']);
				$editeur = ModelEditeur::readOrFalse($where, $values);
				if (!$editeur) {
					unset($editeur);
				} else {
					$editeur = $editeur[0];
				}
			}

			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function consult() {
			$controller = 'editeur';
			$view = 'consult';
			$title = "Editeur";


			if (isset($_GET['idEditeur'])) {
				$where = 'idEditeur = :idEditeur';
				$values = array('idEditeur' => $_GET['idEditeur']);
				$editeur = ModelEditeur::readOrFalse($where, $values);

				require_once File::buildPath(array('model','modelJeu.php'));
				$listJeux = ModelJeu::readOrFalse($where,$values);

				require_once File::buildPath(array('model','modelContact.php'));
				$listContact = ModelContact::readAll($_GET['idEditeur']);

				if (!$editeur) {
					unset($editeur);
				} else {
					$editeur = $editeur[0];
					$title = $editeur->nomEditeur;
				}
			} else {
				$listJeux = false;
				$listContact = false;
				$error = "Veuillez sélectionner un éditeur";
			}

			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function actionCreate() {
			$controller = 'editeur';
			$editeur = new ModelEditeur();
			if (isset($_POST['actifEditeur'])) {
				$_POST['actifEditeur'] = 1;
			} else {
				$_POST['actifEditeur'] = 0;
			}
			$editeur->setArray($_POST);

			// Le nom d'éditeur est obligatoire
			if (!isset($editeur->nomEditeur) && $editeur->nomEditeur == '') {
				$view = 'create';
				$error = 'Le nom d\'éditeur est obligatoire';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			$nomEditeurUnique = $editeur->isNomEditeurUnique();

			if (!$nomEditeurUnique) {
				$view = 'create';
				$title = 'Créer un editeur';
				$error = 'Un éditeur possède déjà ce nom';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			unset($editeur->idEditeur);
			$editeur->create();
			$view = 'update';
			$title = 'Modifier un editeur';
			$info = 'Nouvel éditeur créer';
			require_once File::buildPath(array('view', 'view.php'));
		}

		// Modifie ou créer un editeur dans la base de donnée
		public static function actionUpdate() {
			$controller = 'editeur';
			$view = 'update';
			$title = 'Modifier un editeur';

			$editeur = new ModelEditeur();
			if (isset($_POST['actifEditeur'])) {
				$_POST['actifEditeur'] = 1;
			} else {
				$_POST['actifEditeur'] = 0;
			}
			$editeur->setArray($_POST);

			// Le nom d'éditeur est obligatoire
			if (!isset($editeur->nomEditeur) && $editeur->nomEditeur == '') {
				$error = 'Le nom d\'éditeur est obligatoire';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// Vérifie que l'éditeur existe
			$editeurFound = ModelEditeur::getID($editeur->idEditeur);

			if (!$editeurFound) {
				// L'éditeur n'existe pas
				$error = 'Impossible de modifier l\'éditeur';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			$info = 'Editeur mis à jour';
			$editeur->update();
			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function actionDelete() {
			if (!isset($_GET['idEditeur'])) {
				static::readAll('', 'Impossible de supprimer cet éditeur');
				return false;
			}

			$editeurFound = ModelEditeur::getID($_GET['idEditeur']);
			if (!$editeurFound) {
				static::readAll('', 'Impossible de supprimer cet éditeur');
				return false;
			}

			$editeur = $editeurFound[0];
			$editeur->delete();

			static::readAll('Editeur supprimer');
		}
	}
?>
