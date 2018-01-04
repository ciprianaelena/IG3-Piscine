<?php
	require_once File::buildPath(array('model', 'modelColis.php'));
	require_once File::buildPath(array('model', 'modelContenir.php'));

	class ControllerColis {

		// Affiche tous les contacts
		public static function readAll($info = '', $error = '') {
			$controller = 'colis';
			$view = 'readAll';
			$title = 'Liste des colis';

			$listColis = ModelColis::read();
			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function viewCreateColis($colis = NULL, $error = NULL) {
			$controller = 'colis';
			$view = 'createColis';
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

		public static function viewCreateContenir($colis = NULL, $contenir = NULL, $info = NULL, $error = NULL){
			$controller = 'colis';
			$view = 'createContenir';
			$title = 'Créer un colis';

			if(!is_null($colis)){
				$_GET['idColis'] = $colis->idColis;
			}

			if(!isset($_GET['idColis'])){
				self::readAll(NULL,'Veuillez passer par le colis pour ajouter un jeu');
				return false;
			} else {
				$colisFound = ModelColis::getID($_GET['idColis']);
				if(!$colisFound){
					self::readAll(NULL,'Veuillez passer par le colis pour ajouter un jeu');
					return false;
				} else {
					$colis = $colisFound[0];
				}
			}

			require_once File::buildPath(array('model', 'modelEditeur.php'));
			$editeurFound = ModelEditeur::getID($colis->idEditeur);
			if (!$editeurFound) {
				require_once File::buildPath(array('controller', 'controllerColis.php'));

				self::viewCreateColis($colis, 'Colis incorrect');
				return false;
			}

			$editeur = $editeurFound[0];
			$where = 'idEditeur = :idEditeur';
			$values = array('idEditeur' => $editeur->idEditeur);

			require_once File::buildPath(array('model','modelJeu.php'));
			$listJeu = ModelJeu::readOrFalse($where,$values);

			require_once File::buildPath(array('view','view.php'));
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

		public static function actionCreateColis() {
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
			//$info = 'Nouveau colis créé';
			//self::consult($colis->idColis,$info);
			//Fin du Temporaire


			//Ici on doit renvoyer vers le remplissage du colis.
			$info = "Le colis a été créé. Quel jeu contient-il ?";
			self::viewCreateContenir($colis,NULL,$info);
		}

		public static function actionCreateContenir() {
			$controller = 'contenir';
			$contenir = new ModelContenir();
			if (isset($_POST['(int)renvoyer'])) {
				$_POST['(int)actifEditeur'] = 1;
			} else {
				$_POST['(int)renvoyer'] = 0;
			}

			$contenir->setArrayType($_POST);

			//Obtention du colis
			$colisFound = ModelColis::getID($contenir->idColis);
			if (!$colisFound) {
				static::viewCreateColis(NULL,'Le colis est introuvable');
				return false;
			} else {
				$colis = $colisFound[0];
			}

			if (!isset($_POST['(int)idJeu'])) {
				static::viewCreateContenir($colis,$contenir,NULL, 'Le champ jeu est obligatoire');
				return false;
			}

			require_once File::buildPath(array('model', 'modelJeu.php'));
			$jeuFound = ModelJeu::getID($contenir->idJeu);
			if (!$jeuFound) {
				static::viewCreateContenir($colis,$contenir,NULL,'L\'éditeur est introuvable');
				return false;
			}

			unset($contenir->idContenir);

			$contenir->create();

			//Ici on doit renvoyer vers le remplissage du colis.
			$info = "Le jeu a été ajouté";
			self::consult($colis->idColis,$info);
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
		}*/

		public static function actionDeleteColis() {
			require_once File::buildPath(array('controller', 'controllerEditeur.php'));

			if (!isset($_GET['idColis'])) {
				$error = "Veuillez selectionner un colis valide en passant par l'éditeur";
				ControllerEditeur::readAll(NULL, $error);
				return false;
			}

			$colisFound = ModelColis::getID($_GET['idColis']);
			if (!$colisFound) {
				$error = "Veuillez selectionner un contact valide en passant par l'éditeur";
				ControllerEditeur::readAll(NULL, $error);
				return false;
			}

			$colis = $colisFound[0];

			//Il faut supprimer les contenirs de ce colis avant de le supprimer completement
			//On récupère la liste des "contenirs" lié à ce colis
			$where = 'idColis = :idColis';
			$values = array('idColis' => $colis->idColis);

			require_once File::buildPath(array('model','modelContenir.php'));
			$listContenir = ModelContenir::readOrFalse($where,$values);

			foreach($listContenir as $contenir){
				$contenir->delete();
			}
			$colis->delete();

			ControllerEditeur::consult($colis->idEditeur, 'Colis supprimé');
		}

		public static function actionDeleteContenir() {
			if (!isset($_GET['idContenir'])) {
				$error = "Erreur";
				self::readAll(NULL, $error);
				return false;
			}

			$contenirFound = ModelContenir::getID($_GET['idContenir']);
			if (!$contenirFound) {
				$error = "Erreur";
				self::readAll(NULL, $error);
				return false;
			}


			$contenir = $contenirFound[0];

			/*require_once File::buildPath(array('model','modelColis.php'));
			$colis = ModelColis::getID($contenir->idColis)[0];*/
			$contenir->delete();
			self::consult($contenir->idColis, 'Jeu retiré du colis');
		}



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

				//On récupère la liste des "contenirs" lié à ce colis
				$where = 'idColis = :idColis';
				$values = array('idColis' => $colis->idColis);

				require_once File::buildPath(array('model','modelContenir.php'));
				$listContenir = ModelContenir::readOrFalse($where,$values);

			} else {
				$error = "Veuillez sélectionner un colis";
			}

			require_once File::buildPath(array('view', 'view.php'));

		}

	}


?>
