<?php
	require_once File::buildPath(array('model', 'modelLogement.php'));
	require_once File::buildPath(array('model', 'modelFestival.php'));
	require_once File::buildPath(array('controller', 'controllerEditeur.php'));

	class ControllerLogement {

		// Affiche la page de création d'éditeur
		public static function viewCreate($idEditeur = NULL, $error = NULL) {
			$controller = 'logement';
			$view = 'create';
			$title = 'Faire une demande de logement';

			if (isset($idEditeur)) {
				$_GET['idEditeur'] = $idEditeur;
			}

			if (!isset($_GET['idEditeur'])) {
				ControllerEditeur::readAll('', 'Editeur invalide');
				return false;
			}

			$editeur = ModelEditeur::getID($_GET['idEditeur']);
			if (!$editeur) {
				ControllerEditeur::readAll('', 'Editeur invalide');
				return false;
			}
			$editeur = $editeur[0];

			$listFestival = ModelFestival::read();

			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function actionCreate() {
			$controller = 'logement';
			$logement = new ModelLogement();
			$logement->setArrayType($_POST);

			$editeur = ModelEditeur::getID($logement->idEditeur);
			if (!$editeur) {
				$error = 'L\'éditeur est invalide';
				ControllerEditeur::readAll(NULL, $error);
				return false;
			}
			
			$festival = ModelFestival::getID($logement->idFestival);
			if (!$festival) {
				$error = 'Le festival est invalide';
				self::viewCreate($logement->idEditeur, $error);
				return false;
			}

			$logement->create();
			$info = 'Nouvelle demande de logement enregistrer';
			ControllerEditeur::consult($logement->idEditeur, $info);
		}

		public static function viewUpdate($idDemande = NULL, $error = NULL) {
			$controller = 'logement';
			$view = 'update';
			$title = 'Modifier un logement';

			if (isset($idDemande)) {
				$_GET['idDemande'] = $idDemande;
			}

			if (isset($_GET['idDemande'])) {
				$where = 'idDemande = :idDemande';
				$values = array('idDemande' => $_GET['idDemande']);
				$logement = ModelLogement::readOrFalse($where, $values);
				if (!$logement) {
					unset($logement);
					$error = "Veuillez selectionner une demande de logement valide en passant par l'éditeur";
					ControllerEditeur::readAll(NULL, $error);
				} else {
					$logement = $logement[0];
					$editeur = ModelEditeur::getID($logement->idEditeur);
					$editeur = $editeur[0];

					$listFestival = ModelFestival::read();

					require_once File::buildPath(array('controller', 'controllerRepresentant.php'));
				}
			} else {
				$error = "Veuillez selectionner une demande de logement valide en passant par l'éditeur";
				ControllerEditeur::readAll(NULL, $error);
			}

			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function actionUpdate() {
			$controller = 'logement';
			$logement = new ModelLogement();
			$logement->setArrayType($_POST);

			$editeur = ModelEditeur::getID($logement->idEditeur);
			if (!$editeur) {
				$error = 'L\'éditeur est invalide';
				ControllerEditeur::readAll(NULL, $error);
				return false;
			}
			
			$festival = ModelFestival::getID($logement->idFestival);
			if (!$festival) {
				$error = 'Le festival est invalide';
				self::viewUpdate($logement->idDemande, $error);
				return false;
			}

			$logement->update();
			$info = 'Demande de logement mise à jour';
			ControllerEditeur::consult($logement->idEditeur, $info);
		}

		public static function actionDelete() {
			if (!isset($_GET['idDemande'])) {
				$error = "Veuillez selectionner une demande de logement valide en passant par l'éditeur";
				ControllerEditeur::readAll(NULL, $error);
				return false;
			}

			$logementFound = ModelLogement::getID($_GET['idDemande']);
			if (!$logementFound) {
				$error = "Veuillez selectionner une demande de logement valide en passant par l'éditeur";
				ControllerEditeur::readAll(NULL, $error);
				return false;
			}

			$logement = $logementFound[0];
			$logement->delete();

			ControllerEditeur::consult($logement->idEditeur, 'Demande de logement supprimé');
		}
	}
?>