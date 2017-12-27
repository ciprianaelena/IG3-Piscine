<?php
	require_once File::buildPath(array('model', 'modelRepresentant.php'));

	class ControllerRepresentant {

		public static function readAll($idEditeur = NULL, $info = '', $error = '') {
			$controller = 'representant';
			$view = 'readAll';
			$title = 'Liste des représentants';

			if (!is_null($idEditeur)) {
				$_GET['idEditeur'] = $idEditeur;
			}

			require_once File::buildPath(array('controller', 'controllerEditeur.php'));

			if (!isset($_GET['idEditeur'])) {
				ControllerEditeur::readAll('', 'Impossible de récupérer la liste des représentants pour cet éditeur');
				return false;
			}

			$editeur = ModelEditeur::getID($_GET['idEditeur']);
			if (!$editeur) {
				ControllerEditeur::readAll('', 'Editeur invalide');
				return false;
			}

			$listRepresentant = ModelRepresentant::readAll($_GET['idEditeur']);
			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function viewCreate() {
			$controller = 'representant';
			$view = 'create';
			$title = 'Créer un représentant';

			require_once File::buildPath(array('controller', 'controllerEditeur.php'));

			if (!isset($_GET['idEditeur'])) {
				ControllerEditeur::readAll('', 'Impossible de créer un représentant pour cet éditeur');
				return false;
			}

			$editeur = ModelEditeur::getID($_GET['idEditeur']);
			if (!$editeur) {
				ControllerEditeur::readAll('', 'Editeur invalide');
				return false;
			} else {
				$editeur = $editeur[0];
			}

			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function viewUpdate() {
			$controller = 'representant';
			$view = 'update';
			$title = 'Modifier un représentant';

			if (isset($_GET['idRepresentant'])) {
				$where = 'idRepresentant = :idRepresentant';
				$values = array('idRepresentant' => $_GET['idRepresentant']);
				$representant = ModelRepresentant::readOrFalse($where, $values);
				if (!$representant) {
					unset($representant);

					require_once File::buildPath(array('controller', 'controllerEditeur.php'));
					$error = "Veuillez selectionner un représentant valide en passant par l'éditeur";
					ControllerEditeur::readAll('', $error);

				} else {
					$representant = $representant[0];
				}

			} else {
				require_once File::buildPath(array('controller', 'controllerEditeur.php'));
				$error = "Veuillez selectionner un représentant valide en passant par l'éditeur";
				ControllerEditeur::readAll('', $error);
			}

			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function consult($idRepresentant = NULL, $info = ""){
			$controller = 'representant';
			$view = 'consult';
			$title = 'Représentant';

			if(!is_null($idRepresentant)){
				$_GET['idRepresentant'] = $idRepresentant;
			}

			if (isset($_GET['idRepresentant'])) {
				$where = 'idRepresentant = :idRepresentant';
				$values = array('idRepresentant' => $_GET['idRepresentant']);
				$representant = ModelRepresentant::readOrFalse($where, $values);
				if (!$representant) {
					unset($representant);
				} else {
					$representant = $representant[0];
					$title = $representant->prenomRepresentant .' '. $representant->nomRepresentant;

					//On extrait l'éditeur lié au représentant
					require_once File::buildPath(array('model', 'modelEditeur.php'));
					$editeur = ModelEditeur::getID($representant->idEditeur);
					if(!$editeur){
						unset($editeur);
					}else {
						$editeur = $editeur[0];
					}
				}
			}

			require_once File::buildPath(array('view','view.php'));
		}

		public static function actionCreate() {
			$controller = 'representant';
			$representant = new ModelRepresentant();
			if (isset($_POST['actifRepresentant'])) {
				$_POST['actifRepresentant'] = 1;
			} else {
				$_POST['actifRepresentant'] = 0;
			}

			$representant->setArray($_POST);

			require_once File::buildPath(array('controller', 'controllerEditeur.php'));
			$editeur = ModelEditeur::getID($representant->idEditeur);
			if (!$editeur) {
				ControllerEditeur::readAll('', 'Editeur invalide');
				return false;
			}

			unset($representant->idRepresentant);
			$representant->create();
			$info = 'Nouveau représentant créé';
			self::consult($representant->idRepresentant,$info);
		}

		public static function actionUpdate() {
			$controller = 'representant';

			$representant = new ModelRepresentant();
			if (isset($_POST['actifRepresentant'])) {
				$_POST['actifRepresentant'] = 1;
			} else {
				$_POST['actifRepresentant'] = 0;
			}
			$representant->setArray($_POST);

			$representantFound = ModelRepresentant::getID($representant->idRepresentant);

			if (!$representantFound) {
				$error = 'Impossible de modifier le représentant';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			$info = 'Représentant mis à jour';
			unset($representant->idEditeur);
			$representant->update();
			self::consult($representant->idRepresentant,$info);
		}

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

			static::readAll($representant->idEditeur, 'Représentant supprimé');
		}
	}
?>
