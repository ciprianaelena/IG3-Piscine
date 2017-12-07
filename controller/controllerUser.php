<?php
	require_once File::buildPath(array('model', 'modelUser.php'));

	class ControllerUser {

		// Affiche un formulaire d'inscription
		public static function register() {
			$controller = 'user';
			$view       = 'register';
			$title      = 'Register';

			require_once File::buildPath(array('view', 'view.php'));
		}

		// Enregistre l'utilisateur dans la base de données
		public static function registered() {
			$login          = $_POST['login'];
			$password       = $_POST['password'];
			$passwordRetype = $_POST['passwordRetype'];
			$email          = $_POST['email'];

			$controller = 'user';
			$view       = 'register';
			$title      = 'Register';

			// Le login est trop court
			if (strlen($login) < 3) {
				$error = 'The login must be at least 3 characters long';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// Le login est trop long
			if (strlen($login) > 20) {
				$error = 'The login must be less than 20 chaarcters long';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// Le mot de passe est trop court
			if (strlen($password) < 4) {
				$error = 'The password must be at least 4 characters long';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// Le mot de passe est trop long
			if (strlen($password) > 32) {
				$error = 'The password must be less than 32 chaarcters long';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// Les mots de passe ne correspondent pas
			if ($password != $passwordRetype) {
				$error 		    = 'Passwords missmatch';
				$password       = '';
				$passwordRetype = '';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// Vérifie que le nom d'utilisateur n'est pas déjà utilisé
			if (ModelUser::getUserLogin($login)) {
				$error = 'This login is already used';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			if (strlen($email) > 300) {
				$error = 'The email must be less than 300 chaarcters long';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// Vérifie que l'adresse email est valide
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error = 'The email format is invalid';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// Vérifie que l'adresse email n'est pas déjà utilisé
			if (ModelUser::getUserEmail($email)) {
				$error = 'The email adress is already used by another account';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			try {
				// On crypte le mot de passe
				$password = Usefull::crypt($password);
				// Ajoute l'utilisateur dans la base de données
				ModelUser::registered($login, $password, $email);

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
		public static function connect() {
			$controller = 'user';
			$view       = 'connect';
			$title      = 'Connection';


			$where = 'idUser = :whereUserID';
			$values = array(
				'whereUserID' => 99
 			);

			ModelUser::delete(ModelUser::$className, $where, $values);

			require_once File::buildPath(array('view', 'view.php'));	
		}

		// Vérifie la connexion
		public static function connected() {
			$login    	   = $_POST['login'];
			$password 	   = $_POST['password'];
			$passwordCrypt = Usefull::crypt($password);

			$controller = 'user';
			$view       = 'connect';
			$title      = 'Connect';

			// Essaye de connecter l'utilisateur
			try {
				$user = ModelUser::connected($login, $passwordCrypt);
			} catch (PDOException $exception) {
				if (Conf::$debug) {
					echo $exception->getMessage();
					die();
				}
				$error = 'Your password / login is wrong';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			if (!$user) {
				$error = 'Your password / login is wrong';
				require_once File::buildPath(array('view', 'view.php'));
				return false;
			}

			// Démarre la session
			$_SESSION['id']    = $user[0]->idUser;
			$_SESSION['login'] = $user[0]->login;
			$_SESSION['admin'] = $user[0]->admin;
		}
		
		// Déconnecte un utilisateur
		public static function disconnect() {
			// Vérifie que l'utilisateur est déconnecté
			if (Usefull::isConnected()) {
				session_unset();
				session_destroy();
				setcookie(session_name(), '', time() - 1);
			}
		}
	}
?>