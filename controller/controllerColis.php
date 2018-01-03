<?php
	require_once File::buildPath(array('model', 'modelColis.php'));

	class ControllerColis {

		// Affiche tous les contacts
		public static function readAll($info = '', $error = '') {
			$controller = 'colis';
			$view = 'readAll';
			$title = 'Liste des colis';

			$listColis = ModelColis::read();
			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function viewCreate($colis = NULL, $error = NULL) {
			$controller = 'colis';
			$view = 'create';
			$title = 'Créer un colis';

			require_once File::buildPath(array('model', 'modelEditeur.php'));
			$listEditeur = ModelEditeur::read();

			if (isset($_GET['idEditeur'])) {
				$selectedEditeur = $_GET['idEditeur'];
			} else {
				$selectedEditeur = -1;
			}

			require_once File::buildPath(array('view', 'view.php'));
		}

/*		public static function viewUpdate() {
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
					ControllerEditeur::readAll('', $error);

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
				ControllerEditeur::readAll('', $error);

			}

			require_once File::buildPath(array('view', 'view.php'));
		}*/

		public static function actionCreate() {
			$controller = 'colis';
			$colis = new ModelColis();

			$colis->setArrayType($_POST);

			require_once File::buildPath(array('controller', 'controllerEditeur.php'));
			if (!isset($_POST['(int)idEditeur'])) {
				static::viewCreate($colis, 'Le champ éditeur est obligatoire');
				return false;
			}

			require_once File::buildPath(array('model', 'modelEditeur.php'));
			$editeurFound = ModelEditeur::getID($colis->idEditeur);
			if (!$editeurFound) {
				static::viewCreate($colis, 'L\'éditeur est introuvable');
				return false;
			}

			unset($colis->idColis);
			$colis->create();

			//Temporaire
			$info = 'Nouveau colis créé';
			self::consult($colis->idColis,$info);
			//Fin du Temporaire


			//Ici on doit renvoyer vers le remplissage du colis.
			//require_once File::buildPath(array('controller', 'controllerContenir.php'));
			$info = "Le colis a été créé. Quel jeu contient-il ?";
			//ControllerContenir::viewCreate($colis,$info);
		}

/*		public static function actionUpdate() {
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
				ControllerEditeur::readAll('', $error);
				return false;
			}

			$contactFound = ModelContact::getID($_GET['idContact']);
			if (!$contactFound) {
				$error = "Veuillez selectionner un contact valide en passant par l'éditeur";
				ControllerEditeur::readAll('', $error);
				return false;
			}

			$contact = $contactFound[0];
			$contact->delete();

			ControllerEditeur::consult($contact->idEditeur, 'Contact supprimé');
		}*/

		public static function consult($idColis = NULL, $info = "") {
			$controller = 'colis';
			$view = 'consult';
			$title = "Consultation d'un colis";
			if(!is_null($idColis)){
				$_GET['idColis'] = $idColis;
			}

			if(isset($_GET['idColis'])){
				$where = 'idColis = :idColis';
				$values = array('idColis' => $_GET['idColis']);
				$colis = ModelColis::readOrFalse($where,$values);

				if(!$colis){
					unset($colis);
				} else {
					$colis = $colis[0];

					//On extrait l'éditeur lié au colis
					require_once File::buildPath(array('model', 'modelEditeur.php'));
					$editeur = ModelEditeur::getID($colis->idEditeur);
					if(!$editeur){
						unset($editeur);
					}else {
						$editeur = $editeur[0];
					}
				}

			} else {
				$error = "Veuillez sélectionner un colis";
			}

			require_once File::buildPath(array('view', 'view.php'));


		}

	}


?>
