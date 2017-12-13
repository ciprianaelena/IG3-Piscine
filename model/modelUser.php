<?php
	require_once File::buildPath(array('library', 'usefull.php'));
	require_once File::buildPath(array('model', 'modelCRUD.php'));

	class ModelUser extends ModelCRUD {

		public static $className = 'ModelUser';
		protected static $tableName = 'user';

		// Retourne un utilisateur par son id
		public static function getUserID($idUser) {
			$where = 'idUser = :idUser';
			$values = array('idUser' => $idUser);
			return ModelUser::readOrFalse(ModelUser::$className, $where, $values);
		}

		// Retourne un utilisateur par son login ou false si aucun utilisateur n'est trouvé
		public static function getUserLogin($login) {
			$where = 'login = :login';
			$values = array('login' => $login);
			return ModelUser::readOrFalse(ModelUser::$className, $where, $values);
		}

		// Retourne un utilisateur par sont email
		public static function getUserEmail($email) {
			$where = 'email = :email';
			$values = array('email' => $email);
			return ModelUser::readOrFalse(ModelUser::$className, $where, $values);
		}

		// Vérifie les conditions d'inscriptions
		public static function checkRegister($login, $password, $passwordRetype, $email) {
			// Le login est trop court
			if (strlen($login) < 3) {
				throw new Exception('The login must be at least 3 characters long');
			}

			// Le login est trop long
			if (strlen($login) > 20) {
				throw new Exception('The login must be less than 20 charcters long');
			}

			// Le mot de passe est trop court
			if (strlen($password) < 4) {
				throw new Exception('The password must be at least 4 characters long');
			}

			// Le mot de passe est trop long
			if (strlen($password) > 32) {
				throw new Exception('The password must be less than 32 charcters long');
			}

			// Les mots de passe ne correspondent pas
			if ($password != $passwordRetype) {
				throw new Exception('Passwords missmatch');
			}

			// Vérifie que le nom d'utilisateur n'est pas déjà utilisé
			if (ModelUser::getUserLogin($login)) {
				throw new Exception('This login is already used');
			}

			if (strlen($email) > 300) {
				throw new Exception('The email must be less than 300 chaarcters long');
			}

			// Vérifie que l'adresse email est valide
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				throw new Exception('The email format is invalid');
			}

			// Vérifie que l'adresse email n'est pas déjà utilisé
			if (ModelUser::getUserEmail($email)) {
				throw new Exception('The email adress is already used by another account');
			}

			return true;
		}

		// Enregistre un utilisateur dans la base de données
		public static function register($login, $password, $email) {
			// On crypte le mot de passe
			$password = Usefull::crypt($password);
			// Génére une URL d'activation
			$activationURL = Usefull::generateRandomHex();

			$args = array(
				'login' => $login,
				'password' => $password,
				'email' => $email,
				'activationURL' => $activationURL
			);

			ModelUser::create(ModelUser::$className, $args);
		}

		// Vérifie si il est possible de trouver un utilisateur avec ce login / mot de passe
		public static function checkConnect($login, $password) {
			// On crypte le mot de passe
			$password = Usefull::crypt($password);

			// Query
			$where = 'login = :login AND password = :password';
			$values = array(
				'login' => $login,
				'password' => $password
			);

			return ModelUser::readOrFalse(ModelUser::$className, $where, $values);
		}

		// Connecte réellement l'utilisateur
		public static function connect($user) {
			// Démarre la session
			$_SESSION['id']    = $user->idUser;
			$_SESSION['login'] = $user->login;
			$_SESSION['admin'] = $user->admin;
		}
	}
?>