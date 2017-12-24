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

		public static function viewCreate() {
			$controller = 'jeu';
			$view = 'create';
			$title = 'Ajouter un jeu';

			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function viewUpdate() {
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
			$_POST['largeur'] = (int) $_POST['largeur'];
			$_POST['hauteur'] = (int) $_POST['hauteur'];
			$_POST['longueur'] = (int) $_POST['longueur'];
			$_POST['poids'] = (int) $_POST['poids'];
			$_POST['nbJoueur'] = (int) $_POST['nbJoueur'];
			$_POST['dureePartie'] = (int) $_POST['dureePartie'];
			unset($_POST['dateSortie']);
			$jeu->setArray($_POST);

			var_dump($jeu);

			unset($jeu->idJeu);
			$jeu->create();
			$view = 'update';
			$title = 'Modifier un jeu';
			$info = 'Le jeu à était ajouter';
			require_once File::buildPath(array('view', 'view.php'));
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
			$jeu->setArray($_POST);

			$jeuFound = static::getID($jeu->idJeu);

			if (!$jeuFound) {
				$error = 'Impossible de modifier le jeu';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			$info = 'Le jeu à correctement était modifié';
			$jeu->update();
			require_once File::buildPath(array('view', 'view.php'));
		}

		/*
		public static function actionDelete() {
			if (!isset($_GET['idRepresentant'])) {
				static::readAll(NULL, '', 'Impossible de supprimer ce représentant');
				return false;
			}
			
			$representantFound = ModelRepresentant::getID($_GET['idRepresentant']);
			if (!$representantFound) {
				static::readAll(NULL, '', 'Impossible de supprimer ce représentant');
				return false;
			}

			$representant = $representantFound[0];
			$representant->delete();

			static::readAll($representant->idEditeur, 'Représentant supprimer');
		}
		*/
	}
?>