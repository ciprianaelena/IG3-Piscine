<?php
	require_once File::buildPath(array('model', 'modelUser.php'));

	class ControllerUser {

		// Display a registering form
		public static function viewRegister() {
			$controller = 'user';
			$view = 'register';
			$title = 'Register';

			require_once File::buildPath(array('view', 'view.php'));
		}

		// Register a user in the database
		public static function actionRegister() {
			$controller = 'user';
			
			$user = new ModelUser();
			$user->setArray($_POST);
			$user->activationURL = Usefull::generateRandomHex();

			try {
				$valid = $user->checkRegister();
			} catch (Exception $e) {
				$view = 'register';
				$title = 'Register';
				$error = $e->getMessage();
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}
			
			// Add the user in the database
			$user->password = Usefull::crypt($user->password);
			$user->create();
			$user->password = NULL;
			$view = 'connect';
			$title = 'Connexion';
			$info = 'Register successfull';
			require_once File::buildPath(array('view', 'view.php'));
		}

		// Display a login form
		public static function viewConnect($error = NULL) {
			$controller = 'user';
			$view = 'connect';
			$title = 'Connexion';

			require_once File::buildPath(array('view', 'view.php'));
		}

		// Try to connect a user
		public static function actionConnect() {
			$controller = 'user';
			$view = 'connect';
			$title = 'Connexion';

			$user = new ModelUser();
			$user->setArray($_POST);
			$user->password = Usefull::crypt($user->password);

			try {
				$userFound = $user->checkConnect();
			} catch (PDOException $exception) {
				if (Conf::$debug) {
					echo $exception->getMessage();
					die();
				}
				$error = 'Sorry we can\'t connect you now, try again later!';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// User not found
			if (!$userFound) {
				$error = 'Login or password is incorrect!';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// Else, connect the user
			$user = $userFound[0];
			$user->connect();
			
			require_once File::buildPath(array('controller', 'controllerEditeur.php'));
			ControllerEditeur::readAll('Connexion réussi');
		}
		
		// Disconnect a user
		public static function actionDisconnect() {
			$controller = 'user';
			$view = 'connect';
			$title = 'Connection';
			$info = 'Disconnected';
			ModelUser::disconnect();
			require_once File::buildPath(array('view', 'view.php'));
		}
	}
?>