<?php
	require_once File::buildPath(array('model', 'modelContact.php'));

	class ControllerContact {

		// Affiche tous les contacts
		public static function readAll($idEditeur = NULL, $info = '', $error = '') {
			$controller = 'contact';
			$view = 'readAll';
			$title = 'Liste des contacts';

			if (!is_null($idEditeur)) {
				$_GET['idEditeur'] = $idEditeur;
			}

			require_once File::buildPath(array('controller', 'controllerEditeur.php'));

			if (!isset($_GET['idEditeur'])) {
				ControllerEditeur::readAll('', 'Veuillez sélectionner un éditeur pour accéder aux contacts');
				return false;
			}

			$editeur = ModelEditeur::getID($_GET['idEditeur']);
			if (!$editeur) {
				ControllerEditeur::readAll('', 'Editeur invalide');
				return false;
			}

			$listContact = ModelContact::readAll($_GET['idEditeur']);
			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function viewCreate() {
			$controller = 'contact';
			$view = 'create';
			$title = 'Créer un contact';

			require_once File::buildPath(array('controller', 'controllerEditeur.php'));

			if (!isset($_GET['idEditeur'])) {
				ControllerEditeur::readAll('', "Veuillez passer par l'éditeur pour créer un contact");
				return false;
			}

			$editeur = ModelEditeur::getID($_GET['idEditeur']);
			if (!$editeur) {
				ControllerEditeur::readAll('', 'Editeur invalide');
				return false;
			} else {
				$editeur = $editeur[0];
			}

			require_once File::buildPath(array('controller', 'controllerRepresentant.php'));
			$listRepresentant = ModelRepresentant::readAll($_GET['idEditeur']);
			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function viewUpdate() {
			$controller = 'contact';
			$view = 'update';
			$title = 'Modifier un contact';

			require_once File::buildPath(array('controller', 'controllerEditeur.php'));
			//On vérifie que le contact est donné et existe
			if (isset($_GET['idContact'])) {
				$where = 'idContact = :idContact';
				$values = array('idContact' => $_GET['idContact']);
				$contact = ModelContact::readOrFalse($where, $values);
				if (!$contact) {
					unset($contact);
					$error = "Veuillez selectionner un contact valide en passant par l'éditeur";
					ControllerEditeur::readAll(NULL, $error);

				} else {
					$contact = $contact[0];
					//Une fois le contact trouvé, on extrait l'éditeur et sa liste de représentant
					$editeur = ModelEditeur::getID($contact->idEditeur);
					$editeur = $editeur[0];
					require_once File::buildPath(array('controller', 'controllerRepresentant.php'));
					$listRepresentant = ModelRepresentant::readAll($editeur->idEditeur);
				}
			} else {
				$error = "Veuillez selectionner un contact valide en passant par l'éditeur";
				ControllerEditeur::readAll(NULL, $error);
			}

			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function actionCreate() {
			$controller = 'contact';
			$contact = new ModelContact();
			if (isset($_POST['clos'])) {
				$_POST['clos'] = 1;
			} else {
				$_POST['clos'] = 0;
			}
			$contact->setArray($_POST);

			require_once File::buildPath(array('controller', 'controllerEditeur.php'));
			$editeur = ModelEditeur::getID($contact->idEditeur);
			if (!$editeur) {
				ControllerEditeur::readAll('', 'Editeur invalide');
				return false;
			} else {
				$editeur = $editeur[0];
			}

			unset($contact->idContact);

			$contact->create();
			$info = 'Nouveau contact créé';
			self::consult($contact->idContact,$info);
		}

		public static function actionUpdate() {
			$controller = 'contact';

			$contact = new ModelContact();
			if (isset($_POST['clos'])) {
				$_POST['clos'] = 1;
			} else {
				$_POST['clos'] = 0;
			}
			$contact->setArray($_POST);

			$contactFound = ModelContact::getID($contact->idContact);
			if (!$contactFound) {
				$error = 'Impossible de modifier le contact';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			$info = 'Représentant mis à jour';
			unset($contact->idEditeur);
			$contact->update();
			self::consult($contact->idContact,$info);
		}

		public static function actionDelete() {
			require_once File::buildPath(array('controller', 'controllerEditeur.php'));

			if (!isset($_GET['idContact'])) {
				$error = "Veuillez selectionner un contact valide en passant par l'éditeur";
				ControllerEditeur::readAll(NULL, $error);
				return false;
			}

			$contactFound = ModelContact::getID($_GET['idContact']);
			if (!$contactFound) {
				$error = "Veuillez selectionner un contact valide en passant par l'éditeur";
				ControllerEditeur::readAll(NULL, $error);
				return false;
			}

			$contact = $contactFound[0];
			$contact->delete();

			ControllerEditeur::consult($contact->idEditeur, 'Contact supprimé');
		}

		public static function consult($idContact = NULL, $info = ""){
			$controller = 'contact';
			$view = 'consult';
			$title = 'Contact';

			if(!is_null($idContact)){
				$_GET['idContact'] = $idContact;
			}
			if (isset($_GET['idContact'])) {
				$where = 'idContact = :idContact';
				$values = array('idContact' => $_GET['idContact']);
				$contact = ModelContact::readOrFalse($where, $values);
				if (!$contact) {
					unset($contact);
				} else {
					$contact = $contact[0];

					//On extrait l'éditeur lié au contact
					require_once File::buildPath(array('model', 'modelEditeur.php'));
					$editeur = ModelEditeur::getID($contact->idEditeur);
					if(!$editeur){
						unset($editeur);
					}else {
						$editeur = $editeur[0];
					}

					//On extrait le représentant lié au contact
					require_once File::buildPath(array('model', 'modelRepresentant.php'));
					$representant = ModelRepresentant::getID($contact->idRepresentant);
					if(!$representant){
						unset($representant);
					} else {
						$representant = $representant[0];
					}
				}
			}

			require_once File::buildPath(array('view','view.php'));
		}
	}
?>
