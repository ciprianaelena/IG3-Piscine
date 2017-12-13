<?php
	require_once File::buildPath(array('model', 'modelUser.php'));

	class ControllerUser {

		// Affiche un formulaire d'inscription
		public static function viewRegister() {
			$controller = 'user';
			$view       = 'register';
			$title      = 'Register';

			require_once File::buildPath(array('view', 'view.php'));
		}

		// Enregistre l'utilisateur dans la base de données
		public static function actionRegister() {
			$login          = $_POST['login'];
			$password       = $_POST['password'];
			$passwordRetype = $_POST['passwordRetype'];
			$email          = $_POST['email'];

			$controller = 'user';
			$view       = 'register';
			$title      = 'Register';
			
			// Vérifie que les informations soit valides
			try {
				ModelUser::checkRegister($login, $password, $passwordRetype, $email);
			} catch (Exception $e) {
				$error = $e->getMessage();
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}
			
			// Ajoute l'utilisateur dans la base de données
			try {
				ModelUser::register($login, $password, $email);
			} catch (PDOException $exception) {
				if (Conf::$debug) {
					echo $exception->getMessage();
					die();
				}
				$error = 'Sorry we can\'t register you now, try again later!';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}
		}

		// Affiche un formulaire de connexion
		public static function viewConnect() {
			$controller = 'user';
			$view       = 'connect';
			$title      = 'Connection';

			require_once File::buildPath(array('view', 'view.php'));	
		}

		// Vérifie la connexion
		public static function actionConnect() {
			$login    = $_POST['login'];
			$password = $_POST['password'];

			$controller = 'user';
			$view       = 'connect';
			$title      = 'Connect';

			// Essaye de connecter l'utilisateur
			try {
				$user = ModelUser::checkConnect($login, $password);
			} catch (PDOException $exception) {
				if (Conf::$debug) {
					echo $exception->getMessage();
					die();
				}
				$error = 'Sorry we can\'t connect you now, try again later!';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// On n'a pas trouvé l'utilisateur
			if (!$user) {
				$error = 'Login or password is incorrect!';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// Sinon on connecte l'utilisateur
			ModelUser::connect($user[0]);
			require_once File::buildPath(array('view', 'view.php'));
		}
		
		// Déconnecte un utilisateur
		public static function actionDisconnect() {
			// Vérifie que l'utilisateur est déconnecté
			if (Usefull::isConnected()) {
				session_unset();
				session_destroy();
				setcookie(session_name(), '', time() - 1);
			}
		}
	}
?>