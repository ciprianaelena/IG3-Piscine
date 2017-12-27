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
			$view = 'consult';
			$title = 'Contact';
			$info = 'Nouveau contact créé';
			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function consult(){
			$controller = 'contact';
			$view = 'consult';
			$title = 'Contact';

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
