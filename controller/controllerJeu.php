<?php
	require_once File::buildPath(array('model', 'modelJeu.php'));

	class ControllerJeu {

		public static function readAll($info = '', $error = '') {
			$controller = 'jeu';
			$view = 'readAll';
			$title = 'Liste des jeux';

			$listJeux = ModelJeu::read();
			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function viewCreate($jeu = NULL, $error = NULL) {
			$controller = 'jeu';
			$view = 'create';
			$title = 'Ajouter un jeu';

			require_once File::buildPath(array('model', 'modelEditeur.php'));
			$listEditeur = ModelEditeur::read();

			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function viewUpdate($jeu = NULL, $info = NULL, $error = NULL) {
			$controller = 'jeu';
			$view = 'update';
			$title = 'Modifier un jeu';

			if (isset($_GET['idJeu'])) {
				$where = 'idJeu = :idJeu';
				$values = array('idJeu' => $_GET['idJeu']);
				$jeu = ModelJeu::readOrFalse($where, $values);
				if (!$jeu) {
					unset($jeu);
				} else {
					$jeu = $jeu[0];
				}
			}

			require_once File::buildPath(array('model', 'modelEditeur.php'));
			$listEditeur = ModelEditeur::read();

			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function actionCreate() {
			$controller = 'jeu';
			$jeu = new ModelJeu();
			if (isset($_POST['prototype'])) {
				$_POST['prototype'] = 1;
			} else {
				$_POST['prototype'] = 0;
			}

			$jeu->setArrayType($_POST);

			if ($jeu->nomJeu == '') {
				$error = 'Le nom du jeu est obligatoire';
				static::viewCreate($jeu, $error);
				return false;
			}

			if (!isset($_POST['(int)idEditeur'])) {
				static::viewCreate($jeu, 'Le champ éditeur est obligatoire');
				return false;
			}

			require_once File::buildPath(array('model', 'modelEditeur.php'));
			$editeurFound = ModelEditeur::getID($jeu->idEditeur);
			if (!$editeurFound) {
				static::viewCreate($jeu, 'L\'éditeur est introuvable');
				return false;
			}

			unset($jeu->idJeu);
			$jeu->create();
			static::viewUpdate($jeu);
		}

		public static function actionUpdate() {
			$controller = 'jeu';
			$view = 'update';
			$title = 'Modifier un jeu';

			$jeu = new ModelJeu();
			if (isset($_POST['prototype'])) {
				$_POST['prototype'] = 1;
			} else {
				$_POST['prototype'] = 0;
			}

			$jeu->setArrayType($_POST);

			if ($jeu->nomJeu == '') {
				$error = 'Le nom du jeu est obligatoire';
				static::viewUpdate($jeu, NULL, $error);
				return false;
			}

			$jeuFound = ModelJeu::getID($jeu->idJeu);

			if (!$jeuFound) {
				$error = 'Impossible de modifier le jeu';
				static::viewUpdate($jeu, NULL, $error);
				return false;
			}

			$info = 'Le jeu à correctement était modifié';
			$jeu->update();
			static::viewUpdate($jeu, $info);
		}

		public static function actionDelete() {
			if (!isset($_GET['idJeu'])) {
				static::readAll(NULL, '', 'Impossible de supprimer ce jeu');
				return false;
			}
			
			$jeuFound = ModelJeu::getID($_GET['idJeu']);
			if (!$jeuFound) {
				static::readAll(NULL, '', 'Impossible de supprimer ce jeu');
				return false;
			}

			$jeu = $jeuFound[0];
			$jeu->delete();

			static::readAll('Jeu supprimer');
		}
	}
?>