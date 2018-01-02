<?php
	require_once File::buildPath(array('model', 'modelFestival.php'));

	class ControllerFestival {

		public static function readAll($info = '', $error = '') {
			$controller = 'festival';
			$view = 'readAll';
			$title = 'Liste des festivals';

			$listFestival = ModelFestival::read();
			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function viewCreate() {
			$controller = 'festival';
			$view = 'create';
			$title = 'Créer un festival';

			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function actionCreate() {
			$controller = 'festival';
			$title = 'Créer un festival';
			$festival = new ModelFestival();
			$festival->setArrayType($_POST);

			// L'année du festival est obligatoire
			if (!isset($festival->anneeFestival) && $festival->anneeFestival == '') {
				$view = 'create';
				$error = 'L\'année du festival est incorrecte';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			$anneUnique = $festival->isAnneUnique();

			if (!$anneUnique) {
				$view = 'create';
				$error = 'Un festival à déjà était créer pour cette année';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			$festival->create();
			$info = 'Nouveau festival créer';
			self::readAll($info);
		}

		public static function viewUpdate() {
			$controller = 'festival';
			$view = 'update';
			$title = 'Modifier un festival';

			if (isset($_GET['idFestival'])) {
				$where = 'idFestival = :idFestival';
				$values = array('idFestival' => $_GET['idFestival']);
				$festival = ModelFestival::readOrFalse($where, $values);
				if (!$festival) {
					unset($festival);
					$error = "Festival invalide";
					self::readAll(NULL, $error);
				} else {
					$festival = $festival[0];
				}
			} else {
				$error = 'Veuillez selectionner un festival à modifié';
				self::readAll(NULL, $error);
			}

			require_once File::buildPath(array('view', 'view.php'));
		}

		public static function actionUpdate() {
			$controller = 'festival';
			$view = 'update';
			$title = 'Modifier un festival';

			$festival = new ModelFestival();
			$festival->setArrayType($_POST);

			$festivalFound = ModelFestival::getID($festival->idFestival);

			if (!$festivalFound) {
				$error = 'Impossible de modifier le festival';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// Si l'année du festival change il faut vérifier qu'elle reste unique!
			if ($festival->anneeFestival != $festivalFound[0]->anneeFestival) {
				$anneUnique = $festival->isAnneUnique();
				if (!$anneUnique) {
					$error = 'L\'année du festival doit être unique';
					require_once File::buildPath(array('view', 'view.php'));
					return false;
				}
			}

			$info = 'Festival mis à jour';
			$festival->update();
			self::readAll($info);
		}

		public static function actionDelete() {
			if (!isset($_GET['idFestival'])) {
				static::readAll('', 'Impossible de supprimer ce festival');
				return false;
			}

			$festivalFound = ModelFestival::getID($_GET['idFestival']);
			if (!$festivalFound) {
				static::readAll('', 'Impossible de supprimer ce festival');
				return false;
			}

			$festival = $festivalFound[0];
			$festival->delete();

			static::readAll('Festival supprimer');
		}
	}
?>